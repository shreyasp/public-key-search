<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\Cache;

use Closure;

class UserSession
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $sessionId = NULL;
    $user = $request->cookie('sessionUser');

    if(Cache::has($user)) {
      $sessionId = Cache::get($user);
    }

    if(isset($sessionId)) {
      return $next($request);
    }
    else{
      return redirect('/');
    }
  }
}
