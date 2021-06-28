<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function update(Request $request){
        return 'frontend update';
    }

    public function loginIndex(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'userName' => 'required',
            'password' => 'required',
        ]);
        if($request->userName != config('admin.userName') ||
             $request->password != config('admin.password')){
                Session::flash("failed","اسم المستخدم أو كلمة المرور غير صحيحة");
                return redirect()->back();
        }
        request()->session()->regenerate();
        request()->session()->put('authenticated','true');
        return redirect()->route('admin.index');
    }

    public function logout(Request $request){
        request()->session()->invalidate();
        return redirect()->back();
    }

   
}
