<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
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
use Carbon\Carbon;


class EquipmentController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $data['title'] = 'Equipment';
        $data['template'] = 'equipment/index';
        $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();//sbu
        $data['location']= DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get();//sbu
        $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();//sbu
        $data['suppliers']= DB::table('suppliers')->select('*')->orderBy('suppliers_Organization', 'asc')->get();//sbu
        return view('/template/template', compact('data'));
    }


    public function create(Request $request)
    {


        $request->validate([
            'organization' => ['required', 'string', 'max:255'],
            'device' => ['required', 'string', 'max:255'],
           // 'device_details' => ['required', 'string'],
            'equ_brands_name'=> ['required', 'string'],
            'equpment_location'=> ['required', 'string'],
             ]);
  //  $prifx
      $prifx=  DB::table('subsidiaries')
               ->where('subsidiaries_id','=',$request->organization)
               ->value('prefix');
// last number
        $lastNumber=DB::table('equipment')
                    ->where('equipment_organization','=',$request->organization)
                    ->orderBy('equipment_number', 'desc')->value('equipment_number');

  // get lat number
       if(!empty($lastNumber)){
        $number= explode("-",$lastNumber);
        $equipment_number=$prifx.'-'.str_pad($number['1']+1, 8, '0', STR_PAD_LEFT);
                          }
           else {
             $equipment_number=$prifx.'-'.str_pad(1, 8, '0', STR_PAD_LEFT);
       }




/*

*/

            // dd();
           // dd($request->file('venderInvoice'));


          if(!empty($request->venderInvoice)){
             $fileName = date('Y-m-d-h-m-s').time().'.'.$request->venderInvoice->extension();
             $request->venderInvoice->move(public_path('invoice/'), $fileName);
            }
             else{
                $fileName='';
             }



             if(!empty($request->venderOrganizationInvoice)){
                $fileNameTwo = date('Y-m-d-h-m-s').time().'venderOrganizationInvoice'.'.'.$request->venderOrganizationInvoice->extension();
                $request->venderOrganizationInvoice->move(public_path('invoice/'), $fileNameTwo);
                }
                else{
                    $fileNameTwo='';
                 }




      $data=array(
            'equipment_number'=>$equipment_number,
            'equipment_organization'=>$request->organization,
            'equipment_vender_invoice' =>$fileName, //vender invoice
            'equipment_vender_value'=>$request->vendorPrice,
            'equipment_asset_invoice' =>$fileNameTwo,
            'equipment_asset_value'=>$request->vendorOrganizationPrice,
            'equipment_type' => $request->device,
            'equ_brand_id'=>$request->equ_brands_name,
            'equipment_model_details'=>$request->equipment_model_details,
            'equipment_details' => $request->device_details,
            'equipment_asset_invoice' => $request->device_details,
            'equipment_asset_value' => $request->equipment_asset_value,
            'equipment_vender_id' => $request->vender_name,
           // 'equipment_vender_invoice' => $request->venderInvoice,
            'equipment_asset_sn' => $request->equipment_asset_sn,
            'equipment_vender_value' => $request->vendorPrice,
            'equipment_warranty' => $request->warranty,
            'equpment_location'=>$request->equpment_location,
            'equipment_user' =>'' ,
            'equipment_status' =>1,
            'equipment_issued_day' => date('Y-m-d H:i:s'),
            'equipment_issued_by' =>Auth::user()->name,
            "last_update_by"=>Auth::user()->profile_id,
            "last_update_date"=>date('Y-m-d H:i:s'),
      );

     // dd($data);
      DB::table('equipment')->insert($data);
      return redirect('/new_qupment')->with('success' ,$equipment_number,'&nbsp;&nbsp; Save Sucess Full');

    }

    public function equlist(){


        $data['title'] = 'Equipment';
        $data['template'] = 'equipment/list';
        $data['equipment']= DB::table('equipment')
                               ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')
                               ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
                              // ->join('profiles','profiles.profile_id','=','equipment.equipment_user')
                               ->orderBy('equipment.equipment_number', 'asc')
                               //->whereNull('equipment.equipment_user')
                               ->get();
                              // ;//sbu


        $data['suppliers']= DB::table('suppliers')->select('*')->orderBy('suppliers_Organization', 'asc')->get();//sbu
        return view('/template/template', compact('data'));



    }


    public static function status($equipment_status){
        switch ($equipment_status) {
            case "1":
                echo "Active";
                break;
            case "2":
                echo "Used";
                break;
            case "3":
                echo "Not Use";
                break;

                case "4":
                echo "NG";
                break;
                case "5":
                echo "Disposal";
                break;

                }

    }




    public function organizationPc(){

        $mysbu=DB::table('job_working')
                ->where('job_working.profile_job_work_status','=','Active')
                ->where('job_working.profile_id','=',Auth::user()->profile_id)
                ->value('profile_job_work_sbu');

        $data['title'] = 'Equipment';
        $data['template'] = 'equipment/list';
        $data['equipment']= DB::table('equipment')
                               ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')
                               ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
                               ->orderBy('equipment.equipment_number', 'asc')
                               ->where('equipment.equipment_organization','=',$mysbu)
                               ->get();



        $data['suppliers']= DB::table('suppliers')->select('*')->orderBy('suppliers_Organization', 'asc')->get();//sbu
        return view('/template/template', compact('data'));

    }




    public static function responsiblePerson($profile_id){
     echo    DB::table('profiles')
               ->where('profile_id','=',$profile_id)
               ->value('profile_first_name').'  '.DB::table('profiles')->where('profile_id','=',$profile_id)->value('profile_last_name');
            }



     /// view equpment       

public function equpment_view($qupmentID){

    $data['equipment']= DB::table('equipment')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
      //->where('equipment.equipment_organization','=',$mysbu)
    ->orderBy('equipment.equipment_number', 'asc')
    ->where('equipment.equipment_number','=',$qupmentID)
    ->get();


    $data['location']= DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get();//sbu
    $data['profile'] = DB::table('profiles')->select('*')->where('profile_status','Active')->orderBy('profile_Full_name', 'asc')->get();
    $data['title'] = 'Equipment';
    $data['template'] = 'equipment/view';
    $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();//sbu
    $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();//sbu
    $data['suppliers']= DB::table('suppliers')->select('*')->orderBy('suppliers_Organization', 'asc')->get();//sbu
    return view('/template/template', compact('data'));




}


public static function vendername($venderID){

    echo DB::table('suppliers')->where('suppliers_id' ,$venderID)->value('suppliers_Organization');
}


public function equpment_update(Request $request){


   // dd($request->warranty);
    

        $data=array(
            "equipment_vender_id"=>$request->vender_name,
            "equipment_vender_value"=>$request->vendorPrice,
            "equipment_model_details"=>$request->equipment_model_details,
            "equipment_details"=>$request->device_details,
            "equipment_warranty"=>$request->warranty,
            'equipment_status' =>$request->equipment_status,
            'equipment_type' =>$request->device,
            'equ_brand_id' =>$request->equ_brands_name,
            'equipment_details' =>$request->device_details,
            "equipment_asset_value"=>$request->equipment_asset_value,
            'equipment_asset_sn' => $request->equipment_asset_sn,
            "equipment_user"=> $request->profile_id,
            'equpment_location'=>$request->equpment_location,
            "last_update_by"=>Auth::user()->profile_id,
            "last_update_date"=>date('Y-m-d H:i:s'),
        );

        if(empty(DB::table('equipment')->where('equipment_id' ,$request->equipment_id)->value('equipment_user'))){
          $history=array(
            "equipment_histories_equipment_number"=>$request->equipment_id,
            "equipment_user"=>$request->profile_id,
            "equipment_histories_status"=>'User add',
            "equipment_histories_issued_by"=>Auth::user()->profile_id,
            "equipment_histories_issued_day"=> date('Y-m-d H:i:s'),
          );

          DB::table('equipment_histories')->insert($history);
        }


        DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);
        return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; Details Update Success');
    
}



public function venderInvoiceDelete(Request $request){

    if(isset($_POST["submit"])){

        $data=array(
            "equipment_vender_invoice"=>'',
            "last_update_by"=>Auth::user()->profile_id,
           "last_update_date"=>date('Y-m-d H:i:s'),
        );

       // dd($request->equipment_id);

        if(file_exists(public_path('invoice/'.$request->equipment_vender_invoice.''))){

            unlink(public_path('invoice/'.$request->equipment_vender_invoice.''));
             DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);
             return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File Remove Success full');

            }else{
               return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File does not exists');
               DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);
            }

            DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);

            return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File Remove Success full');


    }



}


public function vander_invoice_upload(Request $request){
        $fileName = date('Y-m-d-h-m-s').time().'.'.$request->venderInvoice->extension();
        $request->venderInvoice->move(public_path('invoice/'), $fileName);

        $data=array(
            'equipment_vender_invoice' =>$fileName,
            "last_update_by"=>Auth::user()->profile_id,
            "last_update_date"=>date('Y-m-d H:i:s'),
        );
        DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);

        return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File Save Success full');

}



public function assetInvoiceDelete(){


    if(isset($_POST["submit"])){

        $data=array(
            "equipment_asset_invoice"=>'',
            "last_update_by"=>Auth::user()->profile_id,
            "last_update_date"=>date('Y-m-d H:i:s'),
        );

        if(file_exists(public_path('invoice/'.$request->equipment_asset_invoice.''))){

            unlink(public_path('invoice/'.$request->equipment_asset_invoice.''));
             DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);
             return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File Remove Success full');

            }else{
               return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File does not exists');
               DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);
            }

            DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);

            return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; File Remove Success full');


    }


}


public function live_pcview(){

    $all=  DB::table('equipment')
    ->select('*')
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')

    ->where('equipment.equipment_number','like', '%' . $_GET["q"] . '%')
    ->orWhere('equipment.equipment_organization','like', '%' . $_GET["q"] . '%')
    ->orWhere('equipment.equipment_type','like', '%' . $_GET["q"] . '%')
    ->orWhere('equipment.equipment_details','like', '%' . $_GET["q"] . '%')
    ->orWhere('subsidiaries.subsidiaries_name','like', '%' . $_GET["q"] . '%')
    ->orWhere('equpment_types.equpment_name','like', '%' . $_GET["q"] . '%')
   // ->orWhere('profile_emergency_mobile_number','like', '%' . $_GET["q"] . '%')
   // ->orWhere('profile_email','like', '%' . $_GET["q"] . '%')

    ->limit(25)
    ->get();


     foreach ( $all as $details){

            echo '<div >
            <a  class="text-light" href="/equpment/'.$details->equipment_number.'" target="_blank" ><i class="fa fa-unlock text-light" aria-hidden="true"></i> '. $details->equipment_number.'&nbsp;&nbsp;&nbsp;'.$details->equpment_name.'&nbsp;&nbsp;&nbsp;'.$details->subsidiaries_name.'</a>
            </div>';

     }

}


public function  equpmentuserupdate(Request $request){

   // dd($request->equipment_id);


    $history=array(
      "equipment_histories_equipment_number"=>$request->equipment_id,
      "equipment_user"=>$request->profile_id,
      "equipment_histories_issued_by"=>Auth::user()->profile_id,
      "equipment_histories_issued_day"=> date('Y-m-d H:i:s'),
      "equipment_histories_status"=>1,
    //  "device"=>$request->device,
     );

    DB::table('equipment_histories')->insert($history);


  $data=array(
   // "device"=>$request->device,
    "equipment_user"=>$request->profile_id,
    "last_update_by"=>Auth::user()->profile_id,
    "last_update_date"=>date('Y-m-d H:i:s'),
  );

  DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($data);
  return redirect('equpment/'.$request->equipment_number.'')->with('success' ,'&nbsp;&nbsp; Details Update Success');
}



public static function workmobile_equ_org($profile_id){

  echo  DB::table('job_working')
    ->where('profile_id',$profile_id)
    ->value('profile_job_work_mobile');

}



public static function workmobile($profile_id){

    echo  DB::table('job_working')
      ->where('job_working.profile_id',$profile_id)
      ->where('profile_id',$profile_id)
      ->value('profile_id').'/'.DB::table('job_working')
      ->where('profile_id',$profile_id)
      ->value('profile_job_work_mobile');
  
  }

  





public static function workemail_org($org_id,$profile_id){

    echo  DB::table('job_working')
      ->where('profile_job_work_sbu',$org_id)
      ->where('profile_id',$profile_id)
      ->value('profile_id').'/'.DB::table('job_working')
      ->where('profile_id',$profile_id)
      ->value('profile_job_work_mobile');

  }



public function removeEqu(Request $request){

  //  dd($request);

    $update_history=array(
        "equipment_histories_remove_by"=>Auth::user()->profile_id,
        "equipment_histories_remove_date"=>date('Y-m-d H:i:s'),
        "equipment_histories_remove_reson"=>$request->equipment_histories_remove_reson,
        "equipment_histories_status"=>0,
    );


    $equupdate=array(
        "equipment_id"=>$request->equipment_id,
        "equipment_user"=>'',
        "equipment_status"=>'Not Using',
       // "equipment_histories_status"=>0,
        "last_update_by"=>Auth::user()->profile_id,
        "last_update_date"=>date('Y-m-d H:i:s'),
    );



    DB::table('equipment')->where('equipment_id',$request->equipment_id)->update($equupdate);
    DB::table('equipment_histories')->where('equipment_histories_id',$request->equipment_histories_id)->update($update_history);
    return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Save Sucess Please hand over it  Organization');
}


public static function history($equipment_id){
    $equipments = DB::table('equipment_histories')
    ->join('equipment', 'equipment.equipment_id', '=', 'equipment_histories.equipment_histories_equipment_number')
    ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'equipment.equipment_type')
    ->join('profiles', 'profiles.profile_id', '=', 'equipment_histories.equipment_user')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
    ->orderBy('equipment.equipment_number', 'asc')
    ->where('equipment_histories.equipment_id', '=',$request->equipment_id)
    ->get();

}


public function allorganizationpc(){

    $data['title'] = 'Equipment';
        $data['template'] = 'equipment/allorganizationpc';
        $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();//sbu
        $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();//sbu
        //$data['suppliers']= DB::table('suppliers')->select('*')->orderBy('suppliers_Organization', 'asc')->get();//sbu
        return view('/template/template', compact('data'));

}



public static function countEqupment($subsidiaries_id,$equpment_types_id,$status){

$equpment =DB::table('equipment')->select('*')
->where('equipment_organization', '=', $subsidiaries_id)
->where('equipment_type', '=', $equpment_types_id)
->where('equipment_status', '=', $status)
->count();

if(!empty($equpment)){
    echo $equpment;
}
else{

    echo '';
}

    
}



public static function countmontlySel($equpment_types_id){

$equ= DB::table('equipment')->select('*')
->where('equipment_type', '=', $equpment_types_id)
->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
->count();
if(!empty($equ)){
    echo  $equ;
}else{
echo '';
}
}




public static function countmontlySelcost($equpment_types_id){

    $equ= DB::table('equipment')->select('*')    
    ->where('equipment_type', '=', $equpment_types_id)
    ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
    ->sum('equipment_vender_value');    
    if(!empty($equ)){
        echo number_format($equ, 2)  ;
    }else{
    echo '';
    }
    }

    public static function countmontlyourprice($equpment_types_id){

        $equ= DB::table('equipment')->select('*')    
        ->where('equipment_type', '=', $equpment_types_id)
        ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
        ->sum('equipment_asset_value');    
        if(!empty($equ)){
            echo number_format($equ, 2)  ;
        }else{
        echo '';
        }
        }


        public static function countmontlfrpfit($equpment_types_id){

            $equ= DB::table('equipment')->select('*')    
            ->where('equipment_type', '=', $equpment_types_id)
            ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
            ->sum('equipment_asset_value')-DB::table('equipment')->select('*')    
            ->where('equipment_type', '=', $equpment_types_id)
            ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
            ->sum('equipment_vender_value');  
            
            
            if(!empty($equ)){
                echo number_format($equ, 2)  ;
            }else{
            echo '';
            }
            }


            public static function thismonthTotalsell(){
                $equ= DB::table('equipment')->select('*') 
                ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
                ->sum('equipment_asset_value'); 
                 if(!empty($equ)){
                    echo number_format($equ, 2)  ;
                }else{
                echo '';
                }
                }

                public static function thismonthprofit(){
                    $equ= DB::table('equipment')->select('*') 
                    ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
                    ->sum('equipment_asset_value')-DB::table('equipment')->select('*') 
                    ->whereBetween('equipment_issued_day',[Carbon::now()->subDay(8).'%',Carbon::now()->addDay(1).'%'])   
                    ->sum('equipment_vender_value'); 
                     if(!empty($equ)){
                        echo number_format($equ, 2)  ;
                    }else{
                    echo '';
                    }
                    }



public function organization_it_equipment_list(){


    $data['title'] = 'Organization IT Equipment list';
    $data['template'] = 'equipment/organization_it_equipment_list';
    $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();//sbu
    $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();//sbu    
    return view('/template/template', compact('data'));


}


public static function equ_location($equpment_location){

  /* echo  DB::table('office_locations')
    ->where('office_locations_id',$equpment_location)
    ->value('office_locations_name');
    */

    

}



public static function org_equ_list($sbu){

    $equipment= DB::table('equipment')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
    ->join('equ_brands','equ_brands.equ_brands_id','=','equipment.equ_brand_id')
    ->where('equipment.equipment_organization','=',$sbu)
    ->orderBy('equipment.equipment_number', 'asc')
    //->where('equipment.equipment_number','=',$qupmentID)
    ->get();

    $count=1;
    foreach($equipment as $equipment){


    echo "<tr>
    <td>".$count ++."</td>
    <td><a href='equpment/".$equipment->equipment_number."' target='_new'>".$equipment->equipment_number."</a> </td>
    <td>".$equipment->equpment_name."</td>
    <td>".$equipment->equ_brands_name."</td>
    <td>".$equipment->equipment_model_details."</td>
    <td>".$equipment->equipment_asset_sn."</td>   
    <td>".DB::table('office_locations')->where('office_locations_id',$equipment->equpment_location)->value('office_locations_name')."</td>
    <td>";

    switch ($equipment->equipment_status) {
        case "1":
            echo "Active";
            break;
        case "2":
            echo "Used";
            break;
        case "3":
            echo "Not Use";
            break;

            case "4":
            echo "NG";
            break;
            case "5":
            echo "Disposal";
            break;

            }
   echo "</td><td>".$equipment->equipment_asset_value."</td>
    <td>".DB::table('profiles')->where('profile_id',$equipment->equipment_user)->value('profile_Full_name')."</td>
  </tr>";
  //number_format($equipment->equipment_asset_value,2)
    }
}



public static function location_equ_list($office_locations_id){

    $equipment= DB::table('equipment')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
    ->join('equ_brands','equ_brands.equ_brands_id','=','equipment.equ_brand_id')
    ->where('equipment.equpment_location','=',$office_locations_id)
    ->orderBy('equipment.equipment_number', 'asc')
    //->where('equipment.equipment_number','=',$qupmentID)
    ->get();

    $count=1;
    foreach($equipment as $equipment){


    echo "<tr>
    <td>".$count ++."</td>
    <td><a href='equpment/".$equipment->equipment_number."' target='_new'>".$equipment->equipment_number."</a> </td>
    <td>".$equipment->equpment_name."</td>
    <td>".$equipment->equ_brands_name."</td>
    <td>".$equipment->equipment_model_details."</td>
    <td>".$equipment->equipment_asset_sn."</td>       
    <td>".DB::table('office_locations')->where('office_locations_id',$equipment->equpment_location)->value('office_locations_name')."</td>
    <td>";

    switch ($equipment->equipment_status) {
        case "1":
            echo "Active";
            break;
        case "2":
            echo "Used";
            break;
        case "3":
            echo "Not Use";
            break;

            case "4":
            echo "NG";
            break;
            case "5":
            echo "Disposal";
            break;

            }
   echo "</td>
   
   <td>".$equipment->equipment_asset_value."</td>
   <td>".$equipment->subsidiaries_name."</td> 
    <td>".DB::table('profiles')->where('profile_id',$equipment->equipment_user)->value('profile_Full_name')."</td>
  </tr>";
  //number_format($equipment->equipment_asset_value,2)
    }
 

}


public static function no_location_equ_list(){

    $equipment= DB::table('equipment')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','equipment.equipment_organization')
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
    ->join('equ_brands','equ_brands.equ_brands_id','=','equipment.equ_brand_id')
    ->where('equipment.equpment_location','=','')
    ->orderBy('equipment.equipment_number', 'asc')
    //->where('equipment.equipment_number','=',$qupmentID)
    ->get();

    $count=1;
    foreach($equipment as $equipment){


    echo "<tr>
    <td>".$count ++."</td>
    <td><a href='equpment/".$equipment->equipment_number."' target='_new'>".$equipment->equipment_number."</a> </td>
    <td>".$equipment->equpment_name."</td>
    <td>".$equipment->equ_brands_name."</td>
    <td>".$equipment->equipment_model_details."</td>
    <td>".$equipment->equipment_asset_sn."</td>
    <td>".$equipment->subsidiaries_name."</td>    
    <td>".DB::table('office_locations')->where('office_locations_id',$equipment->equpment_location)->value('office_locations_name')."</td>
    <td>";

    switch ($equipment->equipment_status) {
        case "1":
            echo "Active";
            break;
        case "2":
            echo "Used";
            break;
        case "3":
            echo "Not Use";
            break;

            case "4":
            echo "NG";
            break;
            case "5":
            echo "Disposal";
            break;

            }
   echo "</td><td>".$equipment->equipment_asset_value."</td>
    <td>".DB::table('profiles')->where('profile_id',$equipment->equipment_user)->value('profile_Full_name')."</td>
  </tr>";
  //number_format($equipment->equipment_asset_value,2)
    }
}




public function location_it_equipment_list(){

    $data['title'] = 'Location IT Equipment list';
    $data['template'] = 'equipment/location_it_equipment_list';
    $data['office_locations']= DB::table('office_locations')->select('*')->orderBy('office_locations_name', 'asc')->get();//sbu
    $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();//sbu    
    return view('/template/template', compact('data'));

}

                 


}

