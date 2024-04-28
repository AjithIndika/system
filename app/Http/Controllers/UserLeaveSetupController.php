<?php

namespace App\Http\Controllers;

use App\Models\UserLeaveSetup;
use App\Http\Requests\StoreUserLeaveSetupRequest;
use App\Http\Requests\UpdateUserLeaveSetupRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class UserLeaveSetupController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create(Request $request)
    {


       // dd($request);

        $request->validate([
            'user_leave_setups_rule' => ['required', 'string', 'max:255'],
            'user_leave_setups_start_date' => ['required', 'string', 'max:255'],
            'user_leave_setups_end_date' => ['required', 'string', 'max:255'],
            'user_leave_setups_insertReson' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
                'profile_id'=>$request->profile_id,
                'user_leave_setups_rule'=>$request->user_leave_setups_rule,
                'user_leave_setups_start_date'=>$request->user_leave_setups_start_date,
                'user_leave_setups_insertReson'=>$request->user_leave_setups_insertReson,
                'user_leave_setups_end_date'=>$request->user_leave_setups_end_date,
                'user_leave_setups_adby'=>Auth::user()->name,
                'user_leave_setups_ad_date'=>date('Y-m-d H:i:s'),
                'user_leave_setups_updateReson'=>$request->user_leave_setups_insertReson,
                'user_leave_setups_updateby'=>Auth::user()->name,
                'user_leave_setups_updatedate'=>date('Y-m-d H:i:s'),
                'user_leave_setups_status'=>'Active',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),

             );
             DB::table('user_leave_setups')->insert( $data);
            return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

    }



    public function update(Request $request)
    {
       // dd($request);

        $request->validate([
            'user_leave_setups_rule' => ['required', 'string', 'max:255'],
            'user_leave_setups_start_date' => ['required', 'string', 'max:255'],
            'user_leave_setups_end_date' => ['required', 'string', 'max:255'],
            'user_leave_setups_updateReson' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
                'user_leave_setups_rule'=>$request->user_leave_setups_rule,
                'user_leave_setups_start_date'=>$request->user_leave_setups_start_date,
                'user_leave_setups_end_date'=>$request->user_leave_setups_end_date,
                'user_leave_setups_updateReson'=>$request->user_leave_setups_updateReson,
                'user_leave_setups_updateby'=>Auth::user()->name,
                'user_leave_setups_updatedate'=>date('Y-m-d H:i:s'),
                'user_leave_setups_status'=>$request->user_leave_setups_status,
                'updated_at'=>date('Y-m-d H:i:s'),
             );

             DB::table('user_leave_setups')->where('user_leave_setups_id', $request->user_leave_setups_id)->update($data);
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

    }


}
