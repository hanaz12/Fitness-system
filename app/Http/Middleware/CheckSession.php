<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Cuomponent\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
{

    if (!session()->has('user_id') || !session()->has('user_role')) {

        return redirect()->route('logined')->with('error', 'You must log in first.');
    }

    return $next($request);
}
}
