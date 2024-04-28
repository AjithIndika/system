<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Http\Requests\StoreBonusRequest;
use App\Http\Requests\UpdateBonusRequest;
use Illuminate\Support\Facades\Validator;
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


class BonusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['title'] = 'New Bonus Add';
        $data['template'] = 'bonus/new';
        return view('template/template', compact('data'));
    }







    // bouns bulk ad all active users
    public function bonusBulkaddnew(Request $request){

        $bonuses_percentage = $request->bonuses_percentage;
       $profilesAll= DB::table('profiles')->select('*')->where('profile_status','Active')->orderBy('profile_Full_name', 'asc')->get();
       foreach ( $profilesAll as  $profilesAll){



      $toal =DB::table('allowances')
      ->where('profile_id','=',$profilesAll->profile_id)
      ->get()
      ->sum('allowances_salary')
      +
      DB::table('salaries')
      ->where('profile_id','=',$profilesAll->profile_id)
      ->get()
      ->sum('salary_salary')

      +
      DB::table('incresments')
      ->where('profile_id','=',$profilesAll->profile_id)
      ->get()
      ->sum('incresments_salary');

        $bonus=array(
            'profile_id'=>$profilesAll->profile_id,
            'bonuses_salary'=>$toal/100*$bonuses_percentage,
            'bonuses_reson'=>$request->bonuses_reson,
            'bonuses_percentage'=>$bonuses_percentage,
            'bonuses_add_by'=>Auth::user()->name,
            'bonuses_add_date'=>date('Y-m-d H:i:s'),
            'bonuses_update_reson'=>$request->bonuses_reson,
            'bonuses_update_by'=>Auth::user()->name,
            'bonuses_update_date'=>date('Y-m-d H:i:s'),
            'created_at'=>date('Y-m-d H:i:s'),
        );

        BonusController::cratebonus($bonus);

            }
            return redirect('bonusBulkadd')->with('success'.'&nbsp;&nbsp; Bulk bonus Save Sucess Full');
          //  return redirect('bonusBulkadd/')->with('success'.'&nbsp;&nbsp; Bulk bonus Sucess Full');
      }



    public static function cratebonus($bonus){
        DB::table('bonuses')->insert($bonus);
     }




       // Bonace
    public static function bonace($profile_id){
        echo DB::table('allowances')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('allowances_salary');
     }

 /// basic
     public static function BasicSalary($profile_id){
        echo DB::table('salaries')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('salary_salary');
     }

     /// allowns
     public static function allowns($profile_id){
        echo DB::table('salaries')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('salary_salary');
     }

    //incresment
    public static function incresment($profile_id){
        echo DB::table('incresments')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('incresments_salary');
     }


     // total basic allowns
     public static function totalsalary($profile_id){
       echo DB::table('allowances')
      ->where('profile_id','=',$profile_id)
      ->get()
      ->sum('allowances_salary')
      +
      DB::table('salaries')
      ->where('profile_id','=',$profile_id)
      ->get()
      ->sum('salary_salary')

      +
      DB::table('incresments')
      ->where('profile_id','=',$profile_id)
      ->get()
      ->sum('incresments_salary');
     }

      // total basic allowns
      public static function bounescount($profile_id,$bounes){
        echo ( DB::table('allowances')
       ->where('profile_id','=',$profile_id)
       ->get()
       ->sum('allowances_salary')
       +
       DB::table('salaries')
       ->where('profile_id','=',$profile_id)
       ->get()
       ->sum('salary_salary')

       +
       DB::table('incresments')
       ->where('profile_id','=',$profile_id)
       ->get()
       ->sum('incresments_salary'))/100*$bounes;
      }






     /// bonace details
     public static function bonacedetails($profile_id){
        $data= DB::table('bonuses')
         ->where('profile_id','=',$profile_id)
         ->get();
         foreach($data as $row){
             echo '
             <tr>
             <td>'.$row->bonuses_add_date.'&nbsp;&nbsp;/&nbsp;&nbsp;'.$row->bonuses_reson.'</td>
             <td>Rs :/&nbsp;&nbsp; '.number_format($row->bonuses_salary, 2, '.', ',').'</td>
             <td></td>
           </tr>';

           //<a href="/editsalary/'.$row->bonuses_id.'"><i class="fa fa-pencil-square-o text-success fa-2x" aria-hidden="true"></i></a>
          }
      }


   public function bonusBulkbefor(){
    $data['title'] = 'Befor Add Bonus';
    $data['template'] = 'bonus/bonusBulkbefor';
    return view('template/template', compact('data'));
    }

    public function runbonusBulkbefor(Request $request){

        $data['allprofile'] = DB::table('profiles')
    ->select('*')
   // ->join('job_join_history','job_join_history.profile_id','=','profiles.profile_id')
    ->join('job_working','job_working.profile_id','=','profiles.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('departments','departments.department_id','=','job_working.profile_job_work_department')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
    ->join('office_locations','office_locations.office_locations_id','=','job_working.profile_job_work_office_location')
    ->join('religions','religions.religion_id','=','profiles.religion_id')
    ->where('profiles.profile_status','=','Active')
    ->get();


        $data['title'] = 'Befor Add Bonus';
        $data['bounes'] = $request->bonuses_percentage;
        $data['template'] = 'bonus/runbonusBulkbefor';
        return view('template/template', compact('data'));

    }

}
