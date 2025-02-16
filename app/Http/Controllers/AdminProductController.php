<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminProductController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $products = Product::all();
        return view('admin.page.product.index',
            [
                'products' => $products
            ]);
    }

    public function showCreate(): View|Factory|Application
    {
        $categories = Category::all();
        return view('admin.page.product.create',
            [
                'categories' => $categories,
            ]);
    }

    public function showUpdate(): View|Factory|Application
    {
        return view('admin.page.product.update');
    }

    public function postCreate(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $product = new Product();
            $product->fill($input);
            $product->save();
            if ($request->hasFile('detail_image')) {
                $product->detail_image = $this->handleUploadFile($request->file('detail_image'), $product, 'detail_image');
            }
            if ($request->hasFile('detail_image_1')) {
                $product->detail_image_1 = $this->handleUploadFile($request->file('detail_image_1'), $product, 'detail_image_1');
            }
            if ($request->hasFile('detail_image_2')) {
                $product->detail_image_2 = $this->handleUploadFile($request->file('detail_image_2'), $product, 'detail_image_2');
            }
            if ($request->hasFile('detail_image_3')) {
                $product->detail_image_3 = $this->handleUploadFile($request->file('detail_image_3'), $product, 'detail_image_3');
            }
            $product->save();

            $product->code = 'SP-' . str_pad($product->id, 3, '0', STR_PAD_LEFT);
            $product->save();
            DB::commit();
            return redirect()->route('admin.product.showIndex');
        }catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function getDelete($id){
        DB::beginTransaction();
        try {
            Product::where('id', $id)->delete();
            DB::commit();
            return redirect()->route('admin.product.showIndex')->with('deleteProduct', "Bạn đã xoá sản phẩm thành công!!");
        }catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function searchProduct(Request $request): View|Factory|Application
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->orWhere('price', 'like', '%' . $query . '%')
            ->get();

        return view('admin.page.product.search-results', compact('products'));
    }

    private function handleUploadFile($file, $model, $type): string
    {
        $fileName = $type . '_' . $model->id . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storePubliclyAs('products/' . $type, $fileName);
        return asset('storage/' . $filePath);
    }
}
