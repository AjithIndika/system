<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjctnameRequest;
use App\Http\Requests\UpdateProjctnameRequest;
use App\Models\Projctname;
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
use Carbon;


class ProjctnameController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

 
    public function index()
    {
        $data['title'] = 'Project Listing';
        $data['project']= DB::table('projctnames')->select('*')
                        ->join('subsidiaries','subsidiaries.subsidiaries_id','=','projctnames.subsidiaries_id')->orderBy('subsidiaries.subsidiaries_name', 'asc')->get();
        $data['subsidiaries']= DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();
        $data['template'] = 'project/index';
        return view('template/template', compact('data'));
    }


    public function saveproject(Request $request){
        $request->validate([
            'subsidiaries_id' => ['required', 'max:255'],
            'project_name' => ['required', 'string', 'max:255','unique:projctnames'],
               ]);

             $data=array(
                'subsidiaries_id'=>$request->subsidiaries_id,
                'project_name'=>$request->project_name,                
                );
             DB::table('projctnames')->insert($data); 
             return redirect()->back()->with('success', $request->project_name.' '.'Save Success Full !');  

    }


    public function projectlist(){

        $all=  DB::table('projctnames')
        ->select('*')
        ->where('subsidiaries_id','like', '%' . $_GET["q"] . '%')      
        ->get();

         echo ' <select class="custom-select projctnames_id"  name="projctnames_id"  required>';
        foreach ($all as $key => $value) {
            echo '<option value="'.$value->projctnames_id.'" >'.$value->project_name.'</option>';
        }
        echo '</select>';


    }




    public function listproject(){

        $all=  DB::table('projctnames')
        ->select('*')
        ->where('subsidiaries_id','like', '%' . $_GET["q"] . '%')      
        ->get();

        // echo ' <select class="custom-select projctnames_id"  name="projctnames_id"  required>';
         echo '<option value="'.$value->projctnames_id.'" >'.$value->project_name.'</option>';
        foreach ($all as $key => $value) {
            echo '<option value="'.$value->projctnames_id.'" >'.$value->project_name.'</option>';
        }
       // echo '</select>';


    }


    public static function currant_project($profile_job_work_sbu,$projctnames_id){

       $all=  DB::table('projctnames')
       ->select('*')
       ->where('subsidiaries_id','=',$profile_job_work_sbu)      
       ->get();       
        echo '<option value="'.$projctnames_id.'" >'.DB::table('projctnames')->where('projctnames_id', '=',$projctnames_id)->value('project_name').'</option>';
       foreach ($all as $key => $value) {         
          echo "<option value='".$value->projctnames_id."' >$value->project_name</option>";
       }

    }



    public function editproject(Request $request){
           
        $request->validate([
            'subsidiaries_id' => ['required', 'max:255'],
            'project_name' => ['required', 'string', 'max:255','unique:projctnames'],
               ]);

             $data=array(
                'subsidiaries_id'=>$request->subsidiaries_id,
                'project_name'=>$request->project_name,                
                );
                DB::table('projctnames')->where('projctnames_id',$request->projctnames_id)->update($data);     
             return redirect()->back()->with('success', $request->project_name.' '.'Update Success Full !');  

    }

   
}
