<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class IssueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $data['title'] = 'Issue Name';
        $data['issues']= DB::table('issues')->select('*')->get();
        $data['template'] = 'issues/index';
        return view('template/template', compact('data'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'issues_name' => ['required', 'string', 'max:255','unique:issues'],
             ]);
              $data=array('issues_name'=>$request->issues_name,);
             DB::table('issues')->insert($data);

          return redirect('/new_issue')->with('success', $request->issues_name.'&nbsp;&nbsp; Save Sucess Full');
    }


    public function edit(Request $request)
    {
        $data=array('issues_name'=>$request->issues_name,);
        DB::table('issues')->where('issues_id', $request->issues_id)->update($data);
        return redirect('/new_issue')->with('success', $request->issues_name.'&nbsp;&nbsp; Save Sucess Full');
    }
}
