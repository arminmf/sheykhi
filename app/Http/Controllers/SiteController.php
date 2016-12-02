<?php

namespace App\Http\Controllers;

use App\A_filters;
use App\Cm;
use App\Event_members;
use App\Http\Requests;
use App\News;
use App\Newsletter;
use App\Project;
use App\Up;
use Illuminate\Http\Request;
use Auth;
use App\Video;
use App\Event;
use App\Pages;
use App\Cat;
use App\Http\Requests\CmRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
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

        $video = Video::all();
        $event= Event::all();
        $news = News::get();
        $newsm = News::where('important',1)->get();
        $memari_cat1 = Project::where('cat',9)->get();
        $memari_cat2 = Project::where('cat',10)->get();
        $memari_cat3 = Project::where('cat',11)->get();
        $memari_cat4 = Project::where('cat',12)->get();
        $up = Up::orderBy('time','desc')->where('accept',1)->get();
        $project_mohem=Project::where('important',1)->get();
        $event_mohem=Event::where('important',1)->get();
        //13 post_type = news
        $interview = News::where('cat',13)->get();
        return view('site.index',
            [
                'event'=>$event,
                'project_mohem'=>$project_mohem,
                'event_mohem'=>$event_mohem,
                'video'=>$video,
                'up'=>$up,
                'memari_cat1'=>$memari_cat1,
                'memari_cat2'=>$memari_cat2,
                'memari_cat3'=>$memari_cat3,
                'memari_cat4'=>$memari_cat4,
                'news'=>$news,
                'newsm'=>$newsm,
                'interview'=>$interview
            ]
        );
    }


    public function newa($name){
        $project_single = Project::where("title",$name)->get();
        foreach ($project_single as $item)
            $item_id=$item->id;

        $comments = Cm::orderBy('time','desc')->where("post_id",$item_id)->where("replay_to","0")->where("accept",1)->get();
        $all_projects = Project::paginate(10);
        return view('site.project_single',['project_single'=>$project_single,'comments'=>$comments,'all_projects'=>$all_projects]);
    }





    public function projectcm(Request $request){
        $cm = new CmRequest($request->all());

        $time= time();
        DB::table('comment')->insert(['post_id'=>$cm->id,'name'=>$cm->name,'email'=>$cm->email,'comment_text'=>$cm->cm,'post_type'=>$cm->project_type,'accept'=>'0','time'=>$time,'replay_to'=>$cm->replay_to]);
        if ($cm->project_type=="news")
            $url = 'news/'.$cm->onvan;
        if ($cm->project_type=="prjct")
            $url = 'project/'.$cm->onvan;
        if ($cm->project_type=="tv")
            $url = 'tv/'.$cm->onvan;
        if ($cm->project_type=="event")
            $url = 'event/'.$cm->onvan;
        return redirect($url)->with('message','با موفقیت ثبت شد.');

    }



    public function project(){
        $project = Project::orderBy('id','desc')->paginate(2);
        $comments = Cm::orderBy('time','desc')->paginate(2);
        return view('site.project',[
            'project'=>$project
        ]);
    }
    public function filter(Request $request){

        $p_id=0;
        $filter[]=0;
        $str=$request->str;


        $pieces = explode(",", $str);

        for ($i=0;$i < count($pieces); $i++ ){
            $project = A_filters::where("f_id",$pieces[$i])->get();
            foreach ($project as $item)
                $p_id=$item->p_id;

            if($p_id) $filter[$i]=$p_id;
        }

        return view('site.filter.filter',['arr'=>$filter]);
    }
    public function all(Request $request){
        if($request->ajax()){
                $project = Project::all()->toArray();
                return view('site.filter.all',['project'=>$project]);
        }
    }



    public function event_reg(Request $request){
        if($request->ajax()){

            DB::table('event_members')->insert(['event_id'=>$request->eid,'user_id'=>$request->uid]);

        }
    }


    public function news_single($name){
        $news = News::where('title',$name)->get();
        foreach ($news as $item)
            $item_id=$item->id;
        $comments = Cm::orderBy('time','desc')->where("post_id",$item_id)->where("replay_to","0")->where("accept",1)->get();

        return view('site.news_single',['news'=>$news,'comments'=>$comments]);
    }

    public function tv_list($name){
        $video = Video::where('title',$name)->get()->toArray();
        $tv_all = Video::paginate(10);
        if($video == null){
            return redirect('/');
        }else{
            foreach ($video as $item)
                $item_id=$item['id'];
            $comments = Cm::orderBy('time','asc')->where("post_id",$item_id)->get();

            return view('site.tv_single',['video'=>$video,'comments'=>$comments,'all_tv'=>$tv_all]);
        }
    }
    public function tv_show(){
        $video = Video::paginate(2);
        return view('site.tv',['video'=>$video]);
    }
    public function show_page($page_name){
        $pages = Pages::where('eng_name',$page_name)->get()->toArray();
        if($pages == null){
            return redirect('/');
        }else{
            return view('site.pages',['pages'=>$pages]);
        }
    }
    public function event(){
        $event = Event::paginate(1);
        return view('site.event',['event'=>$event]);
    }
    public function event_single($name){

        $event = Event::where('title',$name)->get();
        foreach ($event as $item)
            $item_id=$item->id;
        $comments = Cm::orderBy('time','desc')->where("post_id",$item_id)->where("replay_to","0")->where("accept",1)->get();
        $all_event = Event::paginate(10);
        return view('site.event_single',['event'=>$event,'comments'=>$comments,'all_event'=>$all_event]);
    }
    public function newad(){

        $cats = Cat::get();
        return view('site.newad',['cats'=>$cats]);


    }

    public function vote(Request $request)
    {
        //comment_id
        $cm_id = $request->cm_id;
        //+ or -
        $vote = $request->vote;
        $comment = Cm::where('id', $cm_id)->get()->toArray();
        foreach ($comment as $item) {
            $before_vote_pos = $item['pos'];
            $before_vote_neg = $item['neg'];
        }


        if ($vote == 'pos' && Session::get($cm_id) != '1') {
            $before_vote_pos++;
            Cm::where('id', $cm_id)->update(['pos' => $before_vote_pos]);
            Session::put($cm_id, '1');
            return $before_vote_pos;

        } elseif ($vote == 'neg' && session::get($cm_id) != '1') {

            $before_vote_neg++;
            Cm::where('id', $cm_id)->update(['neg' => $before_vote_neg]);
            Session::put($cm_id, '1');
            return $before_vote_neg;

        } elseif ($vote == 'neg') {

            return $before_vote_neg;

        } elseif ($vote == 'pos') {

            return $before_vote_pos;

        }
    }
    public function articles_all(){
        $articles = Up::orderBy('id','desc')->paginate(1);
        return view('site.articles',['articles'=>$articles]);
    }
    public function articles_single($title){
        $article =Up::where('title',$title)->get();
        return view('site.articles_single',['article'=>$article]);
    }

    public function save_newsletter(Request $request){
        if(isset($request->email) && !empty($request->email)){
            $email = $request->email;
            $query = DB::insert('insert into newsletter (email) values (?)', [$email]);
            if($query){
                echo 'با موفقیت ثبت شد';
                return redirect('')->with('msg','ایمیل شما با موفقیت ثبت شد');
            }
        }else{
            abort('404');
        }
    }

}
