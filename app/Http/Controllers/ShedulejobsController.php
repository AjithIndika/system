<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AllowanceController;
use App\Mail\OnbordNotification;
use App\Mail\Offbordalletsend;
use App\Mail\BithdayWish;
use App\Mail\BithdayNotification;
use App\Mail\Taskremaind;
use App\Mail\InvoiceRemaind;



use Illuminate\Support\Carbon;

class ShedulejobsController extends Controller
{
    // onbord notification daily send 6pm
    public function onbordnotification_daily()
    {
        //echo Carbon::now()->addDays(18)->format('Y-m-d');

        //  echo Carbon::now()->format('Y-m-d');

        $onbord = DB::table('onbords')
            ->select('*')
            ->join('job_working', 'job_working.job_working_profile_id', '=', 'onbords.onbords_job_working_profile_id')
            ->join('profiles', 'profiles.profile_id', '=', 'onbords.onbords_profile_id')
            // ->where('onbords.onbords_crate_date','=',Carbon::now()->format('Y-m-d'))
            ->where('onbords.onbords_crate_date', 'like', '%' . Carbon::now()->format('Y-m-d') . '%')
            ->get();

        foreach ($onbord as $onbord) {
            $sublogo = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $onbord->onbords_profile_id)
                ->value('subsidiaries_logo');

            $subdiary = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $onbord->onbords_profile_id)
                ->value('subsidiaries_name');

            $onbordPerson = DB::table('onbords')
                ->join('profiles', 'profiles.profile_id', '=', 'onbords.onbords_profile_id')
                ->where('onbords.onbords_profile_id', '=', $onbord->onbords_profile_id)
                ->value('profile_Full_name');

            $jobroll = DB::table('job_join_history')
                ->join('designations', 'designations.designations_id', '=', 'job_join_history.profile_job_join_designation')
                ->where('job_join_history.profile_id', '=', $onbord->onbords_profile_id)
                ->value('designations_name');

            $mailData = [
                'appname' => config('app.name'),
                'base_url' => config('app.url'),
                'title' => 'New Onbord allert',
                'logo' => $sublogo,
                'subdiary' => $subdiary,
                'infromto' => $onbord->profile_first_name . ' ' . $onbord->profile_last_name,
                'Joindate' => $onbord->onbords_date,
                'new_onbord' => $onbordPerson,
                'jobroll' => $jobroll,
                'requstings' => $onbord->onbords_requst,
            ];

            Mail::mailer('hr')
                ->to($onbord->profile_job_work_email)
                ->send(new OnbordNotification($mailData));
        }
    }

    //onbord notification befor 18 days 5 am

    public function onbordnotification()
    {
        $onbord = DB::table('onbords')
            ->select('*')
            ->join('job_working', 'job_working.job_working_profile_id', '=', 'onbords.onbords_job_working_profile_id')
            ->join('profiles', 'profiles.profile_id', '=', 'onbords.onbords_profile_id')
            ->where(
                'onbords.onbords_date',
                '=',
                Carbon::now()
                    ->addDays(18)
                    ->format('Y-m-d'),
            )
            ->get();

        foreach ($onbord as $onbord) {
            $sublogo = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $onbord->onbords_profile_id)
                ->value('subsidiaries_logo');

            $subdiary = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $onbord->onbords_profile_id)
                ->value('subsidiaries_name');

            $onbordPerson = DB::table('onbords')
                ->join('profiles', 'profiles.profile_id', '=', 'onbords.onbords_profile_id')
                ->where('onbords.onbords_profile_id', '=', $onbord->onbords_profile_id)
                ->value('profile_Full_name');

            $jobroll = DB::table('job_join_history')
                ->join('designations', 'designations.designations_id', '=', 'job_join_history.profile_job_join_designation')
                ->where('job_join_history.profile_id', '=', $onbord->onbords_profile_id)
                ->value('designations_name');

            //    dd($jobroll);
            $mailData = [
                'appname' => config('app.name'),
                'base_url' => config('app.url'),
                'title' => 'New Onbord allert',
                'logo' => $sublogo,
                'subdiary' => $subdiary,
                'infromto' => $onbord->profile_first_name . ' ' . $onbord->profile_last_name,
                'Joindate' => $onbord->onbords_date,
                'new_onbord' => $onbordPerson,
                'jobroll' => $jobroll,
                'requstings' => $onbord->onbords_requst,
            ];

            Mail::mailer('hr')
                ->to($onbord->profile_job_work_email)
                ->send(new OnbordNotification($mailData));

            // echo $onbord->profile_id;
        }
    }

    // off bord notifications send daily

    public function offbordnotification_daily()
    {
        //echo Carbon::now()->addDays(18)->format('Y-m-d');

        $ofbord = DB::table('offbord_tasks')
            ->select('*')
            ->join('job_working', 'job_working.job_working_profile_id', '=', 'offbord_tasks.offbord_tasks_job_working_profile_id')
            ->join('profiles', 'profiles.profile_id', '=', 'offbord_tasks.offbord_tasks_profile_id')
            ->where('offbord_tasks.offbord_tasks_crate_date', 'like', '%' . Carbon::now()->format('Y-m-d') . '%')
            // ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(31).'%',Carbon::now()->addDay(1).'%'])
            ->get();

        foreach ($ofbord as $ofbord) {
            $sublogo = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $ofbord->offbord_tasks_profile_id)
                ->value('subsidiaries_logo');

            $subdiary = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $ofbord->offbord_tasks_job_working_profile_id)
                ->value('subsidiaries_name');

            $ofbordPerson = DB::table('offbord_tasks')
                ->join('profiles', 'profiles.profile_id', '=', 'offbord_tasks.offbord_tasks_job_working_profile_id')
                ->where('offbord_tasks.offbord_tasks_profile_id', 'like' . '%' . $ofbord->offbord_tasks_profile_id . '%')
                ->value('profile_Full_name');

            $jobroll = DB::table('job_join_history')
                ->join('designations', 'designations.designations_id', '=', 'job_join_history.profile_job_join_designation')
                ->where('job_join_history.profile_id', '=', $ofbord->offbord_tasks_job_working_profile_id)
                ->value('designations_name');

            $mailData = [
                'appname' => config('app.name'),
                'base_url' => config('app.url'),
                'title' => 'New Off-bord allert',
                'logo' => $sublogo,
                'subdiary' => $subdiary,
                'infromto' => $ofbord->profile_first_name . ' ' . $ofbord->profile_last_name,
                'Joindate' => $ofbord->offbord_tasks_date,
                'offbord' => $ofbordPerson,
                'jobroll' => $jobroll,
                'requstings' => $ofbord->offbord_tasks_requst,
            ];

            Mail::mailer('hr')
                ->to($ofbord->profile_job_work_email)
                ->send(new Offbordalletsend($mailData));

            // echo $onbord->profile_id;
        }
    }

    // off bord notifications send befor 18 days

    public function offbordnotification()
    {
        //echo Carbon::now()->addDays(18)->format('Y-m-d');

        $ofbord = DB::table('offbord_tasks')
            ->select('*')
            ->join('job_working', 'job_working.job_working_profile_id', '=', 'offbord_tasks.offbord_tasks_job_working_profile_id')
            ->join('profiles', 'profiles.profile_id', '=', 'offbord_tasks.offbord_tasks_profile_id')
            ->where(
                'offbord_tasks.offbord_tasks_crate_date',
                'like',
                '%' .
                    Carbon::now()
                        ->addDays(18)
                        ->format('Y-m-d') .
                    '%',
            )
            ->get();

        foreach ($ofbord as $ofbord) {
            $sublogo = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $ofbord->offbord_tasks_profile_id)
                ->value('subsidiaries_logo');

            $subdiary = DB::table('job_join_history')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'job_join_history.profile_job_join_sbu')
                ->where('job_join_history.profile_id', '=', $ofbord->offbord_tasks_job_working_profile_id)
                ->value('subsidiaries_name');

            $ofbordPerson = DB::table('offbord_tasks')
                ->join('profiles', 'profiles.profile_id', '=', 'offbord_tasks.offbord_tasks_job_working_profile_id')
                ->where('offbord_tasks.offbord_tasks_profile_id', '=', $ofbord->offbord_tasks_profile_id)
                ->value('profile_Full_name');

            $jobroll = DB::table('job_join_history')
                ->join('designations', 'designations.designations_id', '=', 'job_join_history.profile_job_join_designation')
                ->where('job_join_history.profile_id', '=', $ofbord->offbord_tasks_job_working_profile_id)
                ->value('designations_name');

            $mailData = [
                'appname' => config('app.name'),
                'base_url' => config('app.url'),
                'title' => 'New Off-bord allert',
                'logo' => $sublogo,
                'subdiary' => $subdiary,
                'infromto' => $ofbord->profile_first_name . ' ' . $ofbord->profile_last_name,
                'Joindate' => $ofbord->offbord_tasks_date,
                'offbord' => $ofbordPerson,
                'jobroll' => $jobroll,
                'requstings' => $ofbord->offbord_tasks_requst,
            ];

            Mail::mailer('hr')
                ->to($ofbord->profile_job_work_email)
                ->send(new Offbordalletsend($mailData));
        }
    }

    public function bithdaywishtoday()
    {
        if ('06:30:02' == Carbon::now()->format('h:i:s')) {
            $bithday = DB::table('profiles')
                ->select('*')
                ->join('job_working', 'job_working.profile_id', '=', 'profiles.profile_id')
                // ->where('profiles.profile_bith_day','like','%'.Carbon::now()->format('m-d').'%')
                ->where('profiles.profile_status', 'Active')
                ->where('job_working.profile_job_work_status', 'Active')
                ->get();

            foreach ($bithday as $key => $bithday) {
                if (date('m-d', strtotime($bithday->profile_bith_day)) == Carbon::now()->format('m-d')) {
                    //   dd($bithday->profile_image);

                    $mailData = [
                        'appname' => config('app.name'),
                        'base_url' => config('app.url'),
                        'proimage' => $bithday->profile_image,
                        
                        'name' => $bithday->profile_first_name . ' ' . $bithday->profile_last_name,
                        
                    ];

                    // Mail::mailer('hr')->to($bithday->profile_job_work_email)->send(new BithdayWish($mailData));

                    Mail::mailer('hr')
                        ->to('it@assetnetworks.net')
                        ->send(new BithdayWish($mailData));
                } else {
                    $bith_alllert = DB::table('job_working')
                        ->select('*')
                        ->join('profiles', 'profiles.profile_id', '=', 'job_working.profile_id')
                        // ->where('profiles.profile_bith_day','like','%'.Carbon::now()->format('m-d').'%')
                        ->where('job_working.profile_job_work_status', 'Active')
                        //  ->where('job_working.profile_job_work_status','Active')
                        ->where('profiles.profile_bith_day', 'like', '%' . Carbon::now()->format('m-d') . '%')
                        ->get();

                    foreach ($bith_alllert as $key => $bith_alllert) {
                        if (!empty($bithday->profile_image)) {
                            $images = config('app.url') . '/profile-image/' . $bithday->profile_image;
                        } else {
                            $images = 'https://media.tenor.com/620SpbPsljwAAAAi/cake.gif';
                        }

                        $mailData = [
                            'appname' => config('app.name'),
                            'base_url' => config('app.url'),
                            'proimage' => $images,
                            //'subdiary'=> $subdiary,
                            // 'infromto'=>$ofbord->profile_first_name.' '.$ofbord->profile_last_name,
                            // 'Joindate'=>$ofbord->offbord_tasks_date,
                            'bithday_owner_email' => $bith_alllert->profile_job_work_email,
                            'bithday_owner_mobile' => $bith_alllert->profile_job_work_mobile,
                            'name' => $bith_alllert->profile_first_name . ' ' . $bith_alllert->profile_last_name,

                            //'requstings'=>$ofbord->offbord_tasks_requst
                        ];
                        //  echo $bithday->profile_job_work_email."</br>";

                        Mail::mailer('hr')
                            ->to('it@assetnetworks.net')
                            ->send(new BithdayNotification($mailData));
                    }
                }
            }
        }
    }

    public function pandingJobsallert()
    {
       

        $tech = DB::table('users')
            ->join('job_working', 'job_working.profile_id', '=', 'users.profile_id')
            ->where('users.ticketupdate', '=', 'on')
            ->where('job_working.profile_job_work_status', '=', 'Active')
            ->get();

        foreach ($tech as $key => $tech) {
            // echo $tech->name.'</br>';
            $tickets = DB::table('tickets')
                ->where([
                    'tickets.ticket_owner' => $tech->profile_id,
                    'tickets.ticket_status' => 'View',
                    'tickets.ticket_status' => 'Crate',
                    'tickets.ticket_status' => 'Process',
                ])
                ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
                ->get();

            $mailData = [
                // 'appname' => config('app.name'),
                'base_url' => config('app.url'),
                'title' => 'Pending Tasks',
                'techmember' => $tech->name,
                'tasklist' => $tickets,
            ];
            Mail::mailer('it')
                ->to($tech->profile_job_work_email)
                ->send(new Taskremaind($mailData));
        }
    
}



public function invoiceremaind(){

    $tech = DB::table('users')
    ->join('job_working', 'job_working.profile_id', '=', 'users.profile_id')
    ->where('users.invoice_permition', '=', 'on')
    ->where('job_working.profile_job_work_status', '=', 'Active')
    ->get();

    foreach($tech as $key => $tech){

        $tickets = DB::table('tickets')
        ->where([
            'tickets.ticket_invoisable' =>'Yes',
            'tickets.ticket_invoice_number' =>null,
            'tickets.ticket_on_agriment' =>null,
        ])
        ->join('issues', 'issues.issues_id', '=', 'tickets.ticket_issues_id')
        ->get();

        $mailData = [
            // 'appname' => config('app.name'),
            'base_url' => config('app.url'),
            'title' => 'Pending Tasks',
            'invoiceName' => $tech->name,
            'tasklist' => $tickets,
        ];

        Mail::mailer('it')
            ->to($tech->profile_job_work_email)
            ->send(new InvoiceRemaind($mailData));
    }



}



}
