<?php


namespace App\Http\Controllers;

//use Request;
use App\Event_members;
use App\Events\Event;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Morilog\Jalali\jDate;
use App\Cat;
use Auth;
use DB;

use PhpParser\Node\Stmt\Foreach_;
use Validator;
use Session;
use Redirect;


class EventController extends Controller
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
        //$adv = adv::orderBy('status',1)->get();
        $event = DB::table('event')->get();


        return view('admin.event',['event'=>$event]);
    }

    public function create()
    {



        return view('admin.event_create');

    }
    public function remove(Request $request)
    {

        if($request->ajax()){
            $id = $request->id;
            $project = \App\Event::find($id)->delete();
        }

    }
    public function memremove(Request $request)
    {

        if($request->ajax()){
            $id = $request->id;
            $project = \App\Event_members::find($id)->delete();

        }

    }

    public function show(Request $request)
    {



    }

    public function store(Requests\EventRequest $request)
    {
        $filename="";

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }



        $project = new \App\Event($request->all());
        $project->time = time();
        if(Auth::check()){
            $author_id = Auth::user();
            $author_id = $author_id->id;
        }
        $project->author_id = $author_id;
        if(Input::hasFile("myfile")){
            $file = Input::file("myfile");
            $filename = $randomString.''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);


        }

        if($project->save()){
            DB::table('image')->insert(['event_id'=>$project->id,'img_name'=>$filename]);
        }

            Session::flash('success', 'Upload successfully');
            $url = 'admin/event';
            return redirect($url)->with('message','با موفقیت ثبت شد.');




    }
    public function edit($id)
    {
        $model = \App\Event::find($id);
        return view('admin.event_edit',['model'=>$model]);
    }

    public function members(){
        $user_id="";
        $member_id="";
        $id = Input::get('id');
        $project = Project::all();
        $members = DB::table('event_members')->where('event_id', $id)->get();


        return view('admin.event_members',['members'=>$members, 'pid'=>$id,'member_id'=>$member_id]);
    }

    public function sendsm(Request $request){

      echo $request->sendmail;

    }


    public function update(Request $request, $id)
    {
        $project = \App\Event::find($id);
        $project->update($request->all());
        $url = 'admin/event';
        return redirect($url)->with('message','با موفقیت ویرایش شد.');
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
            \App\Event::find($id)->where('id',$id)->update(['important'=>$action]);
        }
    }
}


