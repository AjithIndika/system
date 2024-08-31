<?php

namespace App\Http\Controllers;

use App\Models\Subsidiaries;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;


class SubsidiariesController extends Controller
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
        $data['title'] = 'Subsidiaries';
        $data['template'] = 'subsidiaries/index';
        $data['sbu_names'] =  DB::table('subsidiaries')->select('*')->orderBy('subsidiaries_name', 'asc')->get();
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
           //'image_name' => ['required|image|mimes:jpg,png,jpeg,gif,svg'],
            'subsidiaries_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'subsidiaries_address' => ['required', 'string', 'max:255'],
            'subsidiaries_name' => ['required', 'string', 'max:255'],
            'assetsubsidiarie' => ['required', 'string', 'max:255'],
            'prefix'            => ['required', 'string', 'max:255'],


             ]);

            $image       = $request->file('subsidiaries_logo');
            $filename    = str::slug($request->subsidiaries_name).'.'.$image->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(500, 500);
            $image_resize->save(public_path('sbu_logo/' .$filename));


        $data=array(
            'subsidiaries_name'=>$request->subsidiaries_name,
            'subsidiaries_address'=>$request->subsidiaries_address,
            'subsidiaries_logo'=>$filename,
            'assetsubsidiarie'=>$request->assetsubsidiarie,
            'prefix'=>$request->prefix,

            'created_at'=>date('Y-m-d H:i:s'),
         );

          DB::table('subsidiaries')->insert($data);
         return redirect()->back()->with('success', $request->subsidiaries_name .'&nbsp;&nbsp; Save Sucess Full');

    }



    public function edit(Request $request)
    {

        $data=array(
            'subsidiaries_name'=>$request->subsidiaries_name,
            'subsidiaries_address'=>$request->subsidiaries_address,
            'assetsubsidiarie'=>$request->assetsubsidiarie,
            'created_at'=>date('Y-m-d H:i:s'),
         );
        // DB::table('subsidiaries')->insert($data);
          DB::table('subsidiaries')->where('subsidiaries_id', $request->subsidiaries_id)->update( $data);
          return redirect('/subsidiaries')->with('success', $request->subsidiaries_name .'&nbsp;&nbsp; Save Sucess Full');
    }


    public function update(Request $request, Subsidiaries $subsidiaries)
    {
        //
    }


    public function destroy(Subsidiaries $subsidiaries)
    {
        //
    }


    // delet subdiaris logo
    public function deletlogo(Request $request) {

        if(!empty($request->subsidiaries_logo)){
            unlink('sbu_logo/'.$request->subsidiaries_logo);
        }

            $data=array(
                'subsidiaries_logo'=>'',
                'updated_at'=>date('Y-m-d H:i:s'),
            );

     DB::table('subsidiaries')->where('subsidiaries_id', $request->subsidiaries_id)->update( $data);
     return redirect('/subsidiaries')->with('success', $request->subsidiaries_name .'&nbsp;&nbsp; Save Sucess Full');
    }

    // uplode logo
    public function uplodelogo(Request $request) {



        $request->validate([
             'subsidiaries_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
              ]);

             $image       = $request->file('subsidiaries_logo');
             $filename    = str::slug($request->subsidiaries_name).'.'.$image->getClientOriginalExtension();

             $image_resize = Image::make($image->getRealPath());
             $image_resize->resize(500, 500);
             $image_resize->save(public_path('sbu_logo/' .$filename));


            $data=array(
                'subsidiaries_logo'=> $filename,
                'updated_at'=>date('Y-m-d H:i:s'),
            );

     DB::table('subsidiaries')->where('subsidiaries_id', $request->subsidiaries_id)->update( $data);
     return redirect('/subsidiaries')->with('success', $request->subsidiaries_name .'&nbsp;&nbsp; Save Sucess Full');

    }



    public static function subdiariscount($subsidiaries_id){
     echo   DB::table('job_working')->select('*')
        ->where('profile_job_work_sbu',$subsidiaries_id)
        ->where('profile_job_work_status', 'Active')
        ->count();
    }


}
