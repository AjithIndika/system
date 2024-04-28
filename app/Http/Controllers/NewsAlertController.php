<?php

namespace App\Http\Controllers;

use App\Models\NewsAlert;
use App\Http\Requests\StoreNewsAlertRequest;
use App\Http\Requests\UpdateNewsAlertRequest;
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
use App\Mail\NewsAllert;


class NewsAlertController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $data['title'] = 'New News';
        $data['template'] = 'news/index';
        return view('template/template', compact('data'));
    }


    public function store(Request $request){
        $files=[];

        foreach($request->file('files') as $key => $file){
                $no=$key+1;
                $fileName = time().rand(1,99).'.'.$file->extension();
                $filename    =date('Y-M-d').'-'.str_slug($request->newstitel).'-'.$no.'.'.$file->getClientOriginalExtension();
                $image_resize = Image::make($file->getRealPath());
                $image_resize->resize(1200, 1200);
                $image_resize->save(public_path('news_image/' .$filename));
                $files[]['files'] = $fileName;
                $dd[]=$filename;

        }

            $newnew=array(
                'news_slug'=>str_slug($request->newstitel),
                'news_titel'=>$request->newstitel,
                'news_image'=>json_encode($dd),
                'news_details'=>$request->news_body,
                'news_add_by'=>Auth::user()->name,
                'news_add_date'=>date('Y-m-d H:i:s'),
            );
            DB::table('news_alerts')->insert($newnew);

            //email send
            $mailData = [
                'appname'=>config('app.name'),
                'base_url'=>config('app.url'),
                'title' => $request->newstitel,
                'images'=>json_encode($dd),
                'newsBody'=>$request->news_body,
                ];


        $data =DB::table('profiles')->select('*')
        ->join('job_working','job_working.profile_id','=','profiles.profile_id')
        ->where('job_working.profile_job_work_status','=','Active')
        ->where('profile_status','Active')
        ->orderBy('profile_Full_name', 'asc')->get();
        foreach ($data as $key => $profile) {
            Mail::mailer('hr')->to($profile->profile_job_work_email)->send(new NewsAllert($mailData));
        }




            return redirect('/new_news')->with('success', $request->newstitel.'&nbsp;&nbsp; Save Sucess Full');



            }



public static function showDashbord(){

$data=DB::table('news_alerts')->select('*')->orderBy('news_add_date', 'DESC')->limit(7)->get();
foreach($data as $row){
$filenames =json_decode($row->news_image);
$selected_filename = $filenames[0];

     echo '
        <div class="post-item clearfix">
        <img src="'.url('/news_image').'/'.$selected_filename.'" class="img-thumbnail" alt="Cinque Terre">
        <h4><a href="/newsRead/'.$row->news_slug.'">'.$row->news_titel.'</a></h4>

      </div>
';


    }
}


public static function newsRead($news_slug){

        $data['title'] = 'News Reader';
        $data['news']=DB::table('news_alerts')->where('news_slug','=',$news_slug)->orderBy('news_add_date', 'DESC')->get();
        $data['template'] = 'news/view';
        return view('template/template', compact('data'));

}



public function newslist(){
    $data['title'] = 'New News';
    $data['news']=DB::table('news_alerts')->select('*')->orderBy('news_add_date', 'DESC')->get();
    $data['template'] = 'news/newslist';
    return view('template/template', compact('data'));

}





    }

