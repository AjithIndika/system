<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOnbordRequest;
use App\Http\Requests\UpdateOnbordRequest;
use App\Models\Onbord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AllowanceController;

class OnbordController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function newonbord(Request $request){
        $request->validate([
            'onbords_job_working_profile_id' => ['required', 'string', 'max:255'],
            'onbords_requst' => ['required', 'string', 'max:255'],                

             ]);

             $data=array(
                "onbords_profile_id"=>$request->onbords_profile_id, 
                "onbords_date"=>$request->onbords_date,               
                "onbords_job_working_profile_id"=>$request->onbords_job_working_profile_id,
                "onbords_requst"=>$request->onbords_requst,
                "onbords_crate_date"=>date('Y-m-d H:i:s'),
                "onbords_by"=>Auth::user()->name,
             );
             DB::table('onbords')->insert($data);
            return redirect('/view-profile/'.$request->profile_sug.'')->with('success','&nbsp;&nbsp; Register on board notification success full');
    }

public static function removeonbord(Request $request){
   Onbord::where('onbord_id',$request->onbord_id)->delete();
   return redirect('/view-profile/'.$request->profile_sug.'')->with('success','&nbsp;&nbsp; On board remove notification success full');


}

    

}
