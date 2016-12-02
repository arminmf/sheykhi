<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cat;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Morilog\Jalali\jDate;
use Auth;
use DB;

class CatController extends Controller
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
        $cat = Cat::all();
        return view('admin.cat',['cat'=>$cat]);
    }


    public function create()
    {
        $cat_parent = Cat::where('parent','')->get()->toArray();
        return view('admin.cat_create',['cat_parent'=>$cat_parent]);
    }

    public function store(Request $request)
    {
        $cat = new Cat($request->all());
        if($cat->save()){
            $url = 'admin/cat';
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }
    }

    public function edit($id)
    {
        $model = Cat::find($id);
        if($model->cat != 0){
            $cat_array = Cat::where("id","$model->cat")->get()->toArray();
            foreach ($cat_array as $item) {
                $cat_name =  $item['name'];
            }
            $cat = ["$model->cat"=>"$cat_name"]+Cat::lists('name','id')->toArray();
        }else {
            $cat = [""=>"مادر"]+Cat::lists('name', 'id')->toArray();
        }
        return view('admin.cat_edit',['model'=>$model,'cat'=>$cat]);
    }

    public function update(Request $request, $id)
    {
        $cat = Cat::find($id);
        $cat->update($request->all());
        $url = 'admin/cat';
        return redirect($url)->with('message','با موفقیت ویرایش شد.');
    }

    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            Cat::find($id)->delete();
        }
    }
    public function show(){

    }
}
