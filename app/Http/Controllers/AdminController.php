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
        $request->validate([
            'max_num' => 'required|integer|min:1',
            'max_sides' => 'required|integer|min:1'
         ]);

         $sb = "";
         $a = ["'max_num'", "'max_sides'"];
         $k = 0;
         $dice_file = fopen("../config/dice.php", "r");
         while(!feof($dice_file)) {
            $r = trim(fgets($dice_file));
            for($i=0, $p=0; $i<strlen($r); $i++,$p++){
                if($k == count($a) || $r[$i] != $a[$k][$p]){
                    $sb .= $r;
                    break;
                }
                if($p+1 == strlen($a[$k])){
                    $sb .= "\t".  $a[$k] . " => "
                        . $request->{substr($a[$k],1,-1)} .",";
                    $k++;
                    break;
                }
            }
            $sb .= "\n";
          }
         fclose($dice_file);
         $dice_file = fopen("../config/dice.php", "w");
         fwrite($dice_file, $sb);
         fclose($dice_file);

         return redirect()->back();
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
                Session::flash("failed","User name or password is not corrent");
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
