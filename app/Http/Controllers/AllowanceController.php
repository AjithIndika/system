<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Http\Requests\StoreAllowanceRequest;
use App\Http\Requests\UpdateAllowanceRequest;
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


class AllowanceController extends Controller
{

    public static function create($allowance)

    {
        DB::table('allowances')->insert($allowance);
    }


      /// allowances details
      public static function allowancesdetails($profile_id){
        $data= DB::table('allowances')
         ->where('profile_id','=',$profile_id)
         ->get();
         foreach($data as $row){
             echo '
             <tr>
             <td>'.$row->allowances_add_date.'&nbsp;&nbsp;/&nbsp;&nbsp;'.$row->allowances_reson.'</td>
             <td>'.env('APP_CURRENCY').'&nbsp;&nbsp; '.number_format($row->allowances_salary, 2, '.', ',').'</td>
             <td></td>
           </tr>';
           //<a href="/editsalary/'.$row->allowances_id.'"><i class="fa fa-pencil-square-o text-success fa-2x" aria-hidden="true"></i></a>
          }
      }




       // Allowance
    public static function allowance($profile_id){
        echo number_format(DB::table('allowances')
        ->where('profile_id','=',$profile_id)
        ->get()
        ->sum('allowances_salary'), 2, '.', ',');
     }




}
