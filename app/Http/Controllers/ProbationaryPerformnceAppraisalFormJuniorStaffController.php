<?php

namespace App\Http\Controllers;

use App\Models\Probationary_performnce_appraisal_form_junior_staff;
use App\Http\Requests\StoreProbationary_performnce_appraisal_form_junior_staffRequest;
use App\Http\Requests\UpdateProbationary_performnce_appraisal_form_junior_staffRequest;
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

class ProbationaryPerformnceAppraisalFormJuniorStaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $check= DB::table('profiles')->select('*')
        ->where('profile_sug','=',$request->profile_sug)->count();

       if($check ==1){
        $data['profile_sug'] =$request->profile_sug;
        $data['title'] = 'Junior Staff Form';
      //  $data['profile']= DB::table('profiles')->select('*')->get();
        $data['template'] = 'appraisalForm/appraisal_form_junior_staff';
        return view('template/template', compact('data'));

       }
       else{


       }

    }


    public function create(Request $request)
    {
        $request->validate([
            'period_under_review_from' => ['required', 'string'],
            'period_under_review_to' => ['required', 'string'],
            'attendance_punctuality' => ['required', 'string'],
            'attendance_punctuality_poor' =>  ['required', 'string'],
            'attendance_punctuality_fair' => ['required', 'string'],
            'attendance_punctuality_good' => ['required', 'string'],
            'attendance_punctuality_very_good' => ['required'],
            'attendance_punctuality_excellent' => ['required'],
            'attitude_poor' => ['required','string'],
            'attitude_fair' => ['required','string'],
            'attitude_good' => ['required','string'],
            'commitment_to_task_poor' => ['required','string'],
            'commitment_to_task_fair' => ['required','string'],
            'commitment_to_task_good' => ['required','string'],
            'commitment_to_task_very_good' => ['required','string'],
            'commitment_to_task_excellent' => ['required','string'],
            'job_knowledge_poor' => ['required','string'],
            'job_knowledge_fair' => ['required','string'],
            'job_knowledge_good' => ['required','string'],
            'job_knowledge_very_good' => ['required','string'],
            'job_knowledge_excellent' => ['required','string'],
            'reliability_trustworthiness_poor' => ['required','string'],
            'reliability_trustworthiness_fair' => ['required','string'],
            'reliability_trustworthiness_good' => ['required','string'],
            'reliability_trustworthiness_very_good' => ['required','string'],
            'reliability_trustworthiness_excellent' => ['required','string'],
            'significant_achievements' => ['required','string'],
            'significant_misses_or_lapses' => ['required','string'],
            'strengths_and_special_skills' => ['required','string'],
            'areas_of_improvement' => ['required','string'],
            'any_other_comments' => ['required','string'],
            'progress_summery' => ['required','string'],
            'any_other_comments_2' => ['required','string'],
             ]);
    }


   public static function getprofilname($profile_sug){
         echo DB::table('profiles')->where('profile_sug','=',$profile_sug)->value('profile_Full_name');
   }


   public static function getprofileid($profile_sug){
    echo DB::table('profiles')->where('profile_sug','=',$profile_sug)->value('profile_id');
 }

 public static function getNameofAppraiser(){
    echo DB::table('profiles')->where('profile_id','=',Auth::user()->profile_id)->value('profile_Full_name');
 }
}
