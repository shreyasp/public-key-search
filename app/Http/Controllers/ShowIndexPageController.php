<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class ShowIndexPageController extends BaseController
{
    //

    public function __invoke(){
      return view('index');
    }
}
