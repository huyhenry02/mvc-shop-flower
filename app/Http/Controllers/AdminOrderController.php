<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
