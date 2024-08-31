<?php

namespace App\Http\Controllers;

use App\Models\OfficeLocation;
use App\Http\Requests\StoreOfficeLocationRequest;
use App\Http\Requests\UpdateOfficeLocationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;


class OfficeLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['title'] = 'Office Location';
        $data['template'] = 'officeLocation/index';
        $data['officeLocation'] =  DB::table('office_locations')->select('*')->get();
        return view('/template/template', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'office_locations_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'office_locations_name'=>$request->office_locations_name,
               'created_at'=>date('Y-m-d H:i:s'),
            );
             DB::table('office_locations')->insert($data);
             return redirect('/officelocation')->with('success', $request->office_locations_name.'&nbsp;&nbsp; Save Sucess Full');

    }



    public function edit(Request $request)
    {
         //  dd($request->department_id);
         $data=array(
            'office_locations_name'=>$request->office_locations_name,
            //'created_at'=>date('Y-m-d H:i:s'),
         );
        // DB::table('subsidiaries')->insert($data);
         DB::table('office_locations')->where('office_locations_id', $request->office_locations_id)->update( $data);
         return redirect('/officelocation')->with('success', $request->office_locations_name.'&nbsp;&nbsp; Save Sucess Full');
    }



    public static function count($office_locations_id){
        echo   DB::table('job_working')->select('*')
           ->where('profile_job_work_office_location',$office_locations_id)
           ->where('profile_job_work_status', 'Active')
           ->count();
       }


}
