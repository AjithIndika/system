<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use App\Http\Requests\StoreDailyTaskRequest;
use App\Http\Requests\UpdateDailyTaskRequest;
use Illuminate\Http\Request;
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
use App\Mail\TicketDetails;
use App\Mail\SendTicktAllert;


class DailyTaskController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $data['title'] = 'New Task';
        $data['busnus']= DB::table('subsidiaries')->select('*')->get();
        $data['departments']= DB::table('departments')->select('*')->get();
        $data['equpment_types']= DB::table('equpment_types')->select('*')->get();
        $data['issues']= DB::table('issues')->select('*')->get();
        $data['template'] = 'dailyTask/index';
        return view('template/template', compact('data'));
    }


    public function create(Request $request)
    {


        if(!empty(DB::table('daily_tasks')->orderBy('daily_tasks_number', 'desc')->value('daily_tasks_number'))){

            $getlast_number =explode("-",DB::table('daily_tasks')->orderBy('daily_tasks_number', 'desc')->value('daily_tasks_number'));
            $pnumber='ANDT-'.str_pad($getlast_number['1']+1, 8, '0', STR_PAD_LEFT);

           }
                 else {
                   $pnumber='ANDT-'.str_pad(1, 8, '0', STR_PAD_LEFT);
            }



          $request->validate([
              'daily_tasks_user_name' => ['required', 'string', 'max:255'],
              'daily_tasks_email' => ['email','required', 'string', 'max:255'],
              'daily_tasks_phone_number' => ['required', 'string', 'max:12'],
              'daily_tasks_department_name' => ['required', 'string', 'max:255'],
              'daily_tasks_organization'=> ['required', 'string', 'max:255'],
              'daily_tasks_equpment_types' => ['required', 'string', 'max:255'],
              'daily_tasks_issues_id' => ['required'],
              'daily_tasks_issues_note' => ['required','string'],
               ]);




               $working =array(
                  'daily_tasks_number'=> $pnumber,
                 'daily_tasks_user_name'=>$request->daily_tasks_user_name,
                  'daily_tasks_email'=>$request->daily_tasks_email,
                  'daily_tasks_phone_number'=>$request->daily_tasks_phone_number,
                  'daily_tasks_equpment_types'=>$request->daily_tasks_equpment_types,
                  'daily_tasks_department_name'=>$request->daily_tasks_department_name,
                  'daily_tasks_organization'=>$request->daily_tasks_organization,
                  'daily_tasks_issues_id'=>$request->daily_tasks_issues_id,
                  'daily_tasks_issues_note'=>$request->daily_tasks_issues_note,
                  'daily_tasks_date_time'=>date('Y-m-d H:i:s'),
                  'daily_tasks_status'=>'Crate',
                  'daily_tasks_attend_by'=>Auth::user()->name,
               );



               /*

               $mailData=[
                  'appname'=>config('app.name'),
                  'base_url'=>config('app.url'),
                  'title' => 'Task',
                  'tasks_number'=> $pnumber,
                  'daily_tasks_user_name'=>$request->daily_tasks_user_name,
                  'daily_tasks_email'=>$request->daily_tasks_email,
                  'daily_tasks_phone_number'=>$request->daily_tasks_phone_number,
                  'daily_tasks_equpment_types'=>$request->daily_tasks_equpment_types,
                  'daily_tasks_department_name'=>$request->daily_tasks_department_name,
                  'daily_tasks_organization'=>$request->daily_tasks_organization,
                  'daily_tasks_issues_id'=>$request->daily_tasks_issues_id,
                  'daily_tasks_issues_note'=>$request->daily_tasks_issues_note,
                  'daily_tasks_date_time'=>date('Y-m-d H:i:s'),
                  'daily_tasks_status'=>'Crate',
                  'daily_tasks_attend_by'=>Auth::user()->name,
               ];
*/


$mailData=[
    'appname'=>config('it.name'),
    'base_url'=>config('app.url'),
    'title' => 'Your Ticket  :-'.$pnumber,
    'tickets_number'=> $pnumber,
    'ticket_user_name'=>$request->daily_tasks_user_name,
    'ticket_email'=>$request->daily_tasks_email,
    'ticket_phone_number'=>$request->daily_tasks_phone_number,
    'ticket_equpment_types'=>DB::table('equpment_types')->select('*')->where('equpment_types_id','=',$request->daily_tasks_equpment_types)->pluck('equpment_name')->first(),
    'ticket_department_name'=>DB::table('departments')->select('*')->where('department_id','=',$request->daily_tasks_department_name)->pluck('department_name')->first(),
    'ticket_organization'=>DB::table('subsidiaries')->select('*')->where('subsidiaries_id','=',$request->daily_tasks_organization)->pluck('subsidiaries_name')->first(),
    'ticket_issues_id'=>DB::table('issues')->select('*')->where('issues_id','=',$request->daily_tasks_issues_id)->pluck('issues_name')->first(),
    'ticket_issues_note'=>$request->daily_tasks_issues_note,
    'ticket_date_time'=>date('Y-m-d H:i:s'),
    'ticket_status'=>'Crate',
    'daily_tasks_attend_by'=>Auth::user()->name,

 ];


         Mail::mailer('it')->to($request->daily_tasks_email)->send(new TicketDetails($mailData));
         Mail::mailer('it')->to('it@assetnetworks.net')->send(new SendTicktAllert($mailData));
         DB::table('daily_tasks')->insert($working);
            //  $daily_taskss_id=DB::getPdo()->lastInsertId();

            /*
              $data=[
                  'daily_tasks_timelines_daily_tasks_id'=>$daily_taskss_id,
                  'daily_tasks_timelines_daily_tasks_status'=>'send',
                  'daily_tasks_timelines_date_time'=>date('Y-m-d H:i:s'),
                  'daily_tasks_timelines_adby'=>$request->daily_tasks_user_name,
              ];
              DB::table('daily_tasks_timelines')->insert($data);
  */


       return redirect('/newtask')->with('success', 'Your Task Number  : - </br>'. $pnumber.'&nbsp;&nbsp; Save Sucess Full');



    }








 // pending daily_taskss
 public function pending_daily_tasks(){
    $data['title'] = 'Pending Task';
    $data['daily_tasks_Details']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_tasks_status','=','Crate')
                            ->get();
    $data['template'] = 'dailyTask/daytaskstatus';
    return view('template/template', compact('data'));
 }

 ///
 public function pending_Viewd_aily_tasks(){
    $data['title'] = 'View Task';
    $data['daily_tasks_Details']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_tasks_status','=','View')
                            ->get();
    $data['template'] = 'dailyTask/daytaskstatus';
    return view('template/template', compact('data'));
 }

///process ticktet
 ///
 public function process_daily_tasks(){
    $data['title'] = 'Process Task';
    $data['daily_tasks_Details']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_tasks_status','=','Process')
                            ->get();
    $data['template'] = 'dailyTask/daytaskstatus';
    return view('template/template', compact('data'));
 }



 ///finish daily_tasks
 ///
 public function finsh_daily_tasks(){
    $data['title'] = 'Finish Task';
    $data['daily_tasks_Details']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_tasks_status','=','Finish')
                            ->get();
    $data['template'] = 'dailyTask/daytaskstatus';
    return view('template/template', compact('data'));
 }


 public function daily_tasks($daily_taskss_number){

    $data['title'] = 'Task:-'.$daily_taskss_number;
    $data['daily_tasks_Details']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_taskss_number','=',$daily_taskss_number)
                            ->get();
    $data['template'] = 'dailyTask/onedaily_tasks';
    return view('template/template', compact('data'));


 }


 public static function countdalytask($status){
    echo DB::table('daily_tasks')
     ->select('*')
     ->where('daily_tasks_status','=',$status)
     ->count();
  }



  public static function thismonthfinishtask($status){
    echo DB::table('daily_task_timelines')
     ->select('*')
     ->where('daily_task_timelines_daily_task_status','=',$status)
     ->where('daily_task_timelines_date_time','like', '%' . date('Y-m') . '%')
     ->count();
  }




  public static function taskdetails(){
    $data= DB::table('daily_tasks')
    ->select('*')
    //->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->where('daily_tasks_status', '=','Crate')->get();


    foreach( $data as $row){

     $startTime = Carbon::parse(date('Y-m-d H:i:s'));
     $endTime = Carbon::parse($row->daily_tasks_date_time);

     echo '
     <li class="message-item">
     <a href="/oneDailyTask/'.$row->daily_tasks_number.'">
       <div>
         <h4>'.$row->daily_tasks_number.'</h4>
         <p>'.$row->daily_tasks_phone_number.' /'.$row->daily_tasks_issues_note.'</p>
         <p> D-'.$startTime->diff($endTime)->format('%d %H:%I:%S').' &nbsp;  ago</p>
       </div>
     </a>
   </li>
   <li>
   <hr class="dropdown-divider">
 </li>
   ';

    }
   }


public function oneDailyTask($daily_tasks_number){

    $data['title'] = 'Dily Task :-'.$daily_tasks_number;
    $data['daily_tasksDetails']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_tasks_number','=',$daily_tasks_number)
                            ->get();
    $data['template'] = 'dailyTask/onedaytask';
    return view('template/template', compact('data'));
}



public function steprecords(Request $request){

    $request->validate([
        'daily_tasks_timelines_daily_tasks_action' => ['required', 'string'],
        'daily_tasks_status' => ['required', 'string'],
         ]);



    if($request->daily_tasks_status=='Finish'){

        $updateTicket=array(
            'daily_tasks_status'=>$request->daily_tasks_status,
            'daily_tasks_attend_by'=>Auth::user()->name,
            'daily_tasks_finish_datetime'=>date('Y-m-d H:i:s'),); }
          else{

            $updateTicket=array(
                'daily_tasks_status'=>$request->daily_tasks_status,
                'daily_tasks_attend_by'=>Auth::user()->name,);
              }



    $daily_tasks_timelines=array(
        'daily_task_timelines_daily_task_id'=>$request->daily_tasks_id,
        'daily_task_timelines_daily_task_action'=>$request->daily_tasks_timelines_daily_tasks_action,
        'daily_task_timelines_daily_task_status'=>$request->daily_tasks_status,
        'daily_task_timelines_date_time'=>date('Y-m-d H:i:s'),
        'daily_task_timelines_last_update_adby'=>Auth::user()->name,
            );


         DB::table('daily_task_timelines')->insert($daily_tasks_timelines);


         DB::table('daily_tasks')->where('daily_tasks_id', $request->daily_tasks_id)->update($updateTicket);
        return redirect('/oneDailyTask'.'/'.$request->daily_tasks_number)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

 }


 public static function timeLine($daily_tasks_id){



                         $data=   DB::table('daily_task_timelines')
                            ->select('*')
                            ->where('daily_task_timelines_daily_task_id','=',$daily_tasks_id)
                             ->orderBy('daily_task_timelines_date_time', 'DESC')
                            ->get();

                            foreach($data as $row){
                                echo '

                                <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <p>'.$row->daily_task_timelines_last_update_adby.'<b class="text-danger">&MediumSpace;'.$row->daily_task_timelines_date_time.'</b></p>
                                        <p> '.$row->daily_task_timelines_daily_task_action.'</p>
                                        <span class="vertical-timeline-element-date">'.$row->daily_task_timelines_daily_task_status.'</span>
                                    </div>
                                </div>
                            </div>';
                            }

                            }




 public function daily_tasks_updatesave(Request $request){

    $request->validate([
        'daily_tasks_invoice_number' => ['string', 'max:255'],
        'daily_tasks_invoice_amount' => ['string', 'max:255'],
    ]);


     $data=array(
       //'daily_tasks_invoice_number'=>$request->daily_tasks_invoice_number,
       'daily_tasks_attend_by'=>Auth::user()->name,
       'daily_tasks_invoice_date'=>date('Y-m-d H:i:s'),
       'daily_tasks_invoice_amount'=>$request->daily_tasks_invoice_amount,
       'daily_tasks_on_agriment'=>$request->daily_tasks_on_agriment,
       'daily_tasks_invoisable'=>$request->daily_tasks_invoisable,
     );



     DB::table('daily_tasks')->where('daily_tasks_id', $request->daily_tasks_id)->update($data);

     $ticket_timelines=array(
        'daily_task_timelines_daily_task_id'=>$request->tickets_id,
        'daily_task_timelines_daily_task_status'=>$request->daily_tasks_status,
        'daily_task_timelines_date_time'=>date('Y-m-d H:i:s'),
        'daily_task_timelines_daily_task_action'=>'Invoiceable :-'.$request->daily_tasks_invoisable.'/ Invoice ammount :- '.$request->daily_tasks_invoice_amount.'/ Agriment :-'.$request->daily_tasks_on_agriment,
        'daily_task_timelines_last_update_adby'=>Auth::user()->name,);
     DailyTaskTimelineController::allsteprecords($ticket_timelines);
     
     return redirect('/oneDailyTask'.'/'.$request->daily_tasks_number)->with('success'.'&nbsp;&nbsp; Save Sucess Full');
 }


   // invoicable task
   public function tikerteTask(Request $request){



    $data['title'] = 'Ticket Invoice Pending';
    $data['taskDetails']= DB::table('daily_tasks')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','daily_tasks.daily_tasks_organization')
                            ->join('departments','departments.department_id','=','daily_tasks.daily_tasks_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','daily_tasks.daily_tasks_equpment_types')
                            ->join('issues','issues.issues_id','=','daily_tasks.daily_tasks_issues_id')
                            ->where('daily_tasks.daily_tasks_status','=','Finish')
                            ->where('daily_tasks.daily_tasks_invoisable','=','Yes')
                             ->where('daily_tasks.daily_tasks_invoice_amount','<=',0)
                            //->whereRaw('daily_tasks.invoice_amount = ""')

                            ->get();
    $data['template'] = 'invoice/taskInvoice';
    return view('template/template', compact('data'));


 }



public function invoicableTask(Request $request){



  }




  public static function taskinvoicePending(){
    echo DB::table('daily_tasks')
     ->select('*')
     ->where('daily_tasks_invoisable','=','Yes')
    // ->where('ticket_invoice_number','=','')
    ->whereRaw('daily_tasks_invoice_number = "" OR daily_tasks_invoice_number IS NULL')
     ->count();
  }


  public static function timecaluculate($date_time,$next_date){

    if(!empty($next_date)){
        $startTime = Carbon::parse($next_date);
        $endTime = Carbon::parse($date_time);
         echo 'D-'. $startTime->diff($endTime)->format('%d %H:%I:%S');
    }
    else{
        $startTime = Carbon::parse(date('Y-m-d H:i:s'));
        $endTime = Carbon::parse($date_time);
         echo 'D-'. $startTime->diff($endTime)->format('%d %H:%I:%S');
    }

}

}
