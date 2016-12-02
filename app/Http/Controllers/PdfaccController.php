<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cm;
use App\Cat;
use Auth;
use App\Http\Requests\NewsRequest;
use App\User;

class PdfaccController extends Controller
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
        $user = User::orderBy('id','desc')->whereNotNull('pdf')->get();
        return view('admin.pdfacc',['user'=>$user]);

    }


    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            User::find($id)->where('id',$id)->update(['pdf'=>null ,'pdfacc'=>0]);
        }
    }


    public function taeed(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            user::find($id)->where('id',$id)->update(['pdfacc'=>1]);
        }
    }

}
