<?php

namespace App\Http\Controllers;

use App\Models\AccountDetails;
use App\Http\Requests\StoreAccountDetailsRequest;
use App\Http\Requests\UpdateAccountDetailsRequest;
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

class AccountDetailsController extends Controller
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
    public function index(Request $request)
    {


         $request->validate([
            'account_bank_name' => ['required', 'string', 'max:255'],
            'account_bank_branch' => ['required', 'string', 'max:255'],
            'account_bank_number' => ['required', 'string', 'max:255'],
            'account_reson_to_ad' => ['required', 'string', 'max:255'],
             ]);

             $account_details =array(
               'account_profile_id'=>$request->account_profile_id,
               'account_bank_name'=>$request->account_bank_name,
               'account_bank_branch'=>$request->account_bank_branch,
               'account_bank_number'=>$request->account_bank_number,
               'account_status'=>'Active',
               'account_reson_to_ad'=>$request->account_reson_to_ad,
               'account_reson_to_update'=>'New Acoount Add -'.date('Y-m-d H:i:s'),
               'account_add_by'=>Auth::user()->name,
               'account_add_date'=>date('Y-m-d H:i:s'),
               'account_update_by'=>Auth::user()->name,
               'account_update_date'=>date('Y-m-d H:i:s'),
            );

           DB::table('account_details')->insert($account_details);
           return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

    }


    public function create(Request $request)
    {
        $request->validate([
            'account_bank_name' => ['required', 'string', 'max:255'],
            'account_bank_branch' => ['required', 'string', 'max:255'],
            'account_bank_number' => ['required', 'string', 'max:255'],
            'account_reson_to_ad' => ['required', 'string', 'max:255'],
            'account_reson_to_update' => ['required', 'string', 'max:255'],
             ]);

             $account_details =array(
                'account_profile_id'=>$request->account_profile_id,
                'account_bank_name'=>$request->account_bank_name,
                'account_bank_branch'=>$request->account_bank_branch,
                'account_bank_number'=>$request->account_bank_number,
                'account_status'=>$request->account_status,
                'account_reson_to_ad'=>$request->account_reson_to_ad,
                'account_reson_to_update'=>'New Acoount Add -'.date('Y-m-d H:i:s'),
                'account_update_by'=>Auth::user()->name,
                'account_update_date'=>date('Y-m-d H:i:s'),
             );

          //   dd($request);
             //account_id
            // DB::table('account_details')->insert($account_details); //account_details
             DB::table('account_details')->where('account_id', $request->account_id)->update($account_details );
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

    }





}
