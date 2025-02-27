<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AdminUserController extends Controller
{
    public function showIndex(): View|Factory|Application
    {
        $users = User::where('role', 'customer')->get();
        return view('admin.page.user.index',
            [
                'users' => $users
            ]
        );
    }

    public function searchUser(Request $request): View|Factory|Application
    {
        $query = $request->input('query');
        $users = User::where('role', User::ROLE_CUSTOMER)
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
            ->get();

        return view('admin.page.user.search-results', compact('users'));
    }
}
