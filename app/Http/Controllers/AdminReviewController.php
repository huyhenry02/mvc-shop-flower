<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{

    public function showIndex(): View|Factory|Application
    {
        return view('admin.page.review.index');
    }
}
