<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
use App\Cat;
use Auth;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Input;

class NewsController extends Controller
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
        $news = News::orderBy('id','desc')->get();
        return view('admin.news',['news'=>$news]);

    }


    public function create()
    {
        return view('admin.news_create');
    }

    public function store(NewsRequest $request)
    {


        $news = new News($request->all());

        if(Input::hasFile('myfile')){
            $file = Input::file('myfile');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $news->img = $filename;
        }
        $news->time = time();
        if($news->save()){
            $url = 'admin/news';
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }
    }


    public function edit($id)
    {
        
        
        $model = News::find($id);
        $cat = Cat::where("post_type","news")->get()->toArray();
        return view('admin.news_edit',['model'=>$model,'cat'=>$cat]);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);
        $news->time = time();
        if(Input::hasFile('myfile')){
            $file = Input::file('myfile');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $news->img = $filename;
        }
        $news->update($request->all());
        $url = 'admin/news';
        return redirect($url)->with('message','با موفقیت ویرایش شد.');
    }

    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            news::find($id)->delete();
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

    public function important(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $action = $request->action;
            if($action && $action == true){
                $action = 1;
            }else{
                $action = 0;
            }
            news::find($id)->where('id',$id)->update(['important'=>$action]);
        }
    }
}
