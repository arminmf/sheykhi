<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_members;
use App\Http\Requests;

use App\Http\Requests\UpRequest;
use App\Up;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Morilog\Jalali\jDate;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->role!='user'){
                return redirect(url(''))->send();
            }
        }else{
            return redirect(url(''))->send();
        }

        $event=Event_members::where('user_id',$user->id)->get();

        return view('site.user_index',['event2'=>$event]);
    }

    public function all_users(){
        $users = User::paginate(2);;
        return view('site.users',['users'=>$users]);
    }

    public function settings(Requests\SettingsRequest $request){

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        if(Input::hasFile("myfile")){
            $file = Input::file("myfile");
            $filename = $randomString.''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);

        }

        if(Auth::check()){
            $author_id = Auth::user();
            $author_id = $author_id->id;
        }
        $user_id= $author_id;
       
        User::find($user_id)->where('id',$user_id)->update(['pdf'=>$filename]);
        $url = 'user';
        return redirect($url)->with('message','با موفقیت ثبت شد.');

    }



    public function store_post(UpRequest $request){


        $up = new Up($request->all());
        $up->time = time();
        if(Auth::check()){
            $author_id = Auth::user();
            $author_id = $author_id->id;
        }

        if(Input::hasFile('myfile')){
            $file = Input::file('myfile');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $up->img = $filename;
        }
        $up->user_id= $author_id;
        if($up->save()){
            $url = 'admin/news';
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }

    }
    public function users_single($id){
        $users = User::find($id)->where('id',$id)->get();
        $articles = Up::where('user_id',$id)->get();
        if($users){
            return view('site.users_single',['users'=>$users,'articles'=>$articles]);
        }else{
            abort('404');
        }
    }
}
