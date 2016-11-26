<?php

namespace App\Http\Middleware;

use Closure;

class FormInputValidation
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
    $password = $request->input('password');
    $repeat_password = $request->input('confirm_password');

    if($password === $repeat_password) {
      return $next($request);
    }
    else {
      return redirect('/');
    }
  }
}
