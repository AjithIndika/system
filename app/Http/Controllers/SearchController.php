<?php

namespace App\Http\Controllers;

use App\Models\Search;
use App\Http\Requests\StoreSearchRequest;
use App\Http\Requests\UpdateSearchRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;


class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $all=  DB::table('profiles')
        ->select('*')
        ->where('profile_number','like', '%' . $_GET["q"] . '%')
        ->orWhere('profile_Full_name','like', '%' . $_GET["q"] . '%')
        ->orWhere('profile_nic','like', '%' . $_GET["q"] . '%')
        ->orWhere('profile_mobile_number','like', '%' . $_GET["q"] . '%')
        ->orWhere('profile_emergency_mobile_number','like', '%' . $_GET["q"] . '%')
        ->orWhere('profile_email','like', '%' . $_GET["q"] . '%')
        ->limit(25)
        ->get();


         foreach ( $all as $details){
            if($details->profile_status=='Active'){
                echo '<div >
                <a  class="text-light" href="/view-profile/'.$details->profile_sug.'" target="_blank" ><i class="fa fa-unlock text-success" aria-hidden="true"></i> '. $details->profile_number.'&nbsp;&nbsp;&nbsp;'.$details->profile_Full_name.'</a>
                </div>';
            }
            else{
                echo '<div >
                <a  class="text-light" href="/view-profile/'.$details->profile_sug.'" target="_blank" ><i class="fa fa-exclamation-triangle  text-danger" aria-hidden="true"></i>'. $details->profile_number.'&nbsp;&nbsp;&nbsp;'.$details->profile_Full_name.'</a>
                </div>';
            }


         }


    }


}
