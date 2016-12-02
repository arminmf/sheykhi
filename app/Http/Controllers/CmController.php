<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cm;
use App\Cat;
use Auth;
use App\Http\Requests\NewsRequest;

class CmController extends Controller
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
        $cm = Cm::orderBy('id','desc')->get();
        return view('admin.cm',['cm'=>$cm]);

    }


    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $project = Cm::find($id)->delete();
        }
    }


    public function taeed(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            Cm::find($id)->where('id',$id)->update(['accept'=>1]);
        }
    }

}
