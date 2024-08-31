<?php

namespace App\Http\Controllers;

use App\Models\JobDescription;
use App\Http\Requests\StoreJobDescriptionRequest;
use App\Http\Requests\UpdateJobDescriptionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class JobDescriptionController extends Controller
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
    public function index()
    {
        $data['title'] = 'Job Description';
        $data['template'] = 'JobDescription/index';
        $data['JobDescription'] =  DB::table('job_descriptions')->select('*')->get();
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
            'job_descriptions_name' => ['required', 'string', 'max:255'],
             'job_descriptions_note' => 'required|mimes:pdf|max:10000',

              ]);

      $file = $request->file('job_descriptions_note');
      $filename    = str::slug($request->job_descriptions_name).'.'.$file->getClientOriginalExtension();
      $file->move('jds_uplode',$filename);

      $data=array(
        'job_descriptions_name'=>$request->job_descriptions_name,
        'job_descriptions_note'=>$filename,
        'created_at'=>date('Y-m-d H:i:s'),
     );



      DB::table('job_descriptions')->insert($data);
      return redirect()->back()->with('success', $request->job_descriptions_name .'&nbsp;&nbsp; Save Sucess Full');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJobDescriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobDescriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobDescription  $jobDescription
     * @return \Illuminate\Http\Response
     */
    public function show(JobDescription $jobDescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobDescription  $jobDescription
     * @return \Illuminate\Http\Response
     */
    public function edit(JobDescription $jobDescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobDescriptionRequest  $request
     * @param  \App\Models\JobDescription  $jobDescription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobDescriptionRequest $request, JobDescription $jobDescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobDescription  $jobDescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (File::exists('jds_uplode/'.$request->job_descriptions_note)) {
         File::delete('jds_uplode/'.$request->job_descriptions_note);
         }
         $data=array('job_descriptions_note'=>'', );
         DB::table('job_descriptions')->where('job_descriptions_id', $request->job_descriptions_id)->update( $data);
         return redirect('/jd')->with('success', $request->subsidiaries_name .'&nbsp;&nbsp; Remove Sucess Full');

    }

    public function imageUplode(Request $request){


      $request->validate(['job_descriptions_note' => 'required|mimes:pdf|max:100000']);
      $file = $request->file('job_descriptions_note');
      $filename    = str::slug($request->job_descriptions_name).'.'.$file->getClientOriginalExtension();
      $file->move('jds_uplode',$filename);

     $data=array('job_descriptions_note'=>$filename,);
     DB::table('job_descriptions')->where('job_descriptions_id', $request->job_descriptions_id)->update( $data);
     return redirect('/jd')->with('success', $request->subsidiaries_name .'&nbsp;&nbsp; PDF Save Sucess Full');

    }
}
