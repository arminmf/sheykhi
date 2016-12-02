<?php


namespace App\Http\Controllers;

//use Request;
use App\Newsletter;
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
use Mail;

class NewsletterController extends Controller
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
        $newsletter = Newsletter::all();
        return view('admin.newsletter',['newsletter'=>$newsletter]);
    }
    public function send(Request $request){
        if($request && !empty($request->subject) && !empty($request->text)){
            $emails = Newsletter::all()->toArray();
            $email_list = [];
            $subject = $request->subject;
            foreach ($emails as $email) {
                array_push($email_list,$email['email']);
            }
            echo 'منتظر بمانید درحال ارسال خبرنامه به اعضا';
            $data = ['name'=>'خبرنامه','email'=>'imahmoodzamani@gmail.com','text'=>$request->text];
            $mail_admin = Mail::send('emails.newsletter', $data, function ($message) use ($email_list,$subject) {
                $message->from('us@example.com', 'معماری پایدار');
                $message->to($email_list)->subject($subject);
            });
            if($mail_admin){
                return back()->with('message','پیام شما ارسال شد.');
            }
        }else{
            return back()->with('message','پیام ارسال نشد');
        }
    }

}


