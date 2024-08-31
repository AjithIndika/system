<?php

namespace App\Http\Controllers;

use App\Models\EqupmentType;
use App\Http\Requests\StoreEqupmentTypeRequest;
use App\Http\Requests\UpdateEqupmentTypeRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class EqupmentTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['title'] = 'Equpment Name';
        $data['equpment_types']= DB::table('equpment_types')->select('*')->orderBy('equpment_name', 'asc')->get();
        $data['template'] = 'equpmentype/index';
        return view('template/template', compact('data'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'equpment_name' => ['required', 'string', 'max:255','unique:equpment_types'],
             ]);
              $data=array('equpment_name'=>$request->equpment_name,);
             DB::table('equpment_types')->insert($data);

          return redirect('/new_equpment_type')->with('success', $request->equpment_name.'&nbsp;&nbsp; Save Sucess Full');
    }


    public function edit(Request $request)
    {
        $data=array('equpment_name'=>$request->equpment_name,);
        DB::table('equpment_types')->where('equpment_types_id', $request->equpment_types_id)->update($data);
        return redirect('/new_equpment_type')->with('success', $request->equpment_name.'&nbsp;&nbsp; Save Sucess Full');
    }


    public function equpmentBrand(){            


        $data['title'] = 'Equpment Brand';
        $data['equpment_brand']= DB::table('equ_brands')->select('*')->orderBy('equ_brands_name', 'asc')->get();
        $data['template'] = 'equbrand/index';
        return view('template/template', compact('data'));


    }

    public static function countbrand($equ_brands_id){

        echo DB::table('equipment')->select('*')->where('equ_brand_id', $equ_brands_id)->count();
    }


    public function newequbrand(Request $request){

        $request->validate([
            'equ_brands_name' => ['required', 'string', 'max:255','unique:equ_brands'],            
             ]);


        $data=array(
            "equ_brands_name"=>$request->equ_brands_name,
        );

        DB::table('equ_brands')->insert($data);
        return redirect('/equpmentBrand')->with('success','&nbsp;&nbsp; SEqupment save Sucess Full');
    }


    public function updateequbrand(Request $request){

        $data=array(
            "equ_brands_name"=>$request->equ_brands_name,
        );

        DB::table('equ_brands')->where('equ_brands_id', $request->equ_brands_id)->update($data);

       // DB::table('equ_brands')->insert($data);
        return redirect('/equpmentBrand')->with('success','&nbsp;&nbsp; SEqupment save Sucess Full');


}
}
