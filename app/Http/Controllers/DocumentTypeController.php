<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use App\Http\Requests\StoreDocumentTypeRequest;
use App\Http\Requests\UpdateDocumentTypeRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class DocumentTypeController extends Controller
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
        $data['title'] = 'Document Type';
        $data['template'] = 'documentType/index';
        $data['documentType'] =  DB::table('document_types')->select('*')->get();
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
            'document_types_name' => ['required', 'string', 'max:255'],
             ]);

             $data=array(
               'document_types_name'=>$request->document_types_name,
               'created_at'=>date('Y-m-d H:i:s'),
            );
             DB::table('document_types')->insert($data);
             return redirect('/documentType')->with('success', $request->document_types_name .'&nbsp;&nbsp; Save Sucess Full');

    }



    public function edit(Request $request)
    {
         //  dd($request->department_id);
         $data=array(
            'document_types_name'=>$request->document_types_name,
            //'created_at'=>date('Y-m-d H:i:s'),
         );
        // DB::table('subsidiaries')->insert($data);
         DB::table('document_types')->where('document_types_id', $request->document_types_id)->update( $data);
         return redirect('/documentType')->with('success', $request->document_types_name .'&nbsp;&nbsp; Save Sucess Full');
    }




}
