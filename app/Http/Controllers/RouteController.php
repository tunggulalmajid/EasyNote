<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteController extends Controller
{
     public function Onboarding(){
        $id = 1;
        return view ("Onboarding", compact('id'));
    }
}
