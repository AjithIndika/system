<?php
use App\Http\Controllers\SalaryController;



use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;
use App\Http\Controllers\ProjctnameController;
?>


<script>
    function showUser(str) {
      if (str == "") {
        document.getElementById("tprojectlist").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("projectlist").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","/projectlist?q="+str,true);
        xmlhttp.send();
      }
    }


    function showMack(str) {
      if (str == "") {
        document.getElementById("tlist").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("list").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET","/projectlist?q="+str,true);
        xmlhttp.send();
      }
    }
    </script>






@if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
    <button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal"
        data-target="#newWorkcompanidetails">
        <i class="bi bi-plus" style="">New Company</i>
    </button>
@endif
<!----- add working sbu details --------!----->

<div class="modal fade" id="newWorkcompanidetails">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add New Working Company Details </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="/newjobwork" method="post">
                    @csrf


                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group ">
                                <label for="email">Subsidiaries:</label></br>
                                <select
                                    class="custom-select @error('profile_job_work_sbu') is-invalid @enderror profile_job_work_sbu"
                                    name="profile_job_work_sbu" required style="width: 400px" onchange="showUser(this.value)" >
                                    <option value="0">Select One</option>
                                    @foreach ($data['subsidiaries'] as $subsidiaries)
                                        <option value="{{ $subsidiaries->subsidiaries_id }}">
                                            {{ $subsidiaries->subsidiaries_name }}</option>
                                    @endforeach

                                </select>
                                @error('profile_job_work_sbu')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    <div class="col-sm-5">
                        <div class="form-group">
                        <label for="email">Project</label>
                        <div id="projectlist"></div>
                         @error('projctnames_id')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    </div>
                    <div class="row">

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Designation:</label></br>
                                <select
                                    class="custom-select  @error('profile_job_work_designation') is-invalid @enderror profile_job_work_designation"
                                    name="profile_job_work_designation" required required style="width: 400px">
                                    <option value="0">Select One</option>
                                    @foreach ($data['designations'] as $designations)
                                        <option value="{{ $designations->designations_id }}">
                                            {{ $designations->designations_name }}</option>
                                    @endforeach
                                </select>
                                @error('profile_job_work_designation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Department:</label></br>
                                <select
                                    class="custom-select  @error('profile_job_work_department') is-invalid @enderror profile_job_work_department"
                                    name="profile_job_work_department" required required style="width: 400px">
                                    <option value="0">Select One</option>
                                    @foreach ($data['departments'] as $departments)
                                        <option value="{{ $departments->department_id }}">
                                            {{ $departments->department_name }}</option>
                                    @endforeach
                                </select>
                                @error('profile_job_work_department')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="row">



                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Job Description:</label></br>
                                <select
                                    class="custom-select  @error('profile_job_work_jd') is-invalid @enderror profile_job_work_jd"
                                    name="profile_job_work_jd" required required style="width: 400px">
                                    <option value="0">Select One</option>
                                    @foreach ($data['job_descriptions'] as $job_descriptions)
                                        <option value="{{ $job_descriptions->job_descriptions_id }}">
                                            {{ $job_descriptions->job_descriptions_name }}</option>
                                    @endforeach
                                </select>
                                @error('profile_job_work_jd')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col"><hr></hr></div>
                    </div>


                    <div class="row">

                      <div class="col-sm-5">
                        <div class="form-group">
                            <label for="email">Employee Index Number:</label>
                            <input type="text"
                                class="form-control  @error('profile_job_work_employee_index_number') is-invalid @enderror"
                                placeholder="Employee Index Number" id="email"
                                name="profile_job_work_employee_index_number">
                            @error('profile_job_work_employee_index_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                      <div class="col-sm-5">
                        <div class="form-group">
                            <label for="email">EPF Number:</label>
                            <input type="text"
                                class="form-control  @error('profile_job_work_epf_number') is-invalid @enderror "
                                placeholder="EPF Number" id="email" name="profile_job_work_epf_number">
                            @error('profile_job_work_epf_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    </div>




                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Joined Date:</label>
                                <input type="date" name="profile_job_work_join_date"
                                    class="form-control  @error('profile_job_work_join_date') is-invalid @enderror"
                                    required>
                                @error('profile_job_work_join_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Office Location:</label></br>
                                <select
                                    class="custom-select  @error('profile_job_work_office_location') is-invalid @enderror profile_job_work_office_location"
                                    name="profile_job_work_office_location" required required style="width: 400px">
                                    <option value="0">Select One</option>
                                    @foreach ($data['office_locations'] as $office_locations)
                                        <option value="{{ $office_locations->office_locations_id }}">
                                            {{ $office_locations->office_locations_name }}</option>
                                    @endforeach

                                </select>
                                @error('profile_job_work_office_location')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>                    </div>



                        <div class="row">
                          <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email"> Reporting Manager:</label></br>
                                <select
                                    class="custom-select  @error('profile_job_work_head_of_sbu') is-invalid @enderror profile_job_work_head_of_sbu"
                                    name="profile_job_work_head_of_sbu" style="width: 400px">
                                    <option value="0">Select One</option>

                                    @foreach ($data['sbu_head'] as $sbu_head)
                                        <option value="{{ $sbu_head->profile_id }}">{{ $sbu_head->profile_Full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('profile_job_work_head_of_sbu')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        </div>



                    <div class="row">

                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" name="profile_job_work_email"
                                    class="form-control  @error('profile_job_work_email') is-invalid @enderror"
                                    placeholder="Email">
                                @error('profile_job_work_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>

                        <div class="col-sm-5 ml-1">
                            <div class="form-group">
                                <label for="email">Mobile Number:</label>
                                <input type="tel" name="profile_job_work_mobile"
                                    class="form-control  @error('profile_job_work_mobile') is-invalid @enderror"
                                    placeholder="Mobile Number"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                @error('profile_job_work_mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-----
                <div class="col-sm-5">
                    <div class="form-group">
                    <label for="email">Profile Status:</label>
                    <select  class="custom-select  @error('profile_job_work_status') is-invalid @enderror" name="profile_job_work_status" value="{{ old('profile_job_work_status') }}" required>

                        <option value="Active">Active</option>
                        <option value="Stopped">Stopped</option>
                    </select>
                    @error('profile_job_work_status')
    <div class="text-danger">{{ $message }}</div>
@enderror
                  </div>
            </div>
              !----------->
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Reason :</label>
                                <input type="tel" name="profile_job_work_status_reson"
                                    class="form-control  @error('profile_job_work_status_reson') is-invalid @enderror"
                                    required>
                                @error('profile_job_work_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>




                    <input type="hidden" value="{{ $profile[0]->profile_id }}" name="profile_id">
                    <input type="hidden" value="{{ $profile[0]->profile_number }}" name="profile_number">
                    <input type="hidden" value="{{ $profile[0]->profile_sug }}" name="profile_sug">

                    <button type="submit" class="btn btn-success" name="joindetails">Save</button>
                </form>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>








<div class="mt-3 badge-secondary shadow-lg p-2 mb-1 bg-white rounded text-center text-capitalize">
    <h4 class="text-bold text-capitalize text-info">JOB History</h4>
</div>
<hr class="text-success">
</hr>





<table class="table table-hover mb-5">
    <thead>
        <tr>
            <th>#</th>
            <th>EPF No</th>
            <th>Company Name</th>
            <th>Effective date</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Reporting Manager</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        @foreach ($data['lastworkscompani'] as $keywork => $Workstop)
            <tr @if ($Workstop->profile_job_work_status == 'Active') class="bg-success text-white rounded" @endif>
                <td> {{ $keywork + 1 }}</td>
                <td> {{ $Workstop->profile_job_work_epf_number }}</td>
                <td> {{ $Workstop->subsidiaries_name }}</td>
                <td> {{ $Workstop->profile_job_work_join_date }}</td>
                <td> {{ $Workstop->department_name }}</td>
                <td> {{ $Workstop->designations_name }}</td>
                <td>{{ ProfileController::reportingManager($Workstop->profile_job_work_head_of_sbu) }}</td>

                <td>
                    @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
                        <i class="bi bi-pencil-square  text-white" style="font-size: 1.5rem;" data-toggle="modal"
                            data-target="#editWorkcompani{{ $Workstop->job_working_profile_id }}"></i>
                        <!-----
            <button type="button" class="btn btn-success  mb-3" class="btn btn-primary" data-toggle="modal" data-target="#editWorkcompani{{ $Workstop->job_working_profile_id }}">Edit  {{ $Workstop->subsidiaries_name }} Details</button></td>
           !------->
                    @endif
            </tr>


            <div class="modal fade" id="editWorkcompani{{ $Workstop->job_working_profile_id }}">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $Workstop->subsidiaries_name }}  Details Edit </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="/jobworkupdate" method="post">
                                @csrf


                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Subsidiaries: </label></br>
                                            <select
                                                class="custom-select  @error('profile_job_work_sbu') is-invalid @enderror profile_job_work_sbu"
                                                name="profile_job_work_sbu" required style="width: 400px" onchange="showMack(this.value)" >
                                                <option value="{{ $Workstop->profile_job_work_sbu }}">
                                                    {{ DB::table('subsidiaries')->where('subsidiaries_id', $Workstop->profile_job_work_sbu)->value('subsidiaries_name') }}
                                                </option>

                                                @foreach ($data['subsidiaries'] as $subsidiaries)
                                                    <option value="{{ $subsidiaries->subsidiaries_id }}">
                                                        {{ $subsidiaries->subsidiaries_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('profile_job_work_sbu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                        <label for="email">Project </label>
                                        <select class="custom-select projctnames_id"  name="projctnames_id">
                                       {{ProjctnameController::currant_project($Workstop->profile_job_work_sbu,$Workstop->profile_job_work_projctnames)}}
                                        </select>

                                         @error('projctnames_id')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    </div>


                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Designation:</label></br>
                                            <select
                                                class="custom-select  @error('profile_job_work_designation') is-invalid @enderror profile_job_work_designation"
                                                name="profile_job_work_designation" required style="width: 400px">
                                                <option value="{{ $Workstop->profile_job_work_designation }}">
                                                    {{ DB::table('designations')->where('designations_id', $Workstop->profile_job_work_designation)->value('designations_name') }}
                                                </option>
                                                @foreach ($data['designations'] as $designations)
                                                    <option value="{{ $designations->designations_id }}">
                                                        {{ $designations->designations_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('profile_job_work_designation')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Department:</label></br>
                                            <select
                                                class="custom-select  @error('profile_job_work_department') is-invalid @enderror profile_job_work_department"
                                                name="profile_job_work_department" required style="width: 400px">
                                                <option value="{{ $Workstop->profile_job_work_department }}">
                                                    {{ DB::table('departments')->where('department_id', $Workstop->profile_job_work_department)->value('department_name') }}
                                                </option>
                                                @foreach ($data['departments'] as $departments)
                                                    <option value="{{ $departments->department_id }}">
                                                        {{ $departments->department_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('profile_job_work_department')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="email">Joined Date:</label>
                                            <input type="date" name="profile_job_work_join_date"
                                                class="form-control  @error('profile_job_work_join_date') is-invalid @enderror"
                                                value="{{ $Workstop->profile_job_work_join_date }}"  style="width: 400px" required>
                                            @error('profile_job_work_join_date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Job Description:</label></br>
                                            <select
                                                class="custom-select  @error('profile_job_work_jd') is-invalid @enderror profile_job_work_jd"
                                                name="profile_job_work_jd" required style="width: 400px">
                                                <option value="{{ $Workstop->profile_job_work_jd }}">
                                                    {{ DB::table('job_descriptions')->where('job_descriptions_id', $Workstop->profile_job_work_jd)->value('job_descriptions_name') }}
                                                </option>
                                                @foreach ($data['job_descriptions'] as $job_descriptions)
                                                    <option value="{{ $job_descriptions->job_descriptions_id }}">
                                                        {{ $job_descriptions->job_descriptions_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('profile_job_work_jd')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Office Location:</label></br>
                                            <select
                                                class="custom-select  @error('profile_job_work_office_location') is-invalid @enderror  profile_job_work_office_location"
                                                name="profile_job_work_office_location" required style="width: 400px">
                                                <option value="{{ $Workstop->profile_job_work_office_location }}">
                                                    {{ DB::table('office_locations')->where('office_locations_id', $Workstop->profile_job_work_office_location)->value('office_locations_name') }}
                                                </option>
                                                @foreach ($data['office_locations'] as $office_locations)
                                                    <option value="{{ $office_locations->office_locations_id }}">
                                                        {{ $office_locations->office_locations_name }}</option>
                                                @endforeach

                                            </select>
                                            @error('profile_job_work_office_location')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>




                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Employee Index Number:</label>
                                            <input type="text"
                                                class="form-control  @error('profile_job_work_employee_index_number') is-invalid @enderror"
                                                placeholder="Employee Index Number" id="email"
                                                name="profile_job_work_employee_index_number"
                                                value="{{ $Workstop->profile_job_work_employee_index_number }}">
                                            @error('profile_job_work_employee_index_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">EPF Number:</label>
                                            <input type="text"
                                                class="form-control  @error('profile_job_work_epf_number') is-invalid @enderror"
                                                placeholder="EPF Number" id="email"
                                                name="profile_job_work_epf_number"
                                                value="{{ $Workstop->profile_job_work_epf_number }}">
                                            @error('profile_job_work_epf_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Head Of Business:</label></br>
                                            <select
                                                class="custom-select  @error('profile_job_work_head_of_sbu') is-invalid @enderror profile_job_work_head_of_sbu"
                                                name="profile_job_work_head_of_sbu" style="width: 400px">
                                                <option value="{{ $Workstop->profile_job_work_head_of_sbu }}">
                                                    {{ DB::table('profiles')->where('profile_id', $Workstop->profile_job_work_head_of_sbu)->value('profile_Full_name') }}
                                                </option>

                                                @foreach ($data['sbu_head'] as $sbu_head)
                                                    <option value="{{ $sbu_head->profile_id }}">
                                                        {{ $sbu_head->profile_Full_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('profile_job_work_head_of_sbu')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Head Of SBU:</label>
                                            <select
                                                class="custom-select  @error('profile_head_of_departmrnt_this_account') is-invalid @enderror"
                                                name="profile_head_of_departmrnt_this_account"
                                                value="{{ old('profile_head_of_departmrnt_this_account') }}" required>
                                                <option
                                                    value="{{ $Workstop->profile_head_of_departmrnt_this_account }}">
                                                    {{ $Workstop->profile_head_of_departmrnt_this_account }}</option>
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                            @error('profile_head_of_departmrnt_this_account')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>



                                </div>

                                <div class="row">

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Email Address:</label>
                                            <input type="email" name="profile_job_work_email"
                                                class="form-control  @error('profile_job_work_email') is-invalid @enderror"
                                                value="{{ $Workstop->profile_job_work_email }}" placeholder="Email">
                                            @error('profile_job_work_email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Mobile Number:</label>
                                            <input type="tel" name="profile_job_work_mobile"
                                                class="form-control  @error('profile_job_work_mobile') is-invalid @enderror"
                                                value="{{ $Workstop->profile_job_work_mobile }}"
                                                placeholder="Mobile Number"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                            @error('profile_job_work_mobile')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="email">Profile Status:</label>
                                            <select
                                                class="custom-select  @error('profile_job_work_status') is-invalid @enderror"
                                                name="profile_job_work_status"
                                                value="{{ old('profile_job_work_status') }}" required>
                                                <option value="{{ $Workstop->profile_job_work_status }}">
                                                    {{ $Workstop->profile_job_work_status }}</option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            @error('profile_job_work_status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Reason:</label>
                                            <input type="tel" name="profile_job_work_status_reson"
                                                class="form-control  @error('profile_job_work_status_reson') is-invalid @enderror"
                                                value="{{ $Workstop->profile_job_work_status_reson }}" required>
                                            @error('profile_job_work_status')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col mt-3">
                                        Last Edited: {{ $Workstop->job_work_last_update_by }} /
                                        {{ $Workstop->job_work_last_update_date }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        Created : {{ $Workstop->job_work_profile_crate_by }} /
                                        {{ $Workstop->job_work_profile_crate_date }}
                                    </div>
                                </div>

                                <input type="hidden" value="{{ $Workstop->job_working_profile_id }}"
                                    name="job_working_profile_id">
                                <input type="hidden" value="{{ $Workstop->profile_job_join_profile_id }}"
                                    name="profile_job_join_profile_id">
                                <input type="hidden" value="{{ $profile[0]->profile_number }}"
                                    name="profile_number">
                                <input type="hidden" value="{{ $profile[0]->profile_sug }}" name="profile_sug">

                                <button type="submit" class="btn btn-success" name="joindetails">Save</button>
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








<div class="modal fade" id="jds">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Current Job Description:</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                @if (!empty($profile[0]->profile_job_work_jd))
                    <iframe
                        src="/jds_uplode/{{ DB::table('job_descriptions')->where('job_descriptions_id', $profile[0]->profile_job_work_jd)->value('job_descriptions_note') }}"
                        class="col" height="800px">
                    </iframe>
                @else
                    No File to View.
                @endif
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
