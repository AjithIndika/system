<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Validator;
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
use App\Http\Controllers\AllowanceController;


class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public static function prfilenotification(){

        $appruwal= DB::table('profiles_change_waiting_approvel')->select('*')
        ->count();

        if( $appruwal == 0){}
        else{
            echo '<li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                <span class="badge bg-success badge-number">'. $appruwal.'</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                <li class="dropdown-header">
                    You have new '. $appruwal.' Allert
                    <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/allprofileupdaterequst/"><span
                            class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/allprofileupdaterequst/">Show
                        all messages</a>
                </li>
            </ul>
        </li>';
        }
    }
}
