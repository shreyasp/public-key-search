<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Laravel\Lumen\Routing\Controller as BaseController;

class ShowMainPageController extends BaseController
{
  /************************************************************************************************/
  public function __invoke(Request $request, $id){
    $sshKey = NULL;
    $githubUser = $request->cookie('githubUser');

    //Erase the cookie, since it's not needed anymore
    if(Cache::has($githubUser)) {
      $sshKey = Cache::get($githubUser);
      Cache::forget($githubUser);
    }

    return view('main', ['name' => ucfirst($id), 'sshKey' => $sshKey]);
  }
}
