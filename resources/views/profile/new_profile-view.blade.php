<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;



?>

@foreach($data['profile'] as $profile)
<section class="section dashboard">



    <style>
    .center {
   margin: auto;
    width: 50%;
    padding: 10px;
    text-align: center;
    }
    </style>
<div class="row">


 <div class="col ">

    <!-- tabs !------>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal</a>
        </li>
<!---
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Joined Company </a>
        </li>
!----->

<style>
    .nav-link{
        font-size: 80%;
    }
</style>

   <li class="nav-item">
    <a class="nav-link" id="Training-development-tab" data-toggle="tab" href="#Training-development" role="tab" aria-controls="Training-development" aria-selected="false">Training and development </a>
   </li>

   @if(!empty(Auth::user()->hrAdmin))
   <li class="nav-item">
    <a class="nav-link" id="Performance-eveluation-tab" data-toggle="tab" href="#Performance-eveluation" role="tab" aria-controls="Performance-eveluation" aria-selected="false">Performance eveluation </a>
   </li>

@endif

        <li class="nav-item">
          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"> Working Company</a>
        </li>

        @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
          <li class="nav-item">
            <a class="nav-link" id="Account-Details-tab" data-toggle="tab" href="#Account-Details" role="tab" aria-controls="Account-Details" aria-selected="false">Bank</a>
          </li>
        @endif

        @if(!empty(Auth::user()->hrAdmin))
          <li class="nav-item">
            <a class="nav-link" id="Salary-Details-tab" data-toggle="tab" href="#Salary-Details" role="tab" aria-controls="Salary-Details" aria-selected="false">Salary</a>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link" id="leave-tab" data-toggle="tab" href="#leave-details" role="tab" aria-controls="leave-details" aria-selected="false">Leave</a>
          </li>


          <li class="nav-item">
            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
          </li>

          @if(!empty(Auth::user()->hrAdmin))
          <li class="nav-item">
            <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="status-tab" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status</a>
          </li>
      </ul>


 </div>

 <div class="row  mb-1 shadow-lg p-3 mb-5 bg-white rounded">
    <!--- profile Image Start !---->
<div class="col-sm-2 ">

<div class="col mt-2 ">
        <div class="container">
        <img src="@if (!empty( $profile[0]->profile_image))/profile-image/{{ $profile[0]->profile_image}}@else/sbu_logo/{{ $profile[0]->subsidiaries_logo}}@endif " alt="Avatar" class="image" style="width:90%">
        <div class="middle">

            <div class="text mt-1">

                @if (empty($profile[0]->profile_image))
                @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfileImage">
                    <i class="bi bi-cloud-upload"></i>
                </button>
                @endif
                @endif

                @if (!empty( $profile[0]->profile_image))
                @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfileImage">
                <i class="bi bi-trash-fill"></i>
                </button>
                @endif
                @endif

            </div>
        </div>


        </div>



<style>
.h4-text{
    margin-top: 20px;
    margin-left: 40px
}
</style>



                  <!-- The ProfileImage -->
          <div class="modal" id="ProfileImage">
              <div class="modal-dialog">
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                  <h4 class="modal-title">Profile Image</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                      @if (!empty( $profile[0]->profile_image))
                      <form action="/delet_profile_image" method="POST" enctype="multipart/form-data">
                          @csrf

                          <input  type="hidden"  name="profile_image"  value="{{ $profile[0]->profile_image}}">
                          <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                          <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                          <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                          <button type="submit" class="btn btn-success" name="joindetails">Remove It</button>
                  </form>
                  @else
                  <form action="/uplode_profile_image" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                      <label for="email">Image:</label>
                      <input type="file" class="form-control" placeholder="Profile Image" id="email" name="profile_image" required>
                      </div>
                      <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                      <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                      <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                      <button type="submit" class="btn btn-success" name="joindetails">Save</button>
                    </form>


                  @endif
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
              </div>
              </div>
          </div>


<!--------- ProfileImage-----------!--------->


</div>
</div>
<!--- end  profile Image  !---->




<div class="col-sm-10 center">
<div class="row mt-2 ">
     <h3>{{ $profile[0]->profile_Full_name }}</h3>
</div>
</div>

</div>




      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <hr class="text-success"></hr>


                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="email">Full Name :</label>
                        <input type="email" class="form-control"  id="email" value="{{ $profile[0]->profile_Full_name }}" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">Preferred Name ( First / Last) :</label>
                        <input type="email" class="form-control col" value="{{ $profile[0]->profile_call_name}}" id="email" disabled>
                      </div>
                    </div>

                      <div class="col-sm-2">
                      <div class="form-group">
                        <label for="email">Birth Day:</label>
                        <input type="email" class="form-control"  value="{{ $profile[0]->profile_bith_day}}" disabled>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="email">Age:</label>
                        <input type="email" class="form-control"  id="result" disabled>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="email">Gender:</label>
                        <input type="email" class="form-control " value="{{ $profile[0]->profile_gender}}" id="email" disabled>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="email">Marital Status:</label>
                        <input type="email" class="form-control col" value="{{ $profile[0]->profile_marital_status}}" id="email" disabled>
                      </div>
                    </div>

                  </div>


                  <div class="row">

                    <div class="col">
                      <div class="form-group">
                        <label for="email">NIC:</label>
                        <input type="email" class="form-control" value="{{ $profile[0]->profile_nic}}" id="email" disabled>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="email">Province:</label>
                        <input type="email" class="form-control " value="{{ $profile[0]->profile_living_province}}" id="email" disabled>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="email">Gender:</label>
                        <input type="email" class="form-control " value="{{ $profile[0]->profile_gender}}" id="email" disabled>
                      </div>
                    </div>


                  </div>


                  <div>   <hr class="text-success"></hr></div>

                  <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Mobile Number:</label>
                        <input type="email" class="form-control " value="{{ $profile[0]->profile_mobile_number}}" id="email" disabled>
                      </div>
                  </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="email">Emergency Mobile Number:</label>
                        <input type="email" class="form-control " value="{{ $profile[0]->profile_emergency_mobile_number}}" id="email" disabled>
                      </div>
                    </div>


                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control " value="{{ $profile[0]->profile_email}}" id="email" disabled>
                      </div>
                    </div>

                  </div>

                     <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="email">Permanent Address:</label>
                            <textarea class="form-control  @error('profile_permant_address') is-invalid @enderror" name="profile_permant_address" required rows="5" cols="3">{{ $profile[0]->profile_permant_address}}</textarea>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                            <label for="email">Current Address:</label>
                            <textarea class="form-control  @error('profile_current_address') is-invalid @enderror" name="profile_current_address" required rows="5" cols="3">{{ $profile[0]->profile_current_address}}</textarea>
                             </div>
                           </div>
                    </div>




                    @if(!empty(Auth::user()->hrAdmin))
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-pencil-square-o  fa-1x" aria-hidden="true" title="">  </i> Edit personal details
                    </button>

                    @endif



                    <!---- edit personl Details !------>

                      <!----- personal details update !----------->

            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $profile[0]->profile_Full_name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/edit_profile_personal_details" method="post">
                @csrf

                <div class="mt-3"><h4>Personal Details</h4></div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                    <label for="email">Full Name:</label>
                    <input type="text" class="form-control  @error('profile_Full_name') is-invalid @enderror @error('profile_sug') is-invalid @enderror  "  value="{{ $profile[0]->profile_Full_name}}" id="email" name="profile_Full_name"  required>
                    @error('profile_Full_nam')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>


                <div class="col">
                    <div class="form-group">
                    <label for="email">Call Name:</label>
                    <input type="text" class="form-control  @error('profile_call_name') is-invalid @enderror" placeholder="Call Name" id="email" value="{{ $profile[0]->profile_call_name}}" required name="profile_call_name">
                    @error('profile_call_name')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>

            </div>




            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                    <label for="email">Birth Day:</label>
                    <input type="date" class="form-control  @error('profile_bith_day') is-invalid @enderror" value="{{ $profile[0]->profile_bith_day}}" id="email" name="profile_bith_day" required>
                    @error('profile_bith_day')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>



                <div class="col">
                    <div class="form-group">
                    <label for="email">Religion:</label>
                    <select  class="custom-select  @error('religion_id') is-invalid @enderror" name="religion_id"  required>

                        <option value="{{ $profile[0]->religion_id}}">{{ $profile[0]->religion_name}}</option>
                        @foreach ($data['religions'] as $religions)
                        <option value="{{$religions->religion_id}}">{{$religions->religion_name}}</option>
                        @endforeach
                    </select>
                    @error('religion_id')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                </div>






                <div class="col">
                    <div class="form-group">
                    <label for="email">Living Province:</label>
                    <select  class="custom-select  @error('profile_living_province') is-invalid @enderror" name="profile_living_province" value="{{ old('profile_living_province') }}" required>
                       <option>{{ $profile[0]->profile_living_province}}</option>
                        <option>Central</option>
                        <option>East</option>
                        <option>Northcentral</option>
                        <option>North</option>
                        <option>Northwest</option>
                        <option>Sabaragamuwa</option>
                        <option>South</option>
                        <option>Uva</option>
                        <option>West</option>
                    </select>
                    @error('profile_living_province')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                </div>
            </div>






            <div class="row">

                <div class="col">
                    <div class="form-group">
                    <label for="email">Gender:</label>
                    <select  class="custom-select  @error('profile_gender') is-invalid @enderror" name="profile_gender"  required>
                        <option>{{ $profile[0]->profile_gender}}</option>
                        <option>Female</option>
                        <option>Male</option>
                    </select>
                    @error('profile_gender')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                </div>


                <div class="col">
                    <div class="form-group">
                    <label for="email">Marital Status:</label>
                    <select  class="custom-select  @error('profile_marital_status') is-invalid @enderror" name="profile_marital_status"  required>
                      <option>{{ $profile[0]->profile_marital_status}}</option>
                        <option>Single</option>
                        <option>Married</option>
                        <option>Divorced</option>
                    </select>
                    @error('profile_marital_status')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                    <label for="email">Nic:</label>
                    <input type="text" class="form-control  @error('profile_nic') is-invalid @enderror" value="{{ $profile[0]->profile_nic}}" id="email" name="profile_nic"  required>
                    @error('profile_nic')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>

                <div> <hr/></div>
            </div>

            <div class="mt-3"><h4>Contact Details</h4></div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                    <label for="email">Mobile Number:</label>
                    <input type="tel" class="form-control  @error('profile_mobile_number') is-invalid @enderror" value="{{ $profile[0]->profile_mobile_number}}" id="email" name="profile_mobile_number"  required maxlength="10">
                    @error('profile_mobile_number')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                    <label for="email">Eergency Mobile Number:</label>
                    <input type="tel" class="form-control  @error('profile_emergency_mobile_number') is-invalid @enderror" value="{{ $profile[0]->profile_emergency_mobile_number}}" id="email" name="profile_emergency_mobile_number" required maxlength="10">
                    @error('profile_emergency_mobile_number')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control  @error('profile_email') is-invalid @enderror" value="{{ $profile[0]->profile_email}}" id="email" name="profile_email" >
                    @error('profile_email')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label for="email">Permant address:</label>
                    <textarea class="form-control  @error('profile_permant_address') is-invalid @enderror" name="profile_permant_address" required rows="5" cols="3">{{ $profile[0]->profile_permant_address}}</textarea>
                    @error('profile_permant_address')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>

                <div class="col">
                    <div class="form-group">
                    <label for="email">Current address:</label>
                    <textarea class="form-control  @error('profile_current_address') is-invalid @enderror" name="profile_current_address" required rows="5" cols="3">{{ $profile[0]->profile_current_address}}</textarea>
                    @error('profile_current_address')<div class="text-danger">{{ $message }}</div> @enderror
                </div>
                </div>

<input type="hidden" name="profile_id" value="{{ $profile[0]->profile_id}}">

                <div> <hr/></div>
            </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>


</form>

                    <!----- end edit personal details !-------->
        </div>

        <!--- join compani details !---->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                      <label for="email">Company Name:</label>
                      <input type="text" class="form-control " value="{{ $profile[0]->subsidiaries_name}}" id="email" disabled>
                    </div>
                </div>

              <div class="col-sm-3">
                  <div class="form-group">
                    <label for="email">Department:</label>
                    <input type="text" class="form-control " value=" {{ DB::table('departments')->where('department_id',$profile[0]->profile_job_join_department)->value('department_name') }}" id="email" disabled>
                  </div>
              </div>


              <div class="col-sm-4">
                <div class="form-group">
                  <label for="email">Designation:</label>
                  <input type="text" class="form-control " value="{{ DB::table('designations')->where('designations_id',$profile[0]->profile_job_join_designation)->value('designations_name') }}" id="email" disabled>
                </div>
              </div>

      </div>



        <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                  <label for="email">Joined Date:</label>
                  <input type="text" class="form-control " value="{{ $profile[0]->profile_job_join_date}}" id="email" disabled>
                  </div>
                </div>

          <div class="col-sm-3">
              <div class="form-group">
                <label for="email">Job Description:</label></br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jd">
                    {{ DB::table('job_descriptions')->where('job_descriptions_id',$profile[0]->profile_job_join_jd)->value('job_descriptions_name') }}
                </button>
              </div>
          </div>


          <div class="col">
            <div class="form-group">
              <label for="email">ETF Number:</label>
              <input type="text" class="form-control " value="{{ $profile[0]->profile_job_join_epf_number}}" id="email" disabled>
          </div>
        </div>



          <div class="col">
              <div class="form-group">
                <label for="email">Office Location:</label>
                <input type="text" class="form-control " value="{{ DB::table('office_locations')->where('office_locations_id',$profile[0]->profile_job_join_office_location)->value('office_locations_name') }}" id="email" disabled>
            </div>
          </div>

        </div>

      <div class="row">

        <div class="col-sm-5">
          <div class="form-group">
            <label for="email">Mobile Number:</label>
            <input type="text" class="form-control " value="{{ $profile[0]->profile_job_join_mobile}}" id="email" disabled>
        </div>
      </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control " value="{{ $profile[0]->profile_job_join_email}}" id="email" disabled>
        </div>
      </div>

      <div class="col-sm-5">
        <div class="form-group">
          <label for="email">Head:</label>
          <input type="text" class="form-control "  value="{{ DB::table('profiles')->where('profile_id',$profile[0]->profile_job_join_head_of_sbu)->value('profile_Full_name') }}" id="" disabled>
      </div>
    </div>


        <div class="col-sm-5">
          <div class="form-group">
            <label for="email">Duration Worked:</label>
            <input type="text" class="form-control " value="" id="timeofwork" disabled>
        </div>
      </div>

      </div>
        </div>

        <!-- end join compani details !----->

        <!--- Start  job working details !----->
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">






            @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
            <button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal" data-target="#newWorkcompanidetails">  <i class="bi bi-plus" style="">New Company</i></button>
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
                        <div class="col-sm-7">
                            <div class="form-group ">
                            <label for="email">Subsidiaries:</label></br>
                            <select class="custom-select @error('profile_job_work_sbu') is-invalid @enderror profile_job_work_sbu" name="profile_job_work_sbu" required style="width: 500px">
                              @foreach ($data['subsidiaries'] as $subsidiaries)
                                <option value="{{$subsidiaries->subsidiaries_id}}">{{$subsidiaries->subsidiaries_name}}</option>
                                @endforeach

                            </select>
                            @error('profile_job_work_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                            <label for="email">Designation:</label></br>
                            <select class="custom-select  @error('profile_job_work_designation') is-invalid @enderror profile_job_work_designation" name="profile_job_work_designation" required required style="width: 400px">
                                @foreach ($data['designations'] as $designations)
                                <option value="{{$designations->designations_id}}">{{$designations->designations_name}}</option>
                                @endforeach
                            </select>
                            @error('profile_job_work_designation')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-7">
                            <div class="form-group">
                            <label for="email">Department:</label></br>
                            <select class="custom-select  @error('profile_job_work_department') is-invalid @enderror profile_job_work_department" name="profile_job_work_department" required required style="width: 500px">
                                @foreach ($data['departments'] as $departments)
                                <option value="{{$departments->department_id}}">{{$departments->department_name}}</option>
                                @endforeach
                            </select>
                            @error('profile_job_work_department')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                            <label for="email">Job Description:</label></br>
                            <select class="custom-select  @error('profile_job_work_jd') is-invalid @enderror profile_job_work_jd" name="profile_job_work_jd" required required style="width: 400px">
                                @foreach ($data['job_descriptions'] as $job_descriptions)
                                <option value="{{$job_descriptions->job_descriptions_id}}">{{$job_descriptions->job_descriptions_name}}</option>
                                @endforeach
                            </select>
                            @error('profile_job_work_jd')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="email">Joined Date:</label>
                           <input type="date" name="profile_job_work_join_date" class="form-control  @error('profile_job_work_join_date') is-invalid @enderror" required>
                           @error('profile_job_work_join_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>



                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="email">Office Location:</label></br>
                            <select class="custom-select  @error('profile_job_work_office_location') is-invalid @enderror profile_job_work_office_location" name="profile_job_work_office_location" required required style="width: 400px">
                                @foreach ($data['office_locations'] as $office_locations)
                                <option value="{{$office_locations->office_locations_id}}">{{$office_locations->office_locations_name}}</option>
                                @endforeach

                            </select>
                            @error('profile_job_work_office_location')<div class="text-danger">{{ $message }}</div> @enderror
                          </div>
                        </div>

                        <div class="col">

                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                            <label for="email">EPF Number:</label>
                            <input type="text" class="form-control  @error('profile_job_work_epf_number') is-invalid @enderror " placeholder="EPF Number" id="email" name="profile_job_work_epf_number"  required >
                            @error('profile_job_work_epf_number')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>

                        <div class="col-sm-5">

                            <div class="form-group">
                                <label for="email"> Reporting Manager:</label></br>
                                <select class="custom-select  @error('profile_job_work_head_of_sbu') is-invalid @enderror profile_job_work_head_of_sbu" name="profile_job_work_head_of_sbu" required style="width: 400px">

                                    @foreach ($data['sbu_head'] as $sbu_head)
                                    <option value="{{$sbu_head->profile_id}}">{{$sbu_head->profile_Full_name}}</option>
                                    @endforeach
                                </select>
                                @error('profile_job_work_head_of_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>


                        </div>



                    </div>

                    <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" name="profile_job_work_email" class="form-control  @error('profile_job_work_email') is-invalid @enderror"    placeholder="Email">
                                @error('profile_job_work_email')<div class="text-danger">{{ $message }}</div> @enderror

                              </div>
                        </div>

                            <div class="col-sm-5">
                                <div class="form-group">
                                <label for="email">Mobile Number:</label>
                                <input type="tel" name="profile_job_work_mobile" class="form-control  @error('profile_job_work_mobile') is-invalid @enderror" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                @error('profile_job_work_mobile')<div class="text-danger">{{ $message }}</div> @enderror
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
                                @error('profile_job_work_status')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                        </div>
                          !----------->
                        <div class="col">
                          <div class="form-group">
                                <label for="email">Reason :</label>
                                 <input type="tel" name="profile_job_work_status_reson" class="form-control  @error('profile_job_work_status_reson') is-invalid @enderror"   required >
                                @error('profile_job_work_status')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                        </div>
                    </div>




                    <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                    <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                    <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">

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





            @foreach($data['workingJobportal'] as $work)


            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                      <label for="email">Company Name:</label>

                      <input type="text" class="form-control " value="{{ DB::table('subsidiaries')->where('subsidiaries_id',$work->profile_job_work_sbu)->value('subsidiaries_name') }}" id="email" disabled>
                    </div>
                </div>

              <div class="col-sm-3">
                  <div class="form-group">
                    <label for="email">Department:</label>
                    <input type="text" class="form-control " value="{{ DB::table('departments')->where('department_id',$work->profile_job_work_department)->value('department_name') }}" id="email" disabled>
                  </div>
              </div>


              <div class="col-sm-4">
                <div class="form-group">
                  <label for="email">Designation:</label>
                  <input type="text" class="form-control " value="{{ DB::table('designations')->where('designations_id',$work->profile_job_work_designation)->value('designations_name') }}" id="email" disabled>
                </div>
              </div>

      </div>



        <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                  <label for="email">Joined Date:</label>
                  <input type="text" class="form-control " value="{{ $work->profile_job_work_join_date}}" id="email" disabled>
                  </div>
                </div>

          <div class="col-sm-3">
              <div class="form-group">
                <label for="email">Job Description:</label></br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#jds">
                  {{ DB::table('job_descriptions')->where('job_descriptions_id',$work->profile_job_work_jd)->value('job_descriptions_name') }}
                </button>
              </div>
          </div>


          <div class="col">
            <div class="form-group">
              <label for="email">ETF Number:</label>
              <input type="text" class="form-control " value="{{ $work->profile_job_work_epf_number}}" id="email" disabled>
          </div>
        </div>



          <div class="col">
              <div class="form-group">
                <label for="email">Office Location:</label>
                <input type="text" class="form-control " value=" {{ DB::table('office_locations')->where('office_locations_id',$work->profile_job_work_office_location)->value('office_locations_name') }}" id="email" disabled>
            </div>
          </div>

        </div>

      <div class="row">

        <div class="col-sm-5">
          <div class="form-group">
            <label for="email">Mobile Number:</label>
            <input type="text" class="form-control " value="{{ $work->profile_job_work_mobile}}" id="email" disabled>
        </div>
      </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="text" class="form-control " value="{{ $work->profile_job_work_email}}" id="email" disabled>
        </div>
      </div>


      <div class="col-sm-5">
        <div class="form-group">
          <label for="email">Reporting Manager:</label>
          <input type="text" class="form-control "  value="{{ DB::table('profiles')->where('profile_id',$work->profile_job_work_head_of_sbu)->value('profile_Full_name') }}" id="" disabled>
      </div>
    </div>

        <div class="col-sm-5">
          <div class="form-group">
            <label for="email">Duration worked:</label>
            <input type="text" class="form-control " value="" id="timeofwork" disabled>
        </div>
      </div>

      </div>

      <div class="row">

      <div class="col">
        <div class="form-group">
        @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))


      <button type="button" class="btn btn-success col-5 mb-3" class="btn btn-primary" data-toggle="modal" data-target="#editWorkcompanidetails{{$work->job_working_profile_id}}"><i class="bi bi-pencil-square" data-toggle="modal" data-target="#editWorkcompanidetails{{$work->job_working_profile_id}}"> Edit Details </i></button>
      @endif
        </div>
    </div>
      </div>



  <hr class="text-success"></hr>

      <!----- edit working sbu details --------!----->

          <div class="modal fade" id="editWorkcompanidetails{{$work->job_working_profile_id}}">
              <div class="modal-dialog modal-xl">
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                  <h4 class="modal-title">Edit Working Company Details </h4>
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
                                <select class="form-control  @error('profile_job_work_sbu') is-invalid @enderror profile_job_work_sbu" name="profile_job_work_sbu" required style="width: 400px" >
                                    <option value="{{$work->profile_job_work_sbu}}">{{ DB::table('subsidiaries')->where('subsidiaries_id',$work->profile_job_work_sbu)->value('subsidiaries_name') }}</option>

                                    @foreach ($data['subsidiaries'] as $subsidiaries)
                                    <option value="{{$subsidiaries->subsidiaries_id}}">{{$subsidiaries->subsidiaries_name}}</option>
                                    @endforeach

                                </select>
                                @error('profile_job_work_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            </div>


                            <div class="col-sm-5">
                                <div class="form-group">
                                <label for="email">Designation:</label></br>
                                <select class="custom-select  @error('profile_job_work_designation') is-invalid @enderror profile_job_work_designation" name="profile_job_work_designation" required style="width: 400px">
                                    <option value="{{$work->profile_job_work_designation}}">{{ DB::table('designations')->where('designations_id',$work->profile_job_work_designation)->value('designations_name') }}</option>
                                    @foreach ($data['designations'] as $designations)
                                    <option value="{{$designations->designations_id}}">{{$designations->designations_name}}</option>
                                    @endforeach
                                </select>
                                @error('profile_job_work_designation')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            </div>

                          </div>



                      <div class="row">

                        <div class="col-sm-5">
                          <div class="form-group">
                          <label for="email">Department:</label></br>
                          <select class="custom-select  @error('profile_job_work_department') is-invalid @enderror profile_job_work_department" name="profile_job_work_department" required  style="width: 400px">
                              <option value="{{$work->profile_job_work_department}}">{{ DB::table('departments')->where('department_id',$work->profile_job_work_department)->value('department_name') }}</option>
                              @foreach ($data['departments'] as $departments)
                              <option value="{{$departments->department_id}}">{{$departments->department_name}}</option>
                              @endforeach
                          </select>
                          @error('profile_job_work_department')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                      </div>



                          <div class="col-sm-5">
                              <div class="form-group">
                              <label for="email">Job Description:</label>
                              <select class="custom-select  @error('profile_job_work_jd') is-invalid @enderror profile_job_work_jd" name="profile_job_work_jd" required style="width: 400px">
                                  <option value="{{$work->profile_job_work_jd}}">{{ DB::table('job_descriptions')->where('job_descriptions_id',$work->profile_job_work_jd)->value('job_descriptions_name') }}</option>
                                  @foreach ($data['job_descriptions'] as $job_descriptions)
                                  <option value="{{$job_descriptions->job_descriptions_id}}">{{$job_descriptions->job_descriptions_name}}</option>
                                  @endforeach
                              </select>
                              @error('profile_job_work_jd')<div class="text-danger">{{ $message }}</div> @enderror
                          </div>
                          </div>

                      </div>


                      <div class="row ">
                          <div class="col-sm-5">
                              <div class="form-group">
                              <label for="email">Office Location:</label>
                              <select class="custom-select  @error('profile_job_work_office_location') is-invalid @enderror profile_job_work_office_location" name="profile_job_work_office_location" required style="width: 400px">
                                  <option value="{{$work->profile_job_work_office_location}}">{{ DB::table('office_locations')->where('office_locations_id',$work->profile_job_work_office_location)->value('office_locations_name') }}</option>
                                  @foreach ($data['office_locations'] as $office_locations)
                                  <option value="{{$office_locations->office_locations_id}}">{{$office_locations->office_locations_name}}</option>
                                  @endforeach

                              </select>
                              @error('profile_job_work_office_location')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                          </div>


                          <div class="col-sm-5 ">
                            <div class="form-group">
                            <label for="email">Joined Date:</label></br>
                           <input type="date" name="profile_job_work_join_date" class="form-control  @error('profile_job_work_join_date') is-invalid @enderror" value="{{$work->profile_job_work_join_date}}" required>
                           @error('profile_job_work_join_date')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>

                      </div>

                      <div class="row">
                          <div class="col-sm-3">
                              <div class="form-group">
                              <label for="email">EPF Number:</label>
                              <input type="text" class="form-control  @error('profile_job_work_epf_number') is-invalid @enderror" placeholder="EPF Number" id="email" name="profile_job_work_epf_number" value="{{$work->profile_job_work_epf_number}}" required >
                              @error('profile_job_work_epf_number')<div class="text-danger">{{ $message }}</div> @enderror
                          </div>
                          </div>

                          <div class="col-sm-3">

                              <div class="form-group">
                                  <label for="email"> Reporting Manager:</label>
                                  <select class="custom-select  @error('profile_job_work_head_of_sbu') is-invalid @enderror    profile_job_work_head_of_sbu" name="profile_job_work_head_of_sbu" style="width: 400px">
                                      <option value="{{$work->profile_job_work_head_of_sbu}}">{{ DB::table('profiles')->where('profile_id',$work->profile_job_work_head_of_sbu)->value('profile_Full_name') }}</option>

                                      @foreach ($data['sbu_head'] as $sbu_head)
                                      <option value="{{$sbu_head->profile_id}}">{{$sbu_head->profile_Full_name}}</option>
                                      @endforeach
                                  </select>
                                  @error('profile_job_work_head_of_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                          </div>





                      </div>

                      <div class="row">
                        <div class="col-sm-4">

                            <div class="form-group ">
                                <label for="email">Head Of SBU:</label>
                                <select  class="custom-select  @error('profile_head_of_departmrnt_this_account') is-invalid @enderror" name="profile_head_of_departmrnt_this_account" value="{{ old('profile_head_of_departmrnt_this_account') }}" required>
                                    <option value="{{$work->profile_head_of_departmrnt_this_account	}}">{{$work->profile_head_of_departmrnt_this_account	}}</option>
                                    <option value="ON">ON</option>
                                    <option value="NO">NO</option>
                                </select>
                                @error('profile_head_of_departmrnt_this_account')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                          </div>

                      </div>

                      <div class="row">

                              <div class="col-sm-3">
                                  <div class="form-group">
                                  <label for="email">Email Address:</label>
                                  <input type="email" name="profile_job_work_email" class="form-control  @error('profile_job_work_email') is-invalid @enderror" value="{{$work->profile_job_work_email}}"   placeholder="Email">
                                  @error('profile_job_work_email')<div class="text-danger">{{ $message }}</div> @enderror

                                </div>
                          </div>

                              <div class="col-sm-3">
                                  <div class="form-group">
                                  <label for="email">Mobile Number:</label>
                                  <input type="tel" name="profile_job_work_mobile" class="form-control  @error('profile_job_work_mobile') is-invalid @enderror" value="{{$work->profile_job_work_mobile}}" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                  @error('profile_job_work_mobile')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                          </div>
                      </div>

                      <div class="row">
                              <div class="col-sm-3">
                                  <div class="form-group">
                                  <label for="email">Profile Status:</label>
                                  <select  class="custom-select  @error('profile_job_work_status') is-invalid @enderror" name="profile_job_work_status" value="{{ old('profile_job_work_status') }}" required>
                                      <option value="{{$work->profile_job_work_status}}">{{$work->profile_job_work_status}}</option>
                                      <option value="Active">Active</option>
                                      <option value="Stopped">Stopped</option>
                                  </select>
                                  @error('profile_job_work_status')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                          </div>

                          <div class="col">
                            <div class="form-group">
                                  <label for="email">Reason:</label>
                                   <input type="tel" name="profile_job_work_status_reson" class="form-control  @error('profile_job_work_status_reson') is-invalid @enderror" value="{{$work->profile_job_work_status_reson}}"  required >
                                  @error('profile_job_work_status')<div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                          </div>
                      </div>


                      <div class="row">
                        <div class="col mt-3">
                         Last Edited  : {{$work->job_work_last_update_by}}  /  {{$work->job_work_last_update_date}}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col mb-3">
                         Created  : {{$work->job_work_profile_crate_by}}  /  {{$work->job_work_profile_crate_date}}
                        </div>
                      </div>

                      <input type="hidden" value="{{$work->job_working_profile_id}}" name="job_working_profile_id">
                      <input type="hidden" value="{{$work->profile_job_join_profile_id}}" name="profile_job_join_profile_id">
                      <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                      <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">

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



            <div class="mt-3 badge-secondary shadow-lg p-2 mb-1 bg-white rounded text-center text-capitalize"><h4 class="text-bold text-capitalize text-info">Last Worked Commpany Details</h4></div>
            <hr class="text-success"></hr>





            <table class="table table-hover mb-5">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>EPF No</th>
                    <th>Company Name</th>
                    <th>Joined Date</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Reporting Manager</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ( $data['lastworkscompani'] as $keywork=>$Workstop)
                  <tr>
                    <td>  {{$keywork +1}}</td>
                    <td> {{$Workstop->profile_job_work_epf_number}}</td>
                    <td>  {{$Workstop->subsidiaries_name}}</td>
                    <td>  {{$Workstop->profile_job_work_join_date}}</td>
                    <td>  {{$Workstop->department_name}}</td>
                    <td>  {{$Workstop->designations_name}}</td>
                    <td>{{ProfileController::reportingManager($Workstop->profile_job_work_head_of_sbu)}}</td>

                    <td>
                        @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))

                        <i class="bi bi-pencil-square text-success" style="font-size: 1.5rem;" data-toggle="modal" data-target="#editWorkcompani{{$Workstop->job_working_profile_id}}"></i>
                      <!-----
                        <button type="button" class="btn btn-success  mb-3" class="btn btn-primary" data-toggle="modal" data-target="#editWorkcompani{{$Workstop->job_working_profile_id}}">Edit  {{$Workstop->subsidiaries_name}} Details</button></td>
                       !------->
                        @endif
                    </tr>


                  <div class="modal fade" id="editWorkcompani{{$Workstop->job_working_profile_id}}">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Edit Working Company Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="/jobworkupdate" method="post">
                                    @csrf


                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                        <label for="email">Subsidiaries:</label></br>
                                        <select class="custom-select  @error('profile_job_work_sbu') is-invalid @enderror profile_job_work_sbu" name="profile_job_work_sbu" required style="width: 400px">
                                            <option value="{{$Workstop->profile_job_work_sbu}}">{{ DB::table('subsidiaries')->where('subsidiaries_id',$Workstop->profile_job_work_sbu)->value('subsidiaries_name') }}</option>

                                            @foreach ($data['subsidiaries'] as $subsidiaries)
                                            <option value="{{$subsidiaries->subsidiaries_id}}">{{$subsidiaries->subsidiaries_name}}</option>
                                            @endforeach

                                        </select>
                                        @error('profile_job_work_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                        <label for="email">Designation:</label></br>
                                        <select class="custom-select  @error('profile_job_work_designation') is-invalid @enderror profile_job_work_designation" name="profile_job_work_designation" required style="width: 400px">
                                            <option value="{{$Workstop->profile_job_work_designation}}">{{ DB::table('designations')->where('designations_id',$Workstop->profile_job_work_designation)->value('designations_name') }}</option>
                                            @foreach ($data['designations'] as $designations)
                                            <option value="{{$designations->designations_id}}">{{$designations->designations_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('profile_job_work_designation')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                        <label for="email">Department:</label></br>
                                        <select class="custom-select  @error('profile_job_work_department') is-invalid @enderror profile_job_work_department" name="profile_job_work_department" required style="width: 400px">
                                            <option value="{{$Workstop->profile_job_work_department}}">{{ DB::table('departments')->where('department_id',$Workstop->profile_job_work_department)->value('department_name') }}</option>
                                            @foreach ($data['departments'] as $departments)
                                            <option value="{{$departments->department_id}}">{{$departments->department_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('profile_job_work_department')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    </div>

                                    <div class="col-sm-5">
                                      <div class="form-group">
                                      <label for="email">Joined Date:</label>
                                     <input type="date" name="profile_job_work_join_date" class="form-control  @error('profile_job_work_join_date') is-invalid @enderror" value="{{$Workstop->profile_job_work_join_date}}" required>
                                     @error('profile_job_work_join_date')<div class="text-danger">{{ $message }}</div> @enderror
                                  </div>
                                  </div>
                                </div>


                                <div class="row">


                                    <div class="col-sm-5">
                                        <div class="form-group">
                                        <label for="email">Job Description:</label></br>
                                        <select class="custom-select  @error('profile_job_work_jd') is-invalid @enderror profile_job_work_jd" name="profile_job_work_jd" required style="width: 400px">
                                            <option value="{{$Workstop->profile_job_work_jd}}">{{ DB::table('job_descriptions')->where('job_descriptions_id',$Workstop->profile_job_work_jd)->value('job_descriptions_name') }}</option>
                                            @foreach ($data['job_descriptions'] as $job_descriptions)
                                            <option value="{{$job_descriptions->job_descriptions_id}}">{{$job_descriptions->job_descriptions_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('profile_job_work_jd')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    </div>


                                    <div class="col-sm-5">
                                      <div class="form-group">
                                      <label for="email">Office Location:</label></br>
                                      <select class="custom-select  @error('profile_job_work_office_location') is-invalid @enderror  profile_job_work_office_location" name="profile_job_work_office_location" required style="width: 400px">
                                          <option value="{{$Workstop->profile_job_work_office_location}}">{{ DB::table('office_locations')->where('office_locations_id',$Workstop->profile_job_work_office_location)->value('office_locations_name') }}</option>
                                          @foreach ($data['office_locations'] as $office_locations)
                                          <option value="{{$office_locations->office_locations_id}}">{{$office_locations->office_locations_name}}</option>
                                          @endforeach

                                      </select>
                                      @error('profile_job_work_office_location')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                  </div>

                                </div>




                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                        <label for="email">EPF Number:</label>
                                        <input type="text" class="form-control  @error('profile_job_work_epf_number') is-invalid @enderror" placeholder="EPF Number" id="email" name="profile_job_work_epf_number" value="{{$Workstop->profile_job_work_epf_number}}" required >
                                        @error('profile_job_work_epf_number')<div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    </div>

                                    <div class="col-sm-5">

                                        <div class="form-group">
                                            <label for="email">Head Of Business:</label></br>
                                            <select class="custom-select  @error('profile_job_work_head_of_sbu') is-invalid @enderror profile_job_work_head_of_sbu" name="profile_job_work_head_of_sbu" style="width: 400px">
                                                <option value="{{$Workstop->profile_job_work_head_of_sbu}}">{{ DB::table('profiles')->where('profile_id',$Workstop->profile_job_work_head_of_sbu)->value('profile_Full_name') }}</option>

                                                @foreach ($data['sbu_head'] as $sbu_head)
                                                <option value="{{$sbu_head->profile_id}}">{{$sbu_head->profile_Full_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('profile_job_work_head_of_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                                          </div>


                                        <div class="form-group">
                                        <label for="email">Head Of SBU:</label>
                                        <select  class="custom-select  @error('profile_head_of_departmrnt_this_account') is-invalid @enderror" name="profile_head_of_departmrnt_this_account" value="{{ old('profile_head_of_departmrnt_this_account') }}" required>
                                            <option value="{{$Workstop->profile_head_of_departmrnt_this_account	}}">{{$Workstop->profile_head_of_departmrnt_this_account	}}</option>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                        @error('profile_head_of_departmrnt_this_account')<div class="text-danger">{{ $message }}</div> @enderror
                                      </div>

                                    </div>



                                </div>

                                <div class="row">

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                            <label for="email">Email Address:</label>
                                            <input type="email" name="profile_job_work_email" class="form-control  @error('profile_job_work_email') is-invalid @enderror" value="{{$Workstop->profile_job_work_email}}"   placeholder="Email">
                                            @error('profile_job_work_email')<div class="text-danger">{{ $message }}</div> @enderror

                                          </div>
                                    </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                            <label for="email">Mobile Number:</label>
                                            <input type="tel" name="profile_job_work_mobile" class="form-control  @error('profile_job_work_mobile') is-invalid @enderror" value="{{$Workstop->profile_job_work_mobile}}" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                                            @error('profile_job_work_mobile')<div class="text-danger">{{ $message }}</div> @enderror
                                          </div>
                                    </div>
                                </div>

                                <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                            <label for="email">Profile Status:</label>
                                            <select  class="custom-select  @error('profile_job_work_status') is-invalid @enderror" name="profile_job_work_status" value="{{ old('profile_job_work_status') }}" required>
                                                <option value="{{$Workstop->profile_job_work_status}}">{{$Workstop->profile_job_work_status}}</option>
                                                <option value="Active">Active</option>
                                                <option value="Stopped">Stopped</option>
                                            </select>
                                            @error('profile_job_work_status')<div class="text-danger">{{ $message }}</div> @enderror
                                          </div>
                                    </div>

                                    <div class="col">
                                      <div class="form-group">
                                            <label for="email">Reason:</label>
                                             <input type="tel" name="profile_job_work_status_reson" class="form-control  @error('profile_job_work_status_reson') is-invalid @enderror" value="{{$Workstop->profile_job_work_status_reson}}"  required >
                                            @error('profile_job_work_status')<div class="text-danger">{{ $message }}</div> @enderror
                                          </div>
                                    </div>
                                </div>


                                <div class="row">
                                  <div class="col mt-3">
                                   Last Edited: {{$Workstop->job_work_last_update_by}}  /  {{$Workstop->job_work_last_update_date}}
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col mb-3">
                                   Created : {{$Workstop->job_work_profile_crate_by}}  /  {{$Workstop->job_work_profile_crate_date}}
                                  </div>
                                </div>

                                <input type="hidden" value="{{$Workstop->job_working_profile_id}}" name="job_working_profile_id">
                                <input type="hidden" value="{{$Workstop->profile_job_join_profile_id}}" name="profile_job_join_profile_id">
                                <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                                <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">

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




            <!-- End  working compani details    -!---------->

        </div>

        <!--- end job working Details !----->




<!---- start account details !----------->
@if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
        <div class="tab-pane fade" id="Account-Details" role="tabpanel" aria-labelledby="Account-Details-tab">


    <div class="row mt-3 mb-2">
      <div class="row mb-3">
        <div class="col">
            <button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal" data-target="#newbankdetails">  <i class="bi bi-plus" style=""> New Account</i></button>

        <!-------  <i class="bi  bi-file-earmark-plus text-success" style="font-size: 1rem; color:" data-toggle="modal" data-target="#newbankdetails"> New Account</i> ----!---->
      </div>



  <table class="table table-hover mt-2">
    <thead>
      <tr>
        <th>Bank Name</th>
        <th>Branch</th>
        <th>Account Number</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>



        @foreach ( $data['accountdetails'] as $account_details)


      <tr>
        <td>{{ $account_details->account_bank_name}}</td>
        <td>{{ $account_details->account_bank_branch}}</td>
        <td>{{ $account_details->account_bank_number}}</td>
        <td>{{ $account_details->account_status}}</td>
        <td>
            <i class="bi bi-pencil-square text-success" style="font-size: 1.5rem;" data-toggle="modal" data-target="#updatebankdetails{{ $account_details->account_id}}"></i>

         <!--   <button type="button" class="btn btn-success"  >Edit</button></td>!---->
      </tr>



      <!-- Account details upddate !-------->
   <div class="modal fade" id="updatebankdetails{{ $account_details->account_id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Account Details:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/update_bank_account" method="post">
                @csrf


            <div class="row">

                    <div class="col">
                        <div class="form-group">
                          <label for="email">Bank Name:</label>
                           <input type="tel" name="account_bank_name" class="form-control  @error('account_bank_name') is-invalid @enderror" value="{{ $account_details->account_bank_name}}"  required >
                          @error('account_bank_name')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                          <label for="email">Branch Name:</label>
                           <input type="tel" name="account_bank_branch" class="form-control  @error('account_bank_branch') is-invalid @enderror" value="{{ $account_details->account_bank_branch}}"  required >
                          @error('account_bank_branch')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Account Number:</label>
                       <input type="tel" name="account_bank_number" class="form-control  @error('account_bank_number') is-invalid @enderror" value="{{ $account_details->account_bank_number}}"  required >
                      @error('account_bank_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Reason:</label>
                       <input type="tel" name="account_reson_to_ad" class="form-control  @error('account_reson_to_ad') is-invalid @enderror" value="{{ $account_details->account_reson_to_ad}}"  required >
                      @error('account_reson_to_ad')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Updated Reason:</label>
                       <input type="tel" name="account_reson_to_update" class="form-control  @error('account_reson_to_update') is-invalid @enderror" value="{{ $account_details->account_reson_to_update}}"  required >
                      @error('account_reson_to_update')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                      <label for="email">Account Status:</label>
                      <select  name="account_status" class="custom-select @error('account_reson_to_update') is-invalid @enderror" required>
                        <option>{{ $account_details->account_status}}</option>
                        <option>Active</option>
                        <option>Deactive</option>

                      </select>

                      @error('account_status')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col mt-3">
                 Last Edited : {{$account_details->account_update_by}}  /  {{$account_details->account_update_date}}
                </div>
              </div>

              <div class="row">
                <div class="col mb-3">
                 Created : {{$account_details->account_add_by}}  /  {{$account_details->account_add_date}}
                </div>
              </div>


            <input type="hidden" value="{{$account_details->account_id}}" name="account_id">
            <input type="hidden" value="{{$profile[0]->profile_id}}" name="account_profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
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



        </div>
 @endif
<!---- end account details !----------->
      </div>

    
 </div>


<!---- start salary Details !----------->
@if(!empty(Auth::user()->hrAdmin) )
 <div class="tab-pane fade" id="Salary-Details" role="tabpanel" aria-labelledby="Salary-Details-tab">
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
            <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp;{{AllowanceController::allowance($profile[0]->profile_id),2}}</td>
            <td><i class="fa fa-list fa-2x text-success"  aria-hidden="true"  data-toggle="modal" data-target="#allowanceDetails"></i></td>
            <td><i class="fa fa-plus-circle fa-2x text-success" aria-hidden="true"  data-toggle="modal" data-target="#addtoAllowances"></i></td>
          </tr>
          <tr>
            <td>Increment Details</td>
            <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp;{{IncresmentController::increment($profile[0]->profile_id),2}} </td>
            <td><i class="fa fa-list fa-2x text-success" aria-hidden="true" aria-hidden="true"  data-toggle="modal" data-target="#incresmentDetails"></i></td>
            <td><i class="fa fa-plus-circle fa-2x text-success" data-toggle="modal" data-target="#newbincresment"></i></td>
          </tr>

          <tr>
            <td>Bonus</td>
            <td>{{env('APP_CURRENCY')}}&nbsp;&nbsp;{{BonusController::bonace($profile[0]->profile_id),2}}</td>
            <td> <i class="fa fa-list fa-2x text-success" aria-hidden="true" data-toggle="modal" data-target="#bonaceDetails"></i></td>
            <td><i class="fa fa-plus-circle fa-2x text-success"></i></td>
          </tr>
        </tbody>
      </table>




 <div>








    <!-- Bonas details Model -->
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


  </div>

</div>






<div class="tab-pane fade" id="leave-details" role="tabpanel" aria-labelledby="leave-details">



    <div class="row mb-3 mt-3">
    <div class="col-sm-3">
     @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
      <button type="button" class="btn btn-success col"  data-toggle="modal" data-target="#newleavesetup"><i class="bi bi-file-earmark-plus ">&nbsp;  Add New Leave Setup</i></button>
      @endif
    </div>

    <div class="col-sm-3">
    @if(Auth::user()->name = $profile[0]->profile_id  && !empty($profile[0]->profile_id))
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
          <h4 class="modal-title">Leave Requst</h4>
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
                    <div class="col">
                      <div class="form-group">
                        <label for="pwd">Slect Leave Catogury:</label>
                          <select class="custom-select @error('leave_requsts_user_leave_setups_rule_id') is-invalid @enderror"  required name="leave_requsts_user_leave_setups_rule_id">
                            @foreach ( $data['setup_leave_view'] as $leave_rule_view)
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
                                 {{ProfileController::reportingManagerList($profile[0]->profile_id)}}
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
        <th>Authorize Leave</th>
        <th>Total Leave Setup</th>
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
        <td><button type="button" class="btn btn-success col"  data-toggle="modal" data-target="#leaveRuleView{{$leave_rule_view->user_leave_setups_id}}">Edit</button></td>
        <td>{{$leave_rule_view->employee_enrolment_types_name}}/{{$leave_rule_view->leave_types_name}}/{{$leave_rule_view->enrolment_leave_date_calculation}}/{{$leave_rule_view->enrolment_leave_total}} Valid {{$leave_rule_view->user_leave_setups_start_date}} to {{$leave_rule_view->user_leave_setups_end_date}}</td>
        <td>N/D</td>
        <td>N/D</td>
        <td>N/D</td>
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
</div>
<!----- end leave !-------->


<!--traning and devlopment !---------->

<div class="Training-development fade " id="Training-development" role="tabpanel" aria-labelledby="Training-development-tab">
<h3>works</h3>
</div>



<!------- evulution !---->

<div class="Performance-eveluation fade " id="Performance-eveluation" role="tabpanel" aria-labelledby="Performance-eveluation-tab">
    <h3>Performance-eveluation works</h3>
</div>




<!-------- document !----------->

<div class="tab-pane fade " id="documents" role="tabpanel" aria-labelledby="documents-tab">

    @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
    <button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal" data-target="#uplodedocument">  <i class="bi bi-cloud-arrow-up-fill" style=""> &nbsp;Uplode Document</i></button>
    @endif

    <?php
         $document =   DB::table('document_controlls')->select('*')
        ->where('profile_id','=',$profile[0]->profile_id)
        ->get();
    ?>


    <table class="table table-hover mt-4">
        <thead>
          <tr>
            <th>#</th>
            <th>Document Name</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($document  as $ketDocument =>$document )
            <tr>
                <td>{{$ketDocument + 1}}</td>
                <td>{{$document->document_controlls_pdf_name}}</td>
                <td>
                    <i class="bi bi-filetype-pdf text-success" style="font-size: 1.5rem" data-toggle="modal" data-target="#viewdocument{{$document->document_controlls_id}}" title="View PDF"></i>
                    @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
                    <i class="bi bi-trash3 text-danger" style="font-size: 1.5rem" data-toggle="modal" data-target="#removedocument{{$document->document_controlls_id}}"></i>
                    @endif
                  </td>
            </tr>






                   <!-- removedocument -->
    <div class="modal fade" id="removedocument{{$document->document_controlls_id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Do You Want to Remove  ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="/delet_document" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$document->document_controlls_pdf_name}}" name="document_controlls_pdf_name">
                    <input type="hidden" value="{{$document->document_controlls_id}}" name="document_controlls_id">
                    <input type="hidden" value="{{$document->document_uplode_types_id}}" name="document_uplode_types_id">
                    <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                    <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                    <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                    <input type="hidden" value="{{$document->document_controlls_pdf_name}}" name="document_types_name">
                    <div class="row">
                        <button type="submit" class="btn btn-success col-sm-1 ml-2">Yes </button>
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





    <!-- viewdocument -->
    <div class="modal fade" id="viewdocument{{$document->document_controlls_id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Document View</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
               <iframe src="/document_storage/{{$document->document_controlls_pdf_name}}"  class="col" height="800px">
               </iframe>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


                </td>
                <td>
                </td>
              </tr>






            @endforeach




        </tbody>
    </table>





    <!--- uploade document !---------->

              <!-- The Modal -->
              <div class="modal fade" id="uplodedocument">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Uplode Documents</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="/uplode_document" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="form-group">
                              <label for="email">File (PDF Only):</label>
                              <input type="file" class="form-control" placeholder="Document" id="email" name="file" required>
                            </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                  <label for="email">Document Name</label>
                                  <input type="text" class="form-control" placeholder="Document" id="email" name="document_types_id" required>
                                </div>
                                </div>






                            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                            <div class="row">
                                <button type="submit" class="btn btn-success col-sm-1 ml-2">Save</button>

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


</div>



@if(!empty(Auth::user()->hrAdmin))
<div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">


    <?php
   $user_permition_details=  DB::table('users')
      ->select('*')
      ->where('profile_id','=',$profile[0]->profile_id)
      ->get();
?>

@if(!$user_permition_details->isEmpty())
@else
<div class="row mb-1 mt-1">
    <div class="col-sm-3">

        <button type="button" class="btn btn-success mb-5 " class="btn btn-primary" data-toggle="modal" data-target="#accountcrate">  <i class="bi bi-plus" style=""> Account crate</i></button>
      <!---  <i class="bi bi-file-earmark-plus text-success" style="font-size: 2rem;" data-toggle="modal" data-target="#accountcrate" title="New Account crate"></i> !---->
        </div>
  </div>
@endif

  @foreach ($user_permition_details as $user_permition)




<div class="col-sm-6 mt-5">
  <div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">HR Admin: </label>
           <input type="checkbox" class="form-check-input ml-2 @error('hrAdmin') is-invalid @enderror" name="hrAdmin" @if(!empty($user_permition->hrAdmin)) checked  @endif>
          </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">Subsidiaries HR : </label>
           <input type="checkbox" class="form-check-input ml-2 @error('hr') is-invalid @enderror" name="hr"  @if(!empty($user_permition->hr)) checked  @endif>
          </div>
    </div>


    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">Profile Owner: </label>
           <input type="checkbox" class="form-check-input ml-2 @error('profileUser') is-invalid @enderror" name="profileUser"  @if(!empty($user_permition->profileUser)) checked  @endif>
          </div>
    </div>

</div>



<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">IT Admin: </label>
           <input type="checkbox" class="form-check-input ml-2 @error('pcAdmin') is-invalid @enderror" name="pcAdmin"   @if(!empty($user_permition->pcAdmin)) checked  @endif>
          </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">Leave Approval: </label>
           <input type="checkbox" class="form-check-input ml-2 @error('leveApprovalUser') is-invalid @enderror" name="leveApprovalUser"  @if(!empty($user_permition->leveApprovalUser)) checked  @endif>
          </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">Report View: </label>
           <input type="checkbox" class="form-check-input ml-2 @error('reportView') is-invalid @enderror" name="reportView"   @if(!empty($user_permition->reportView)) checked  @endif>
          </div>
    </div>
</div>


<div class="row">

    <div class="col">
        <div class="form-group">
            <label for="email" class="form-check-label">Subsidiaries Head: </label>
           <input type="checkbox" class="form-check-input ml-2 @error('sbuhead') is-invalid @enderror" name="sbuhead"   @if(!empty($user_permition->sbuhead)) checked  @endif>
          </div>
    </div>
</div>
</div>


<div class="row mb-3">
    <div class="col-sm-1">
        <button type="button" class="btn  col"  data-toggle="modal" data-target="#editaccount"><i class="bi bi-pencil-square text-success" style="font-size: 1.5rem;"></i></button>
    </div>
    <div class="col-sm-1">
        <button type="button" class="btn col"  data-toggle="modal" data-target="#deletaccount"><i class="bi bi-trash3 text-danger" style="font-size: 1.5rem;"></i></button></div>
  </div>


  <div class="row mb-3">

        </div>


 <!-- Delet Account !-------->
 <div class="modal fade" id="deletaccount">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delet Account :</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/deletaccount" method="post">
                @csrf


            <input type="hidden" value="{{ $user_permition->id}}" name="id">
            <input type="hidden" value="{{ $profile[0]->profile_call_name}}" name="profile_call_name">
            <input type="hidden" value="{{ $profile[0]->profile_email}}" name="email">
            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
            <button type="submit" class="btn btn-success">Yes I need to delet this.</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>









 <!-- Add to new leave setup !-------->
 <div class="modal fade" id="editaccount">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Account :</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/editaccount" method="post">
                @csrf


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">HR Admin: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('hrAdmin') is-invalid @enderror" name="hrAdmin" @if(!empty($user_permition->hrAdmin)) checked  @endif>
                          </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Subsidiaries HR : </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('hr') is-invalid @enderror" name="hr" @if(!empty($user_permition->hr)) checked  @endif>
                          </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Profile Owner: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('profileUser') is-invalid @enderror" name="profileUser" @if(!empty($user_permition->profileUser)) checked  @endif>
                          </div>
                    </div>

                </div>



                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">IT Admin: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('pcAdmin') is-invalid @enderror" name="pcAdmin" @if(!empty($user_permition->pcAdmin)) checked  @endif>
                          </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Leave Approval: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('leveApprovalUser') is-invalid @enderror" name="leveApprovalUser" @if(!empty($user_permition->leveApprovalUser)) checked  @endif>
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Report View: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('reportView') is-invalid @enderror" name="reportView" @if(!empty($user_permition->reportView)) checked  @endif>
                          </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Subsidiaries Head: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('sbuhead') is-invalid @enderror" name="sbuhead" @if(!empty($user_permition->sbuhead)) checked  @endif>
                          </div>
                    </div>
                </div>

            <input type="hidden" value="{{ $user_permition->id}}" name="id">
            <input type="hidden" value="{{ $profile[0]->profile_call_name}}" name="profile_call_name">
            <input type="hidden" value="{{ $profile[0]->profile_email}}" name="email">
            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
            <button type="submit" class="btn btn-success">Update Account</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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


@endif


</div>

@if(!empty(Auth::user()->hrAdmin))
<div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">

<div class="mt-1 mb-1" >
    <button type="button" class="btn btn-success mb-5 mt-1" class="btn btn-primary" data-toggle="modal" data-target="#newNote">  <i class="bi bi-plus" style="">New Note</i></button>

</div>




@foreach ($data['profileNotes'] as $profileNotes)

<div class="card">
    <div class="card-header">
        {{$profileNotes->new_titel}}
    </div>
    <div class="card-body">
      <blockquote class="blockquote mb-0">
        <p>{{$profileNotes->new_note}}</p>
        <footer class="blockquote-footer">{{$profileNotes->note_by}}<cite title="Source Title">&nbsp; &nbsp; {{$profileNotes->note_date}}</cite></footer>
      </blockquote>
    </div>
  </div>



@endforeach

</div>

@endif

@if(!empty(Auth::user()->hrAdmin))
<div class="tab-pane fade " id="status" role="tabpanel" aria-labelledby="status-tab">





        @if ($profile[0]->profile_status=='Active')
        <h1 class="text-success mt-5 ml-5"> {{$profile[0]->profile_status}}</h1>
        @else
        <h1 class="text-danger  mt-5  ml-5"> {{$profile[0]->profile_status}}</h1>
        @endif



</div>
@endif



 </div>
</div>


</div>
 @endif
<!---- end salary Details !----------->

<!--- strart  leave !--------->


<!--- end leave !--------->
</div>
</section>








<!-- new bank details -!------>


   <!-- Account details ad !-------->
   <div class="modal fade" id="newbankdetails">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New Account Details:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/new_bank_account" method="post">
                @csrf


            <div class="row">

                    <div class="col">
                        <div class="form-group">
                          <label for="email">Bank Name:</label>
                           <input type="tel" name="account_bank_name" class="form-control  @error('account_bank_name') is-invalid @enderror" value=""  required >
                          @error('account_bank_name')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                          <label for="email">Branch Name:</label>
                           <input type="tel" name="account_bank_branch" class="form-control  @error('account_bank_branch') is-invalid @enderror" value=""  required >
                          @error('account_bank_branch')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Account Number:</label>
                       <input type="tel" name="account_bank_number" class="form-control  @error('account_bank_number') is-invalid @enderror" value=""  required >
                      @error('account_bank_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                      <label for="email">Reason For Adding:</label>
                       <input type="tel" name="account_reson_to_ad" class="form-control  @error('account_reson_to_ad') is-invalid @enderror" value=""  required >
                      @error('>account_reson_to_ad')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <input type="hidden" value="{{$profile[0]->profile_id}}" name="account_profile_id">
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







<!-- Display the countdown timer in an element -->


@if (!empty($profile[0]->profile_job_work_date_of_resignation))

<script>
document.getElementById("timeofwork").value = "EXPIRED";
  /*
  var countDownDate = new Date({{$profile[0]->profile_job_join_date}});
  var x = setInterval(function() {
    var now = new Date({{$profile[0]->profile_job_work_date_of_resignation}});
    var distance =  countDownDate-now  ;
    var years =Math.floor(distance / (1000 * 60 * 60 * 24))/(1000 * 24);
    var days = Math.floor(distance / (1000 * 60 * 60 * 24))/(1000 );
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("timeofwork").value =Math.round(years)+ " Year "+ Math.round(days) + " Date " ;
    if (distance > 0) {
      clearInterval(x);
      document.getElementById("timeofwork").value = "EXPIRED";
    }
  }, 1000);
  */
  </script>

@else

<script>
  /*
  var countDownDate = new Date({{$profile[0]->profile_job_join_date}}).getTime();
  var x = setInterval(function() {
    var now = new Date().getTime();
    var distance =  now-countDownDate  ;
    var years =Math.floor(distance / (1000 * 60 * 60 * 24))/(1000 * 24);
    var days = Math.floor(distance / (1000 * 60 * 60 * 24))/(1000 );
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("timeofwork").value =Math.round(years)+ " Year "+ Math.round(days) + " Date " ;
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("timeofwork").value = "EXPIRED";
    }
  }, 1000);
  */
  </script>

@endif








<!-------- pop up !------------->

<!-- The Modal -->
<div class="modal fade " id="newNote">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Note</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <form action="/new-notes-addd" method="POST">
          @csrf
          <div class="form-group">
            <label for="email">Titel:</label>
            <input type="text" class="form-control"  id="email" name="new_titel" required>
          </div>
          <div class="form-group">
            <label for="pwd">Note:</label>
            <textarea class="form-control" name="new_note" required></textarea>
          </div>


            <input type="hidden" value="{{$profile[0]->profile_id}}" name="account_profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">

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

 <!-- Add to new leave setup !-------->
 <div class="modal fade" id="accountcrate">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Account :</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">

            <form action="/newaccount" method="post">
                @csrf


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">HR Admin: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('hrAdmin') is-invalid @enderror" name="hrAdmin">
                          </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Subsidiaries HR : </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('hr') is-invalid @enderror" name="hr">
                          </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Profile Owner: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('profileUser') is-invalid @enderror" name="profileUser">
                          </div>
                    </div>

                </div>



                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">IT Admin: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('pcAdmin') is-invalid @enderror" name="pcAdmin">
                          </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Leave Approval: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('leveApprovalUser') is-invalid @enderror" name="leveApprovalUser">
                          </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Report View: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('reportView') is-invalid @enderror" name="reportView">
                          </div>
                    </div>

                </div>


                <div class="row">



                    <div class="col">
                        <div class="form-group">
                            <label for="email" class="form-check-label">Subsidiaries Head: </label>
                           <input type="checkbox" class="form-check-input ml-2 @error('sbuhead') is-invalid @enderror" name="sbuhead" >
                          </div>
                    </div>

                </div>


            <input type="hidden" value="{{ $profile[0]->profile_call_name}}" name="profile_call_name">
            <input type="hidden" value="{{ $profile[0]->profile_email}}" name="email">
            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
            <input type="hidden" value="{{$profile[0]->subsidiaries_logo}}" name="subsidiaries_logo">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
            <button type="submit" class="btn btn-success">Crate A Account</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </form>

        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
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




<!-- Job Description view !-------->

<div class="modal fade" id="jd">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Job Description:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
          @if (!empty($profile[0]->profile_job_work_jd))

          <iframe src="/jds_uplode/{{ DB::table('job_descriptions')->where('job_descriptions_id',$profile[0]->profile_job_join_jd)->value('job_descriptions_note') }}" class="col" height="800px">
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


    <!-- Job Description view !-------->
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
          <iframe src="/jds_uplode/{{ DB::table('job_descriptions')->where('job_descriptions_id',$profile[0]->profile_job_work_jd)->value('job_descriptions_note') }}" class="col" height="800px">
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



<!-- Add to Salary !-------->
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
                   <input type="text" name="salary_reson" class="form-control  @error('salary_reson') is-invalid @enderror" value=""  required >
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




<script type="text/javascript">
/*
let date_2 = new Date({{$profile[0]->profile_job_join_date}});
let date_1 = new Date();

const days = (date_1, date_2) =>{
    let difference = date_1.getTime() - date_2.getTime();
    let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
    return TotalDays;
}

console.log(days(date_1, date_2) +" days to world cup");

document.getElementById("timeofwork").value=days(date_1, date_2)/365;

/*
  function calculate_age(dob) {
    var diff_ms = Date.now() - dob.getTime({{date('d-m-Y', strtotime($profile[0]->profile_job_join_date))}});
    var age_dt = new Date(diff_ms);
    return Math.abs(age_dt.getUTCFullYear() - {{date('Y', strtotime($profile[0]->profile_job_join_date))}});
}
 document.getElementById("timeofwork").value = calculate_age(new Date({{date('Y-m-d', strtotime($profile[0]->profile_job_join_date))}}))+' Year';
*/
</script>

<!--- end period of worked calculation !---->

    <!-- age calculation !-------->
    <script type="text/javascript">
      function calculate_age(dob) {
        var diff_ms = Date.now() - dob.getTime({{date('d-m-Y', strtotime($profile[0]->profile_bith_day))}});
        var age_dt = new Date(diff_ms);
        return Math.abs(age_dt.getUTCFullYear() - {{date('Y', strtotime($profile[0]->profile_bith_day))}});
    }
     document.getElementById("result").value = calculate_age(new Date({{date('Y-m-d', strtotime($profile[0]->profile_bith_day))}}))+' Year';

    </script>
<!-- age calculation !-------->

    </section>
    @endforeach




<style>

    hr { background-color: red; height: 2px; border: 0; }


 .profile-pic-wrapper {
  height: 100%;
  width: 100%;
  position: relative;
  display: flex;

 /* justify-content: center;*/
  align-items: left;
}
.pic-holder {
  text-align: center;
  position: relative;
  border-radius: 50%;
  width: 400px;
  height: 400px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
}

.pic-holder .pic {
  height: 400px;
  width: 400px;
  -o-object-fit: cover;
  object-fit: cover;
  -o-object-position: center;
  object-position: center;
}

.pic-holder .upload-file-block,
.pic-holder .upload-loader {
  position: absolute;
  top: 0;
  left: 0;
  height: 400px;
  width: 400px;
  background-color: rgba(90, 92, 105, 0.7);
  color: #f8f9fc;
  font-size: 12px;
  font-weight: 600;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.pic-holder .upload-file-block {
  cursor: pointer;
}

.pic-holder:hover .upload-file-block,
.uploadProfileInput:focus ~ .upload-file-block {
  opacity: 1;
}

.pic-holder.uploadInProgress .upload-file-block {
  display: none;
}

.pic-holder.uploadInProgress .upload-loader {
  opacity: 1;
}

/* Snackbar css */
.snackbar {
  visibility: hidden;
  min-width: 250px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 14px;
  transform: translateX(-50%);
}

.snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {
    bottom: 0;
    opacity: 0;
  }
  to {
    bottom: 30px;
    opacity: 1;
  }
}

@keyframes fadein {
  from {
    bottom: 0;
    opacity: 0;
  }
  to {
    bottom: 30px;
    opacity: 1;
  }
}

@-webkit-keyframes fadeout {
  from {
    bottom: 30px;
    opacity: 1;
  }
  to {
    bottom: 0;
    opacity: 0;
  }
}

@keyframes fadeout {
  from {
    bottom: 30px;
    opacity: 1;
  }
  to {
    bottom: 0;
    opacity: 0;
  }
}

</style>

<script>
    $(document).on("change", ".uploadProfileInput", function () {
  var triggerInput = this;
  var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
  var holder = $(this).closest(".pic-holder");
  var wrapper = $(this).closest(".profile-pic-wrapper");
  $(wrapper).find('[role="alert"]').remove();
  triggerInput.blur();
  var files = !!this.files ? this.files : [];
  if (!files.length || !window.FileReader) {
    return;
  }
  if (/^image/.test(files[0].type)) {
    // only image file
    var reader = new FileReader(); // instance of the FileReader
    reader.readAsDataURL(files[0]); // read the local file

    reader.onloadend = function () {
      $(holder).addClass("uploadInProgress");
      $(holder).find(".pic").attr("src", this.result);
      $(holder).append(
        '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
      );

      // Dummy timeout; call API or AJAX below
      setTimeout(() => {
        $(holder).removeClass("uploadInProgress");
        $(holder).find(".upload-loader").remove();
        // If upload successful
        if (Math.random() < 0.9) {
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
          );

          // Clear input after upload
          $(triggerInput).val("");

          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        } else {
          $(holder).find(".pic").attr("src", currentImg);
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
          );

          // Clear input after upload
          $(triggerInput).val("");
          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        }
      }, 1500);
    };
  } else {
    $(wrapper).append(
      '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
    );
    setTimeout(() => {
      $(wrapper).find('role="alert"').remove();
    }, 3000);
  }
});


</script>



<style>
    .alert {
      padding: 20px;
      background-color: green;
      color: white;
    }

    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }
    </style>



<!---------- profile image !------------>
<style>
    .container {
      position: relative;
      width: 100%;

    }

    .image {
      opacity: 1;
      display: block;
      width: 100%;
      height: auto;
      transition: .5s ease;
      backface-visibility: hidden;
      border-radius:15%  20% 40% 10% ;
      box-shadow: rgba(136, 243, 150, 0.25) 0px 14px 28px, rgba(0, 0, 0, 0.22) 0px 10px 10px;
    }

    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      text-align: center;
    }

    .container:hover .image {
      opacity: 0.3;
    }

    .container:hover .middle {
      opacity: 1;
    }

    .text2 {
      background-color: #dfdfdf00;
      color: white;
      font-size: 16px;
      padding: 16px 32px;
      margin-top: 10px;
      border-radius:15%  20% 40% 10% ;
    }

    .text {
      background-color: #6ff786b0;
      color: white;
      font-size: 16px;
      padding: 16px 32px;

      border-radius:15%  20% 40% 10% ;
    }

    </style>




<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

@include('sweetalert::alert')
