<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\VideoRequest;
use App\Video;
use App\Cat;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class VideoController extends Controller
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
        $video = Video::all();
        return view('admin.video',['video'=>$video]);
    }


    public function create()
    {
        return view('admin.video_create');
    }

    public function store(VideoRequest $request)
    {
        $video = new Video($request->all());
        if(Input::hasFile('img')){
            $file = Input::file('img');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $video->img = $filename;
        }

        $filename="";
        if(Input::hasFile('link_video')){
            $file = Input::file('link_video');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $video->link_video = $filename;
        }
        $filename="";

        if(Input::hasFile('link_video2')){
            $file = Input::file('link_video2');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $video->link_video2 = $filename;
        }
        $filename="";

        if(Input::hasFile('link_video3')){
            $file = Input::file('link_video3');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            $video->link_video3 = $filename;
        }


        if($video->save()){
            $url = 'admin/video';
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }
    }


    public function edit($id)
    {
        $model = Video::find($id);
        $cat = Cat::where("post_type","video")->get()->toArray();
        return view('admin.video_edit',['model'=>$model,'cat'=>$cat]);
    }

    public function update(Request $request, $id)
    {

        $video = Video::find($id);
        $video->update($request->all());

        if(Input::hasFile('img')){
            $file = Input::file('img');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);

            DB::table('Video')->where('id', $id)->update(array('img' => $filename));

        }




        $filename="";
        if(Input::hasFile('link_video')){
            $file = Input::file('link_video');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            DB::table('Video')->where('id', $id)->update(array('link_video' => $filename));

        }
        $filename="";

        if(Input::hasFile('link_video2')){
            $file = Input::file('link_video2');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            DB::table('Video')->where('id', $id)->update(array('link_video2' => $filename));
        }
        $filename="";

        if(Input::hasFile('link_video3')){
            $file = Input::file('link_video3');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            DB::table('Video')->where('id', $id)->update(array('link_video3' => $filename));
        }





        $url = 'admin/video';

        return redirect($url)->with('message','با موفقیت ویرایش شد.');
    }

    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;

            Video::find($id)->delete();
        }
    }
    
}
