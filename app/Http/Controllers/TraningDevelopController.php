<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTraningDevelopRequest;
use App\Http\Requests\UpdateTraningDevelopRequest;
use App\Models\TraningDevelop;

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
use Carbon\Carbon;

class TraningDevelopController extends Controller
{ 
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public static function training($profile_id){

       $traning= DB::table('traning_develops')
                ->select('*')
                ->where('traning_develops_profile_id','=',$profile_id)
                ->orderBy('traning_develops', 'DESC')
                ->get();


foreach ($traning as $key => $traning) {
 

        echo '       
        <li>
           <div class="timeline_content">
              <span>'.$traning->training_start.' To '.$traning->training_end.'</span>
              <h4>'.$traning->trained_subject.' </h4>
              <p>'.html_entity_decode($traning->training_description).'</p>
           </div>
        </li>';
    }
    }


    public function newtraning(Request $request){

       

        $request->validate([
            'trained_subject' => ['required', 'string'],
            'training_start' => ['required', 'string', 'max:255'],
            'training_end' => ['required', 'string', 'max:255'],
            'training_description' => ['required', 'string'],          
            ]);

        $data=array(
            'traning_develops_profile_id' => $request->traning_develops_profile_id,
            'trained_subject' => $request->trained_subject,
            'training_start' => $request->training_start,
            'training_end' => $request->training_end,
            'training_description' => $request->training_description,
            'training_status' => 'Active',
            'training_by' => Auth::user()->id,
            'training_day' => date('Y-m-d H:i:s'),         


        );

            DB::table('traning_develops')->insert($data);
            return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Save Sucess Full');


    }



    public static function traninglist($profile_id){


        $data= DB::table('traning_develops')
                        ->select('*')
                        ->where('traning_develops_profile_id','=',$profile_id)
                        ->orderBy('traning_develops', 'DESC')->get();
                        $count=1;
        foreach($data as $row){
            echo '<tr>
            <td>'.$count++.'</td>
            <td>'.$row->trained_subject.'</td>
            <td>'.$row->training_start.'to '.$row->training_end.'</td>
            <td><a href="delettraning"><i class="fa fa-times" aria-hidden="true"></i></a>
            </td>
          </tr>';
        }
        }
    
    
    
    public static function  deletetraning(Request $request){
    
        DB::table('traning_develops')->where('traning_develops', $request->traning_develops)->delete();
        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Delete success Full !');
    
    
    }

}
