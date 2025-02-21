<?php

namespace App\Http\Controllers;

use Exception;
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
        $categories = Category::all();
        return view('admin.page.product.index',
            [
                'products' => $products,
                'categories' => $categories
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

    public function showUpdate(Product $product): View|Factory|Application
    {
        $categories = Category::all();
        return view('admin.page.product.update',
            [
                'product' => $product,
                'categories' => $categories
            ]);
    }

    public function postCreate(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $product = new Product();
            $product->fill($input);
            $product->save();
            $this->handleUploadMultipleFiles($request, $product);
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
        $queryInput = $request->input('queryInput');
        $querySelectOption = $request->input('querySelectOption');
        $products = Product::query();
        if (!empty($querySelectOption)) {
            $products->where('category_id', $querySelectOption);
        }
        if (!empty($queryInput)) {
            $products->where(function ($query) use ($queryInput) {
                $query->where('name', 'like', '%' . $queryInput . '%')
                    ->orWhere('price', 'like', '%' . $queryInput . '%');
            });
        }
        $products = $products->get();
        return view('admin.page.product.search-results', compact('products'));
    }

    public function postUpdate(Request $request, Product $product): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $product->fill($input);
            $this->handleUploadMultipleFiles($request, $product);
            $product->save();
            DB::commit();
            return redirect()->route('admin.product.showIndex');
        }catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    private function handleUploadFile($file, $model, $type): string
    {
        $fileName = $type . '_' . $model->id . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storePubliclyAs('products/' . $type, $fileName);
        return asset('storage/' . $filePath);
    }

    private function handleUploadMultipleFiles(Request $request, Product $product): void
    {
        $imageFields = ['detail_image', 'detail_image_1', 'detail_image_2', 'detail_image_3'];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $product->$field = $this->handleUploadFile($request->file($field), $product, $field);
            }
        }
    }

}
