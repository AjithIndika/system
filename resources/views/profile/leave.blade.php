<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;
use App\Http\Controllers\LeaveRequstController;
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <div class="row mb-3 mt-3">
    <div class="col-sm-3">
     @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
      <button type="button" class="btn btn-success col"  data-toggle="modal" data-target="#newleavesetup"><i class="bi bi-file-earmark-plus ">&nbsp;  Add New Leave Setup</i></button>
      @endif
    </div>

    <div class="col-sm-3">
    @if(Auth::user()->profile_id == $profile[0]->profile_id  && !empty($profile[0]->profile_id))
    <button type="button" class="btn btn-success col"  data-toggle="modal" data-target="#leaverequst"> <i class="bi bi-telegram">&nbsp; Leave Requst </i> </button>
    @endif
   </div>

    </div>







<!-- The Modal -->
<div class="modal fade" id="leaverequst">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Leave Requst </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form action="/leaverequst" method="POST">
                @csrf

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="email">Start Date:</label>
                        <input type="date" class="form-control @error('leave_requsts_start_date') is-invalid @enderror" placeholder="Date" id="date1" name="leave_requsts_start_date">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label for="pwd">End Date:</label>
                        <input type="date" class="form-control @error('leave_requsts_end_date') is-invalid @enderror" placeholder="Enter password" id="date2" name="leave_requsts_end_date" onchange="event.preventDefault(); getTimeBetweenDates();">
                      </div>
                  </div>
                  <p ></p>
                </div>


    <script type="text/javascript">
                function getTimeBetweenDates(e) {
  var date1 = new Date(document.getElementById("date1").value);
  var date2 = new Date(document.getElementById("date2").value);

  var diff;

  if (date1 < date2) {
    diff = new Date(date2 - date1);
  } else {
    diff = new Date(date1 - date2);
  }

  var years = (diff.getFullYear() - 1970);
  var months = diff.getMonth();
  var days = diff.getDate();

  var yearTxt = "year";
  var monthTxt = "month";
  var dayTxt = "day";

  if (years > 1) yearTxt += "s";
  if (months > 1) monthTxt += "s";
  if (days > 1) dayTxt += "s";

  if (years >= 0) {
    document.getElementById("showdiff").value =days ;
  } else {
    document.getElementById("showdiff").value =1;
  }
}</script>


                <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="email">How Much Date You Need:</label>
                          <input type="text" class="form-control @error('leave_requsts_need_date') is-invalid @enderror" placeholder="Dates" id="showdiff" required name="leave_requsts_need_date">
                        </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="pwd">Slect Leave Catogury:</label>
                          <select class="custom-select @error('leave_requsts_user_leave_setups_rule_id') is-invalid @enderror"  required name="leave_requsts_user_leave_setups_rule_id">
                            @foreach ( $data['setup_leave_view'] as $leave_rule_view)
                            @if ( $leave_rule_view->user_leave_setups_end_date < date('y-m-d') )
                            <option value="{{ $leave_rule_view->user_leave_setups_id}} ">{{ $leave_rule_view->leave_types_name}} </option>
                            @else
                            @endif
                            @endforeach
                          </select>
                        </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pwd">Slect Your Head:</label>

                          <select class="custom-select @error('leave_requsts_head_profile_id') is-invalid @enderror" name="leave_requsts_head_profile_id" required>
                                 {{ProfileController::reportingManagerList($profile[0]->profile_id)}}
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pwd">Your Organization</label>

                          <select class="custom-select @error('leave_requsts_org_id') is-invalid @enderror leave_requsts_org_id" name="leave_requsts_org_id" required>
                                 {{ProfileController::leaveoraganazation($profile[0]->profile_id)}}
                          </select>
                        </div>
                    </div>


                  </div>


                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                          <label for="email">Reson For Requst:</label>
                          <input type="text" class="form-control @error('leave_requsts_reson') is-invalid @enderror" placeholder="Reson For Requst" id="email" required name="leave_requsts_reson">
                        </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                          <label for="email">Recover Person:</label></br>
                          <select class="custom-select @error('recovery_person_id') is-invalid @enderror recovery_person_id" name="recovery_person_id" required style="width: 550px">
                            <option>Select One</option>
                            <?php $profile=DB::table('profiles')->select('*')->where('profile_status','Active')->get(); ?>
                          @foreach ($profile as $activeUsers)
                          <option value="{{$activeUsers->profile_id}}"> {{$activeUsers->profile_Full_name }}</option>
                          @endforeach
                          </select>
                        </div>
                    </div>
                  </div>


                  <input type="hidden" value="{{$profile[0]->profile_Full_name}}" name="requster_profile_Full_name">
                <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                <input type="hidden" value="{{$profile[0]->profile_Full_name}}" name="profile_Full_name">
                <input type="hidden" value="{{$profile[0]->profile_image}}" name="profile_image">
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






<div class="row">



  <table class="table table-hover">
    <thead>
      <tr>
        <th></th>
        <th>Leave Rules</th>
        <th>Pending Leave</th>
        <th>Reject Leave</th>
        <th>Authorize Leave</th>
        <th>Total</th>
        <th>Balance</th>

      </tr>
    </thead>
    <tbody>

        <?php
           $leave_rule_view= DB::table('user_leave_setups')->select('*')
                        ->where('profile_id','=',$profile[0]->profile_id)
                        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
                        ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
                        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
                        //->orderBy('user_leave_setups_status', 'DESC')
                        ->get();
         ?>
         @foreach ($leave_rule_view as  $leave_rule_view)


      <tr>
        <td>
            @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))   <button type="button" class="btn btn-success col"  data-toggle="modal" data-target="#leaveRuleView{{$leave_rule_view->user_leave_setups_id}}">Edit</button> @endif
        </td>
        <!-------  {{$leave_rule_view->employee_enrolment_types_name}}/ /{{$leave_rule_view->enrolment_leave_total}} Valid {{$leave_rule_view->user_leave_setups_start_date}} to {{$leave_rule_view->user_leave_setups_end_date}} !------------>
        <td>{{$leave_rule_view->leave_types_name}}</td>
        <td>{{LeaveRequstController::leaveCalculate($profile[0]->profile_id,$leave_rule_view->user_leave_setups_id,'Pending',$leave_rule_view->user_leave_setups_start_date,$leave_rule_view->user_leave_setups_end_date,$leave_rule_view->enrolment_leave_date_calculation,$profile[0]->profile_job_join_date).''.$leave_rule_view->enrolment_leave_total}}</td>
        <td>{{LeaveRequstController::leaveCalculate($profile[0]->profile_id,$leave_rule_view->user_leave_setups_id,'Rejected',$leave_rule_view->user_leave_setups_start_date,$leave_rule_view->user_leave_setups_end_date,$leave_rule_view->enrolment_leave_date_calculation,$profile[0]->profile_job_join_date,$leave_rule_view->enrolment_leave_total)}}</td>
        <td>{{LeaveRequstController::leaveCalculate($profile[0]->profile_id,$leave_rule_view->user_leave_setups_id,'Approved',$leave_rule_view->user_leave_setups_start_date,$leave_rule_view->user_leave_setups_end_date,$leave_rule_view->enrolment_leave_date_calculation,$profile[0]->profile_job_join_date,$leave_rule_view->enrolment_leave_total)}}/{{$leave_rule_view->enrolment_leave_total}}</td>
        <td>{{$leave_rule_view->enrolment_leave_total}}</td>
        <td>{{LeaveRequstController::leaveBalance($profile[0]->profile_id,$leave_rule_view->user_leave_setups_id,'Approved',$leave_rule_view->user_leave_setups_start_date,$leave_rule_view->user_leave_setups_end_date,$leave_rule_view->enrolment_leave_date_calculation,$profile[0]->profile_job_join_date,$leave_rule_view->enrolment_leave_total,$leave_rule_view->enrolment_leave_total)}}</td>

      </tr>

 <!----- start leave rule edit ---!---->
 <div class="modal fade" id="leaveRuleView{{$leave_rule_view->user_leave_setups_id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit {{$leave_rule_view->employee_enrolment_types_name}}/{{$leave_rule_view->leave_types_name}}/{{$leave_rule_view->enrolment_leave_date_calculation}}/{{$leave_rule_view->enrolment_leave_total}} Valid {{$leave_rule_view->user_leave_setups_start_date}} to {{$leave_rule_view->user_leave_setups_end_date}} /> {{$leave_rule_view->user_leave_setups_id}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/updateLeaveRule" method="post">
                @csrf

                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                          <label for="email">Start Date:</label>
                           <input type="date" name="user_leave_setups_start_date" class="form-control  @error('user_leave_setups_start_date') is-invalid @enderror"  value="{{$leave_rule_view->user_leave_setups_start_date}}" required >
                          @error('user_leave_setups_start_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email">End Date:</label>
                         <input type="date" name="user_leave_setups_end_date" class="form-control  @error('user_leave_setups_end_date') is-invalid @enderror" value="{{$leave_rule_view->user_leave_setups_end_date}}"  required >
                        @error('user_leave_setups_end_date')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="email">Status:</label>
                      <select class="custom-select  @error('user_leave_setups_status') is-invalid @enderror" name="user_leave_setups_status" required>
                        <option class="{{$leave_rule_view->user_leave_setups_status}}">{{$leave_rule_view->user_leave_setups_status}}</option>
                        <option class="Active">Active</option>
                        <option class="Deactive">Deactive</option>
                      </select>

                      @error('user_leave_setups_status')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Select Leave Setup:</label>
                      <select class="custom-select  @error('user_leave_setups_rule') is-invalid @enderror" name="user_leave_setups_rule" required>

                        <?php
                         $slect_leave_rule= DB::table('enrolment_leave_setups')->select('*')
                        ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
                        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
                        ->where('enrolment_leave_setups.enrolment_leave_setups_id','=',$leave_rule_view->enrolment_leave_setups_id)
                        ->get();
                        ?>
                        <option value="{{$leave_rule_view->enrolment_leave_setups_id}}">
                            @foreach ( $slect_leave_rule as $slect_leave_rule )
                            {{$slect_leave_rule->employee_enrolment_types_name}}/{{$slect_leave_rule->leave_types_name}}/{{$slect_leave_rule->enrolment_leave_date_calculation}}/{{$slect_leave_rule->enrolment_leave_total}}
                            @endforeach


                        </option>
                         @foreach ( $data['leave_rule'] as $leave_rule )
                        <option value="{{$leave_rule->enrolment_leave_setups_id}}">{{$leave_rule->employee_enrolment_types_name}}/{{$leave_rule->leave_types_name}}/{{$leave_rule->enrolment_leave_date_calculation}}/{{$leave_rule->enrolment_leave_total}}</option>
                        @endforeach
                      </select>
                      @error('user_leave_setups_rule')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Reason For Update :{{$leave_rule_view->user_leave_setups_updateReson}}</label>
                       <input type="text" name="user_leave_setups_updateReson" class="form-control  @error('user_leave_setups_updateReson') is-invalid @enderror" value="{{$leave_rule_view->user_leave_setups_updateReson}}"  required >
                      @error('user_leave_setups_updateReson')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Edited:</label>
                      {{$leave_rule_view->user_leave_setups_updateby}} / {{$leave_rule_view->user_leave_setups_updatedate}}
                         </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Created:</label>
                      {{$leave_rule_view->user_leave_setups_adby}} / {{$leave_rule_view->user_leave_setups_ad_date}}
                         </div>
                </div>
            </div>


            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
            <input type="hidden" value="{{$leave_rule_view->user_leave_setups_id}}" name="user_leave_setups_id">


            <button type="submit" class="btn btn-success col-sm-1 ml-1">Save</button>
            </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>


<!----- end start leave rule edit ---!---->

      @endforeach
    </tbody>
  </table>

</div>







 <!-- Add to new leave setup !-------->
 <div class="modal fade" id="newleavesetup">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add New Leave Rule :</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/addNewLeaveRule" method="post">
                @csrf


            <div class="row">

                    <div class="col">
                        <div class="form-group">
                          <label for="email">Start Date:</label>
                           <input type="date" name="user_leave_setups_start_date" class="form-control  @error('user_leave_setups_start_date') is-invalid @enderror"  required >
                          @error('user_leave_setups_start_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col">
                    <div class="form-group">
                        <label for="email">End Date:</label>
                         <input type="date" name="user_leave_setups_end_date" class="form-control  @error('user_leave_setups_end_date') is-invalid @enderror" value=""  required >
                        @error('user_leave_setups_end_date')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Reason For this:</label>
                       <input type="text" name="user_leave_setups_insertReson" class="form-control  @error('user_leave_setups_insertReson') is-invalid @enderror" value=""  required >
                      @error('user_leave_setups_insertReson')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Select Leave Setup:</label>
                      <select class="custom-select  @error('user_leave_setups_rule') is-invalid @enderror" name="user_leave_setups_rule" required>
                         @foreach ( $data['leave_rule'] as $leave_rule )
                        <option value="{{$leave_rule->enrolment_leave_setups_id}}">{{$leave_rule->employee_enrolment_types_name}}/{{$leave_rule->leave_types_name}}/{{$leave_rule->enrolment_leave_date_calculation}}/{{$leave_rule->enrolment_leave_total}}</option>
                        @endforeach
                      </select>
                      @error('user_leave_setups_rule')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>




            <!-------
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="email">Reson For this:</label>
                       <input type="date" name="user_leave_setups_insertReson" class="form-control  @error('user_leave_setups_insertReson') is-invalid @enderror" value=""  required >
                      @error('user_leave_setups_insertReson')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
!------------>


            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
            <button type="submit" class="btn btn-success">Save</button>
            </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>









    <script>
        $(document).ready(function() {
            $('.profile_job_work_sbu').select2();
            });
        $(document).ready(function() {
            $('.profile_job_work_designation').select2();
            });
        $(document).ready(function() {
            $('.profile_job_work_designation').select2();
            });
        $(document).ready(function() {
            $('.profile_job_work_department').select2();
            });
        $(document).ready(function() {
            $('.profile_job_work_head_of_sbu').select2();
            });
        $(document).ready(function() {
            $('.profile_job_work_office_location').select2();
            });
        $(document).ready(function() {
            $('.profile_job_work_jd').select2();
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



<script>
    $(document).ready(function() {
        $('.profile_job_work_sbu').select2();
        });
    $(document).ready(function() {
        $('.profile_job_work_designation').select2();
        });
    $(document).ready(function() {
        $('.profile_job_work_designation').select2();
        });
    $(document).ready(function() {
        $('.profile_job_work_department').select2();
        });
    $(document).ready(function() {
        $('.profile_job_work_head_of_sbu').select2();
        });
    $(document).ready(function() {
        $('.profile_job_work_office_location').select2();
        });
    $(document).ready(function() {
        $('.profile_job_work_jd').select2();
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



