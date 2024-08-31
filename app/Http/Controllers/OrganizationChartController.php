<?php

namespace App\Http\Controllers;

use App\Models\OrganizationChart;
use App\Http\Requests\StoreOrganizationChartRequest;
use App\Http\Requests\UpdateOrganizationChartRequest;
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


class OrganizationChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Organization Chart';
        $data['template'] = 'charts/index';
        $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();
        return view('/template/template', compact('data'));

    }

    public function newOrganatiazion(Request $request){


     $jobWorking=   DB::table('job_working')
    ->select('*')
    ->join('profiles','.profiles.profile_id','=','job_working.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
   // ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_descriptions.job_descriptions_id')
    ->where('job_working.profile_job_work_sbu','=',$request->subdiary)
    ->where('job_working.profile_job_work_status','=','Active')
    ->get();



        $data['title'] = 'New Organization';
        $data['template'] = 'charts/newOrg';
        $data['jobWorking']= $jobWorking;
        $data['subdiary']=$request->subdiary;
        return view('/template/template', compact('data'));

    }



    public function viewOrganatiazion(Request $request){


      // dd($request->subdiary);
/*
    $jobWorking=   DB::table('job_working')
    ->select('*')
    ->join('profiles','.profiles.profile_id','=','job_working.profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
   // ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_descriptions.job_descriptions_id')
    ->where('job_working.profile_job_work_sbu','=',$request->subdiary)
    ->where('job_working.profile_job_work_status','=','Active')
    ->get();
*/


$jobWorking=   DB::table('organization_charts')
    ->select('*')
    ->join('profiles','.profiles.profile_id','=','organization_charts.organization_profile_id')
    ->join('job_working','job_working.job_working_profile_id','=','organization_charts.organization_job_working_profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
   // ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_descriptions.job_descriptions_id')
    ->where('organization_charts.organization_id','=',$request->subdiary)
  //  ->where('job_working.profile_job_work_status','=','Active')
    ->get();




        $data['orgchart']=$jobWorking;
        $data['title'] = 'New Organization';
        $data['template'] = 'charts/view';
        return view('/template/template', compact('data'));


    }


    public function orgChartCrate(Request $request){

        $data=array(
            "organization_id"=>$request->organization_id,
            "organization_profile_id"=>$request->organization_profile_id,
            "organization_job_rol"=>$request->organization_job_rol,
            "id"=>$request->id,
            "pid"=>$request->pid,

        );

        for ($i = 0; $i < count($request->organization_id); $i++) {
            $insertData[] = [
             "organization_id"=>$request->organization_id[$i],
            "organization_profile_id"=>$request->organization_profile_id[$i],
            "organization_job_working_profile_id"=>$request->organization_job_working_profile_id[$i],
            "id"=>$request->id[$i],
            "pid"=>$request->pid[$i],
            ];


        }

      DB::table('organization_charts')->insert($insertData);

      return redirect('/setup_organization')->with('success','&nbsp;&nbsp;New organization Chart Crate successfully');
    }




    // setup org
    public static function setuporg($sbuid){
     $result=DB::table('organization_charts')->where('organization_id',$sbuid)->count();

     if(!empty($result)){
     }
       else {
             echo '<a href="/newOrganatiazion/'.$sbuid.'"><i class="fa fa-cogs" aria-hidden="true"></i></a>';
       }
    }


   /// view org
      public static function viewporg($sbuid){
       $result=DB::table('organization_charts')->where('organization_id',$sbuid)->count();

     if(!empty($result)){
        echo '<a href="/viewOrganatiazion/'.$sbuid.'"><i class="fa fa-sitemap" aria-hidden="true"></i></a>';
     }
       else {

       }

    }


      /// edit org
      public static function editorg($sbuid){
        $result=DB::table('organization_charts')->where('organization_id',$sbuid)->count();
      if(!empty($result)){
         echo '<a href="/editOrganatiazion/'.$sbuid.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
      }
        else {

        }
    }

       /// delet org
       public static function deletopuporg($sbuid){
        $result=DB::table('organization_charts')->where('organization_id',$sbuid)->count();
      if(!empty($result)){
         echo '<i class="fa fa-trash-o" aria-hidden="true" data-toggle="modal" data-target="#deletorg'.$sbuid.'"></i>';
      }
        else {

        }

     }





     public function deletOrganatiazion(Request $request){
        DB::table('organization_charts')->where('organization_id',$request->organization_id)->delete();
        return redirect('/setup_organization')->with('success','&nbsp;&nbsp;Organization Chart delegate successfully');
     }



     public function editOrganatiazion(Request $request){

    $jobWorking=   DB::table('organization_charts')
    ->select('*')
    ->join('profiles','.profiles.profile_id','=','organization_charts.organization_profile_id')
    ->join('job_working','job_working.job_working_profile_id','=','organization_charts.organization_job_working_profile_id')
    ->join('subsidiaries','subsidiaries.subsidiaries_id','=','job_working.profile_job_work_sbu')
    ->join('designations','designations.designations_id','=','job_working.profile_job_work_designation')
    ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_working.profile_job_work_jd')
   // ->join('job_descriptions','job_descriptions.job_descriptions_id','=','job_descriptions.job_descriptions_id')
    ->where('organization_charts.organization_id','=',$request->subdiary)
  //  ->where('job_working.profile_job_work_status','=','Active')
    ->get();
         $data['jobWorking'] = $jobWorking;
         $data['subdiary'] = $request->subdiary;
         $data['title'] = 'Edit Organization';
         $data['template'] = 'charts/editOrg';
         return view('/template/template', compact('data'));

     }



public function updateOrganatiazion(Request $request){

 //   dd($request->organization_charts_id);

    $data=array(
        'id'=>$request->id,
        'pid'=>$request->pid,
    );

    DB::table('organization_charts')->where('organization_charts_id', $request->organization_charts_id)->update($data);
    return redirect('/editOrganatiazion'.'/'.$request->subdiary)->with('success','&nbsp;&nbsp;Organization Chart Edit successfully Please refresh the chart');


   // subdiary

}


}
