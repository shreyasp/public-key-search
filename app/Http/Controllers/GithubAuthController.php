<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Unirest\Request as uRequest;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Support\Facades\DB;
use App\SocialLogin;

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
    // Obtain the Github ClientID and Client Secret from environment
    $clientId = env('CLIENT_ID');
    $clientSecret = env('CLIENT_SECRET');

    // Get all basics to Check or create a record
    $sessionUser = $request->cookie('sessionUser');
    $userId = DB::table('users')->where('email', $sessionUser)->value('id');
    $userName = $request->input('username');

    // Check whether DB already has record
    $account = new SocialLogin();
    $record = $account->query()->where('userId', $userId)->where('userName', $userName)->first();

    if(!isset($record)) {
      // Create a record for social login as there is no existing
      $account->websiteName = 'github';
      $account->userId = $userId;
      $account->userName = $userName;
      $account->save();

      // Build the query to authorize the application
      $query = Array('client_id' => $clientId, 'client_secret' => $clientSecret);
      $url_query = http_build_query($query);

      // Redirect to GH for authorizing the application
      return redirect('https://github.com/login/oauth/authorize?'.$url_query);
    }
    // Do not duplicate the records, redirect to main page silently
    else {
      $firstName = DB::table('users')->where('email', $sessionUser)->value('firstName');
      return redirect('main/'.strtolower($firstName));
    }

  }

  public function redirect_oauth(Request $request) {
    // This redirection is two step process, 1. We get code from GH, 2. Post the code and get token
    $response = NULL;
    $authToken = NULL;

    // Client ID and Client Secret from the environment
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
      $authToken = json_decode($json)->access_token;
    }

    // Update the authToken in social login table for the user
    $userId = DB::table('users')->where('email', $sessionUser)->value('id');
    DB::table('social_logins')->where('userId', $userId)->update(['authToken' => $authToken]);

    // Get the firstName for the user to build URL
    $sessionUser = $request->cookie('sessionUser');
    $firstName = DB::table('users')->where('email', $sessionUser)->value('firstName');

    // Finally redirect to
    return redirect('main/'.strtolower($firstName))->withCookie($cookie);
  }
}
