<?php

namespace App\Http\Controllers;

use App\Models\DocumentControll;
use App\Http\Requests\StoreDocumentControllRequest;
use App\Http\Requests\UpdateDocumentControllRequest;
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

class DocumentControllController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function create(Request $request)
    {


        $request->validate(['file' => 'required|mimes:pdf|max:100000']);
        $file = $request->file('file');
        
        $filename    = str::slug($request->document_types_id.'-'.$request->profile_number.'-'.$request->document_types_name).'-'.date('Y-m-d-H-i-s').'.'.$file->getClientOriginalExtension();
        $file->move('document_storage/',$filename);

      $data=array(
        'profile_id'=>$request->profile_id,
        'profile_number'=>$request->profile_number,
        'document_uplode_types_id'=>$request->document_types_id,
        'document_controlls_pdf_name'=>$filename,
        'document_controlls_ad_by'=>Auth::user()->name,
        'document_controlls_ad_date'=>date('Y-m-d H:i:s'),
        'document_controlls_update_by'=>Auth::user()->name,
        'document_controlls_update_date'=>date('Y-m-d H:i:s'),

        );
        DB::table('document_controlls')->insert($data);
        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Document '.DocumentControllController::document_name($request->document_types_id).' Sucess Full');
    }


    public function destroy(Request $request)
    {
       // dd($request->document_controlls_id);
        unlink('document_storage/'.$request->document_controlls_pdf_name);
        DB::table('document_controlls')->where('document_controlls_id', $request->document_controlls_id)->delete();
        return redirect('/view-profile'.'/'.$request->profile_sug)->with('success','&nbsp;&nbsp; Delete Sucess Full');



    }



    public static function documentlist(){
        $data=  DB::table('document_types')->select('*')
          ->orderBy('document_types_name', 'ASC')->get();  
          foreach($data as $key => $value){
              echo '<option value='.$value->document_types_id.'>'.$value->document_types_name.'</option>';
  
          }
      }


    public static function document_name($document_types_id){

        echo DB::table('document_types')
        ->where('document_types_id',$document_types_id)
        ->value('document_types_name'); 

    }
      
}
