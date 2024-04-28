<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;
use Auth;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $data['title'] = 'Equipment';
        $data['template'] = 'supplier/index';
        $data['suppliers']= DB::table('suppliers')->select('*')->orderBy('suppliers_Organization', 'asc')->get();//sbu

        return view('/template/template', compact('data'));
    }


    public function create(Request $request)
    {

       $request->validate([
        'suppliers_Organization' => ['required', 'string', 'max:255','unique:suppliers'],
        'suppliers_Contact_person' => ['required', 'string', 'max:255'],
        'suppliers_Contact_number' => ['required', 'string', 'max:255'],

         ]);

         $data=array(
            "suppliers_Organization"=>$request->suppliers_Organization,
            "suppliers_Contact_person"=>$request->suppliers_Contact_person,
            "suppliers_Contact_number"=>$request->suppliers_Contact_number,
            "suppliers_Contact_email"=>$request->suppliers_Contact_email,
            "suppliers_supply_things"=>$request->supply_items,
         );


        DB::table('suppliers')->insert($data);
        return redirect('/venders_rejestration')->with('success' ,$request->suppliers_Organization,'&nbsp;&nbsp; Save Sucess Full');

    }


    public function store(Request $request)
    {

        $data=array(
            "suppliers_Organization"=>$request->suppliers_Organization,
            "suppliers_Contact_person"=>$request->suppliers_Contact_person,
            "suppliers_Contact_number"=>$request->suppliers_Contact_number,
            "suppliers_Contact_email"=>$request->suppliers_Contact_email,
            "suppliers_supply_things"=>$request->supply_items,
         );


        DB::table('suppliers')->where('suppliers_id', $request->suppliers_id)->update($data);
        return redirect('/venders_rejestration')->with('success' ,$request->suppliers_Organization,'&nbsp;&nbsp; Update Sucess Full');

    }



}
