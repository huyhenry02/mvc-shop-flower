<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Mail\SendMail;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminOrderController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $orders = Order::all();
        return view('admin.page.order.index',
            [
                'orders' => $orders
            ]);
    }

    public function showCreate(): View|Factory|Application
    {
        $products = Product::all();
        return view('admin.page.order.create',
            [
                'products' => $products
            ]);
    }

    public function showUpdate(Order $order): View|Factory|Application
    {
        $products = Product::all();
        return view('admin.page.order.update',
            [
                'order' => $order,
                'products' => $products
            ]
        );
    }

    public function showDetail(Order $order): View|Factory|Application
    {
        return view('admin.page.order.detail',
            [
                'order' => $order
            ]
        );
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['status'] = Order::STATUS_PENDING;
            $input['user_id'] = auth()->id();
            $input['order_date'] = date('Y-m-d');
            $input['code'] = 'OD' . date('Ymd') . '-' . $input['user_id'] . '/' . random_int(1, 100);
            $inputOrderDetails = $input['products'];
            $totalAmount = 0;
            foreach ($inputOrderDetails as $product) {
                $product['sub_total'] = (int)str_replace('.', '', $product['sub_total']);
                $totalAmount += $product['sub_total'];
            }
            $input['total'] = $totalAmount;
            $order = new Order();
            $order->fill($input);
            $order->save();

            foreach ($inputOrderDetails as $inputOrderDetail) {
                $orderDetail = new OrderDetail();
                $inputOrderDetail['sub_total'] = (int)str_replace('.', '', $inputOrderDetail['sub_total']);
                $orderDetail->fill($inputOrderDetail);
                $orderDetail->order_id = $order->id;
                $orderDetail->save();
            }

            DB::commit();
            return redirect()->route('admin.order.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function postUpdate(Order $order, Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $order->fill($input);
            $order->save();
            DB::commit();
            return redirect()->route('admin.order.showIndex');
        }catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function updateStatus(Request $request, Order $order): JsonResponse
    {
        try {
            $input = $request->all();
            if ($input['status'] === 'rejected' && empty($input['reject_reason'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lý do hủy đơn hàng không được để trống.'
                ]);
            }

            $order->status = $input['status'];

            if ($input['status'] === 'rejected') {
                $order->reject_reason = $input['reject_reason'];
            }
            $order->fill($input);
            $order->save();

            $dataSendMail = [
                'order' => $order,
                'orderDetails' => $order->orderDetails
            ];
            Mail::to([$order->user?->email, $order->shipping_email])->send(new SendMail(
                $dataSendMail,
                'update-status-order',
                'Thông báo trạng thái đơn hàng'
            ));
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật trạng thái đơn hàng thành công.'
            ]);

        }catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function getSearch(Request $request)
    {
        try {
            $query = $request->input('query');
            $orders = Order::where('total', 'like', '%' . $query . '%')
                            ->orWhere('order_date', 'like', '%' . $query . '%')
                            ->orWhere('code', 'like', '%' . $query . '%')
                            ->orWhereHas('user', function ($q) use ($query) {
                                $q->where('name', 'like', '%' . $query . '%');
                            })
                            ->get();
            DB::commit();
            return view('admin.page.order.search-results',compact('orders'));
        }catch(Exception $e){
            DB::rollBack();
            return back()->withInput()->withErrors($e->getMessage());
        }
    }
}

