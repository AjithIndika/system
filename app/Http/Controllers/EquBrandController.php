<?php

namespace App\Http\Controllers;

use App\Models\EquBrand;
use App\Http\Requests\StoreEquBrandRequest;
use App\Http\Requests\UpdateEquBrandRequest;
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

class EquBrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }





    public static function brandlist(){

      $data=  DB::table('equ_brands')
         ->orderBy('equ_brands_name', 'asc')
         ->get();

         foreach($data as $row){
            echo '
<option value="'.$row->equ_brands_id.'">'.$row->equ_brands_name.'</option>';
         }

    }


    public static function brandname($equ_brands_id){


        if(!empty($equ_brands_id)){
            $brandname=   DB::table('equ_brands')
            ->where('equ_brands_id','=',$equ_brands_id)
            ->value('equ_brands_name');

            echo '<option value="'.$equ_brands_id.'">'.$brandname.'</option>';
        }
        else{
            echo '<option value="">Select Brand name</option>';
        }

    }

}
