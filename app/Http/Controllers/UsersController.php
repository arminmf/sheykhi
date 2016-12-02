<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UsersController extends Controller
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
        $user = User::all();
        return view('admin.users',['user'=>$user]);
    }


    public function create()
    {
    }

    public function store(AdvRequest $request)
    {
    }


    public function edit($id)
    {
        $model = User::find($id);
        return view('admin.users_edit',['model'=>$model]);
    }

    public function update(Request $request, $id)
    {
        $adv = User::find($id);
        $adv->update($request->all());
        $url = 'admin/users';
        return redirect($url)->with('message','با موفقیت ویرایش شد.');
    }

    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $adv = adv::find($id)->delete();
        }
    }
    public function show(){

    }
}
