<?php

namespace App\Http\Controllers;

use App\Models\Designations;
use App\Http\Requests\StoreDesignationsRequest;
use App\Http\Requests\UpdateDesignationsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;
use Auth;

class DesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');


    }


    public function index()
    {


        $data['title'] = 'Designations';
        $data['template'] = 'designations/index';
        $data['designations'] =  DB::table('designations')->select('*')->get();
        return view('/template/template', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      //  dd($request->designations_name);
        $request->validate([
             'designations_name' => ['required', 'string', 'max:255'],
              ]);

              $data=array(
                'designations_name'=>$request->designations_name,
                'created_at'=>date('Y-m-d H:i:s'),
             );
              DB::table('designations')->insert($data);
              return redirect('/designations')->with('success', $request->designations_name .'&nbsp;&nbsp; Save Sucess Full');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDesignationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesignationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function show(Designations $designations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $request->validate([
            'designations_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'designations_name'=>$request->designations_name,
              // 'updated_at'=>date('Y-m-d H:i:s'),
            );
            DB::table('designations')->where('designations_id', $request->designations_id)->update( $data);
             return redirect('/designations')->with('success', $request->designations_name .'&nbsp;&nbsp; Save Sucess Full');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDesignationsRequest  $request
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesignationsRequest $request, Designations $designations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designations $designations)
    {
        //
    }




    public static function count($designations_id){
        echo   DB::table('job_working')->select('*')
           ->where('profile_job_work_designation',$designations_id)
           ->where('profile_job_work_status', 'Active')
           ->count();
       }


}
