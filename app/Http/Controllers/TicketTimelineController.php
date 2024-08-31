<?php

namespace App\Http\Controllers;

use App\Models\TicketTimeline;
use App\Http\Requests\StoreTicketTimelineRequest;
use App\Http\Requests\UpdateTicketTimelineRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;
use Mail;


class TicketTimelineController extends Controller
{

    public static function create($data)
    {
        DB::table('ticket_timelines')->insert($data);
    }


}
