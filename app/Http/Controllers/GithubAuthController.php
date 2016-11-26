<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Unirest\Request as uRequest;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\DB;

class GithubAuthController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  //
  public function connect(Request $request) {
    $clientId = env('CLIENT_ID');
    $clientSecret = env('CLIENT_SECRET');

    // $headers = Array('Accept' => 'applcation/json');
    $query = Array('client_id' => $clientId, 'client_secret' => $clientSecret);
    $url_query = http_build_query($query);

    return redirect('https://github.com/login/oauth/authorize?'.$url_query);
  }

  public function redirect_oauth(Request $request) {
    // This redirection is two step process, 1. We get code from GH, 2. Post the code and get token
    $response = NULL;
    $accessToken = NULL;

    $clientId = env('CLIENT_ID');
    $clientSecret = env('CLIENT_SECRET');

    // Connecting for the first time, post-authorizing the application
    if($request->input('code') !== NULL) {
      // GH provides a code to consume, and get the access token in return
      $code = $request->input('code');
      $headers = Array('Accept' => 'application/json');
      $query = Array('code' => $code, 'client_id' => $clientId, 'client_secret' => $clientSecret);

      $response = uRequest::post('https://github.com/login/oauth/access_token', $headers,
        $query);

      $json = \Unirest\Request\Body::Json($response->body);
      $accessToken = json_decode($json)->access_token;
    }

    $sessionUser = $request->cookie('sessionUser');
    $firstName = DB::table('users')->where('email', $sessionUser)->value('firstName');
    // $cookie = new Cookie('github_access_token', $accessToken);

    // Add the values to Social Login table with foreign from user table

    // Finally redirect to
    return redirect('main/'.$firstName)->withCookie($cookie);
  }
}
