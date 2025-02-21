<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @param string $role
     * @return Response
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('auth.showLogin');
        }

        $user = Auth::user();
        if ($role === User::ROLE_ADMIN && $user->role !== User::ROLE_ADMIN) {
            return response()->view('shop.page.404', [], 403);

        }

        if ($role === User::ROLE_CUSTOMER && $user->role !== User::ROLE_CUSTOMER) {
            return response()->view('shop.page.404', [], 403);
        }
        return $next($request);
    }
}
