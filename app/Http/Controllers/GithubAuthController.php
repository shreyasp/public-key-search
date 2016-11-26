<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Unirest\Request as uRequest;

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
  public function redirect_oauth(Request $request) {
    // This redirection is two step process, 1. We get code from GH, 2. Post the code and get token
    $response = NULL;
    $accessToken = NULL;

    if($request->input('code') !== NULL) {
      // Get the code and use it for getting Access token from github
      $code = $request->input('code');
      $headers = Array('Accept' => 'application/json');
      $query = Array('code' => $code, 'client_id' => 'e2839380361040bb3f3f',
        'client_secret' => 'a4577e6bcf71872a3eae3e793ce5ad4fdda36fc4');

      $response = uRequest::post('https://github.com/login/oauth/access_token', $headers,
        $query);

      $json = \Unirest\Request\Body::Json($response->body);
      $accessToken = json_decode($json)->access_token;
    }

    
  }
}
