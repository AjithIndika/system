@if (!empty($profile[0]->resignation_date) && $profile[0]->profile_id == Auth::user()->profile_id)
@else
    @if (!empty($profile[0]->profile_id == Auth::user()->profile_id))
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Resignation
                </button>
            </div>
        </div>
    @endif


@endif
<?php

$resperson = DB::table('job_working')
    ->select('*')
    ->where('profile_id', '=', $profile[0]->profile_id)
    ->where('profile_job_work_status', '=', 'Active')
    ->get();

?>

@foreach ($resperson as $key => $value)

@if (!empty($profile[0]->resignation_date))
    

    @if ($value->profile_job_work_head_of_sbu == Auth::user()->profile_id or
            !empty(Auth::user()->hrAdmin) or
            !empty(Auth::user()->hr))
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <h4>Request Of Resignation</h4>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">Resignation Date</label>
                        <input type="email" class="form-control" value="{{ $profile[0]->resignation_date }}" disabled>
                    </div>
                </div>
                <div class="col">





                    <div class="form-group">
                        <label for="email">Resignation Letter</label></br>
                        <i class="fa fa-file-pdf fa-2x text-success" aria-hidden="true" data-toggle="modal"
                            data-target="#pdfview"></i>
                    </div>
                </div>
            </div>
       

        <div class="row mt-5">
            <hr></hr>
            <div class="col">

                <div class="form-group">
                    <label for="email">Resignation Note</label></br>
                    {!! html_entity_decode($profile[0]->resignation_text) !!}
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="email"><em>Request Date</em></label>
                    <input type="email" class="form-control" value="{{ $profile[0]->resignation_request_date }}" disabled>
                </div>
                </div>
        </div>

    </div>

    @else
    
@endif

<?php

$resp = DB::table('job_working')
    ->select('*')
    ->where('profile_id', '=', $profile[0]->profile_id)
    ->where('profile_job_work_head_of_sbu', '=',Auth::user()->profile_id)
    ->where('profile_job_work_status', '=', 'Active')
    ->get();

   // dd($profile[0]->resignation_approved);

?>


@foreach ($resp as $resp)

@if($resp->profile_job_work_head_of_sbu==Auth::user()->profile_id And $profile[0]->resignation_approved == '')

<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ResignationApproval">
        Resignation Approval
      </button>   
</div> 


@endif
    
@endforeach





<!-- The Modal -->
<div class="modal fade" id="ResignationApproval">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Resignation Approval</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="post" action="/resignationStatus">
            @csrf


            <div class="form-group">
                <label for="email">Resignation Status:</label></br>
                <select  class="custom-select  @error('resignation_approved') is-invalid @enderror resignation_approved" name="resignation_approved" value="{{ old('resignation_approved') }}" required style="width: 25%">                                    
                   <option  value="1">Approved</option>
                   <option  value="0">Did not Approved</option>
             </select>


              </div>


              <div class="row mt-5">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email"><em>Request Date</em></label>
                        <input type="date"  data-date-format="YYYY-mm-dd" class="form-control" value="{{ date('Y-M-d', strtotime($profile[0]->resignation_request_date ))}}"  name="resignation_approval_date" required>
                    </div>
                    </div>
            </div>


              <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">Approved Note</label>
                        <textarea class="form-control ckeditor  @error('resignation_approved_note') is-invalid @enderror "
                            name="resignation_approved_note" required rows="5" cols="3" required></textarea>
                        @error('resignation_approved_note')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>


            <input type="hidden" name="resignation_request_date" value="{{ $profile[0]->resignation_request_date}}">
            <input type="hidden" name="profile_Full_name" value="{{ $profile[0]->profile_Full_name}}">
            <input type="hidden" name="profile_id" value="{{ $profile[0]->profile_id }}">
            <input type="hidden" name="profile_sug" value="{{ $profile[0]->profile_sug }}">




              
              <button type="submit" class="btn btn-primary">Submit</button>

              
          </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>



    @endif
@endforeach



<!-- The Modal -->
<div class="modal fade" id="pdfview">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Later</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <embed src="{{ url('resignation_document/' . $profile[0]->resignation_letter . '') }}" width="100%"
                    height="500">

                </iframe>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>







<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Hand Over Resignation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">


                <form action="/resignation" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label for="email">Resignation Date</label>
                        <input type="date"
                            class="form-control col-sm-3 @error('resignation_date') is-invalid @enderror" id="email"
                            name="resignation_date" required>
                        @error('resignation_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="pwd">Resignation Letter</label>
                        <input type="file" class="form-control col-sm-4 @error('file') is-invalid @enderror"
                            name="file" id="pwd">
                        @error('file')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                       
                        <label for="email">Resignation </label>
                        <textarea class="form-control ckeditor @error('resignation_text') is-invalid @enderror" name="resignation_text" required
                            rows="5" cols="3"></textarea>
                        @error('resignation_text')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <input type="hidden" name="profile_Full_name" value="{{ $profile[0]->profile_Full_name}}">
                    <input type="hidden" name="profile_id" value="{{ $profile[0]->profile_id }}">
                    <input type="hidden" name="profile_sug" value="{{ $profile[0]->profile_sug }}">




                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>






@if($profile[0]->resignation_approved == 1)

<div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#offbord">
        Assign a Task
      </button>
</div> 


@endif


<!-- The Modal -->
<div class="modal fade" id="offbord">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Register off board notification.</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
        
            <form action="/newoffbord" method="POST">
                @csrf

                <div class="row">
                    <div class="col"> 

                        <div class="form-group">
                            <label for="email">Notification Receive:</label></br>
                            <select class="custom-select  @error('offbord_tasks_job_working_profile_id') is-invalid @enderror offbord_tasks_profile_id"  name="offbord_tasks_job_working_profile_id" required style="width:100%">
                                @foreach ($data['workingprofile'] as $workingprofile)
                                <option value="{{$workingprofile->job_working_profile_id}}">{{$workingprofile->profile_first_name}}  {{$workingprofile->profile_last_name}} <em> {{$workingprofile->profile_job_work_email}}</em></option>
                                @endforeach
    
                            </select>
                            @error('offbord_tasks_job_working_profile_id')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="email">Assigning a Jobs</label>
                        <textarea class="form-control  ckeditor @error('offbord_tasks_requst') is-invalid @enderror" name="offbord_tasks_requst" required rows="5" cols="3" >{{ old('offbord_tasks_requst') }}</textarea>
                        @error('offbord_tasks_requst')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>
                </div>


                <input type="hidden" name="resignation_approval_date" value="{{$profile[0]->resignation_approval_date }}">
                <input type="hidden" name="offbord_tasks_profile_id" value="{{$profile[0]->profile_id }}">
                <input type="hidden" name="profile_sug" value="{{$profile[0]->profile_sug }}">

                <button type="submit" class="btn btn-success" >Save</button>


            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>




  <table class="table table-bordered mt-5">
    <thead>
      <tr>
        <th>#</th>
        <th>Send to</th>
        <th>Email</th>
        <th>Note</th>
        <th></th>
      </tr>
    </thead>
    <tbody>


        <?php  
          $onbords= DB::table('offbord_tasks')->select('*')
            ->join('job_working','job_working.job_working_profile_id','=','offbord_tasks.offbord_tasks_job_working_profile_id')
            ->join('profiles','profiles.profile_id','=','job_working.profile_id')
            ->where('offbord_tasks.offbord_tasks_profile_id','=',$profile[0]->profile_id)
            ->get();
        ?>

@foreach($onbords as $key=> $onbords)
   
    <tr>
    <td>{{$key + 1 }}</td>
    <td>{{$onbords->profile_first_name.'   '.$onbords->profile_last_name }}</td>
    <td>{{$onbords->profile_job_work_email }}</td>
    <td>{!! html_entity_decode($onbords->offbord_tasks_requst) !!}</td>
    <td><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#ofbordtaskremove{{$onbords->offbord_tasks_id}}">Remove</button></td>
  </tr>




  <div class="modal fade" id="ofbordtaskremove{{$onbords->offbord_tasks_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Do you need to Delete this?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          
        <form  method="POST" action="/removeoffbord">

            @csrf
         <input type="hidden" name="offbord_tasks_id" value="{{$onbords->offbord_tasks_id}}">        
         <input type="hidden" name="profile_sug" value="{{$profile[0]->profile_sug}}">
        <button type="submit" class="btn btn-danger" >Yes Remove</button>
  
  
        </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>

@endforeach


      
      
    </tbody>
  </table>




