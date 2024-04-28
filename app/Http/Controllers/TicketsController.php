<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Http\Requests\StoreTicketsRequest;
use App\Http\Requests\UpdateTicketsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\TicketTimelineController;
//use Illuminate\Support\Carbon;
use Image;
use Alert;
use Mail;
use App\Mail\TicketDetails;
use App\Mail\SendTicktAllert;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    public function index()
    {
        $data['title'] = 'New Tickets';
        $data['busnus'] = DB::table('subsidiaries')
            ->select('*')
            ->get();
        $data['departments'] = DB::table('departments')
            ->select('*')
            ->get();
        $data['equpment_types'] = DB::table('equpment_types')
            ->select('*')
            ->get();
        $data['issues'] = DB::table('issues')
            ->select('*')
            ->get();
           
        // $data['template'] = 'tickets/index';
        return view('tickets/index', compact('data'));
    }

    public function create(Request $request)
    {
        if (
            !empty(
                DB::table('tickets')
                    ->orderBy('tickets_number', 'desc')
                    ->value('tickets_number')
            )
        ) {
            //  $pnumber=str_pad(+1, 8, '0', STR_PAD_LEFT);

            $getlast_number = explode(
                '-',
                DB::table('tickets')
                    ->orderBy('tickets_number', 'desc')
                    ->value('tickets_number'),
            );
            $pnumber = 'ANT-' . str_pad($getlast_number['1'] + 1, 8, '0', STR_PAD_LEFT);
        } else {
            $pnumber = 'ANT-' . str_pad(1, 8, '0', STR_PAD_LEFT);
        }

        $request->validate([
            'ticket_user_name' => ['required', 'string', 'max:255'],
            'ticket_email' => ['email', 'required', 'string', 'max:255'],
            'ticket_phone_number' => ['required', 'string', 'max:12'],
            'ticket_department_name' => ['required', 'string', 'max:255'],
            'ticket_organization' => ['required', 'string', 'max:255'],
            'ticket_equpment_types' => ['required', 'string', 'max:255'],
            'ticket_issues_id' => ['required'],
            'ticket_issues_note' => ['required', 'string'],
        ]);

        $working = [
            'tickets_number' => $pnumber,
            'ticket_user_name' => $request->ticket_user_name,
            'ticket_email' => $request->ticket_email,
            'ticket_phone_number' => $request->ticket_phone_number,
            'ticket_equpment_types' => $request->ticket_equpment_types,
            'ticket_department_name' => $request->ticket_department_name,
            'ticket_organization' => $request->ticket_organization,
            'ticket_issues_id' => $request->ticket_issues_id,
            'ticket_issues_note' => $request->ticket_issues_note,
            'ticket_date_time' => date('Y-m-d H:i:s'),
            'ticket_status' => 'Crate',
        ];

        $mailData = [
            'appname' => config('it.name'),
            'base_url' => config('app.url'),
            'title' => 'Your Ticket  :-' . $pnumber,
            'tickets_number' => $pnumber,
            'ticket_user_name' => $request->ticket_user_name,
            'ticket_email' => $request->ticket_email,
            'ticket_phone_number' => $request->ticket_phone_number,
            //'ticket_equpment_types'=>$request->ticket_equpment_types,
            //'ticket_department_name'=>$request->ticket_department_name,
            // 'ticket_organization'=>$request->ticket_organization,
            // 'ticket_issues_id'=>$request->ticket_issues_id,
            'ticket_issues_note' => $request->ticket_issues_note,
            'ticket_date_time' => date('Y-m-d H:i:s'),
            'ticket_status' => 'Crate',

            'ticket_equpment_types' => DB::table('equpment_types')
                ->select('*')
                ->where('equpment_types_id', '=', $request->ticket_equpment_types)
                ->pluck('equpment_name')
                ->first(),
            'ticket_department_name' => DB::table('departments')
                ->select('*')
                ->where('department_id', '=', $request->ticket_department_name)
                ->pluck('department_name')
                ->first(),
            'ticket_organization' => DB::table('subsidiaries')
                ->select('*')
                ->where('subsidiaries_id', '=', $request->ticket_organization)
                ->pluck('subsidiaries_name')
                ->first(),
            'ticket_issues_id' => DB::table('issues')
                ->select('*')
                ->where('issues_id', '=', $request->ticket_issues_id)
                ->pluck('issues_name')
                ->first(),
            'daily_tasks_attend_by' => 'Need to Attend',
        ];

        Mail::mailer('it')
            ->to($request->ticket_email)
            ->send(new TicketDetails($mailData));
        Mail::mailer('it')
            ->to('it@assetnetworks.net')
            ->send(new SendTicktAllert($mailData));

        DB::table('tickets')->insert($working);
        $tickets_id = DB::getPdo()->lastInsertId();

        return redirect('/new_tickts')->with('success', 'Your Ticket Number  : - </br>' . $pnumber . '&nbsp;&nbsp; Save Sucess Full');
    }

    public function newtickets(Request $request)
    {
        // dd($request);

        if (
            !empty(
                DB::table('tickets')
                    ->orderBy('tickets_number', 'desc')
                    ->value('tickets_number')
            )
        ) {
            //  $pnumber=str_pad(+1, 8, '0', STR_PAD_LEFT);

            $getlast_number = explode(
                '-',
                DB::table('tickets')
                    ->orderBy('tickets_number', 'desc')
                    ->value('tickets_number'),
            );
            $pnumber = 'ANT-' . str_pad($getlast_number['1'] + 1, 8, '0', STR_PAD_LEFT);
        } else {
            $pnumber = 'ANT-' . str_pad(1, 8, '0', STR_PAD_LEFT);
        }

        $request->validate([
            'ticket_issues_note' => ['required', 'string'],
            'ticket_organization' => ['required', 'string'],
        ]);



       $ticket_department_name= DB::table('job_working')
        ->where('profile_id','=',$request->ticket_profile_id)
        ->where('profile_job_work_sbu','=',$request->ticket_organization)
        ->value('profile_job_work_department');

        $ticket_email= DB::table('job_working')
        ->where('profile_id','=',$request->ticket_profile_id)
        ->where('profile_job_work_sbu','=',$request->ticket_organization)
        ->value('profile_job_work_email');


        $working = [
            'tickets_number' => $pnumber,
            'tickets_profile_id' => $request->ticket_profile_id,
            'tickets_equ_id' => $request->equipment_id,
            'ticket_user_name' => $request->ticket_user_name,
            'ticket_email' => $ticket_email,
            'ticket_phone_number' => $request->ticket_phone_number,
            'ticket_equpment_types' => $request->ticket_equpment_types,
            'ticket_department_name' =>$ticket_department_name,
            'ticket_organization' => $request->ticket_organization,
            'ticket_issues_id' => $request->ticket_issues_id,
            'ticket_issues_note' => $request->ticket_issues_note,
            'ticket_date_time' => date('Y-m-d H:i:s'),
            'ticket_status' => 'Crate',
        ];


      //  dd( $working );

        $mailData = [
            'appname' => config('it.name'),
            'base_url' => config('app.url'),
            'title' => 'Your Ticket  :-' . $pnumber,
            'tickets_number' => $pnumber,
            'ticket_user_name' => $request->ticket_user_name,
            'ticket_email' => $ticket_email,
            'ticket_phone_number' => $request->ticket_phone_number,
            //'ticket_equpment_types'=>$request->ticket_equpment_types,
            //'ticket_department_name'=>$request->ticket_department_name,
            // 'ticket_organization'=>$request->ticket_organization,
            // 'ticket_issues_id'=>$request->ticket_issues_id,
            'ticket_issues_note' => $request->ticket_issues_note,
            'ticket_date_time' => date('Y-m-d H:i:s'),
            'ticket_status' => 'Crate',

            'ticket_equpment_types' => DB::table('equpment_types')
                ->select('*')
                ->where('equpment_types_id', '=', $request->ticket_equpment_types)
                ->pluck('equpment_name')
                ->first(),
            'ticket_department_name' => DB::table('departments')
                ->select('*')
                ->where('department_id', '=', $request->ticket_department_name)
                ->pluck('department_name')
                ->first(),
            'ticket_organization' => DB::table('subsidiaries')
                ->select('*')
                ->where('subsidiaries_id', '=', $request->ticket_organization)
                ->pluck('subsidiaries_name')
                ->first(),
            'ticket_issues_id' => DB::table('issues')
                ->select('*')
                ->where('issues_id', '=', $request->ticket_issues_id)
                ->pluck('issues_name')
                ->first(),
            'daily_tasks_attend_by' => 'Need to Attend',
        ];

          Mail::mailer('it')->to($ticket_email)->send(new TicketDetails($mailData));
          Mail::mailer('it')->to('it@assetnetworks.net')->send(new SendTicktAllert($mailData));

        DB::table('tickets')->insert($working);
        $tickets_id = DB::getPdo()->lastInsertId();

        return Redirect::back()->with('success', 'Your Ticket Number  : - </br>' . $pnumber . '&nbsp;&nbsp; Save Sucess Full');

      // return redirect('/view-profile/' . $request->profile_sug . '')->with('success', 'Your Ticket Number  : - </br>' . $pnumber . '&nbsp;&nbsp; Save Sucess Full');
    }

    public static function timecaluculate($date_time, $next_date)
    {
        if (!empty($date_time) and !empty($next_date)) {
            if (!empty($next_date)) {
                $startTime = Carbon::parse($next_date);
                $endTime = Carbon::parse($date_time);
                echo 'D-' . $startTime->diff($endTime)->format('%d %H:%I:%S');
            } else {
                $startTime = Carbon::parse(date('Y-m-d H:i:s'));
                $endTime = Carbon::parse($date_time);
                echo 'D-' . $startTime->diff($endTime)->format('%d %H:%I:%S');
            }
        } else {
            $startTime = Carbon::parse(date('Y-m-d H:i:s'));
            $endTime = Carbon::parse($date_time);
            echo 'D-' . $startTime->diff($endTime)->format('%d %H:%I:%S');
        }
    }

    public function weeklyreport()
    {
        $data['title'] = 'Tickets Reports';
        $data['template'] = 'tickets/weeklyreport';
        return view('template/template', compact('data'));
    }

    public function weeklyreportview(Request $request)
    {
        if (empty($request->date1) && empty($request->date2)) {
            return redirect('/weeklyreport')->with('success', 'Please fill a deta');
        }

        $data['title'] = 'Tickets Reports';
        $data['dates'] = $request->date1 . '&' . $request->date2;

        $data['tickets'] = DB::table('tickets')
            ->whereDate('ticket_date_time', '>=', $request->date1)
            ->whereDate('ticket_date_time', '<=', $request->date2)
            ->orderBy('ticket_date_time', 'asc')
            ->get();

        $data['dailywork'] = DB::table('daily_tasks')
            ->whereDate('daily_tasks_date_time', '>=', $request->date1)
            ->whereDate('daily_tasks_finish_datetime', '<=', $request->date2)
            ->orderBy('daily_tasks_date_time', 'asc')
            ->get();

        $data['template'] = 'tickets/weeklyreportview';
        return view('template/template', compact('data'));
    }

    public static function daycount()
    {
    }

    public function allticket()
    {
        $data['all'] = DB::table('tickets')
            ->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
            ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'tickets.ticket_equpment_types')
            ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
            // ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
            // ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
            // ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
            // ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
            // ->where('profiles.profile_sug','=',$profile_id)
            // ->where('job_working.profile_job_work_status','Active')
            // ->orderBy('job_working.job_working_profile_id', 'DESC')
            ->get();

        $data['subdiary'] = DB::table('subsidiaries')
            ->select('*')
            ->get();
        $data['title'] = 'All Tickets';
        $data['template'] = 'tickets/allticket';
        return view('template/template', compact('data'));
    }

    public static function pichart3dallticket($subsidiaries_id)
    {
        DB::table('tickets')
            ->where('ticket_organization', '=', $subsidiaries_id)
            ->count();
    }

    public function ticketstatus()
    {
        $data['all'] = DB::table('tickets')
            ->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
            ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'tickets.ticket_equpment_types')
            ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
            ->where('tickets.ticket_status', 'Crate')
            ->Orwhere('tickets.ticket_status', 'Process')
            ->Orwhere('tickets.ticket_status', 'View')
            // ->orderBy('job_working.job_working_profile_id', 'DESC')
            ->get();

        $data['title'] = 'Tickets ';
        $data['template'] = 'tickets/allticket';
        return view('template/template', compact('data'));
    }

    public function donetickets()
    {
        $data['all'] = DB::table('tickets')
            ->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
            ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'tickets.ticket_equpment_types')
            ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
            ->where('tickets.ticket_status', 'Finish')

            // ->orderBy('job_working.job_working_profile_id', 'DESC')
            ->get();

        $data['title'] = 'Tickets ';
        $data['template'] = 'tickets/allticket';
        return view('template/template', compact('data'));
    }

    public static function alloraganization()
    {
        $org = DB::table('subsidiaries')
            ->select('*')
            ->orderBy('subsidiaries_name', 'asc')
            ->get();
        foreach ($org as $org) {
            echo json_encode($org->subsidiaries_name) . ',';
        }
    }

    public static function dfg()
    {
        $org = DB::table('subsidiaries')
            ->select('*')
            ->orderBy('subsidiaries_name', 'asc')
            ->get();
        foreach ($org as $org) {
            dd($org->subsidiaries_id);

            dd(
                DB::table('tickets')
                    ->select('*')
                    ->where('ticket_date_time', 'like', '%' . date('Y') . '%')
                    ->where('ticket_organization', '=', $org->subsidiaries_id)
                    //  ->where('ticket_date_time','like','%'. date('Y') .'%')
                    //->groupBy('ticket_organization')
                    ->count(),
            );
        }
    }

    public static function yearlytickets()
    {
        $org = DB::table('subsidiaries')
            ->select('*')
            ->orderBy('subsidiaries_name', 'asc')
            ->get();
        foreach ($org as $org) {
            echo DB::table('tickets')
                ->select('*')
                ->where('ticket_date_time', 'like', '%' . date('Y') . '%')
                ->where('ticket_organization', '=', $org->subsidiaries_id)
                //  ->where('ticket_date_time','like','%'. date('Y') .'%')
                //->groupBy('ticket_organization')
                ->count() . ',';
        }
    }

    public static function profileImage($profile_id, $subsidiaries_id)
    {
        if (!empty($profile_id)) {
            $image = DB::table('profiles')
                ->where('profile_id', '=', $profile_id)
                ->value('profile_image');
            echo '/profile-image/' . $image;
        } else {
            $image = DB::table('subsidiaries')
                ->where('subsidiaries_id', '=', $subsidiaries_id)
                ->value('subsidiaries_logo');
            echo '/sbu_logo/' . $image;
        }
    }

    public static function equpmentlinkcrate($tickets_equ_id)
    {
        // dd($tickets_equ_id);
        $equnumber = DB::table('equipment')
            ->where('equipment_id', '=', $tickets_equ_id)
            ->value('equipment_number');
        echo '/equpment/' . $equnumber;
    }

    public function ticketsummaryDate(Request $request)
    {
        $data['startDate'] = $request->startDate;
        $data['endDate'] = $request->endDate;

        $data['subsidiaries'] = DB::table('subsidiaries')
            ->select('*')
            ->orderBy('subsidiaries_name', 'asc')
            ->get();

        $data['title'] = 'Ticket Summary ';
        $data['template'] = 'tickets/ticketsummaryDate';
        return view('template/template', compact('data'));
    }

    public static function ticketfilter($startDate, $endDate, $subsidiaries_id)
    {


        if(!empty($startDate) AND !empty($endDate)){
            $tickets = DB::table('tickets')
            ->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
            ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'tickets.ticket_equpment_types')
            ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
            ->where('tickets.ticket_organization', $subsidiaries_id)
            ->where('ticket_date_time','>=',$startDate)
            ->where('ticket_date_time','<=',$endDate)
            ->get();

        }else{
            $tickets = DB::table('tickets')
            ->select('*')
            ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
            ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'tickets.ticket_equpment_types')
            ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
            ->where('tickets.ticket_organization', $subsidiaries_id)
            ->where('ticket_date_time','>=',date('Y-m-d', strtotime('first day of last month')))
            ->where('ticket_date_time','<=',date('Y-m-d', strtotime('last day of last month')))
            ->get();
        }





            $count=1;
        foreach ($tickets as $row => $tickets) {

            /// swich status

            switch ($tickets->ticket_status) {
                case "Crate":
                   $ticketStatus= ' <span class="badge badge-pill badge-danger">'.$tickets->ticket_status.'</span>';
                  break;
                case "View":
                    $ticketStatus= '<span class="badge badge-pill badge-warning">'.$tickets->ticket_status.'</span>';
                  break;
                case "Process":
                    $ticketStatus= '<span class="badge badge-pill badge-info">'.$tickets->ticket_status.'</span>';
                  break;
                  case "Finish":
                    $ticketStatus= '<span class="badge badge-pill badge-success">'.$tickets->ticket_status.'</span>';
                    break;
              }


                      echo '
                         <tr>
                          <td>'.$count ++.'</td>
                          <td><a href="/oneTicket/'.$tickets->tickets_number.'" target="_blank">'.$tickets->tickets_number.'</a></td>
                          <td>'.$tickets->ticket_user_name.'</td>
                          <td>'.$tickets->ticket_date_time.'</td>
                          <td>'.$ticketStatus.'</td>
                          </tr>';
        }
    }


public static function myticket($profile_id,$tickets_equ_id){


    $tickets = DB::table('tickets')
    ->select('*')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
    ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'tickets.ticket_equpment_types')
    ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
    ->where('tickets.tickets_profile_id', $profile_id)
    ->where('tickets.tickets_equ_id', $tickets_equ_id)
    ->orderBy('tickets.tickets_number', 'DESC')
   // ->where('ticket_date_time','>=',date('Y-m-d', strtotime('first day of last month')))
   // ->where('ticket_date_time','<=',date('Y-m-d', strtotime('last day of last month')))
    ->get();

     $counts=1;
    foreach($tickets as $tickets){



        if (!empty($tickets->ticket_date_time) and !empty($tickets->ticket_finish_datetime)) {
            if (!empty($tickets->ticket_finish_datetime)) {
                $startTime = Carbon::parse($tickets->ticket_finish_datetime);
                $endTime = Carbon::parse($tickets->ticket_date_time);
                $diffdate= 'D-' . $startTime->diff($endTime)->format('%d %H:%I:%S');
            } else {
                $startTime = Carbon::parse(date('Y-m-d H:i:s'));
                $endTime = Carbon::parse($tickets->ticket_date_time);
                $diffdate= 'D-' . $startTime->diff($endTime)->format('%d %H:%I:%S');
            }
        } else {
            $startTime = Carbon::parse(date('Y-m-d H:i:s'));
            $endTime = Carbon::parse($tickets->ticket_date_time);
            $diffdate= 'D-' . $startTime->diff($endTime)->format('%d %H:%I:%S');
        }



        echo '
               <tr>
                        <td>'.$counts ++.'</td>
                        <td >'.$tickets->tickets_number.'</td>
                        <td>'.$tickets->ticket_date_time.'</td>
                        <td>'. $diffdate.'</td>
                        <td>'.$tickets->issues_name.'</td>
                        <td>'.$tickets->ticket_status.'</td>
                    </tr>';
    }

}



    public static function ticket_acess_eploymee(){

        $users=DB::table('users')
            ->select('*')
            ->join('profiles','profiles.profile_id','=','users.profile_id')
            ->where('users.ticketupdate','on')
            ->orderBy('profiles.profile_Full_name', 'asc')
            ->get();

            foreach($users as $row){

                echo '<option value="'.$row->profile_id.'">'.$row->profile_Full_name.'</option>';
            }

    }



    public function ticketOwner(Request $request){


        $request->validate([
            'ticket_owner' => ['required', 'string', 'max:255'],         
    
             ]);

             $ticketdetails=array(
                'ticket_owner'=>$request->ticket_owner,
             );
             DB::table('tickets')->where('tickets_id',$request->tickets_id)->update($ticketdetails);

             return redirect('/oneTicket/'.$request->tickets_number.'')->with('success',' Ticket Owner added successfully');

             //tickets_id
             //tickets_number
    

    }



    public static function ticket_owner_view($profile_id){

       $firstName= DB::table('profiles')->where('profile_id','=',$profile_id)->value('profile_first_name');
       $LastName= DB::table('profiles')->where('profile_id','=',$profile_id)->value('profile_last_name');

       if(!empty($firstName)){
        echo '
        <div class="col-sm-12">
        <h4> Ticket Ticket Assigned to : '.$firstName.' '.$LastName.'</h4>
        </div>';
       }
       else{
        echo ' <div class="alert alert-danger">
        <strong>Danger!</strong> Not assigned Ticket owner
      </div>';
       }
    }



public function ticket_ownerWice(){



    $data['tiket_owers']= DB::table('users')
       ->select('*')
       ->join('profiles','profiles.profile_id','=','users.profile_id')
       ->whereNotNull('ticketupdate')         
       ->get();


       $data['tiket_issued']= DB::table('issues')
       ->select('*')       
       ->get();



        $data['title'] = 'Ticket Owners Report';
        $data['template'] = 'tickets/ticket_owners_report';
        return view('template/template', compact('data'));

}


public static function lastweekCountofstatus($profile_id,$status){

        if($status=='Finish'){  
        $finish=  DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
        ->where('ticket_status',$status) 
        ->whereBetween('ticket_finish_datetime',[Carbon::now()->subDay(7).'%',Carbon::now()->addDay(1).'%'])      
        ->count();

        echo $finish;




       }
       else{    
        

        $finish= DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
        ->where('ticket_status',$status)        
        ->count();


     echo $finish;

       }
    }


       public static function lastMonthCountofstatus($profile_id,$status){

        if($status=='Finish'){  
        $finish=  DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
        ->where('ticket_status',$status) 
        ->whereBetween('ticket_finish_datetime',[Carbon::now()->subDay(30).'%',Carbon::now()->addDay(1).'%'])      
        ->count();

        echo $finish;




       }
       else{    
        

        $finish= DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
        ->where('ticket_status',$status)        
        ->count();


     echo $finish;

       }


   
    }


    public static function lastweektotalTickets($profile_id){

        $finish= DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
       ->where('ticket_status','Crate') 
       ->ORwhere('ticket_status','View')
       ->Orwhere('ticket_status','Process')      
       ->whereBetween('ticket_date_time',[Carbon::now()->subDay(7).'%',Carbon::now()->addDay(1).'%'])       
        ->count()+
        DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
        ->where('ticket_status','Finish') 
        ->whereBetween('ticket_finish_datetime',[Carbon::now()->subDay(7).'%',Carbon::now()->addDay(1).'%'])      
        ->count();


        echo $finish;

    }



    public static function lastmonthtotalTickets($profile_id){

        $finish=  DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
       ->where('ticket_status','Crate') 
       ->ORwhere('ticket_status','View')
       ->Orwhere('ticket_status','Process')      
       ->whereBetween('ticket_date_time',[Carbon::now()->subDay(31).'%',Carbon::now()->addDay(1).'%'])       
        ->count()+
        DB::table('tickets')
        ->select('*')
        ->where('ticket_owner',$profile_id) 
        ->where('ticket_status','Finish') 
        ->whereBetween('ticket_finish_datetime',[Carbon::now()->subDay(31).'%',Carbon::now()->addDay(1).'%'])      
        ->count();

        echo $finish;

    }
public static function tismonthinvoice(){
    B::table('tickets')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
    ->whereNotNull('ticket_invoice_amount')->get();
}


public static function thisweektiketorf($subsidiaries_id){

    $ticket= DB::table('tickets')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
    ->whereBetween('tickets.ticket_finish_datetime',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])  
    ->whereNotNull('tickets.ticket_invoice_amount')
    ->where('tickets.ticket_organization',$subsidiaries_id) 
    ->count();

    if(!empty($ticket)){
        echo $ticket  ;
    }else{
    echo '';
    }

}


public static function thisweektiketorfValuve($subsidiaries_id){

    $ticket= DB::table('tickets')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
    ->whereBetween('tickets.ticket_finish_datetime',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])  
    ->whereNotNull('tickets.ticket_invoice_amount')
    ->where('tickets.ticket_organization',$subsidiaries_id) 
    ->sum('ticket_invoice_amount'); 

    if(!empty($ticket)){
       // echo number_format($ticket,2);
    }else{
    echo '';
    }

}



public static function thisweektikettotal(){

    $ticket= DB::table('tickets')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
    ->whereBetween('tickets.ticket_finish_datetime',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])  
    ->whereNotNull('tickets.ticket_invoice_amount')    
    ->count();

    if(!empty($ticket)){
        echo $ticket  ;
    }else{
    echo '';
    }

}


public static function thisweektikettotalincome(){

    $ticket= DB::table('tickets')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
    ->whereBetween('tickets.ticket_finish_datetime',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])  
    ->whereNotNull('tickets.ticket_invoice_amount')    
    ->sum('ticket_invoice_amount'); 

    if(!empty($ticket)){
        echo number_format($ticket,2);
    }else{
    echo '';
    }

}




public static function totalthisweek(){


    $ticket= DB::table('tickets')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')
    ->whereBetween('tickets.ticket_finish_datetime',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])  
    ->whereNotNull('tickets.ticket_invoice_amount')    
    ->sum('ticket_invoice_amount');
    
    $equipment = DB::table('equipment')->select('*') 
    ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(31).'%',Carbon::now()->addDay(1).'%'])   
    ->sum('equipment_asset_value')-DB::table('equipment')->select('*') 
    ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(31).'%',Carbon::now()->addDay(1).'%'])   
    ->sum('equipment_vender_value'); 

    if(!empty($ticket) AND !empty($equipment)){
        echo number_format($ticket-$equipment,2);
    }else{
    echo '';
    }



}


public function tickat_dash(){
    $data['title'] = 'Ticket Dashbord';
    $data['template'] = 'tickets/dashbord';
    return view('template/template', compact('data'));
    }



  

     public static function tiket_asingname($profile_id){

   echo      DB::table('profiles')
   ->where('profile_id', '=',$profile_id) 
   ->value('profile_first_name').' '.DB::table('profiles')
   ->where('profile_id', '=',$profile_id) 
   ->value('profile_last_name'); 

     }

     public function target_date_update(Request $request){
        $request->validate([
            'ticket_target_finish_datetime' => ['required', 'string'],                       
            ]);

            $updateTicket=array(
                'ticket_status'=>'Process',
                'ticket_target_finish_datetime'=>$request->ticket_target_finish_datetime,
                'ticket_attend_by'=>Auth::user()->name,);
             DB::table('tickets')->where('tickets_id', $request->tickets_id)->update($updateTicket);


             $ticket_timelines=array(
                'ticket_timelines_ticket_id'=>$request->tickets_id,
                'ticket_timelines_ticket_action'=>'Adding Ticket target date'.' * '.$request->ticket_target_finish_datetime.' * ',
                'ticket_timelines_ticket_status'=>'Process',
                'ticket_timelines_date_time'=>date('Y-m-d H:i:s'),
                'ticket_timelines_last_update_adby'=>Auth::user()->name,
                );
            DB::table('ticket_timelines')->insert($ticket_timelines);

            return Redirect::back()->with('success', 'Your Ticket Number  : - </br>' . $request->tickets_number . '&nbsp;&nbsp; Save Sucess Full');


     }



     public function ticket_report(Request $request){

         $data['ticket']=  DB::table('tickets')
        ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')        
        ->where('tickets.ticket_date_time', '>=', "%".date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7)))."%")
        ->Orwhere('tickets.ticket_date_time', '=<', "%".date('Y-m-d 00:00:00', strtotime(Carbon::now()))."%")
         ->get() ;

         $data['tecnical_officer']= DB::table('users')
         ->join('profiles', 'profiles.profile_id', '=', 'users.profile_id')        
         ->where('users.ticketupdate', '=','on')         
         ->get() ;

         $data['subsidiaries']= DB::table('subsidiaries')
         ->select('*')
         ->orderBy('subsidiaries_name', 'ASC')       
         ->get() ;

 
         $data['title'] = 'Ticket Report';
         $data['template'] = 'tickets/ticketreport01';
         return view('template/template', compact('data'));
     }
 
 
     public function ticket_get_report(Request $request){
 
        // dd(date('Y-m-d H:i:s', strtotime($request->start)));
 
          $data['ticket']=  DB::table('tickets')
          ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'tickets.ticket_organization')        
          ->where('tickets.ticket_date_time', '>=', date('Y-m-d 00:00:00', strtotime($request->start)))
          ->ORwhere('tickets.ticket_date_time', '=<', date('Y-m-d 00:00:00', strtotime($request->end)))
          ->get() ;
 
          $data['tecnical_officer']= DB::table('users')
          ->join('profiles','profiles.profile_id','=','users.profile_id')        
          ->where('users.ticketupdate', '=','on')         
          ->get() ;

          $data['subsidiaries']= DB::table('subsidiaries')
          ->select('*')
          ->orderBy('subsidiaries_name', 'ASC')       
          ->get() ;
 
          $data['start_date']=date('Y-m-d H:i:s', strtotime($request->start));
          $data['end_date']=date('Y-m-d H:i:s', strtotime($request->end));
          
          $data['title'] = 'Ticket Report';
          $data['template'] = 'tickets/ticketreport02';
          return view('template/template', compact('data'));
      }
 

     // ticket twodays count

     public static function viewtickets_view($profile_id,$start_date,$end_date){
        $deta=  DB::table('tickets')
        ->where('ticket_owner','=',$profile_id) 
        ->where('ticket_status','=','View')  
        ->where('ticket_date_time', '>=', $start_date)
        ->Orwhere('ticket_date_time', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{

        }
     }


     public static function viewtickets_received($profile_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
        ->where('ticket_owner','=',$profile_id) 
        //->where('ticket_status','=','Crate')  
        ->where('ticket_date_time', '>=', $start_date)
        ->Orwhere('ticket_date_time', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }

     public static function viewtickets_pending($profile_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
        ->where('ticket_owner','=',$profile_id)        
        ->where('ticket_status','=','Process')      
        ->where('ticket_date_time', '>=', $start_date)
        ->Orwhere('ticket_date_time', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }

     public static function viewtickets_finish($profile_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
      //  ->select('*')
        ->where('ticket_owner','=',$profile_id) 
       ->where('ticket_status','=','Finish')     
        ->where('ticket_finish_datetime', '>=', $start_date)
        ->Orwhere('ticket_finish_datetime', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }


     public static function viewtickets_total($profile_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
        ->where('ticket_status','=','Finish') 
        ->where('ticket_owner','=',$profile_id)    
        ->where('ticket_finish_datetime', '>=', $start_date)
        ->Orwhere('ticket_finish_datetime', '=<', $end_date)      
        ->count() +  DB::table('tickets')                    
                    ->where('ticket_owner','=',$profile_id) 
                    ->where('ticket_status','Crate')   
                    ->where('ticket_date_time', '>=', $start_date)
                    ->Orwhere('ticket_date_time', '=<', $end_date)      
                    ->count() +
                    DB::table('tickets')                    
                    ->where('ticket_owner','=',$profile_id) 
                    ->where('ticket_status','View') 
                    ->where('ticket_date_time', '>=', $start_date)
                    ->Orwhere('ticket_date_time', '=<', $end_date)      
                    ->count() +
                    DB::table('tickets')                    
                    ->where('ticket_owner','=',$profile_id)
                    ->where('ticket_status','Process')  
                    ->where('ticket_date_time', '>=', $start_date)
                    ->Orwhere('ticket_date_time', '=<', $end_date)      
                    ->count(); 

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
      
    

     }


     //organization tickets


     public static function org_viewtickets_view($subsidiaries_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
        //->select('*')
        ->where('ticket_organization','=',$subsidiaries_id) 
        ->where('ticket_status','=','View')  
        ->where('ticket_date_time', '>=', $start_date)
        ->Orwhere('ticket_date_time', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }


     public static function org_viewtickets_received($subsidiaries_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
        //->select('*')
        ->where('ticket_organization','=',$subsidiaries_id) 
        ->where('ticket_status','=','Crate')  
        ->where('ticket_date_time', '>=', $start_date)
        ->Orwhere('ticket_date_time', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }

     public static function org_viewtickets_pending($subsidiaries_id,$start_date,$end_date){
        $deta=   DB::table('tickets')
        ->where('ticket_organization','=',$subsidiaries_id)        
        ->where('ticket_status','=','Process')      
        ->where('ticket_date_time', '>=', $start_date)
        ->Orwhere('ticket_date_time', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }

     public static function org_viewtickets_finish($subsidiaries_id,$start_date,$end_date){
        $deta=  DB::table('tickets')
        ->where('ticket_organization','=',$subsidiaries_id) 
        ->where('ticket_status','=','Finish')     
        ->where('ticket_finish_datetime', '>=', $start_date)
        ->Orwhere('ticket_finish_datetime', '=<', $end_date)      
        ->count();

        if(!empty($deta)){
            echo $deta;
        }
        else{
            
        }
     }

     public static function org_total($subsidiaries_id,$start_date,$end_date){

        $deta=  DB::table('tickets')
          ->where('ticket_organization','=',$subsidiaries_id)              
          ->where('ticket_finish_datetime', '>=', $start_date)
          ->Orwhere('ticket_finish_datetime', '=<', $end_date)      
          ->count()+
          DB::table('tickets')
          ->where('ticket_organization','=',$subsidiaries_id)        
          ->where('ticket_status','=','Crate')      
          ->where('ticket_date_time', '>=', $start_date)
          ->Orwhere('ticket_date_time', '=<', $end_date)      
          ->count()+
          DB::table('tickets')
          ->where('ticket_organization','=',$subsidiaries_id)        
          ->where('ticket_status','=','View')      
          ->where('ticket_date_time', '>=', $start_date)
          ->Orwhere('ticket_date_time', '=<', $end_date)      
          ->count() +
          DB::table('tickets')
          ->where('ticket_organization','=',$subsidiaries_id)        
          ->where('ticket_status','=','Process')      
          ->where('ticket_date_time', '>=', $start_date)
          ->Orwhere('ticket_date_time', '=<', $end_date)      
          ->count();
  
          if(!empty($deta)){
              echo $deta;
          }
          else{
              
          }

     }


}
