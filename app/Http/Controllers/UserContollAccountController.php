<?php

namespace App\Http\Controllers;
use App\Models\UserContollAccount;
use App\Http\Requests\StoreUserContollAccountRequest;
use App\Http\Requests\UpdateUserContollAccountRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Mail;
use App\Mail\EmailManage;
use App\Mail\PasswordSend;



use Image;
Use Alert;

class UserContollAccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function create(Request $request)
    {






        $randome_pass= Str::random(10);

         $data=array(
            'name'=>$request->profile_first_name,
            'email'=>$request->email,
            'profile_id'=>$request->profile_id,
            'hr'=>$request->hr,
            'hrAdmin'=>$request->hrAdmin,
            'profileUser'=>$request->profileUser,
            'pcUser'=>$request->pcUser,
            'pcAdmin'=>$request->pcAdmin,
            'sbuPcAdmin'=>$request->sbuPcAdmin,
            'leveApprovalUser'=>$request->leveApprovalUser,
            'reportView'=>$request->reportView,
            'sbuhead'=>$request->sbuhead,


            'password'=>Hash::make($randome_pass),
            'user_crate_by'=>Auth::user()->name,
            'user_update_by'=>Auth::user()->name,
            'updated_at'=>date('Y-m-d H:i:s'),
            'created_at'=>date('Y-m-d H:i:s'),
            );
           DB::table('users')->insert($data);



                    //email send
                    $mailData = [
                    'appname'=>config('app.name'),
                    'base_url'=>config('app.url'),
                    'title' => 'Your Login Details For ASSET HR',
                    'logo'=>$request->subsidiaries_logo,
                    'username'=>$request->email,
                    'password'=>$randome_pass,];

       //  Mail::to($request->email)->send(new PasswordSend($mailData));
          Mail::mailer('hr')->to($request->email)->send(new PasswordSend($mailData));

          $profileupdate=array("profile_head_of_departmrnt_this_account"=>$request->sbuhead);
          DB::table('profiles')->where('profile_id', $request->profile_id)->update($profileupdate);
         return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');


    }


    public function edit(Request $request)
    {
        $data=array(
            'hr'=>$request->hr,
            'hrAdmin'=>$request->hrAdmin,
            'profileUser'=>$request->profileUser,
            'pcUser'=>$request->pcUser,
            'pcAdmin'=>$request->pcAdmin,
            'sbuPcAdmin'=>$request->sbuPcAdmin,
            'leveApprovalUser'=>$request->leveApprovalUser,
            'reportView'=>$request->reportView,
            'sbuhead'=>$request->sbuhead,
            'user_update_by'=>Auth::user()->name,
            'updated_at'=>date('Y-m-d H:i:s'),
            );

              DB::table('users')->where('id', $request->id)->update($data);
              $profileupdate=array("profile_head_of_departmrnt_this_account"=>$request->sbuhead);
              DB::table('profiles')->where('profile_id', $request->profile_id)->update($profileupdate);


              return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');
    }


    public function destroy(Request $request)
    {
        DB::table('users')->where('id', $request->id)->delete();
        $profileupdate=array("profile_status"=>'Off');
        DB::table('profiles')->where('profile_id', $request->profile_id)->update($profileupdate);
        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');
    }




    public function password(Request $request){
        $data=array(
            'password'=>Hash::make($request->password),
            );
        DB::table('users')->where('id',Auth::user()->id)->update($data);
        return redirect('/home')->with('success'.'&nbsp;&nbsp; Save Sucess Full');
    }


    public function userlist(){
        $data['title'] = 'User Permission';
        $data['userDetails']= DB::table('users')->select('*')->get();
        $data['template'] = 'users/ituserlist';
        return view('template/template', compact('data'));
    }

    public function userupdate(Request $request){

        $data=array(
            'itequipmentadd'=>$request->itequipmentadd,
            'itsetting'=>$request->itsetting,
            'ticketupdate'=>$request->ticketupdate,
            'ticketview'=>$request->ticketview,
            'report'=>$request->report,
            'userpermition'=>$request->userpermition,
            'invoice_permition'=>$request->invoice_permition,
            'ticket_assign'=>$request->ticket_assign,
            'sbuPcAdmin'=>$request->sbuPcAdmin,

        );
        DB::table('users')->where('id',$request->id)->update($data);
        return redirect('/userlist')->with('success'.'U&nbsp;&nbsp; Save Sucess Full');

    }



    
}
