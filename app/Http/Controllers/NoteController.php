<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\FrontHomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
Use Alert;

class NoteController extends Controller
{

    public function create(Request $request)
    {

        $request->validate([
            'new_titel' => ['required', 'string'],
            'new_note' => ['required', 'string'],
             ]);

             $data=array(
               'new_titel'=>$request->new_titel,
               'new_note'=>$request->new_note,
               'new_note_profile_id'=>$request->account_profile_id,
               'note_by'=>Auth::user()->name,
               'note_date'=>date('Y-m-d H:i:s'),
            );
             DB::table('notes')->insert($data);
             return redirect('/view-profile'.'/'.$request->profile_sug)->with('success'.'&nbsp;&nbsp; Save Sucess Full');

    }


    public static function show(Note $note)
    {
        //
    }


}
