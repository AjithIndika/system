<section class="section dashboard">
    <div class="col-12 ">
        <div class="card recent-sales overflow-auto">
    <div class="card-body mt-2">

        <h2 >Leave</h2>
        <p></p>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Name</th>
              <th>Requst Leave </th>
              <th>Leave Basic</th>
              <th>Leave Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

            @foreach ( $data['leave_requsts'] as $leave_requsts)


            <tr>
              <td>{{$leave_requsts->profile_first_name.' '.$leave_requsts->profile_last_name }} </td>
              <td>{{$leave_requsts->leave_requsts_start_date}} to {{$leave_requsts->leave_requsts_end_date}} /  {{$leave_requsts->leave_requsts_need_date}}</td>
              <td>{{$leave_requsts->leave_types_name}}({{$leave_requsts->employee_enrolment_types_name}})</td>
              <td>{{$leave_requsts->enrolment_leave_total}}</td>
              <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewLeave{{$leave_requsts->leave_requsts_id}}">View</button>
            </td>
            </tr>



<!-------- setting !------->

                <!-- The Modal -->
                <div class="modal fade" id="viewLeave{{$leave_requsts->leave_requsts_id}}">
                    <div class="modal-dialog  modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">{{$leave_requsts->profile_first_name.' '.$leave_requsts->profile_last_name  }} Leave Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">



                            <div class="profile-pic-wrapper">
                                <div class="pic-holder">
                                  @if (!empty( $leave_requsts->profile_image))
                                  <img id="profilePic" class="rounded-circle col-sm-4" src="/profile-image/{{$leave_requsts->profile_image}}">
                                  @else



                                      </div>
                                    </div>
                                  @endif


                   =




            <form action="/leavehedupdate" method="POST">
                @csrf
 <input type="hidden" name="leave_requsts_org_id" value="{{$leave_requsts->leave_requsts_org_id }}">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="email">Start Date:</label>
                        <input type="date" class="form-control @error('leave_requsts_start_date') is-invalid @enderror" value="{{$leave_requsts->leave_requsts_start_date}}" id="email" name="leave_requsts_start_date">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label for="pwd">End Date:</label>
                        <input type="date" class="form-control @error('leave_requsts_end_date') is-invalid @enderror" value="{{$leave_requsts->leave_requsts_end_date}}" id="pwd" name="leave_requsts_end_date">
                      </div>
                  </div>

                </div>


                <div class="row">

                    <div class="col-sm-4">
                      <div class="form-group">
                          <label for="email">How Much Date You Need:</label>
                          <input type="text" class="form-control col-sm-4 @error('leave_requsts_need_date') is-invalid @enderror" value="{{$leave_requsts->leave_requsts_need_date}}" id="email" required name="leave_requsts_need_date">
                        </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="pwd">Slect Leave Catogury:</label>
                          <select class="custom-select @error('leave_requsts_user_leave_setups_rule_id') is-invalid @enderror"  required name="leave_requsts_user_leave_setups_rule_id">

                            <?php

                        $setup_leave_view= DB::table('user_leave_setups')->select('*')
                        ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
                        ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
                        ->where('user_leave_setups.profile_id','=',$leave_requsts->profile_id)
                        ->where('user_leave_setups.user_leave_setups_status','=','Active')
                        ->get();
                                ?>
                            <option value="{{$leave_requsts->leave_requsts_user_leave_setups_rule_id }}">
                                {{   DB::table('leave_requsts')
                                          ->join('user_leave_setups','user_leave_setups.user_leave_setups_id','=','leave_requsts.leave_requsts_user_leave_setups_rule_id')
                                          ->join('enrolment_leave_setups','enrolment_leave_setups.enrolment_leave_setups_id','=','user_leave_setups.user_leave_setups_rule')
                                          ->join('employee_enrolment_types','employee_enrolment_types.employee_enrolment_types_id','=','enrolment_leave_setups.enrolment_employee_enrolment_types_id')
                                          ->join('leave_types','leave_types.leave_types_id','=','enrolment_leave_setups.enrolment_leave_types_id')
                                          ->where('leave_requsts.leave_requsts_user_leave_setups_rule_id','=',$leave_requsts->leave_requsts_user_leave_setups_rule_id)
                                          ->value('leave_types_name')
                                    }}

                            </option>
                            @foreach ( $setup_leave_view as $leave_rule_view)
                            <option value="{{ $leave_rule_view->user_leave_setups_id}} ">{{ $leave_rule_view->leave_types_name}}  </option>
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
                            <option value="{{$leave_requsts->leave_requsts_head_profile_id}}">
                                {{ DB::table('profiles')
                                ->where('profile_id','=',$leave_requsts->leave_requsts_head_profile_id)
                                ->value('profile_Full_name')}}
                                        </option>
                            @foreach ( $data['usr_head_list'] as $usr_head_list)
                            <option value="{{$usr_head_list->profile_job_work_head_of_sbu}}">{{ $usr_head_list->profile_Full_name}}  </option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                          <label for="email">Status:</label>
                          <select class="custom-select" name="leave_requsts_status" required>
                            <option>{{$leave_requsts->leave_requsts_status}}</option>
                            <option>Approved</option>
                            <option>Rejected</option>
                          </select>

                        </div>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                          <label for="email">Reson For Requst:</label>
                          <input type="text" class="form-control @error('leave_requsts_reson') is-invalid @enderror" value="{{$leave_requsts->leave_requsts_reson}}" id="email" required name="leave_requsts_reson" disabled>
                          <input type="hidden" class="form-control @error('leave_requsts_reson') is-invalid @enderror" value="{{$leave_requsts->leave_requsts_reson}}" id="email" required name="leave_requsts_reson" >
                        </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                          <label for="email">Reson For Approved/Rejected:</label>
                          <input type="text" class="form-control @error('leave_requsts_head_reson') is-invalid @enderror" value="{{$leave_requsts->leave_requsts_head_reson}}" id="email" required name="leave_requsts_head_reson" >
                        </div>
                    </div>
                  </div>
                  <input type="hidden" value="{{$leave_requsts->leave_requsts_profile_id}}" name="leave_requsts_profile_id">
                  <input type="hidden" value="{{$leave_requsts->leave_requsts_id}}" name="leave_requsts_id">



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






            @endforeach
          </tbody>
        </table>


    </div>
</div>
</div>








    </section>
