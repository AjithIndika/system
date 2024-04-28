<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;
?>

@foreach ($data['profile'] as $profile)
    <div class="main-body">
        <div class="row">
            <div class="col-lg-3 ">
                <div class="card position-fixed col-sm-2">
                    <div class="card-body ">
                        <div class="d-flex flex-column align-items-center text-center ">

                            <img src="@if (!empty($profile[0]->profile_image)) /profile-image/{{ $profile[0]->profile_image }} @else /sbu_logo/{{ $profile[0]->subsidiaries_logo }} @endif"
                                alt="Admin" class="rounded-circle p-1 bg-primary mt-2" width="110">


                            @if (empty($profile[0]->profile_image))
                                @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
                                    <button type="button" class="btn imageload" data-toggle="modal"
                                        data-target="#ProfileImage" style="margin-top:5px">
                                        <i class="bi bi-cloud-upload"></i>
                                    </button>
                                @endif
                            @endif

                            @if (!empty($profile[0]->profile_image))
                                @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
                                    <button type="button" class="btn " data-toggle="modal"
                                        data-target="#ProfileImage" style="margin-top:5px">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                @endif
                            @endif


                            <div class="mt-5">
                                <h4>{{ $profile[0]->profile_first_name }} {{ $profile[0]->profile_last_name }}</h4>
                                @foreach ($data['workingJobportal'] as $work)
                                    <p class="text-secondary mb-1">
                                        {{ DB::table('subsidiaries')->where('subsidiaries_id', $work->profile_job_work_sbu)->value('subsidiaries_name') }}
                                    </p>
                                    <p class="text-secondary mb-1">
                                        {{ DB::table('job_descriptions')->where('job_descriptions_id', $work->profile_job_work_jd)->value('job_descriptions_name') }}
                                    </p>

                                    <p class="text-secondary mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                            fill="currentColor" class="bi bi-phone-vibrate" viewBox="0 0 16 16"
                                            id="IconChangeColor">
                                            <path
                                                d="M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z"
                                                id="mainIconPathAttribute" fill="green" stroke="#00ff2a"
                                                stroke-width="0.2"></path>
                                            <path
                                                d="M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM1.599 4.058a.5.5 0 0 1 .208.676A6.967 6.967 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A7.968 7.968 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208zm12.802 0a.5.5 0 0 1 .676.208A7.967 7.967 0 0 1 16 8a7.967 7.967 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A6.967 6.967 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676zM3.057 5.534a.5.5 0 0 1 .284.648A4.986 4.986 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A5.986 5.986 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284zm9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8c0 .769-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8c0-.642-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648z"
                                                id="mainIconPathAttribute" fill="green" stroke="#00ff2a"></path>
                                        </svg>
                                        {{ DB::table('job_working')->where('profile_id', $profile[0]->profile_id)->value('profile_job_work_mobile') }}
                                    </p>

                                    <hr>
                                @endforeach
                                <p class="text-muted font-size-sm">
                                    {!! html_entity_decode(nl2br($profile[0]->profile_permant_address)) !!}</p>

                                <!---------
                                            @if (empty($profile[0]->profile_image))
@if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
<button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#ProfileImage">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
@endif
@endif

                                            @if (!empty($profile[0]->profile_image))
@if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
<button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#ProfileImage">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
@endif
@endif

            !------------->


                            </div>
                        </div>
                        <hr class="my-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        fill="currentColor" class="bi bi-phone-vibrate" viewBox="0 0 16 16"
                                        id="IconChangeColor">
                                        <path
                                            d="M10 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4zM6 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z"
                                            id="mainIconPathAttribute" fill="green" stroke="#00ff2a"
                                            stroke-width="0.2"></path>
                                        <path
                                            d="M8 12a1 1 0 1 0 0-2 1 1 0 0 0 0 2zM1.599 4.058a.5.5 0 0 1 .208.676A6.967 6.967 0 0 0 1 8c0 1.18.292 2.292.807 3.266a.5.5 0 0 1-.884.468A7.968 7.968 0 0 1 0 8c0-1.347.334-2.619.923-3.734a.5.5 0 0 1 .676-.208zm12.802 0a.5.5 0 0 1 .676.208A7.967 7.967 0 0 1 16 8a7.967 7.967 0 0 1-.923 3.734.5.5 0 0 1-.884-.468A6.967 6.967 0 0 0 15 8c0-1.18-.292-2.292-.807-3.266a.5.5 0 0 1 .208-.676zM3.057 5.534a.5.5 0 0 1 .284.648A4.986 4.986 0 0 0 3 8c0 .642.12 1.255.34 1.818a.5.5 0 1 1-.93.364A5.986 5.986 0 0 1 2 8c0-.769.145-1.505.41-2.182a.5.5 0 0 1 .647-.284zm9.886 0a.5.5 0 0 1 .648.284C13.855 6.495 14 7.231 14 8c0 .769-.145 1.505-.41 2.182a.5.5 0 0 1-.93-.364C12.88 9.255 13 8.642 13 8c0-.642-.12-1.255-.34-1.818a.5.5 0 0 1 .283-.648z"
                                            id="mainIconPathAttribute" fill="green" stroke="#00ff2a"></path>
                                    </svg>

                                </h6>
                                <span class="text-secondary">{{ $profile[0]->profile_mobile_number }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                        fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16"
                                        id="IconChangeColor">
                                        <path
                                            d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z"
                                            id="mainIconPathAttribute" stroke-width="0.2" stroke="#1eff00"
                                            fill="green"></path>
                                    </svg>
                                </h6>
                                <span class="text-secondary">{{ $profile[0]->profile_email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                        fill="currentColor" class="bi bi-activity" viewBox="0 0 16 16"
                                        id="IconChangeColor">
                                        <path fill-rule="evenodd"
                                            d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"
                                            id="mainIconPathAttribute" fill="green" stroke="#00ff11"
                                            stroke-width="0.1"></path>
                                    </svg>
                                </h6>
                                <span class="text-secondary">{{ $profile[0]->profile_number }}</span>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body bg-white">

                        <ul class="nav nav-tabs">


                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" title="Personal information">Personal information</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu12" title="Education">Education</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu13" title="Work Experience">Work Experience</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu7" title="Documents">Documents</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1"
                                    title="Training and development">T & D</a>
                            </li>








                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu3" title="JOB">JOB</a>
                            </li>


                            @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
<!--- Bank Details !-------->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu4">Bank Details</a>
                            </li>
<!--- Bank !---->
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu6" title="Leave">Leave</a>
                            </li>


                            @if (!empty(Auth::user()->hrAdmin))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2" title="Performance eveluation">Performance evaluation </a>
                                </li>
                            @endif








                            <!---  Salary Details !--->
                            @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
<li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu5">Salary</a>
                                </li>
@endif







                            @if (!empty(Auth::user()->hrAdmin))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu8" title="Login">Login</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu9" title="Notes">Notes</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu11" title="Device & Support Ticket">Device & Support Ticket</a>
                            </li>


                            @if (!empty(Auth::user()->hrAdmin))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu14" title="On Board">On Board</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu15" title="Off Board">Off Board</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu10" title="Status">Status</a>
                            </li>



                        </ul>

                        <div>
                            @include('profile/profileImage')

                        </div>

                        <div class="card">
                            <div class="card-body bg-white">
                                <div class="tab-content col-sm-12">
                                    <div id="home" class="container tab-pane  active">
                                        @include('profile/personaldetails')
                                    </div>
                                    <!--- Personal !---------->
                                    <div id="menu1" class="container tab-pane fade col-sm-12">
                                        @include('profile/trainingDevelopment')
                                    </div>
                                    <!--- Training and development !---------->
                                    <div id="menu2" class="container tab-pane fade"> Performance eveluation </div>
                                    <!--- Performance eveluation !---------->
                                    <div id="menu3" class="container tab-pane fade col-sm-12">
                                        @include('profile/workingCompany')</div>
                                    <!--- Working Company !---------->
                                    <div id="menu4" class="container tab-pane fade col-sm-12">
                                        @include('profile/bankdetails')</div><!--- >Bank !---------->
                                    <div id="menu5" class="container tab-pane fade col-sm-12">
                                        @include('profile/salary')</div><!--- Salary !---------->
                                    <div id="menu6" class="container tab-pane fade col-sm-12">
                                        @include('profile/leave')</div><!--- Leave !---------->
                                    <div id="menu7" class="container tab-pane fade col-sm-12">
                                        @include('profile/document')</div><!--- Documents !---------->
                                    <div id="menu8" class="container tab-pane fade col-sm-12">
                                        @include('profile/login') </div><!--- Login !---------->
                                    <div id="menu9" class="container tab-pane fade col-sm-12">
                                        @include('profile/note') </div><!--- Notes !---------->
                                    <div id="menu10" class="container tab-pane fade col-sm-12">
                                        @include('profile/status')</div><!--- Status !---------->

                                    <div id="menu11" class="container tab-pane fade col-sm-12">
                                        @include('profile/equpment')</div>

                                    <div id="menu12" class="container tab-pane fade col-sm-12">
                                        @include('profile/education')</div>

                                    <div id="menu13" class="container tab-pane fade col-sm-12">
                                        @include('profile/work_experience')</div>

                                    <div id="menu14" class="container tab-pane fade col-sm-12">
                                        @include('profile/onbord')</div>

                                    <div id="menu15" class="container tab-pane fade col-sm-12">
                                        @include('profile/offbord')
                                    </div>




                                </div>




                            </div>



                        </div>

                        <!---- equpment !-------->






                    </div>







                </div>
            </div>
        </div>





        <style>
            .imageload:hover {
                background: #10d33a;
            }

            body {
                background: #f7f7ff;
                margin-top: 20px;
            }

            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid transparent;
                border-radius: .25rem;
                margin-bottom: 1.5rem;
                box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
            }

            .me-2 {
                margin-right: .5rem !important;
            }
        </style>





        <script>
            $(document).ready(function() {
                $('.offbord_tasks_profile_id').select2();
            });


            $(document).ready(function() {
                $('.ticket_equpment_types').select2();
            });



            $(document).ready(function() {
                $('.ticket_organization').select2();
            });


            $(document).ready(function() {
                $('.ticket_issues_id').select2();
            });



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

            $(document).ready(function() {
                $('.recovery_person_id').select2();
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
                let date_2 = new Date({{ $profile[0]->profile_job_join_date }});
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
                  var diff_ms = Date.now() - dob.getTime({{ date('d-m-Y', strtotime($profile[0]->profile_job_join_date)) }});
                  var age_dt = new Date(diff_ms);
                  return Math.abs(age_dt.getUTCFullYear() - {{ date('Y', strtotime($profile[0]->profile_job_join_date)) }});
                }
                document.getElementById("timeofwork").value = calculate_age(new Date({{ date('Y-m-d', strtotime($profile[0]->profile_job_join_date)) }}))+' Year';
                */
        </script>

        <!--- end period of worked calculation !---->

        <!-- age calculation !-------->
        <script type="text/javascript">
            function calculate_age(dob) {
                var diff_ms = Date.now() - dob.getTime({{ date('d-m-Y', strtotime($profile[0]->profile_bith_day)) }});
                var age_dt = new Date(diff_ms);
                return Math.abs(age_dt.getUTCFullYear() - {{ date('Y', strtotime($profile[0]->profile_bith_day)) }});
            }
            document.getElementById("result").value = calculate_age(new Date(
                {{ date('Y-m-d', strtotime($profile[0]->profile_bith_day)) }})) + ' Year';
        </script>
        <!-- age calculation !-------->

        </section>
@endforeach




<style>
    a {
        text-decoration: none;
    }

    hr {
        background-color: red;
        height: 2px;
        border: 0;
    }


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
    .uploadProfileInput:focus~.upload-file-block {
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
    $(document).on("change", ".uploadProfileInput", function() {
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

            reader.onloadend = function() {
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
        border-radius: 15% 20% 40% 10%;
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
        border-radius: 15% 20% 40% 10%;
    }

    .text {
        background-color: #6ff786b0;
        color: white;
        font-size: 16px;
        padding: 16px 32px;

        border-radius: 15% 20% 40% 10%;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
