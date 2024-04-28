<?php

namespace App\Http\Controllers;

use App\Models\DailyTaskTimeline;
use App\Http\Requests\StoreDailyTaskTimelineRequest;
use App\Http\Requests\UpdateDailyTaskTimelineRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\TicketTimelineController;
use Illuminate\Support\Carbon;
use Image;
Use Alert;
use Mail;
use App\Mail\TicketDetails;

class DailyTaskTimelineController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
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
             $updateTicket=array(
                'ticket_status'=>$request->ticket_timelines_ticket_status,
                'ticket_attend_by'=>Auth::user()->name,
                              );
             DB::table('tickets')->where('tickets_id', $request->tickets_id)->update($updateTicket);
             return redirect('/oneTicket'.'/'.$request->tickets_number)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

     }



    public static function allsteprecords($ticket_timelines){

        /*
        $request->validate([
            'ticket_timelines_ticket_action' => ['required', 'string'],
            'ticket_timelines_ticket_status' => ['required', 'string'],
             ]);

*/


             DB::table('daily_task_timelines')->insert($ticket_timelines);
             /*
             $updateTicket=array(
                'ticket_status'=>$request->ticket_timelines_ticket_status,
                'ticket_attend_by'=>Auth::user()->name,
                              );
             DB::table('tickets')->where('tickets_id', $request->tickets_id)->update($updateTicket);
*/
    }
}
