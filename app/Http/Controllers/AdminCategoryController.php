<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminCategoryController extends Controller
{

    public function showIndex(): View|Factory|Application
    {
        $categories = Category::all();
        return view('admin.page.category.index',
            [
                'categories' => $categories
            ]
        );
    }

    public function showCreate(): View|Factory|Application
    {
        return view('admin.page.category.create');
    }

    public function showUpdate(Category $category): View|Factory|Application
    {
        return view('admin.page.category.update',
            ['category' => $category]
        );
    }

    public function postCreate(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $category = new Category();
            $category->fill($input);
            $category->save();
            DB::commit();
            return redirect()->route('admin.category.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function postUpdate(Category $category, Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $input = $request->all();
            $category->fill($input);
            $category->save();
            DB::commit();
            return redirect()->route('admin.category.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function delete(Category $category): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $category->products()->delete();
            $category->delete();
            DB::commit();
            return redirect()->route('admin.category.showIndex');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    public function search(Request $request)
    {
//        DB::beginTransaction();
        try {
            $query = $request->input('query');
            $categories = Category::where('name', 'like', "%".$query."%")
                ->orWhere('description', 'like', "%".$query."%")
                ->get();
            DB::commit();
            return view('admin.page.category.search-results',compact('categories'));
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }


}
