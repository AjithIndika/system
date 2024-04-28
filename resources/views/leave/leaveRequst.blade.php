<?php 
use App\Http\Controllers\LeaveRequestAlertController;

?>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">


<div class="card-body">   
    <div class="container col-12">
        <h2>Leave Notification Setting </h2>
        <p></p>            
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th class="col-3">Organization</th>
              <th class="col-2">Add Alert Receiver</th>
              <th class="text-center">Alert Receiver</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data['subsidiaries'] as $key=>$subsidiaries)
                
            
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$subsidiaries->subsidiaries_name }}</td>
              <td><button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newallrtmember{{$subsidiaries->subsidiaries_id}}">New Alert Receiver</button></td>
              <td>

                <table class="table table-bordered table-sm">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>

 <?php 
  
  $leave=  DB::table('leave_request_alerts')   
    ->join('job_working','job_working.job_working_profile_id','leave_request_alerts.leave_request_alerts_user_work_id')
    ->join('profiles','profiles.profile_id','job_working.profile_id')
    ->where('leave_request_alerts.leave_request_alerts_organization',$subsidiaries->subsidiaries_id)
    ->get();

    $count=1;

  ?>                     
@foreach ($leave as $leaveallert)



  <tr @if($leaveallert->profile_job_work_status =='Deactivate') class="bg-danger" @endif>
<td>{{$count++}}</td>
<td>{{$leaveallert->profile_Full_name}}</td>
<td>{{$leaveallert->profile_job_work_email}}</td>
<td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#{{$leaveallert->leave_request_alerts_id}}">Remove</button>
  
</td>
</tr>

  






<!-- The Modal -->
<div class="modal fade" id="{{$leaveallert->leave_request_alerts_id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Do you need to stop allert ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form action="/removealeert" method="post">
        @csrf
        <input type="hidden" value="{{$leaveallert->leave_request_alerts_id}}" name="leave_request_alerts_id">
        <button type="submit" class="btn btn-success">Yes Stop allert</button>
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

              </td>
            </tr>




            <!-- The Modal -->
<div class="modal fade" id="newallrtmember{{$subsidiaries->subsidiaries_id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Settup New allert for {{$subsidiaries->subsidiaries_name }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          
            <form action="/cratenewleaveRequestAlert" action="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <select class="custom-select  @error('leave_request_alerts_user_work_id') is-invalid @enderror  leave_request_alerts_user_work_id  h-4" name="leave_request_alerts_user_work_id" required  style="width: 100%">
                           
                   {{LeaveRequestAlertController::leaveallertsbuwice($subsidiaries->subsidiaries_id)}}
                        </select>
                        @error('leave_request_alerts_user_work_id')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="leave_request_alerts_organization" value="{{$subsidiaries->subsidiaries_id}}">
                </div>
               </div>

               <div class="row mt-2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
            </div>
           </div>

 
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
      </div>


</div>
        </div>
    </div>
</section>





<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.leave_request_alerts_user_work_id ').select2();
    });

    

 </script>

 <style>
.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 40px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
 </style>



<style>
    hr {
margin-top: 1rem;
margin-bottom: 1rem;
border: 0;
border-top: 3px solid rgba(0, 0, 0, 0.1);
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

