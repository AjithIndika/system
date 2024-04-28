<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\EmailManage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('kindika144@gmail.com')->send(new EmailManage($mailData));
        return redirect('/new-profile')->with('success'.'&nbsp;&nbsp; Save Sucess Full');
    }
}
