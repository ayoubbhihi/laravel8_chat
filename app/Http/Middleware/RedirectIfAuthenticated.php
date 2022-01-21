<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

use function Ramsey\Uuid\v1;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @param  string|null  ...$guards
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, $guards = null, $riderectTo = 'login')
  {
    // $guards = empty($guards) ? [null] : $guards;

    // foreach ($guards as $guard) {
    //     if (Auth::guard($guard)->check()) {
    //         return redirect(RouteServiceProvider::HOME);
    //     }
    // }




    if (Auth::guard($guards)->check()) {

      return redirect($riderectTo);
    }




    Auth::shouldUse($guards);


    return  $next($request);
  }
}