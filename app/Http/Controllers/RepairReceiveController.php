<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepairReceiveRequest;
use App\Http\Requests\UpdateRepairReceiveRequest;
use App\Models\RepairReceive;
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
use App\Http\Controllers\AllowanceController;

use Session;
use Illuminate\Support\Facades\Cookie;

class RepairReceiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index(){

        $data['title'] = 'Recive from';
        $data['profile']= DB::table('profiles')->select('*')->get();
        $data['template'] = 'recive/index';
        return view('template/template', compact('data'));
    }


    public function cratenew(Request $request){



      //  dd($request->repair_receives_location);
        $request->validate([
            'repair_receives_reson' => ['required', 'string'],
            'repair_receives_location' => ['required', 'string'],            
            ]);

            /// get location name
       $location=DB::table('office_locations') 
            ->where('office_locations_id',$request->repair_receives_location)            
            ->value('office_locations_name');

            // pdate tiket timeline
            $ticket_timelines=array(
                'ticket_timelines_ticket_id'=>$request->repair_receives_ticket_id,
                'ticket_timelines_ticket_action'=>'Recive and Keep'.' * '.$location.' * '.$request->repair_receives_reson,
                'ticket_timelines_ticket_status'=>'Process',
                'ticket_timelines_date_time'=>date('Y-m-d H:i:s'),
                'ticket_timelines_last_update_adby'=>Auth::user()->name,
                );
            DB::table('ticket_timelines')->insert($ticket_timelines);
            
           //update recive table

            $data=array(
                'repair_receives_ticket_id'=>$request->repair_receives_ticket_id,
                'repair_receives_equpment_id'=>$request->repair_receives_equpment_id,
                'repair_receives_by'=>$request->repair_receives_by,
                'repair_receives_reson'=>$request->repair_receives_reson,
                'repair_receives_date'=>date('Y-m-d H:i:s'),
                'repair_receives_location'=>$request->repair_receives_location,
                                
             );
             DB::table('repair_receives')->insert($data); 

            //update tiket status
             $updateTicket=array(
                'ticket_status'=>'Process',
                'ticket_attend_by'=>Auth::user()->name,);
             DB::table('tickets')->where('tickets_id', $request->repair_receives_ticket_id)->update($updateTicket);



             // retun to tikets 

             return redirect('/oneTicket/'.$request->tickets_number.'')->with('success',' Please store the item  mentioned location');
    }


public static function reciveitems($tickets_id){

  $repair_receives=  DB::table('repair_receives')->select('*') 
    ->where('repair_receives_ticket_id',$tickets_id)
    ->whereNull('repair_receives_status')
    ->value('repair_receives_ticket_id');

    if(!empty($repair_receives) ){
        echo '
        <i class="fa fa-building-o text-danger" aria-hidden="true"></i>
        ';
    }else{
    echo '';
    }

}



public static function tdevicedetails($repair_receives_equpment_id){

   $details= DB::table('equipment')->select('*') 
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
    ->join('equ_brands','equ_brands.equ_brands_id','=','equipment.equ_brand_id')
    ->where('equipment_id',$repair_receives_equpment_id)
    ->get();

    foreach($details as $details){

        echo '<a href="equpment/'.$details->equipment_number.'"  target="_blank">'. $details->equipment_number.'</a>';
        ;

    }

}



public static function repeireRecive($tickets_id){

    $repair_receives=  DB::table('repair_receives')->select('*') 
    ->where('repair_receives_ticket_id',$tickets_id)
    ->whereNull('repair_receives_status')
    ->value('repair_receives_ticket_id');

    if(!empty($repair_receives)){
    }
    else{

        echo '<i class="fa fa-exchange p-3 fa-3x text-success " data-toggle="modal" data-target="#reciveFrom" titel=" Recive from" aria-hidden="true"></i>';
        /* <button type="button" class="btn btn-primary mt-2 mb-2"  data-toggle="modal" data-target="#reciveFrom">
        Recive from
        </button>
        */
    }
}



public function sedtoRepirForm(){


    $data['title'] = 'Sed To Repir Form';
    $data['suppliers']= DB::table('suppliers')->select('*')
                       // ->where('repair_receives_ticket_id',$tickets_id)
                       ->get();
    $data['template'] = 'recive/sedtoRepirForm';
    return view('template/template', compact('data'));


}



public function addservicecenter(Request $request){

    if(!empty($request->service_center_id)){
        Cookie::queue(Cookie::make('service_center_id', $request->service_center_id, 30));

    }
    else{

        Cookie::queue(Cookie::make('service_center_id', Cookie::get('service_center_id'), 30));
    }

    


    $data['title'] = 'Sed To Repir Form';
    $data['suppliers']= DB::table('suppliers')->select('*')
                         ->where('suppliers_id',Cookie::get('service_center_id'))
                       ->get();

    $data['device']= DB::table('repair_receives')->select('*') 
                        ->join('tickets','tickets.tickets_id','=','repair_receives.repair_receives_ticket_id')
                       // ->join('repair_receives','repair_receives.repair_receives_ticket_id','=','repair_receives_teparry_keeping.repair_receives_teparry_keeping_ticket_id')
                        ->whereNull('repair_receives_repircenter')
                       //->whereNull('repair_receives_status')
                       ->get();


    $data['tempary_keeping']= DB::table('repair_receives_teparry_keeping')->select('*') 
                    ->join('tickets','tickets.tickets_id','=','repair_receives_teparry_keeping.repair_receives_teparry_keeping_ticket_id')
                    ->join('repair_receives','repair_receives.repair_receives_ticket_id','=','repair_receives_teparry_keeping.repair_receives_teparry_keeping_ticket_id')
                    ->where('repair_receives_teparry_keeping_service_center_id',Cookie::get('service_center_id'))
                    ->where('repair_receives_teparry_keeping_by',Auth::user()->profile_id)
                    ->where('repair_receives_teparry_keeping_date',date('Y-m-d'))
                    ->get();

   

    $data['template'] = 'recive/addrepirequpment';
    return view('template/template', compact('data'));


}



public static function supplier_name($service_center_id){
   echo DB::table('suppliers')
          ->where('suppliers_id','=',$service_center_id)
          ->value('suppliers_Organization');
}


public function addsendingItems(Request $request){ 

  

    $data=array(
        'repair_receives_id'=>$request->repair_receives_id,       
                        
     );


     $equpment_id=DB::table('repair_receives')->where('repair_receives_ticket_id','=',$request->repair_receives_id)->value('repair_receives_equpment_id');
//dd($equpment_id);
     $data=array(
        'repair_receives_teparry_keeping_ticket_id'=>$request->repair_receives_id,
        'repair_receives_teparry_keeping_equpment_id'=>$equpment_id,
        'repair_receives_teparry_keeping_service_center_id'=>Cookie::get('service_center_id'),
        'repair_receives_teparry_keeping_by'=>Auth::user()->profile_id,
        'repair_receives_teparry_keeping_date'=>date('Y-m-d'),
        );

     DB::table('repair_receives_teparry_keeping')->insert($data); 
     return redirect('/addservicecenter/')->with('success','Item Added');

}


public static function equpmentDetails($repair_receives_teparry_keeping_equpment_id){


//dd($repair_receives_teparry_keeping_equpment_id);

         $equpment = DB::table('equipment')->select('*') 
                    ->join('equ_brands','equ_brands.equ_brands_id','=','equipment.equ_brand_id')
                    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
                    ->where('equipment.equipment_id',$repair_receives_teparry_keeping_equpment_id)                    
                    ->get();

                    foreach($equpment as $equ){
                        echo 'Equipment :-'.$equ->equpment_name."</br> Brand  :-".$equ->equ_brands_name.'</br> Model -: '.$equ->equipment_model_details.' </br> SN  -:'.$equ->equipment_asset_sn;

                    }


}


public static function equpmentFaulit($repair_receives_teparry_keeping_equpment_id){

   // dd($repair_receives_teparry_keeping_equpment_id);

  echo DB::table('repair_receives')
    ->where('repair_receives_equpment_id',$repair_receives_teparry_keeping_equpment_id)                    
    ->value('repair_receives_reson');

}


public function addsendingItemsremove(Request $request){
    DB::table('repair_receives_teparry_keeping')->where('repair_teparry_keeping_id',$request->repair_teparry_keeping_id)->delete();
    return redirect('/addservicecenter/')->with('success','Equipment removal successful');

}

public function addsendingItemsprocess(){

    $lastNumber=DB::table('repair_send_history')->orderBy('repair_send_history_keeping_number', 'desc')->value('repair_send_history_keeping_number');

    if(!empty($lastNumber)){
        $number= explode("-",$lastNumber);
        $anrs='ANRS'.'-'.str_pad($number['1']+1, 5, '0', STR_PAD_LEFT);
                          }
           else {
            $anrs='ANRS'.'-'.str_pad(1, 5, '0', STR_PAD_LEFT);
       }
   
    $tempary_keeping= DB::table('repair_receives_teparry_keeping')->select('*') 
                    ->join('tickets','tickets.tickets_id','=','repair_receives_teparry_keeping.repair_receives_teparry_keeping_ticket_id')
                    ->join('repair_receives','repair_receives.repair_receives_ticket_id','=','repair_receives_teparry_keeping.repair_receives_teparry_keeping_ticket_id')
                    ->where('repair_receives_teparry_keeping_service_center_id',Cookie::get('service_center_id'))
                    ->where('repair_receives_teparry_keeping_by',Auth::user()->profile_id)
                    ->where('repair_receives_teparry_keeping_date',date('Y-m-d'))
                    ->get();

            foreach($tempary_keeping  as $tempary_keeping){
                $updatedata=array(
                    "repair_receives_repircenter"=>$tempary_keeping->repair_receives_teparry_keeping_service_center_id,
                    "repair_receives_reipercenter_by"=>Auth::user()->profile_id,
                    "repair_receives_reipercenter_date"=>date('Y-m-d H:i:s'),
                );


                $historyData=array(                   
                    'repair_send_history_keeping_number'=>$anrs,
                    'repair_send_history_keeping_ticket_id'=>$tempary_keeping->repair_receives_teparry_keeping_ticket_id,
                    'repair_send_history_keeping_equpment_id'=>$tempary_keeping->repair_receives_teparry_keeping_equpment_id,
                    'repair_send_history_keeping_service_center_id'=>$tempary_keeping->repair_receives_teparry_keeping_service_center_id,
                    'repair_send_history_keeping_by'=>Auth::user()->profile_id,
                    'repair_send_history_keeping_date'=>date('Y-m-d H:i:s'),

                );


                DB::table('repair_send_history')->insert($historyData); // ad history
                DB::table('repair_receives')->where('repair_receives_ticket_id', $tempary_keeping->repair_receives_ticket_id)->update($updatedata); //upade history data                
                DB::table('repair_receives_teparry_keeping')->where('repair_teparry_keeping_id',$tempary_keeping->repair_teparry_keeping_id)->delete();  //delet teparray data

                 
               
                //
            }

            return redirect('/repirsendPrint/'.$anrs.'')->with('success','Now print Your handover from');
}


public function repirsendPrint($anrs){

   

    $data['repircenter']=  DB::table('repair_send_history')
    ->where('repair_send_history_keeping_number', $anrs)
    ->join('suppliers','suppliers.suppliers_id','=','repair_send_history.repair_send_history_keeping_service_center_id')
    ->limit(1)
    //->groupBy('repair_send_history_keeping_service_center_id')
    ->get();


    $data['repiritems']=  DB::table('repair_send_history')
    ->where('repair_send_history_keeping_number', $anrs)
    ->join('tickets','tickets.tickets_id','=','repair_send_history.repair_send_history_keeping_ticket_id')
    ->join('equipment','equipment.equipment_id','=','repair_send_history.repair_send_history_keeping_equpment_id')
    ->join('equpment_types','equpment_types.equpment_types_id','=','equipment.equipment_type')
    ->join('equ_brands','equ_brands.equ_brands_id','=','equipment.equ_brand_id')
    ->join('repair_receives','repair_receives.repair_receives_ticket_id','=','repair_send_history.repair_send_history_keeping_ticket_id')
    //->groupBy('repair_send_history_keeping_service_center_id')
    ->get();



    $data['title'] = 'Print From';
    $data['anrs'] = $anrs;   

    $data['template'] = 'recive/print';
    return view('template/template', compact('data'));


}


// service center name 

public static function servicecenterName($repair_receives_repircenter){

  $supplier=  DB::table('suppliers')
    ->where('suppliers_id', $repair_receives_repircenter)   
    ->get();

    foreach($supplier as  $supplier){
        echo '<a href="" title="Service Center Name">' . $supplier->suppliers_Organization. '</a>';
    }
}


public function repierReciveRepierCenter(Request $request){




    $ticket_timelines=array(
         'ticket_timelines_ticket_id'=>$request->repair_receives_ticket_id,
         'ticket_timelines_ticket_action'=>$request->ticket_timelines_ticket_action,
         'ticket_timelines_ticket_status'=>$request->ticket_timelines_ticket_status,
         'ticket_timelines_date_time'=>date('Y-m-d H:i:s'),
         'ticket_timelines_last_update_adby'=>Auth::user()->name,
         );
     DB::table('ticket_timelines')->insert($ticket_timelines);


     $reciveUpdate=array(
         "repair_receives_fix"=>$request->ticket_timelines_ticket_action,
         "repair_receives_reipercenter_recive_by"=>Auth::user()->name,
         "repair_receives_reipercenter_recive_date"=>date('Y-m-d H:i:s'),
         "repair_receives_status"=>1,
         "repair_receives_back_by"=>Auth::user()->profile_id ,
     );

     DB::table('repair_receives')->where('repair_receives',$request->repair_receives)->update($reciveUpdate);

     return redirect('/home')->with('success','Please hand it over to the owner as soon as possible.');



}


}
