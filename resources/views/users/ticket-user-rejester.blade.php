@include('../template/header')



<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
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
    </script>




<header>

    <!-- Background image -->
    <div
      class="p-5 text-center bg-image"
      style="
        background-image: url('https://mdbcdn.b-cdn.net/img/new/slides/041.webp');
        height: 400px;
      "
    >
      <div class="mask" style="background-color: rgba(0, 0, 0, 0.678);">
        <div class="d-flex justify-content-center align-items-center h-100">
          <div class="text-white">
            <h1 class="mb-3">Asset Networks</h1>
            <h4 class="mb-3">Support Ticket System</h4>
            <a data-mdb-ripple-init class="btn btn-outline-light btn-lg" href="htps://hr.assetnetworks.net" role="button"
            >Call to action</a
            >
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>

  <script>
    // Initialization for ES Users
import { Collapse, Ripple, initMDB } from "mdb-ui-kit";
initMDB({ Collapse, Ripple });
  </script>


<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            @if($errors->any())
            <div class="alert alert-danger col-sm-6 row h-100 justify-content-center align-items-center">
            {!! implode('', $errors->all(':message </br>')) !!}
            </div>
            @endif




                <form action="/savenewuser" method="post">

                    @csrf

                    <div class="mt-3"><h4>Personal Details</h4></div>

                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                        <label for="email">Full Name:</label>
                        <input type="text" class="form-control  @error('profile_Full_name') is-invalid @enderror @error('profile_sug') is-invalid @enderror  " placeholder="Full Name" id="email" name="profile_Full_name" value="{{ old('profile_Full_name') }}" required>
                        @error('profile_Full_nam')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col">
                        <div class="form-group">
                        <label for="email">First Name:</label>
                        <input type="text" class="form-control  @error('profile_first_name') is-invalid @enderror" placeholder="First Name" id="email" name="profile_first_name" value="{{ old('profile_first_name') }}" required>
                        @error('profile_first_name')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                        <label for="email">Last Name :</label>
                        <input type="text" class="form-control  @error('profile_last_name') is-invalid @enderror" placeholder="Last Name" id="email" name="profile_last_name" value="{{ old('profile_last_name') }}" required>
                        @error('profile_last_name')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                </div>




                <div class="row">



                    <div class="col-sm-2">
                        <div class="form-group">
                        <label for="email">Religion:</label>
                        <select  class="custom-select  @error('religion_id') is-invalid @enderror" name="religion_id" value="{{ old('religion_id') }}" required>
                            @foreach ($data['religions'] as $religions)
                            <option value="{{$religions->religion_id}}">{{$religions->religion_name}}</option>
                            @endforeach
                        </select>
                        @error('religion_id')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Living Province:</label>
                        <select  class="custom-select  @error('profile_living_province') is-invalid @enderror" name="profile_living_province" value="{{ old('profile_living_province') }}" required>
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

                    <div class="col-sm-2">
                        <div class="form-group">
                        <label for="email">Gender:</label>
                        <select  class="custom-select  @error('profile_gender') is-invalid @enderror" name="profile_gender" value="{{ old('profile_gender') }}" required>
                            <option>Female</option>
                            <option>Male</option>
                        </select>
                        @error('profile_gender')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>


                    <div class="col-sm-2">
                        <div class="form-group">
                        <label for="email">Marital Status:</label>
                        <select  class="custom-select  @error('profile_marital_status') is-invalid @enderror" name="profile_marital_status" value="{{ old('profile_marital_status') }}" required>
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
                        <input type="text" class="form-control  @error('profile_nic') is-invalid @enderror" placeholder="Nic" id="email" name="profile_nic" value="{{ old('profile_nic') }}" required>
                        @error('profile_nic')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>




                </div>

                <div class="row">
                    <div class="col-sm-3">

                            <div class="form-group">
                            <label for="email">Birth Day:</label>
                            <input type="date" class="form-control  @error('profile_bith_day') is-invalid @enderror" placeholder="Birth Day" id="email" name="profile_bith_day" value="{{ old('profile_bith_day') }}" required>
                            @error('profile_bith_day')<div class="text-danger">{{ $message }}</div> @enderror

                        </div>
                    </div>
                    <div> <hr/></div>
                </div>





                <div class="mt-3"><h4>Contact Details</h4></div>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Personal Mobile Number:</label>
                        <input type="tel" class="form-control  @error('profile_mobile_number') is-invalid @enderror" placeholder="0760000000" id="email" name="profile_mobile_number" value="{{ old('profile_mobile_number') }}" required maxlength="10">
                        @error('profile_mobile_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for="email">Personal Email address:</label>
                        <input type="email" class="form-control  @error('profile_email') is-invalid @enderror" placeholder="Email address" id="email" name="profile_email"  value="{{ old('profile_email') }}">
                        @error('profile_email')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>
                </div>





                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="email">Permant address:</label>
                        <textarea class="form-control  ckeditor @error('profile_permant_address') is-invalid @enderror" name="profile_permant_address" required rows="5" cols="3" id="myInput" onkeyup="getInputValue();">{{ old('profile_permant_address') }}</textarea>
                        @error('profile_permant_address')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                        <label for="email">Current address:</label>
                        <textarea class="form-control ckeditor  @error('profile_current_address') is-invalid @enderror" name="profile_current_address" required rows="5" cols="3" id="destinationTextField">{{ old('profile_current_address') }}</textarea>
                        @error('profile_current_address')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                    <script>
                        function getInputValue(){
                            // Selecting the input element and get its value
                            var inputVal = document.getElementById("myInput").value;

                            // Displaying the value
                            alert(inputVal);
                        }
                    </script>


                    <div> <hr/></div>
                </div>


                <div class="mt-3"><h4>Emergency Contact Details</h4></div>
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Emergency Contact Person Name:</label>
                        <input type="tel" class="form-control  @error('profile_emergency_contact_person_name') is-invalid @enderror"  id="email" name="profile_emergency_contact_person_name" value="{{ old('profile_emergency_contact_person_name') }}" required maxlength="100">
                        @error('profile_emergency_contact_person_name')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Relationship:</label>
                        <input type="tel" class="form-control  @error('profile_relationship') is-invalid @enderror"  id="email" name="profile_relationship" value="{{ old('profile_relationship') }}" required maxlength="100">
                        @error('profile_relationship')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Emergency mobile number:</label>
                        <input type="tel" class="form-control  @error('profile_emergency_mobile_number') is-invalid @enderror"  id="email" name="profile_emergency_mobile_number" value="{{ old('profile_emergency_mobile_number') }}" required maxlength="10">
                        @error('profile_emergency_mobile_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                </div>


                <div class="mt-3"><h4>Joined company details</h4><hr class="bg-success"></hr></div>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                        <label for="email">Organization</label>
                        <select class="custom-select  @error('profile_job_join_sbu') is-invalid @enderror profile_job_join_sbu"  name="profile_job_join_sbu"  onchange="showUser(this.value)" required>
                            <option value="">Your Organization</option>
                            @foreach ($data['subsidiaries'] as $subsidiaries)
                            <option value="{{$subsidiaries->subsidiaries_id}}">{{$subsidiaries->subsidiaries_name}}</option>
                            @endforeach

                        </select>
                        @error('profile_job_join_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>








                </div>

<div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                        <label for="email">Designation:</label>
                        <select class="custom-select  @error('profile_job_join_designation') is-invalid @enderror profile_job_join_designation" name="profile_job_join_designation" required>
                            <option value="">Your Designation</option>
                            @foreach ($data['designations'] as $designations)
                            <option value="{{$designations->designations_id}}">{{$designations->designations_name}}</option>
                            @endforeach
                        </select>
                        @error('profile_job_join_designation')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Department:</label>
                        <select class="custom-select  @error('profile_job_join_department') is-invalid @enderror profile_job_join_department" name="profile_job_join_department" required>
                            <option value="">Your Department</option>
                            @foreach ($data['departments'] as $departments)
                            <option value="{{$departments->department_id}}">{{$departments->department_name}}</option>
                            @endforeach
                        </select>
                        @error('profile_job_join_department')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                </div>



                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Join Date:</label>
                       <input type="date" name="profile_job_join_date" class="form-control  @error('profile_job_join_date') is-invalid @enderror" value="{{ old('profile_job_join_date') }}" required>
                       @error('profile_job_join_date')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Job Description:</label>
                        <select class="custom-select  @error('profile_job_join_jd') is-invalid @enderror  profile_job_join_jd h-4" name="profile_job_join_jd" required >
                            <option value="">Your Job Description</option>
                            @foreach ($data['job_descriptions'] as $job_descriptions)
                            <option value="{{$job_descriptions->job_descriptions_id}}">{{$job_descriptions->job_descriptions_name}}</option>
                            @endforeach
                        </select>
                        @error('profile_job_join_jd')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>



                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Office Location:</label>
                        <select class="custom-select  @error('profile_job_join_office_location') is-invalid @enderror profile_job_join_office_location" name="profile_job_join_office_location" required>
                            <option value="">Your Office Location</option>
                            @foreach ($data['office_locations'] as $office_locations)
                            <option value="{{$office_locations->office_locations_id}}">{{$office_locations->office_locations_name}}</option>
                            @endforeach

                        </select>
                        @error('profile_job_join_office_location')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Reporting Manager:</label>
                        <select class="custom-select  @error('profile_job_join_head_of_sbu') is-invalid @enderror profile_job_join_head_of_sbu" name="profile_job_join_head_of_sbu" >
                            <option value="">Your Reporting Manager</option>

                            @foreach ($data['sbu_head'] as $sbu_head)
                            <option value="{{$sbu_head->profile_id}}">{{$sbu_head->profile_Full_name}}</option>
                            @endforeach
                        </select>
                        @error('profile_job_join_head_of_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Employee index Number:</label>
                        <input type="text" class="form-control  @error('profile_job_join_epf_number') is-invalid @enderror" placeholder="Employee index Number" id="email" name="profile_job_join_epf_number" value="{{ old('profile_job_join_epf_number') }}"  >
                        @error('profile_job_join_epf_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">EPF Number:</label>
                        <input type="text" class="form-control  @error('profile_job_join_epf_number') is-invalid @enderror" placeholder="EPF Number" id="email" name="profile_job_join_epf_number" value="{{ old('profile_job_join_epf_number') }}"  >
                        @error('profile_job_join_epf_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>





                    <!---
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Basic Salary:</label>
                        <input type="titel" name="profile_job_join_basic_salary" class="form-control  @error('profile_job_join_basic_salary') is-invalid @enderror" value="{{ old('profile_job_join_basic_salary') }}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                        @error('profile_job_join_basic_salary')<div class="text-danger">{{ $message }}</div> @enderror

                      </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Allowances:</label>
                        <input type="titel" name="allowances_salary" class="form-control  @error('allowances_salary') is-invalid @enderror" value="{{ old('allowances_salary') }}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                        @error('allowances_salary')<div class="text-danger">{{ $message }}</div> @enderror

                      </div>
                    </div>

                      !----------------->
                </div>

                <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="email">company Email:</label>
                            <input type="email" name="profile_job_join_email" class="form-control  @error('profile_job_join_email') is-invalid @enderror" value="{{ old('profile_job_join_email') }}"   placeholder="Email">
                            @error('profile_job_join_email')<div class="text-danger">{{ $message }}</div> @enderror

                          </div>
                    </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="email">company Mobile Number:</label>
                            <input type="tel" name="profile_job_join_mobile" class="form-control  @error('profile_job_join_mobile') is-invalid @enderror" value="{{ old('profile_job_join_mobile') }}" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
                            @error('profile_job_join_mobile')<div class="text-danger">{{ $message }}</div> @enderror

                          </div>
                    </div>
                </div>




                <input type="submit" value="Save" class="btn btn-success">
                </form>



          </div>

        </div>
      </div><!-- End Recent Sales -->
    </section>





    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.profile_job_join_jd').select2();
        });

        $(document).ready(function() {
            $('.profile_job_join_head_of_sbu').select2();
        });

        $(document).ready(function() {
            $('.projctnames_id').select2();
        });



        $(document).ready(function() {
            $('.profile_job_join_office_location').select2();
        });

            $(document).ready(function() {
            $('.profile_job_join_department').select2();
        });


           $(document).ready(function() {
            $('.profile_job_join_designation').select2();
        });



           $(document).ready(function() {
            $('.profile_job_join_sbu').select2();
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


.cke_top{
    display: none !important;
}




    </style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });

    ClassicEditor
    .create( document.querySelector( '#ckeditor' ), {
        toolbar: [ 'undo', 'redo', 'bold', 'italic', 'numberedList', 'bulletedList' ]
    } )
    .catch( error => {
        console.log( error );
    } );
</script>





@include('../template/footer')
