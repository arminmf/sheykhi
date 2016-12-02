<?php

namespace App\Http\Controllers;

//use Request;
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

use Validator;
use Session;
use Redirect;


class ProjectController extends Controller
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
        $project = Project::all();
        return view('admin.project',['project'=>$project]);
    }


    public function create()
    {
        $cat = Cat::where("post_type","prjct")->get()->toArray();
        return view('admin.project_create',['cat'=>$cat]);
    }

    public function image_info(){

        $id = Input::get('id');
        $project = Project::all();
        $image = DB::table('image')->where('project_id', $id)->get();


        return view('admin.project_image_info',['image'=>$image , 'pid'=>$id]);
    }

    public function img_update(Request $request){

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }





        $a= $request->all();
        $pid = $a['pid'];
        $image = DB::table('image')->where('project_id', $pid)->get();

        foreach ($image as $item){

            DB::table('image')->where('id', $item->id)->update(['det' => $a[$item->id]]);

        }
        if (array_key_exists("asli",$a)) {
            $main = $a['asli'];
            DB::table('image')->where('project_id', $pid)->where('main', '1')->update(['main' => '0']);
            DB::table('image')->where('project_id', $pid)->where('id', $main)->update(['main' => '1']);
        }









        $files = Input::file('images');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach($files as $file) {
            $rules = array('file' => 'required|mimes:png,gif,jpeg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file'=> $file), $rules);
            if($validator->passes()){
                $destinationPath = 'resources/upload/images';
                $filename = $randomString.''.$file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount ++;


                    DB::table('image')->insert(['project_id'=>$pid,'img_name'=>$filename]);

            }
        }
        if($uploadcount == $file_count){
            Session::flash('success', 'Upload successfully');

            $url = 'admin/project/create/images?id='.$pid;
            return redirect($url)->with('message','با موفقیت ثبت شد.');

        }
        else {
            $url = 'admin/project';
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }


    }
    public function img_remove(Request $request){
        if($request->ajax()){
            $id = $request->id;
            DB::table('image')->where('id', $id)->delete();
        }
    }




    public function store(ProjectRequest $request)
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }



        $project = new Project($request->all());
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
                if($project->save()){
                    DB::table('image')->insert(['project_id'=>$project->id,'img_name'=>$filename,'main'=>1]);


                }

        }

        $files = Input::file('images');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach($files as $file) {
            $rules = array('file' => 'required|mimes:png,gif,jpeg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file'=> $file), $rules);
            if($validator->passes()){
                $destinationPath = 'resources/upload/images';
                $filename = $randomString.''.$file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount ++;

                if($project->save()){
                    DB::table('image')->insert(['project_id'=>$project->id,'img_name'=>$filename]);
                }
            }
        }

        if ($uploadcount==0)$project->save();

        if(Input::hasFile('voice')){
            $file = Input::file('voice');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            DB::table('project')->where('id', $project->id)->update(array('voice' => $filename));
        }

        if ($request->filter1) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'1']);
        if ($request->filter2) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'2']);
        if ($request->filter3) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'3']);
        if ($request->filter4) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'4']);
        if ($request->filter5) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'5']);
        if ($request->filter6) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'6']);
        if ($request->filter7) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'7']);
        if ($request->filter15) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'15']);
        if ($request->filter16) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'16']);
        if ($request->filter17) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'17']);
        if ($request->filter18) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'18']);
        if ($request->filter19) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'19']);
        if ($request->filter20) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'20']);
        if ($request->filter21) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'21']);
        if ($request->filter22) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'22']);
        if ($request->filter23) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'23']);
        if ($request->filter24) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'24']);
        if ($request->filter25) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'25']);
        if ($request->filter26) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'26']);
        if ($request->filter27) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'27']);
        if ($request->filter28) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'28']);
        if ($request->filter29) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'29']);
        if ($request->filter30) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'30']);
        if ($request->filter31) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'31']);
        if ($request->filter32) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'32']);
        if ($request->filter33) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'33']);
        if ($request->filter34) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'34']);
        if ($request->filter35) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'35']);
        if ($request->filter36) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'36']);
        if ($request->filter37) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'37']);
        if ($request->filter38) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'38']);
        if ($request->filter39) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'39']);
        if ($request->filter40) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'40']);
        if ($request->filter41) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'41']);
        if ($request->filter42) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'42']);
        if ($request->filter43) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'43']);
        if ($request->filter44) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'44']);
        if ($request->filter45) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'45']);
        if ($request->filter46) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'46']);
        if ($request->filter47) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'46']);
        if ($request->filter48) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'48']);
        if ($request->filter49) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'49']);
        if ($request->filter50) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'50']);
        if ($request->filter51) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'51']);
        if ($request->filter52) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'52']);
        if ($request->filter53) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'53']);
        if ($request->filter54) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'54']);
        if ($request->filter55) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'55']);
        if ($request->filter56) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'56']);
        if ($request->filter57) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'57']);
        if ($request->filter58) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'58']);
        if ($request->filter59) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'59']);
        if ($request->filter60) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'60']);
        if ($request->filter61) DB::table('a_filters')->insert(['p_id'=>$project->id,'f_id'=>'61']);





        if($uploadcount == $file_count){
            Session::flash('success', 'Upload successfully');
            $url = 'admin/project/create/images?id='.$project->id;
            return redirect($url)->with('message','با موفقیت ثبت شد.');

        }
        else {
            $url = 'admin/project/create/images?id='.$project->id;
            return redirect($url)->with('message','با موفقیت ثبت شد.');
        }
    }


    public function edit($id)
    {
        $model = Project::find($id);
        $cat = Cat::where("post_type","prjct")->get()->toArray();
        return view('admin.project_edit',['model'=>$model,'cat'=>$cat]);
    }

    public function update(Request $request, $id)
    {
        if(Input::hasFile('voice')){
            $file = Input::file('voice');
            $filename = time().''.$file->getClientOriginalName();
            $uploadSuccess = $file->move('resources/upload/images',$filename);
            DB::table('project')->where('id', $id)->update(array('voice' => $filename));
        }

        $project = Project::find($id);
        $project->update($request->all());
        $url = 'admin/project';


        return redirect($url)->with('message','با موفقیت ویرایش شد.');

    }

    public function remove(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $project = Project::find($id)->delete();
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
            Project::find($id)->where('id',$id)->update(['important'=>$action]);
        }
    }

    public function show(){

    }
}
