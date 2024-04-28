<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;
?>
<table class="table">
    <thead>
      <tr>

        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Salary</td>
        <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp; {{SalaryController::salaryone($profile[0]->profile_id)}} </td>
        <td><i class="fa fa-list fa-2x text-success" aria-hidden="true"  data-toggle="modal" data-target="#salaryDetails"></i></td>
        <td><i class="fa fa-plus-circle fa-2x text-success" data-toggle="modal" data-target="#addtosalary"></i></td>
      </tr>
      <tr>
        <td>Allowance</td>
        <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp;{{AllowanceController::allowance($profile[0]->profile_id)}}</td>
        <td><i class="fa fa-list fa-2x text-success"  aria-hidden="true"  data-toggle="modal" data-target="#allowanceDetails"></i></td>
        <td><i class="fa fa-plus-circle fa-2x text-success" aria-hidden="true"  data-toggle="modal" data-target="#addtoAllowances"></i></td>
      </tr>
      <tr>
        <td>Increment Details</td>
        <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp;{{IncresmentController::increment($profile[0]->profile_id)}} </td>
        <td><i class="fa fa-list fa-2x text-success" aria-hidden="true" aria-hidden="true"  data-toggle="modal" data-target="#incresmentDetails"></i></td>
        <td><i class="fa fa-plus-circle fa-2x text-success" data-toggle="modal" data-target="#newbincresment"></i></td>
      </tr>

      <tr>
        <td>Bonus</td>
        <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp;{{BonusController::bonace($profile[0]->profile_id)}}</td>
        <td> <i class="fa fa-list fa-2x text-success" aria-hidden="true" data-toggle="modal" data-target="#bonaceDetails"></i></td>
        <td><i class="fa fa-plus-circle fa-2x text-success"></i></td>
      </tr>
    </tbody>
  </table>







  <div class="modal fade" id="bonaceDetails">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Salary Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{ BonusController::bonacedetails($profile[0]->profile_id)}}
                </tbody>
            </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>




    <!-- Salary Model -->
<div class="modal fade" id="salaryDetails">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Salary Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{ SalaryController::salarydetails($profile[0]->profile_id)}}
                </tbody>
            </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


  <!-- Allowances view Model -->
<div class="modal fade" id="allowanceDetails">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Allowance Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">


            <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    {{ AllowanceController::allowancesdetails($profile[0]->profile_id)}}
                </tbody>
            </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>



<!-- Add to Allowances !-------->
<div class="modal fade" id="addtoAllowances">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New Allowance Details:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/addtoAllowance" method="post">
                @csrf


            <div class="row">

                    <div class="col-sm-5">
                        <div class="form-group">
                          <label for="email">Allowance:</label>
                           <input type="text" name="allowances_salary" class="form-control  @error('allowances_salary') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   required >
                          @error('allowances_salary')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

            </div>
            <div class="row">
                <div class="form-group">
                  <label for="email">Reason:</label>
                   <input type="text" name="allowances_update_reson" class="form-control  @error('allowances_update_reson') is-invalid @enderror" value=""  required >
                  @error('allowances_update_reson')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                      <label for="email">Effective Data:</label>
                       <input type="date" name="salary_add_date" class="form-control  @error('salary_add_date') is-invalid @enderror" value=""  required >
                      @error('salary_add_date')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>



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









    <div class="modal fade" id="bonaceDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Salary Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">


                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        {{ BonusController::bonacedetails($profile[0]->profile_id)}}
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>




        <!-- Salary Model -->
    <div class="modal fade" id="salaryDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Salary Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">


                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        {{ SalaryController::salarydetails($profile[0]->profile_id)}}
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>


      <!-- Allowances view Model -->
    <div class="modal fade" id="allowanceDetails">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Allowance Details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">


                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Total</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        {{ AllowanceController::allowancesdetails($profile[0]->profile_id)}}
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>



    <!-- Add to Allowances !-------->
    <div class="modal fade" id="addtoAllowances">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">New Allowance Details:</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <form action="/addtoAllowance" method="post">
                    @csrf


                <div class="row">

                        <div class="col-sm-5">
                            <div class="form-group">
                              <label for="email">Allowance:</label>
                               <input type="text" name="allowances_salary" class="form-control  @error('allowances_salary') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   required >
                              @error('allowances_salary')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                </div>
                <div class="row">
                    <div class="form-group">
                      <label for="email">Reason:</label>
                       <input type="text" name="allowances_update_reson" class="form-control  @error('allowances_update_reson') is-invalid @enderror" value=""  required >
                      @error('allowances_update_reson')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label for="email">Effective Data:</label>
                           <input type="date" name="salary_add_date" class="form-control  @error('salary_add_date') is-invalid @enderror" value=""  required >
                          @error('salary_add_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>



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









        <!-- Salary Model -->
    <div class="modal fade" id="incresmentDetails">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Increment Details </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Increment</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                      {{ IncresmentController::incresmentDetails($profile[0]->profile_id)}}
                  </tbody>
              </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>







    <div class="modal fade" id="addtosalary">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">New Salary Details:</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <form action="/addtosalary" method="post">
                    @csrf


                <div class="row">

                        <div class="col-sm-5">
                            <div class="form-group">
                              <label for="email">Salary:</label>
                               <input type="text" name="salary_salary" class="form-control  @error('salary_salary') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   required >
                              @error('salary_salary')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                </div>
                <div class="row">
                    <div class="form-group">
                      <label for="email">Reason:</label>
                       <input type="text" name="salary_reson" class="form-control  col-sm-12 @error('salary_reson') is-invalid @enderror" value=""  required >
                      @error('salary_reson')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label for="email">Effective Data:</label>
                           <input type="date" name="salary_add_date" class="form-control  @error('salary_add_date') is-invalid @enderror" value=""  required >
                          @error('salary_add_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>



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



     <!-- Add to incersment !-------->
     <div class="modal fade" id="newbincresment">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">New Increment Details:</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <form action="/addtoincresment" method="post">
                    @csrf


                <div class="row">

                        <div class="col-sm-5">
                            <div class="form-group">
                              <label for="email">Increment:</label>
                               <input type="text" name="incresments_salary" class="form-control  @error('incresments_salary') is-invalid @enderror" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   required >
                              @error('incresments_salary')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                </div>
                <div class="row">
                    <div class="form-group">
                      <label for="email">Reason:</label>
                       <input type="text" name="incresments_reson" class="form-control  @error('incresments_reson') is-invalid @enderror" value=""  required >
                      @error('incresments_reson')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                          <label for="email">Effective Data:</label>
                           <input type="date" name="incresments_add_date" class="form-control  @error('incresments_add_date') is-invalid @enderror" value=""  required >
                          @error('incresments_add_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>



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



