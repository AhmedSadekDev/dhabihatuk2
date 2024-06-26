<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Role::where('name', 'User')->first();
        if (!auth()->user()) {
            return redirect(route('login'));
        }
        if ($user) {

            if (auth()->user()->role_id == $user->id) {
                session()->flash('error', 'أنت غير مسموح لك لدخول هذه الصفحة');
                return redirect(route('login'));
            }
            return $next($request);

        } else {
            return $next($request);
        }
    }
}
