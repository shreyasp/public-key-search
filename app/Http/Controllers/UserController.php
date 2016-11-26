<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Cookie;
use App\Users;

class UserController extends Controller
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

    public function createNewUser(Request $request){
      // Create new user from register route
      $userid = $request->input('userid'); //email
      $password = $request->input('password');
      $fullname = $request->input('fullname');

      if(strpos($fullname, " ")) {
        list($firstName, $lastName) = explode(" ", $fullname); // Split First and Last name
      }
      else {
        $firstName = $fullname;
      }

      $sessionId = bin2hex(random_bytes(16));

      $user = new Users;

      $user->email = $userid;
      $user->password = password_hash($password, CRYPT_BLOWFISH);
      $user->firstName = $firstName;

      if(isset($lastName)) {
          $user->lastName = $lastName;
      }

      $user->sessionId = $sessionId;
      $user->save();

      Cache::forever($userid, $sessionId); // Put the session id in cache forever
      $cookie = new Cookie('sessionUser', $userid);

      $redirect_url = 'main/'.strtolower($firstName);
      return redirect($redirect_url)->withCookie($cookie);
    }

    public function authenticateUser(Request $request){
      // Authenticate existing users for login
      return redirect('main/shreyas');

    }

    public function logoutUser(Request $request){
      $sessionUser = $request->cookie('sessionUser');

      // Proceed to cleanup the cookies and cache for the user
      Cache::forget($sessionUser);
      $cookie = new Cookie('sessionUser', '');
      // Get user from DB, clean his session ID

      //Redirect to main page
      return redirect('/')->withCookie($cookie);
    }
}
