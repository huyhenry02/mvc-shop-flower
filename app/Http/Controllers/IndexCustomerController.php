<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Mail\SendMail;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class IndexCustomerController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        return view('shop.page.index');
    }

    public function showProducts(): View|Factory|Application
    {
        $categories = Category::all();
        $products = Product::paginate(9);
        return view('shop.page.products',
            [
                'categories' => $categories,
                'products' => $products
            ]);
    }

    public function showProductDetail(Product $product): View|Factory|Application
    {
        return view('shop.page.product-detail',
            [
                'product' => $product
            ]);
    }

    public function showCart(): View|Factory|Application
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalCart = $cartItems->sum('sub_total');
        return view('shop.page.cart',
            [
                'cartItems' => $cartItems,
                'totalCart' => $totalCart
            ]);
    }

    public function showCheckout(): View|Factory|Application
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $totalCart = $cartItems->sum('sub_total');
        return view('shop.page.checkout',
            [
                'cartItems' => $cartItems,
                'totalCart' => $totalCart
            ]);
    }

    public function showContact(): View|Factory|Application
    {
        return view('shop.page.contact');
    }

    public function showYourOrder(): View|Factory|Application
    {
        $orders = Order::where('user_id', auth()->id())->get();
        $data = $orders->map(function ($order) {
            return [
                'code' => $order->code,
                'order_date' => $order->order_date,
                'status' => $order->status,
                'total' => $order->total,
                'items' => $order->orderDetails->map(function ($item) {
                    return [
                        'product_name' => $item->product->name,
                        'quantity' => $item->quantity,
                        'size' => $item->size,
                        'sub_total' => number_format($item->sub_total, 0, ',', '.'),
                    ];
                })->toArray()
            ];
        });
        return view('shop.page.your-order'
            , [
                'orders' => $data
            ]);
    }

    public function addToCart(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['user_id'] = auth()->id();
            $input['quantity'] = $request->has('quantity') ? $request->quantity : 1;
            $input['sub_total'] = Product::find($request->product_id)->price * $input['quantity'];
            $oldCart = Cart::where('user_id', auth()->id())
                ->where('product_id', $request->product_id)
                ->first();
            if ($oldCart) {
                $oldCart->quantity += $input['quantity'];
                $oldCart->sub_total += $input['sub_total'];
                $oldCart->save();
                DB::commit();
                return redirect()->route('customer.showCart')->with('success', 'Add to cart successfully');
            }
            $cart = new Cart();
            $cart->fill($input);
            $cart->save();
            DB::commit();
            return redirect()->route('customer.showCart')->with('success', 'Add to cart successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.showProducts')->with('error', $e->getMessage());
        }
    }

    public function removeCartItem(Cart $cart): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $cart->delete();
            DB::commit();
            return redirect()->route('customer.showCart')->with('success', 'Remove item from cart successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.showCart')->with('error', $e->getMessage());
        }
    }

    public function updateQuantity(Request $request): JsonResponse
    {
        $cartItem = Cart::find($request->cart_id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.']);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->sub_total = $cartItem->quantity * $cartItem->product->price;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'subTotal' => $cartItem->sub_total,
            'message' => 'Cập nhật số lượng thành công.',
            'totalCart' => Cart::sum('sub_total')
        ]);
    }

    public function postCheckout(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['user_id'] = auth()->id();
            $input['order_date'] = date('Y-m-d');
            $input['code'] = 'OD' . date('Ymd') . '-' . $input['user_id'] . '/' . random_int(1, 100);
            $input['status'] = Order::STATUS_PENDING;
            $cartItems = Cart::where('user_id', auth()->id())->get();
            $input['total'] = $cartItems->sum('sub_total');
            $order = new Order();
            $order->fill($input);
            $order->save();

            foreach ($cartItems as $cartItem) {
                $inputOrderDetail = [
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'sub_total' => $cartItem->sub_total,
                ];
                $orderDetail = new OrderDetail();
                $orderDetail->fill($inputOrderDetail);
                $orderDetail->save();
                $cartItem->delete();
            }
            $adminEmails = User::getAdminEmails();
            $dataSendMail = [
                'order' => $order,
                'orderDetails' => $order->orderDetails
            ];
            Mail::to($adminEmails)->send(new SendMail(
                $dataSendMail,
                'new-order',
                'Bạn có đơn hàng mới'
            ));
            DB::commit();
            return redirect()->route('customer.showYourOrder');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.showCart')->with('error', $e->getMessage());
        }
    }

    public function filterProducts(Request $request): JsonResponse
    {
        try {
            $query = Product::with('category');
            if (!empty($request->categories) && $request->has('categories')) {
                $query->whereIn('category_id', $request->categories);
            }

            if ($request->has('search') && !empty($request->search)) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('tags', 'LIKE', '%' . $request->search . '%');
                });
            }

            if (!empty($request->sort_by) && $request->has('sort_by')) {
                if ($request->sort_by === 'asc') {
                    $query->orderBy('price');
                } elseif ($request->sort_by === 'desc') {
                    $query->orderBy('price', 'desc');
                                                                        } elseif ($request->sort_by === 'max') {
                    $query->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
                        ->selectRaw('products.*, sum(order_details.quantity) as total_quantity')
                        ->groupBy('products.id')
                        ->orderBy('total_quantity', 'desc');
                }
            }

            if (!empty($request->min_price) && $request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            $products = $query->paginate(9)->appends($request->query());
            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
