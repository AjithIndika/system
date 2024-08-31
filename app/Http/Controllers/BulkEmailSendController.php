<?php

namespace App\Http\Controllers;
//use App\Models\BulkEmailSend;
use App\Http\Requests\StoreBulkEmailSendRequest;
use App\Http\Requests\UpdateBulkEmailSendRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Requst;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\DailyTaskTimelineController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;
Use Alert;
use Mail;
use App\Mail\BulkEmailSend;


class BulkEmailSendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['title'] = 'New Email';
        //$data['busnus']= DB::table('subsidiaries')->select('*')->get();
        $data['template'] = 'bulkemail/index';
        return view('template/template', compact('data'));


    }


    public function create(Request $request)
    {
        $mailData=array(
            'appname'=>'HR-Email System',
            'emailaddress'=>$request->emailaddress,
            'subject'=>$request->subject,
            'bulkemailbody'=>$request->bulkemailbody,
        );
      Mail::mailer('hr')->to($request->emailaddress)->send(new BulkEmailSend($mailData));
      return redirect('/one_email')->with('success', $request->emailaddress.'&nbsp;&nbsp; Email Send Success Full');
}

public function activeuseremail()
{
    $data['title'] = 'New Email';
    //$data['busnus']= DB::table('subsidiaries')->select('*')->get();
    $data['template'] = 'bulkemail/activeuserEmai';
    return view('template/template', compact('data'));
}


public function activeuseremailSend(Request $request)
{

    $mailData=array(
        'appname'=>'HR-Email System',
       // 'emailaddress'=>$request->emailaddress,
        'subject'=>$request->subject,
        'bulkemailbody'=>$request->bulkemailbody,
    );



  $email= DB::table('job_working')->select('*')->where('profile_job_work_status','Active')->get();
  foreach ($email as $email){
    $cc[]=$email->profile_job_work_email;
  }
  Mail::mailer('hr')->to('kindika144@gmail.com')->cc($cc)->send(new BulkEmailSend($mailData));


return redirect('/activeuseremail')->with('success', $request->emailaddress.'&nbsp;&nbsp; Email Send Success Full');
}






}
