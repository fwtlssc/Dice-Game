<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Exceptions\IllegalArgumentException;

class FrontendController extends Controller
{
    public function index(){
        return view('index')->with("results",request()->session()->get('results'));
    }
    public function roll(Request $request){
        $request->validate([
            'dices' => 'required|integer|min:1|max:'.config("dice.max_num"),
            'sides' => 'required|array',
            'sides.*' => 'integer|min:1|max:'.config("dice.max_sides")
        ]);
        if($request->dices != count($request->sides)){
            throw new IllegalArgumentException("Number of dices must be equal to number of sides");
        }
        $roll_results = [];
        for($i=0; $i<$request->dices; $i++){
             array_push($roll_results, rand(1,$request->sides[$i]));
        }
        request()->session()->flash('results',$roll_results);
        return redirect()->back();
    }

  
}
