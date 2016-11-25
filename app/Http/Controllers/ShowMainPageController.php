<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class ShowMainPageController extends BaseController
{
    //

    public function __invoke($id){
      return view('main', ['name' => ucfirst($id)]);
    }
}
