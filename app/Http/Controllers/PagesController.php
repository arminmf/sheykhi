<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use App\Http\Requests;
use App\Pages;
use Auth;

class PagesController extends Controller
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
        $pages = pages::all();
        return view('admin.pages',['pages'=>$pages]);
    }

    public function create()
    {
        return view('admin.pages_create');
    }

    public function store(PagesRequest $request)
    {
        $page = new pages($request->all());
        $page->time = time();
        if($page->save()){
            $url = 'admin/pages';
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }
    }


    public function edit($id)
    {
        $model = pages::find($id);
        return view('admin.pages_edit',['model'=>$model]);
    }

    public function update(Request $request, $id)
    {
        $adv = pages::find($id);
        $adv->update($request->all());
        $url = 'admin/pages';
        return redirect($url)->with('message','با موفقیت ویرایش شد.');
    }

    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $adv = pages::find($id)->delete();
        }
    }
    public function show(){

    }
    public function accept(Request $request){
        if($request->ajax()){
            $id = $request->id;
            $adv = adv::find($id)->where("id","$id")->update(['status'=>'1']);
        }
    }


}
