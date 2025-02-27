<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class AuthController extends Controller
{
    public function showLogin(): View|Factory|Application
    {
        return view('auth.login');
    }

    public function showRegister(): View|Factory|Application
    {
        return view('auth.register');
    }

    public function postRegister(Request $request): ?RedirectResponse
    {

        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['role'] = 'customer';
            $input['password'] = bcrypt($input['password']);
            $user = new User();
            $user->fill($input);
            $user->save();
            DB::commit();
            return redirect()->route('auth.showLogin')->with('success', 'Register successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('auth.showRegister')->with('error', $e->getMessage());
        }
    }

    public function postLogin(Request $request): ?RedirectResponse
    {
        try {
            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                if (auth()->user()->role === 'admin') {
                    return redirect()->route('admin.user.showIndex');
                }
                return redirect()->route('customer.showIndex');
            }
            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->route('auth.showLogin')->with('error', $e->getMessage());
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('auth.showLogin');
    }
}
