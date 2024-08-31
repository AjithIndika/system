<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;
use App\Http\Controllers\LeaveRequstController;
?>
<section class="section dashboard">
    <div class="col-12 ">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mt-2">



            <form action="/leaverequst" method="POST">
                @csrf

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                        <label for="email">Start Date:</label>
                        <input type="date" class="form-control @error('leave_requsts_start_date') is-invalid @enderror" placeholder="Date" id="email" name="leave_requsts_start_date">
                      </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                        <label for="pwd">End Date:</label>
                        <input type="date" class="form-control @error('leave_requsts_end_date') is-invalid @enderror" placeholder="Enter password" id="pwd" name="leave_requsts_end_date">
                      </div>
                  </div>

                </div>


                <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                          <label for="email">How Much Date You Need:</label>
                          <input type="text" class="form-control @error('leave_requsts_need_date') is-invalid @enderror" placeholder="Dates" id="email" required name="leave_requsts_need_date">
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="pwd">Slect Leave Catogury:</label>
                          <select class="custom-select  @error('leave_requsts_user_leave_setups_rule_id') is-invalid @enderror"  required name="leave_requsts_user_leave_setups_rule_id">
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
                              {{LeaveRequstController::reportingManagerList(Auth::user()->profile_id)}}
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



                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>



    </div>
        </div>
         </div>
</section>
