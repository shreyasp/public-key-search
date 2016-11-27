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

      // Caveat: Expecting a name with 2 bits, but there can be larger names, this needs to be taken
      // care at some point of time.
      if(strpos($fullname, " ")) {
        list($firstName, $lastName) = explode(" ", $fullname); // Split First and Last name
      }
      else {
        $firstName = $fullname;
      }

      // Generate 16 character random session id to be stored in DB and cache
      $sessionId = bin2hex(random_bytes(16));

      // Get a user model object to insert in the database.
      $user = new Users;

      $user->email = $userid;
      $user->password = password_hash($password, CRYPT_BLOWFISH);
      $user->firstName = $firstName;

      // Skip last name, If user hasn't specified it
      if(isset($lastName)) {
          $user->lastName = $lastName;
      }

      $user->sessionId = $sessionId;
      $user->save();

      Cache::forever($userid, $sessionId); // Put the session id in cache forever
      $cookie = new Cookie('sessionUser', $userid); // Generate a cookie for username persistentcy

      $redirect_url = 'main/'.strtolower($firstName);
      return redirect($redirect_url)->withCookie($cookie);
    }

    public function authenticateUser(Request $request){
      // Authenticate existing users for login
      return redirect('main/shreyas');

    }

    public function logoutUser(Request $request) {
      // Get the session user from cookie and proceed with cleanup
      $sessionUser = $request->cookie('sessionUser');

      // Proceed to cleanup the cookies and cache for the user
      Cache::forget($sessionUser);
      $cookie = new Cookie('sessionUser', '');

      // Get user from DB, clean his session ID.
      // A dangerous way to update directly in the DB ;), but should be harmless in current context
      DB::table('users')->where('email', $sessionUser)->update(['sessionId' => NULL]);

      //Redirect to main page
      return redirect('/')->withCookie($cookie);
    }
}
