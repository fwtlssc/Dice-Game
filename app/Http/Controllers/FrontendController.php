<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class FrontendController extends Controller
{
    public function index(){
        return 'frontend index';
    }
    public function roll(){
        return 'roll';
    }

  
}
