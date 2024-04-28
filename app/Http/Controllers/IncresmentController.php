<?php

namespace App\Http\Controllers;

use App\Models\Incresment;
use App\Http\Requests\StoreIncresmentRequest;
use App\Http\Requests\UpdateIncresmentRequest;
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

class IncresmentController extends Controller
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
    public function index($incresments_id)
    {

        $data['title'] = 'Incresment Edit';
        $data['incresment'] =   DB::table('incresments')->select('*')
        ->join('profiles','profiles.profile_id','=','incresments.profile_id')
         ->where('incresments.incresments_id','=',$incresments_id)
        ->get();
        $data['template'] = 'salary/incresments_edit';
        return view('template/template', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'incresments_salary' => ['required', 'string', 'max:255'],
            'incresments_reson' => ['required', 'string', 'max:255'],
            'incresments_add_date' => ['required', 'string', 'max:255'],
             ]);


             $incresments_details =array(
                'profile_id'=>$request->profile_id,
                'incresments_salary'=>$request->incresments_salary,
                'incresments_reson'=>$request->incresments_reson,
                'incresments_add_by'=>Auth::user()->name,
                'incresments_add_date'=>$request->incresments_add_date,
                'incresments_update_reson'=>$request->incresments_reson,
                'incresments_update_by'=>Auth::user()->name,
                'incresments_update_date'=>date('Y-m-d H:i:s'),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
             );


             DB::table('incresments')->insert( $incresments_details); //account_details
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Success Full');

    }



    public function edit(Request $request)
    {
        $request->validate([
            'incresments_salary' => ['required', 'string', 'max:255'],
            'incresments_add_date' => ['required', 'string', 'max:255'],
            'incresments_update_reson' => ['required', 'string', 'max:255'],
             ]);


             $incresments_details =array(
                'profile_id'=>$request->profile_id,
                'incresments_salary'=>$request->incresments_salary,
                'incresments_add_date'=>$request->incresments_add_date,
                'incresments_update_reson'=>$request->incresments_update_reson,
                'incresments_update_by'=>Auth::user()->name,
                'incresments_update_date'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
             );

             DB::table('incresments')->where('incresments_id', $request->incresments_id)->update($incresments_details);
             //DB::table('incresments')->insert( $incresments_details); //account_details
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Success Full');
    }



    public static function increment($profile_id){
        echo number_format(DB::table('incresments')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('incresments_salary'), 2, '.', ',');
     }



         /// incresment Details
         public static function incresmentDetails($profile_id){
            $data= DB::table('incresments')
             ->where('profile_id','=',$profile_id)
             ->get();
             foreach($data as $row){
                 echo '
                 <tr>
                 <td>'.$row->incresments_add_date.'&nbsp;&nbsp;/&nbsp;&nbsp;'.$row->incresments_reson.'</td>
                 <td>'.env('APP_CURRENCY').'&nbsp;&nbsp;'.number_format($row->incresments_salary, 2, '.', ',').'</td>
                 <td><a href="/editincresment/'.$row->incresments_id.'"><i class="fa fa-pencil-square-o text-success fa-2x" aria-hidden="true"></i></a></td>
               </tr>';
              }
          }


          
}
