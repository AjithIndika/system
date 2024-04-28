<?php

namespace App\Http\Controllers;

use App\Models\ReportAll;
use App\Http\Requests\StoreReportAllRequest;
use App\Http\Requests\UpdateReportAllRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
use App\UserModel;
use App\Models;
use Image;
Use Alert;
use Mail;
use App\Mail\TicketStatus;



use Illuminate\Http\Request;


class ReportAllController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    public function subwiceprofile(ReportAll $reportAll)
    {
      $data['subsidiaries']= DB::table('subsidiaries')->select('*')
      ->where('subsidiaries.assetsubsidiarie','=','yes')
      ->get();

      $data['active_users']=
                        DB::table('profiles')
                        ->join('job_working','job_working.profile_id','=','profiles.profile_id')
                        ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
                        ->where('subsidiaries.assetsubsidiarie','=','yes')
                        ->where('profiles.profile_status','=','Active')
                        ->count();

     $data['in_active_users']=
                        DB::table('profiles')
                        ->join('job_working','job_working.profile_id','=','profiles.profile_id')
                        ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
                        ->where('subsidiaries.assetsubsidiarie','=','yes')
                        ->where('profiles.profile_status','=','Stopped')
                        ->count();





        $data['title'] = 'Report 01';
        $data['template'] = 'reports/sbu-wice-profile';
        return view('template/template', compact('data'));
    }

    public function departmentWice(){

          $data['departments']= DB::table('departments')->select('*')->get();
          $data['title'] = 'Deparment ';
          $data['template'] = 'reports/deparmrnt-wice';
          return view('template/template', compact('data'));

    }



    public function sudepartmentWice(){

        $data['subsidiaries']= DB::table('subsidiaries')->select('*')->where('assetsubsidiarie','=','yes')->get();
        $data['departments']= DB::table('departments')->select('*')->get();
        $data['title'] = 'Busnuss & Department ';
        $data['template'] = 'reports/sudepartmentWice';
        return view('template/template', compact('data'));

  }



    public static function subdepart($subsidiaries_id,$department_id){

        $all=  DB::table('profiles')
    ->select('*')
    ->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->where('job_working.profile_job_work_sbu','=',$subsidiaries_id)
    ->where('job_working.profile_job_work_department','=',$department_id)
    ->where('job_working.profile_job_work_status','=','Active')
    ->get();

    $counts=1;
    foreach( $all as $all){

    echo '<div class="border mb-1 mt-1"><a href="/view-profile/'.$all->profile_sug.'"  target="_blank">'.$counts++.' : '.$all->profile_Full_name.'</a></div>';
    }
}



// office location wice users

    public function officelocationwice(){
        $data['office_locations']= DB::table('office_locations')->select('*')->get();
        $data['title'] = 'Office Location';
        $data['template'] = 'reports/office-location-wice';
        return view('template/template', compact('data'));

    }


    public static function officeUsers($office_locations_id){
        $all=  DB::table('profiles')
        ->select('*')
        ->join('job_working','job_working.profile_id','=','profiles.profile_id')
        ->where('job_working.profile_job_work_office_location','=',$office_locations_id)
        ->where('job_working.profile_job_work_status','=','Active')
        ->get();

        $counts=1;
        foreach( $all as $all){
        echo '<div class="border border-secondary mb-1 mt-1"><a href="/view-profile/'.$all->profile_sug.'"  target="_blank">'.$counts++.' : '.$all->profile_Full_name.'</a></div>';
        }


    }



    //new job notification

    public static function ticketallert($status){
      echo  DB::table('tickets')->where('ticket_status', '=',$status)->count();
    }



    ///

    //new job notification

    public static function ticketfinishthismonth($status){
        echo  DB::table('tickets')
        ->join('ticket_timelines','ticket_timelines.ticket_timelines_ticket_id','=','tickets.tickets_id')
        ->where('ticket_timelines.ticket_timelines_ticket_status', '=',$status)
        ->where('ticket_timelines.ticket_timelines_date_time','like', '%' . date('Y-m') . '%')
        ->count();
      }


    public static function ticketdetails(){
       $data= DB::table('tickets')
       ->select('*')
       //->join('job_working','job_working.profile_id','=','profiles.profile_id')
       ->where('ticket_status', '=','Crate')
       ->limit(6)
       ->get();


       foreach( $data as $row){

        $startTime = Carbon::parse(date('Y-m-d H:i:s'));
        $endTime = Carbon::parse($row->ticket_date_time);

        echo '<li>
        <hr class="dropdown-divider">
      </li>

      <li class="notification-item">
        <i class="bi bi-exclamation-circle text-warning"></i>
        <div>
          <h4><a href="/oneTicket/'.$row->tickets_number.'">'.$row->tickets_number.'</a></h4>
          <p>D-'.$startTime->diff($endTime)->format('%d %H:%I:%S')." Minutes".'</p>
        </div>
      </li>';
/// <!---  <p>'.$row->ticket_phone_number.' /'.$row->ticket_issues_note.'</p>
       }
      }




 // pending tickets
 public function pendingticket(){
    $data['title'] = 'Pending Ticket';
    $data['ticketDetails']= DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.ticket_status','=','Crate')
                            ->get();
    $data['template'] = 'tickets/pending';
    return view('template/template', compact('data'));
 }

 ///
 public function pendingViewticket(){
    $data['title'] = 'Pending Ticket';
    $data['ticketDetails']= DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.ticket_status','=','View')
                            ->get();
    $data['template'] = 'tickets/pending';
    return view('template/template', compact('data'));
 }

///process ticktet
 ///
 public function processticket(){
    $data['title'] = 'Pending Ticket';
    $data['ticketDetails']= DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.ticket_status','=','Process')
                            ->get();
    $data['template'] = 'tickets/pending';
    return view('template/template', compact('data'));
 }



 ///finish ticket
 ///
 public function finshticket(){
    $data['title'] = 'Pending Ticket';
    $data['ticketDetails']= DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.ticket_status','=','Finish')
                            ->get();
    $data['template'] = 'tickets/pending';
    return view('template/template', compact('data'));
 }


 public function oneTicket($tickets_number){

    $data['title'] = 'Ticket:-'.$tickets_number;
    $data['ticketDetails']= DB::table('tickets')
                            ->select('*')
                            ->join('subsidiaries','subsidiaries.subsidiaries_id','=','tickets.ticket_organization')
                            ->join('departments','departments.department_id','=','tickets.ticket_department_name')
                            ->join('equpment_types','equpment_types.equpment_types_id','=','tickets.ticket_equpment_types')
                            ->join('issues','issues.issues_id','=','tickets.ticket_issues_id')
                            ->where('tickets.tickets_number','=',$tickets_number)
                            ->get();
     $data['officeLocation'] =  DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get();
    $data['template'] = 'tickets/oneticket';
    return view('template/template', compact('data'));


 }


 public function steprecords(Request $request){


    $request->validate([
        'ticket_timelines_ticket_action' => ['required', 'string'],
        'ticket_timelines_ticket_status' => ['required', 'string'],
         ]);


            $ticket_timelines=array(
                'ticket_timelines_ticket_id'=>$request->tickets_id,
                'ticket_timelines_ticket_action'=>$request->ticket_timelines_ticket_action,
                 'ticket_timelines_ticket_status'=>$request->ticket_timelines_ticket_status,
                 'ticket_timelines_date_time'=>date('Y-m-d H:i:s'),
                 'ticket_timelines_last_update_adby'=>Auth::user()->name,
                 );
         DB::table('ticket_timelines')->insert($ticket_timelines);


         

         if($request->ticket_timelines_ticket_status=='Finish'){
            $updateTicket=array(
            'ticket_status'=>$request->ticket_timelines_ticket_status,
            'ticket_attend_by'=>Auth::user()->name,
            'ticket_finish_datetime'=>date('Y-m-d H:i:s'),);
         }
         else{
                $updateTicket=array(
                'ticket_status'=>$request->ticket_timelines_ticket_status,
                'ticket_attend_by'=>Auth::user()->name,);
         }



         if($request->ticket_timelines_ticket_status=='Finish'){


            $mailData = [
                'appname' => config('it.name'),
                'base_url' => config('app.url'),
                'tickets_number' => $request->tickets_number,
                'tickets_issued' => $request->tickets_issued,
                'ticket_finish_user' =>Auth::user()->name,
                'ticket_user_name' => $request->ticket_user_name,
                'ticketaction'=>$request->ticket_timelines_ticket_action,
                'ticket_date_time' => date('Y-m-d H:i:s'),
                'ticket_status' => 'Finish',
            ];


            //email send

            Mail::mailer('it')
            ->to($request->ticket_email)
            ->send(new TicketStatus($mailData));



         }
         DB::table('tickets')->where('tickets_id', $request->tickets_id)->update($updateTicket);
         return redirect('/oneTicket'.'/'.$request->tickets_number)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

 }


 public static function timeLine($tickets_id){

                         $data=   DB::table('ticket_timelines')
                            ->select('*')
                            ->where('ticket_timelines_ticket_id','=',$tickets_id)
                           ->orderBy('ticket_timelines_date_time', 'DESC')
                            ->get();

                            foreach($data as $row){
                                echo '

                                <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <p>'.$row->ticket_timelines_last_update_adby.'<b class="text-danger">&MediumSpace;'.$row->ticket_timelines_date_time.'</b></p>
                                        <p> '.$row->ticket_timelines_ticket_action.'</p>
                                        <span class="vertical-timeline-element-date">'.$row->ticket_timelines_ticket_status.'</span>
                                    </div>
                                </div>
                            </div>';

                            }


 }



 public static function countticket($status){
   echo DB::table('tickets')
    ->select('*')
    ->where('ticket_status','=',$status)
    ->count();
 }


 public static function todayticket(){
    echo DB::table('tickets')
     ->select('*')
     ->where('ticket_date_time','like', '%' . date('Y-m-d') . '%')

     ->count();
  }

  public static function contmonthicket($status){

                echo DB::table('tickets')
                ->select('*')
                ->where('ticket_date_time','like','%'. date('Y') .'%')
                ->where('ticket_status','=',$status)
                ->count();

            }



  public static function daycountticket($status){
$start_date = "01-".date('m')."-".date('Y');
$start_time = strtotime($start_date);
$end_time = strtotime("+1 month", $start_time);
for($i=$start_time; $i<$end_time; $i+=86400)
{
   $list[] = DB::table('tickets')
   ->select('*')
   ->where('ticket_date_time','like','%'. date('Y-m-d', $i) .'%')
   ->where('ticket_status','=',$status)
  // ->where('ticket_finish_datetime','like', '%' . date('Y-m-d') . '%')
   ->count();
}
echo json_encode($list);
}


public static function daycountticketFinish(){
    $start_date = "01-".date('m')."-".date('Y');
    $start_time = strtotime($start_date);
    $end_time = strtotime("+1 month", $start_time);
    for($i=$start_time; $i<$end_time; $i+=86400)
    {
       $list[] = DB::table('tickets')
       ->select('*')
     //  ->where('ticket_date_time','like','%'. date('Y-m-d', $i) .'%')
       ->where('ticket_status','=','Finish')
       ->where('ticket_finish_datetime','like', '%' . date('Y-m-d', $i) . '%')
       ->count();
    }
    echo json_encode($list);
    }



public function ticketupdate(Request $request){

    $request->validate([
        'ticket_invoisable' => ['string', 'max:255'],
        'ticket_on_agriment' => ['string', 'max:255'],
        //'invoice_amount' => ['string'],
         ]);


    $ticket_timelines=array(
        'ticket_timelines_ticket_id'=>$request->tickets_id,
       'ticket_timelines_ticket_action'=>'Invoice -: '.$request->ticket_invoisable.' &  Agriment :-'.$request->ticket_on_agriment.'',
       'ticket_timelines_ticket_status'=>$request->ticket_status,
       'ticket_timelines_date_time'=>date('Y-m-d H:i:s'),
       'ticket_timelines_last_update_adby'=>Auth::user()->name,
                          );
     DB::table('ticket_timelines')->insert($ticket_timelines);


     $updateTicket=array(
        'ticket_status'=>$request->ticket_status,
        'ticket_invoice_amount'=>$request->ticket_invoice_amount,
        'ticket_on_agriment'=>$request->ticket_on_agriment,
        'ticket_invoisable'=>$request->ticket_invoisable,
        'ticket_attend_by'=>Auth::user()->name,
             );
        DB::table('tickets')->where('tickets_id', $request->tickets_id)->update($updateTicket);
       return redirect('/oneTicket'.'/'.$request->tickets_number)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

}


public static function thimonthdates()
{
    $y_m = date('Y-m');
    $list = array();
    $d = date('d', strtotime('last day of this month', strtotime($y_m)));
    for ($i = 1; $i <= $d; $i++) {
      $dates[] = $y_m . '-' .str_pad($i, 2, '0', STR_PAD_LEFT);
    }
    echo json_encode($dates);

}



public function reportDashbord(){

    $data['title'] = 'All Reports';
    $data['template'] = 'reports/reportdash';
    return view('template/template', compact('data'));

}

public function allactivecontact(){

    $data['subsidiaries']= DB::table('subsidiaries')->select('*')->where('assetsubsidiarie','=','yes')->orderBy('subsidiaries_name', 'asc')->get();
    $data['title'] = 'All Contacts';
    $data['template'] = 'reports/contactlist';
    return view('template/template', compact('data'));


}


public static function contactlist($subsidiaries_id){
    $data=  DB::table('job_working')->select('*')
        ->join('profiles','profiles.profile_id','=','job_working.profile_id')
      //  ->join('job_join_history','job_join_history.profile_id','=','job_working.profile_id')
        ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
        ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
        ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
        ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
        ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
        ->where('subsidiaries.subsidiaries_id','=',$subsidiaries_id)
        ->where('job_working.profile_job_work_status','Active')
        ->orderBy('profiles.profile_Full_name', 'asc')
        ->get();

           $count =1;
        foreach($data as $row){

            echo '<tr>
            <td>'.$count++.'</td>
            <td>'.$row->profile_Full_name.'</td>
            <td>'.$row->designations_name.'</td>
            <td>'.$row->profile_job_work_email.'</td>
            <td>'.$row->profile_job_work_mobile.'</td>
          </tr>
';
        }

}


public function CustomReport(){

    //organization
    $data['subsidiaries']= DB::table('subsidiaries')->select('*')->where('assetsubsidiarie','=','yes')->orderBy('subsidiaries_name', 'asc')->get();
   //office location
   $data['office_locations']= DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get();
   //department
   $data['departments']= DB::table('departments')->select('*')->orderBy('department_name', 'asc')->get();
    //disignation
    $data['designations']= DB::table('designations')->select('*')->orderBy('designations_name', 'asc')->get();
    //projctnames
    $data['projctnames']= DB::table('projctnames')->select('*')->orderBy('project_name', 'asc')->get();
    // religions 
    $data['religions']= DB::table('religions')->select('*')->orderBy('religion_name', 'asc')->get();

    $data['sbu_head'] = DB::table('job_working')->select('*')
    ->join('profiles','profiles.profile_id','=','job_working.profile_job_work_head_of_sbu')    
    //->where('job_working.profile_job_work_head_of_sbu','=','Active')
    ->where('profiles.profile_status','=','Active')
    ->orderBy('profiles.profile_Full_name', 'asc')
    ->get();


    $data['profile']=  DB::table('profiles')
    ->select('*')
    ->join('job_join_history','job_join_history.profile_id','=','profiles.profile_id')
    ->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
     ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
     ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
     ->join('religions','religions.religion_id','=','profiles.religion_id')
  //  ->where('profiles.profile_sug','=',$request->profile_sug)
  // ->limit(1)
    ->get();

    $data['title'] = 'Custom Report';
    $data['template'] = 'reports/CustomReport';
    return view('template/template', compact('data'));


}

}



