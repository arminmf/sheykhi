<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Up;
use App\Cat;
use Auth;
use App\Http\Requests\NewsRequest;

class UpController extends Controller
{
    public function __construct(){
        if(Auth::check()){
            $user = Auth::user();
            if($user->role!='admin'){
                return redirect(url(''))->send();
            }
        }else{
            return redirect(url(''))->send();
        }
    }
    public function index()
    {
        $up = Up::orderBy('id','desc')->get();
        return view('admin.up',['up'=>$up]);

    }


    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $project = Up::find($id)->delete();
        }
    }


    public function taeed(Request $request)
    {
        echo $request->id;
        if($request->ajax()){
            $id = $request->id;
            Up::find($id)->where('id',$id)->update(['accept'=>1]);
        }
    }

}
