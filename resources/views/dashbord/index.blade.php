<?php
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NewsAlertController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RepairReceiveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Carbon;

?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<!--- time grating !------->


<!--- time grating !------->


<section class="section dashboard">

    <div class="row">

        <div class="col ">

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <p id="imedemo" class="text-success mt-3"></p>
                    </div>
                    <h5 class="card-title">Have a nice day <em class="text-danger">{{ Auth::user()->name }}
                        </em><span>.....!</span></h5>


                    @foreach ($data['myprofile'] as $myprofile)
                        <div class="row">




                            <div class="col-sm-2">
                                <img src="/profile-image/{{ $myprofile->profile_image }}"
                                    class="rounded-circle shadow-4" style="width: 150px;"
                                    alt="{{ Auth::user()->name }}" />
                            </div>

                            <div class="col-sm-2">

                            </div>

                            <div class="col">
                                <div>


                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>




            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4>My Devices</h4>
                        <hr>
                        </hr>
                        <p id="imedemo" class="text-success mt-1"></p>
                    </div>


                    <div class="mb-3 ">




                        <i class="fa fa-ticket-o" aria-hidden="true" data-toggle="modal" data-target="#newTicket"> New
                            Ticket </i>


                        <svg width="30" data-toggle="modal" data-target="#newTicket" height="30"
                            viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" id="IconChangeColor">
                            <path
                                d="M34 30V28.989C34 27.3382 35.3382 26 36.989 26V26C38.6381 26 39.9756 27.3356 39.978 28.9847L39.99 37.1853C39.9955 40.9473 36.9473 44 33.1853 44H25.6472C21.2342 44 17.0822 41.9088 14.4552 38.363L10.19 32.6062C9.46968 31.6339 9.40592 30.3235 10.0285 29.2858V29.2858C11.0299 27.6168 13.3332 27.3332 14.7096 28.7096L16 30V16C16 14.3431 17.3431 13 19 13V13C20.6569 13 22 14.3431 22 16V27.875V21.0263C22 19.3549 23.3549 18 25.0263 18V18C26.6977 18 28.0526 19.3549 28.0526 21.0263V29V27.8987C28.0526 26.2564 29.384 24.925 31.0263 24.925V24.925C32.6686 24.925 34 26.2564 34 27.8987V30Z"
                                stroke="#00f028" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                id="mainIconPathAttribute" fill="#ffffff"></path>
                            <path d="M32 4V12" stroke="#00f028" stroke-width="1" stroke-linecap="round"
                                id="mainIconPathAttribute" fill="#ffffff"></path>
                            <path
                                d="M16 20H6V16C8 16 10 14.5 9.97403 12C9.94805 9.5 8 8 6 8V4H42V8C40 8 38.0519 9.5 38.026 12C38 14.5 40 16 42 16V20H28"
                                stroke="#00f028" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                                id="mainIconPathAttribute" fill="#ffffff"></path>
                        </svg>
                    </div>








                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Contolle Number</th>
                                <th>Equipment type</th>
                                <th>SN</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $equipments = DB::table('equipment_histories')
                                ->join('equipment', 'equipment.equipment_id', '=', 'equipment_histories.equipment_histories_equipment_number')
                                ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'equipment.equipment_type')
                                ->join('profiles', 'profiles.profile_id', '=', 'equipment_histories.equipment_user')
                                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
                                ->orderBy('equipment.equipment_number', 'asc')
                                ->where('equipment_histories.equipment_histories_status', '=', 1)
                                ->where('equipment_histories.equipment_user', '=', Auth::user()->profile_id)
                                ->get();
                            ?>


                            @foreach ($equipments as $key => $equipment)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td data-toggle="modal" data-target="#history{{ $equipment->equipment_id }}">
                                        {{ $equipment->equipment_number }}</td>
                                    <td>{{ $equipment->equpment_name }}</td>
                                    <td>{{ $equipment->equipment_asset_sn }}</td>
                                    <td></td>

                                    <td>





                                        <svg width="30" data-toggle="modal"
                                            data-target="#newTicket{{ $equipment->equipment_id }}" height="30"
                                            viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            id="IconChangeColor">
                                            <path
                                                d="M34 30V28.989C34 27.3382 35.3382 26 36.989 26V26C38.6381 26 39.9756 27.3356 39.978 28.9847L39.99 37.1853C39.9955 40.9473 36.9473 44 33.1853 44H25.6472C21.2342 44 17.0822 41.9088 14.4552 38.363L10.19 32.6062C9.46968 31.6339 9.40592 30.3235 10.0285 29.2858V29.2858C11.0299 27.6168 13.3332 27.3332 14.7096 28.7096L16 30V16C16 14.3431 17.3431 13 19 13V13C20.6569 13 22 14.3431 22 16V27.875V21.0263C22 19.3549 23.3549 18 25.0263 18V18C26.6977 18 28.0526 19.3549 28.0526 21.0263V29V27.8987C28.0526 26.2564 29.384 24.925 31.0263 24.925V24.925C32.6686 24.925 34 26.2564 34 27.8987V30Z"
                                                stroke="#00f028" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" id="mainIconPathAttribute" fill="#ffffff">
                                            </path>
                                            <path d="M32 4V12" stroke="#00f028" stroke-width="1" stroke-linecap="round"
                                                id="mainIconPathAttribute" fill="#ffffff"></path>
                                            <path
                                                d="M16 20H6V16C8 16 10 14.5 9.97403 12C9.94805 9.5 8 8 6 8V4H42V8C40 8 38.0519 9.5 38.026 12C38 14.5 40 16 42 16V20H28"
                                                stroke="#00f028" stroke-width="1" stroke-linecap="round"
                                                stroke-linejoin="round" id="mainIconPathAttribute" fill="#ffffff">
                                            </path>
                                        </svg>

                                        <svg data-toggle="modal" data-target="#myticket{{ $equipment->equipment_id }}"
                                            id="changeColor" fill="#DC7633" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="38"
                                            zoomAndPan="magnify" viewBox="0 0 375 374.9999" height="38"
                                            preserveAspectRatio="xMidYMid meet" version="1.0">
                                            <defs>
                                                <path id="pathAttribute"
                                                    d="M 33 37.5 L 342 37.5 L 342 345.75 L 33 345.75 Z M 33 37.5 ">
                                                </path>
                                                <path id="pathAttribute"
                                                    d="M 272 42 L 358.730469 42 L 358.730469 341 L 272 341 Z M 272 42 ">
                                                </path>
                                            </defs>
                                            <g>
                                                <path id="pathAttribute"
                                                    d="M 187.355469 329.726562 C 109.519531 329.726562 46.421875 266.585938 46.421875 188.703125 C 46.421875 110.816406 109.519531 47.675781 187.355469 47.675781 C 265.1875 47.675781 328.28125 110.816406 328.28125 188.703125 C 328.28125 266.585938 265.1875 329.726562 187.355469 329.726562 Z M 187.355469 37.46875 C 102.300781 37.46875 33.351562 106.460938 33.351562 191.574219 C 33.351562 276.683594 102.300781 345.675781 187.355469 345.675781 C 272.40625 345.675781 341.355469 276.683594 341.355469 191.574219 C 341.355469 106.460938 272.40625 37.46875 187.355469 37.46875 "
                                                    fill-opacity="1" fill-rule="nonzero"></path>
                                            </g>
                                            <path id="pathAttribute"
                                                d="M 26.582031 191.574219 C 26.582031 128.707031 56.914062 73.574219 102.472656 42.617188 C 50.828125 72.148438 16.019531 127.789062 16.019531 191.574219 C 16.019531 255.355469 50.828125 310.996094 102.472656 340.527344 C 56.914062 309.566406 26.582031 254.433594 26.582031 191.574219 "
                                                fill-opacity="1" fill-rule="nonzero"></path>
                                            <g>
                                                <path id="pathAttribute"
                                                    d="M 272.234375 42.617188 C 317.796875 73.574219 348.121094 128.707031 348.121094 191.574219 C 348.121094 254.433594 317.796875 309.566406 272.234375 340.527344 C 323.878906 310.996094 358.6875 255.355469 358.6875 191.574219 C 358.6875 127.789062 323.878906 72.148438 272.234375 42.617188 "
                                                    fill-opacity="1" fill-rule="nonzero"></path>
                                            </g>
                                            <g id="inner-icon" transform="translate(85, 75)"> <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-list-details" width="203"
                                                    height="203" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round" id="IconChangeColor">
                                                    <path stroke="#52f019" d="M0 0h24v24H0z" fill="#ffffff"
                                                        id="mainIconPathAttribute">
                                                    </path>
                                                    <path d="M13 5h8" id="mainIconPathAttribute" fill="#ffffff"
                                                        stroke="#52f019">
                                                    </path>
                                                    <path d="M13 9h5" id="mainIconPathAttribute" fill="#ffffff"
                                                        stroke="#52f019">
                                                    </path>
                                                    <path d="M13 15h8" id="mainIconPathAttribute" fill="#ffffff"
                                                        stroke="#52f019">
                                                    </path>
                                                    <path d="M13 19h5" id="mainIconPathAttribute" fill="#ffffff"
                                                        stroke="#52f019">
                                                    </path>
                                                    <rect x="3" y="4" width="6" height="6" rx="1">
                                                    </rect>
                                                    <rect x="3" y="14" width="6" height="6" rx="1">
                                                    </rect>
                                                </svg> </g>
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                    @foreach ($equipments as $key => $equipment)
                        <!-- new ticket !---->
                        <div class="modal fade" id="newTicket">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                    <!-- Modal Header !---->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Support Request Ticket</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body !---->
                                    <div class="modal-body">

                                        <div class="p-2  col">
                                            <div class="row col-sm-6 "><img class="mb-5"
                                                    src="{{ url('assets/img/Asset_network_banner.png') }}"></div>

                                            <form action="/ticketsave" method="POST">
                                                @csrf


                                                <input type="hidden" class="form-control "
                                                    value=" {{ ProfileController::profile_slug(Auth::user()->profile_id) }}"
                                                    id="email" name="profile_sug" readonly>
                                                <input type="hidden" class="form-control " value=""
                                                    id="email" name="equipment_id" readonly>
                                                <input type="hidden"
                                                    class="form-control @error('ticket_user_name') is-invalid @enderror"
                                                    value="{{ Auth::user()->name }}  {{ Auth::user()->name }}"
                                                    id="email" name="ticket_user_name" readonly>
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_profile_id" value="{{ Auth::user()->profile_id }}">
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_email"
                                                    value="@foreach ($data['workingJobportal'] as $work){{ $work->profile_job_work_email }} @endforeach">
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_phone_number"
                                                    value="{{ EquipmentController::workmobile_equ_org(Auth::user()->profile_id) }}">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="email">Organization:</label></br>
                                                            <select
                                                                class="custom-select  @error('ticket_organization')  is-invalid @enderror ticket_organization"
                                                                name="ticket_organization" required
                                                                style="width: 100%">
                                                                {{ ProfileController::workingCompanys(Auth::user()->profile_id) }}
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label for="email">Device:</label>
                                                            </br>
                                                            <select
                                                                class="custom-select  @error('ticket_equpment_types')  ticket_issues_id is-invalid @enderror ticket_equpment_types"
                                                                name="ticket_equpment_types" required
                                                                style="width: 100%">
                                                                @foreach ($data['equpment_types'] as $equpment_types)
                                                                    <option
                                                                        value="{{ $equpment_types->equpment_types_id }}">
                                                                        {{ $equpment_types->equpment_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <div class="form-group">



                                                            <label for="email">Issue:</label>
                                                            </br>
                                                            <select
                                                                class="custom-select  @error('ticket_issues_id') ticket_issues_id is-invalid @enderror ticket_issues_id"
                                                                name="ticket_issues_id" required style="width:100%">
                                                                @foreach ($data['issues'] as $issues)
                                                                    <option value="{{ $issues->issues_id }}">
                                                                        {{ $issues->issues_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="email">Problem Text (Describe Your Issue)
                                                                :</label>
                                                            <textarea class="ckeditor form-control @error('ticket_issues_note') is-invalid @enderror" name="ticket_issues_note"
                                                                required></textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit a
                                                    ticket</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal footer !---->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>





                        <div class="modal fade" id="newTicket{{ $equipment->equipment_id }}">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                    <!-- Modal Header !---->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Support Request Ticket</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body !---->
                                    <div class="modal-body">

                                        <div class="p-2  col">
                                            <div class="row col-sm-6 "><img class="mb-5"
                                                    src="{{ url('assets/img/Asset_network_banner.png') }}"></div>

                                            <form action="/ticketsave" method="POST">
                                                @csrf

                                                <input type="hidden" class="form-control "
                                                    value="{{ $equipment->equipment_type }}" id="email"
                                                    name="ticket_equpment_types" readonly>


                                                <input type="hidden" class="form-control "
                                                    value="{{ ProfileController::profile_slug(Auth::user()->profile_id) }}"
                                                    id="email" name="profile_sug" readonly>
                                                <input type="hidden" class="form-control "
                                                    value="{{ $equipment->equipment_id }}" id="email"
                                                    name="equipment_id" readonly>
                                                <input type="hidden"
                                                    class="form-control @error('ticket_user_name') is-invalid @enderror"
                                                    value="{{ Auth::user()->name }}  {{ Auth::user()->name }}"
                                                    id="email" name="ticket_user_name" readonly>
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_profile_id" value="{{ Auth::user()->profile_id }}">
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_email"
                                                    value="@foreach ($data['workingJobportal'] as $work){{ $work->profile_job_work_email }} @endforeach">
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_phone_number"
                                                    value="{{ EquipmentController::workmobile_equ_org(Auth::user()->profile_id) }}">
                                                <input type="hidden" class="form-control " id="email"
                                                    name="ticket_organization"
                                                    value="{{ DB::table('subsidiaries')->where('subsidiaries_id', $equipment->equipment_organization)->value('subsidiaries_id') }}">
                                                <div class="row ">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="email">Department:</label>
                                                            <select
                                                                class="custom-select  @error('ticket_organization')  ticket_issues_id is-invalid @enderror"
                                                                name="ticket_organization" required>
                                                                {{ ProfileController::workingCompanys(Auth::user()->profile_id) }}
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <div class="form-group">
                                                            <label for="email">Issue:</label>
                                                            <select
                                                                class="custom-select  @error('ticket_issues_id') ticket_issues_id is-invalid @enderror"
                                                                name="ticket_issues_id" required>
                                                                @foreach ($data['issues'] as $issues)
                                                                    <option value="{{ $issues->issues_id }}">
                                                                        {{ $issues->issues_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="email">Problem Text (Describe Your Issue)
                                                                :</label>
                                                            <textarea class="ckeditor form-control @error('ticket_issues_note') is-invalid @enderror" name="ticket_issues_note"
                                                                required></textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit a
                                                    ticket</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal footer !---->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>



                        <script>
                            $(document).ready(function() {
                                $('.ticket_issues_id').select2();
                            });
                        </script>


                        <!----- my ticket !-------------->



                        <!-- The Modal -->
                        <div class="modal fade" id="myticket{{ $equipment->equipment_id }}">
                            <div class="modal-dialog  modal-xl">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ $equipment->equipment_number }} Ticket Details</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">


                                        <table id="example" class="table table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ticket No</th>
                                                    <th>Post Date</th>
                                                    <th></th>
                                                    <th>Error</th>
                                                    <th>Status</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{ TicketsController::myticket(Auth::user()->profile_id, $equipment->equipment_id) }}

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ticket No</th>
                                                    <th>Post Date</th>
                                                    <th></th>
                                                    <th>Error</th>
                                                    <th>Status</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>






            @if (!empty(Auth::user()->pcAdmin))
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ticket<span>/This Month</span></h5>

                        <div id="reportsChart" class="col"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                new ApexCharts(document.querySelector("#reportsChart"), {
                                    series: [

                                        {
                                            name: 'Crate',
                                            data: {{ ReportAllController::daycountticket('Crate') }},

                                        },


                                        {
                                            name: 'View',
                                            data: {{ ReportAllController::daycountticket('View') }},

                                        },
                                        {
                                            name: 'Process',
                                            data: {{ ReportAllController::daycountticket('Process') }},

                                        },
                                        {
                                            name: 'Finish',
                                            data: {{ ReportAllController::daycountticketFinish() }},

                                        }

                                    ],
                                    chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false
                                        },
                                    },
                                    markers: {
                                        size: 4
                                    },
                                    colors: ['#f44336', '#2986cc', '#c90076', '#a6e712'],
                                    fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'smooth',
                                        width: 2
                                    },
                                    xaxis: {
                                        type: 'datetime',

                                        categories: {{ ReportAllController::thimonthdates() }}

                                    },
                                    tooltip: {
                                        x: {
                                            format: 'dd/MM/yy'
                                        },
                                    }
                                }).render();
                            });
                        </script>


                    </div>
                </div>
            @endif

        </div>

        <div class="col">




            <div class="card">
                <div class="card-body">

                    <h5 class="card-title">Today Birthdays</h5>

                    <div class="row ">
                        @foreach ($data['profile_birth_day_today'] as $profile_birth_day_today)
                            <div class="col">
                                <img src="@if (!empty($profile_birth_day_today->profile_image)) /profile-image/{{ $profile_birth_day_today->profile_image }} @endif"
                                    class="rounded-circle shadow-4 align-center" style="width: 150px;"
                                    class="border-0"
                                    title=" {{ $profile_birth_day_today->profile_first_name . ' ' . $profile_birth_day_today->profile_last_name }}" />

                            </div>
                        @endforeach
                    </div>

                </div>
            </div>


            <div class="card">
                <div class="card-body" id="birthday">
                    <h5 class="card-title">Upcoming Birthdays</h5>





                    <div class="row text-center">
                        @foreach ($data['Upcoming_profile_birth_day'] as $Upcoming_profile_birth_day)
                            @if (Carbon::today()->format('m-d') < Carbon::parse($Upcoming_profile_birth_day->profile_bith_day)->format('m-d'))
                                <div class="col text-center">
                                    <img title="{{ $Upcoming_profile_birth_day->profile_first_name . ' ' . $Upcoming_profile_birth_day->profile_last_name }} /{{ Carbon::parse($Upcoming_profile_birth_day->profile_bith_day)->format('m-d') }} "
                                        src="@if (!empty($Upcoming_profile_birth_day->profile_image)) /profile-image/{{ $Upcoming_profile_birth_day->profile_image }} @endif"
                                        class="rounded-circle shadow-4 align-center" style="width: 100px;"
                                        class="border-0"
                                        title=" {{ $Upcoming_profile_birth_day->profile_first_name . ' ' . $Upcoming_profile_birth_day->profile_last_name }} /  {{ Carbon::parse($Upcoming_profile_birth_day->profile_bith_day)->format('m-d') }}" />

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <style>
                h8 {
                    font-size: 80%;
                }
            </style>


            @if (!empty(Auth::user()->pcAdmin))
                <div class="card">


                    <div class="card-body pb-0">
                        <h5 class="card-title">Ticket <span>| Status {{ date('Y') }}</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [{
                                                value: {{ ReportAllController::contmonthicket('Crate') }},
                                                name: 'Crate'
                                            },
                                            {
                                                value: {{ ReportAllController::contmonthicket('View') }},
                                                name: 'View'
                                            },
                                            {
                                                value: {{ ReportAllController::contmonthicket('Process') }},
                                                name: 'Process'
                                            },
                                            {
                                                value: {{ ReportAllController::contmonthicket('Finish') }},
                                                name: 'Finish'
                                            },

                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div>
            @endif

        </div>

    </div>





    @if (!empty(Auth::user()->ticketupdate))
        <div class="card">
            <div class="card-body">

                <div class="row">


                    <div class="col-sm-6">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <h5 class="card-title">My<span> Jobs</span></h5>


                                </tr>


                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>

                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Ticket Number</th>
                                                    <th class="text-center">By</th>
                                                    <th class="text-center">Organization</th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($data['pendingtiketUser'] as $key => $pendingtiketUser)
                                                    @if ($pendingtiketUser->ticket_owner == Auth::user()->profile_id)
                                                        <tr class="">
                                                            <td class="text-center bg-info">{{ $key + 1 }}</td>
                                                            <td class=""><a
                                                                    href="/oneTicket/{{ $pendingtiketUser->tickets_number }}"
                                                                    target="_blank">{{ $pendingtiketUser->tickets_number }}
                                                                    &nbsp;&nbsp;
                                                                    {{ RepairReceiveController::reciveitems($pendingtiketUser->tickets_id) }}</a>
                                                            </td>
                                                            <td class="">
                                                                {{ $pendingtiketUser->ticket_user_name }}
                                                            </td>
                                                            <td class="">
                                                                {{ $pendingtiketUser->subsidiaries_name }}
                                                            </td>


                                                        </tr>
                                                    @else
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>

                                    </td>
                            </tbody>
                        </table>





                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <h5 class="card-title"> To Repair Receive<span>&nbsp; Pending </span></h5>


                                </tr>


                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>

                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Ticket Number</th>
                                                    <th class="text-center">View Device </th>
                                                    <th class="text-center">Service Center</th>
                                                    <th class="text-center"></th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($data['repirRecive'] as $key => $repirRecive)
                                                    <tr class="">
                                                        <td class="text-center bg-info">{{ $key + 1 }}</td>
                                                        <td class=""><a
                                                                href="/oneTicket/{{ $repirRecive->tickets_number }}"
                                                                target="_blank">{{ $repirRecive->tickets_number }}&nbsp;&nbsp;
                                                                {{ RepairReceiveController::reciveitems($repirRecive->tickets_id) }}
                                                            </a></td>
                                                        <td class="">
                                                            {{ RepairReceiveController::tdevicedetails($repirRecive->repair_receives_equpment_id) }}
                                                        </td>
                                                        <td class="">
                                                            {{ RepairReceiveController::servicecenterName($repirRecive->repair_receives_repircenter) }}
                                                        </td>
                                                        <td class="">

                                                            <i class="fa fa-pencil-square-o text-success"
                                                                aria-hidden="true" data-toggle="modal"
                                                                data-target="#repairRecive{{ $repirRecive->tickets_number }}">
                                                            </i>

                                                        </td>


                                                    </tr>




                                                    <!-- The Modal -->
                                                    <div class="modal fade"
                                                        id="repairRecive{{ $repirRecive->tickets_number }}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">
                                                                        {{ $repirRecive->tickets_number }} Did you
                                                                        receive the mentioned item? </h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <form method="post"
                                                                        action="/repierReciveRepierCenter">
                                                                        @csrf


                                                                        <div class="form-group">
                                                                            <label for="email">What's the
                                                                                status?</label>
                                                                            <textarea class="form-control ckeditor @error('ticket_timelines_ticket_action') is-invalid @enderror"
                                                                                name="ticket_timelines_ticket_action" required>It received from {{ RepairReceiveController::servicecenterName($repirRecive->repair_receives_repircenter) }} and </textarea>

                                                                        </div>


                                                                        <input type="hidden" name="repair_receives"
                                                                            value="{{ $repirRecive->repair_receives }}">
                                                                        <input type="hidden"
                                                                            name="repair_receives_ticket_id"
                                                                            value="{{ $repirRecive->repair_receives_ticket_id }}">
                                                                        <input type="hidden"
                                                                            name="ticket_timelines_ticket_status"
                                                                            value="Process">

                                                                        </br>

                                                                        <button type="submit"
                                                                            class="btn btn-success">Save</button>
                                                                    </form>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <script type="text/javascript">
                                                        $(document).ready(function() {
                                                            $('.ckeditor').ckeditor();
                                                        });
                                                    </script>
                                                @endforeach

                                            </tbody>
                                        </table>

                                    </td>
                            </tbody>
                        </table>

                    </div>


                    <div class="col-sm-6">

                        @if (!empty(Auth::user()->pcAdmin))

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <h5 class="card-title">This Week Selling List</h5>


                                    </tr>


                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <thead>


                                                    <tr>

                                                        <th class="text-center">#</th>
                                                        <th class="text-center">Equipment</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Cost</th>
                                                        <th class="text-center">Selling Price</th>
                                                        <th class="text-center">Profit</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($data['equpment_types'] as $key => $rows)
                                                        <tr class="">
                                                            <td class="text-center bg-info">{{ $key + 1 }}</td>
                                                            <td class="text-left ">{{ $rows->equpment_name }}</td>
                                                            <td class="text-center ">
                                                                {{ EquipmentController::countmontlySel($rows->equpment_types_id) }}
                                                            </td>
                                                            <td class="text-center ">
                                                                {{ EquipmentController::countmontlySelcost($rows->equpment_types_id) }}
                                                            </td>
                                                            <td class="text-center ">
                                                                {{ EquipmentController::countmontlyourprice($rows->equpment_types_id) }}
                                                            </td>
                                                            <td class="text-center ">
                                                                {{ EquipmentController::countmontlfrpfit($rows->equpment_types_id) }}
                                                            </td>


                                                        </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="4" class="text-center"> This Week Total</td>
                                                        <td class="text-center ">
                                                            {{ EquipmentController::thismonthTotalsell() }}</td>
                                                        <td class="text-center ">
                                                            {{ EquipmentController::thismonthprofit() }}</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </td>
                                </tbody>
                            </table>


                            <!--- ticket bills !----------->

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <h5 class="card-title">This Week Selling List</h5>


                                    </tr>


                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <table class="table table-bordered table-sm">
                                                <thead>


                                                    <tr>

                                                        <th class="text-center">#</th>
                                                        <th class="text-center">Organization</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Total</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    @foreach ($data['sbu_names'] as $key => $rowss)
                                                        <tr class="">
                                                            <td class="text-center bg-info">{{ $key + 1 }}</td>
                                                            <td class="text-left ">{{ $rowss->subsidiaries_name }}
                                                            </td>
                                                            <td class="text-center ">
                                                                {{ TicketsController::thisweektiketorf($rowss->subsidiaries_id) }}
                                                            </td>
                                                            <td class="text-center ">
                                                                {{ TicketsController::thisweektiketorfValuve($rowss->subsidiaries_id) }}
                                                            </td>


                                                        </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="2" class="text-right"> This Week Total</td>
                                                        <td class="text-center ">
                                                            {{ TicketsController::thisweektikettotal() }}</td>
                                                        <td class="text-center ">
                                                            {{ TicketsController::thisweektikettotalincome() }}</td>
                                                    </tr>



                                                    <tr>
                                                        <td colspan="2" class="text-right"> This Week Tiket &
                                                            Selling Total</td>
                                                        <td></td>
                                                        <td>{{ TicketsController::totalthisweek() }}</td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </td>
                                </tbody>
                            </table>

                        @endif
                    </div>

                </div>






                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tickets<span></span></h5>

                        <div class="row">

                            <div class="col-sm-6">


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>

                                            <th>Last Week Tickets</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>

                                                            <th class="text-center">New</th>
                                                            <th class="text-center">View</th>
                                                            <th class="text-center">Process</th>
                                                            <th class="text-center">Finish</th>
                                                            <th class="text-center">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>

                                                            <td class="text-center bg-danger"><a href="#"
                                                                    class="text-light" data-toggle="modal"
                                                                    data-target="#myModal{{ Auth::user()->profile_id . 'Crate' }}">{{ TicketsController::lastweekCountofstatus(Auth::user()->profile_id, 'Crate') }}
                                                                </a></td>
                                                            <td class="text-center bg-warning"><a href="#"
                                                                    class="text-light" data-toggle="modal"
                                                                    data-target="#myModal{{ Auth::user()->profile_id . 'View' }}">{{ TicketsController::lastweekCountofstatus(Auth::user()->profile_id, 'View') }}</a>
                                                            </td>
                                                            <td class="text-center bg-info"><a href="#"
                                                                    class="text-light" data-toggle="modal"
                                                                    data-target="#myModal{{ Auth::user()->profile_id . 'Process' }}">{{ TicketsController::lastweekCountofstatus(Auth::user()->profile_id, 'Process') }}</a>
                                                            </td>
                                                            <td class="text-center bg-success "><a href="#"
                                                                    class="text-light" data-toggle="modal"
                                                                    data-target="#myModal{{ Auth::user()->profile_id . 'Finish' }}">{{ TicketsController::lastweekCountofstatus(Auth::user()->profile_id, 'Finish') }}</a>
                                                            </td>

                                                            <td class="text-center bg-success "><a href="#"
                                                                    class="text-light" data-toggle="modal"
                                                                    data-target="#myModal{{ Auth::user()->profile_id . 'Finish' }}">{{ TicketsController::lastweektotalTickets(Auth::user()->profile_id) }}</a>
                                                            </td>

                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </td>
                                    </tbody>
                                </table>

                            </div>

                            <div class="col-sm-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Last Month Tickets</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr>

                                                                <th class="text-center">New</th>
                                                                <th class="text-center">View</th>
                                                                <th class="text-center">Process</th>
                                                                <th class="text-center">Finish</th>
                                                                <th class="text-center">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                            <tr>

                                                                <td class="text-center bg-danger"><a href="#"
                                                                        class="text-light" data-toggle="modal"
                                                                        data-target="#myModal{{ Auth::user()->profile_id . 'Crate' }}">{{ TicketsController::lastMonthCountofstatus(Auth::user()->profile_id, 'Crate') }}
                                                                    </a></td>
                                                                <td class="text-center bg-warning"><a href="#"
                                                                        class="text-light" data-toggle="modal"
                                                                        data-target="#myModal{{ Auth::user()->profile_id . 'View' }}">{{ TicketsController::lastMonthCountofstatus(Auth::user()->profile_id, 'View') }}</a>
                                                                </td>
                                                                <td class="text-center bg-info"><a href="#"
                                                                        class="text-light" data-toggle="modal"
                                                                        data-target="#myModal{{ Auth::user()->profile_id . 'Process' }}">{{ TicketsController::lastMonthCountofstatus(Auth::user()->profile_id, 'Process') }}</a>
                                                                </td>
                                                                <td class="text-center bg-success "><a href="#"
                                                                        class="text-light" data-toggle="modal"
                                                                        data-target="#myModal{{ Auth::user()->profile_id . 'Finish' }}">{{ TicketsController::lastMonthCountofstatus(Auth::user()->profile_id, 'Finish') }}</a>
                                                                </td>

                                                                <td class="text-center bg-success "><a href="#"
                                                                        class="text-light" data-toggle="modal"
                                                                        data-target="#myModal{{ Auth::user()->profile_id . 'Finish' }}">{{ TicketsController::lastmonthtotalTickets(Auth::user()->profile_id) }}</a>
                                                                </td>

                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>





                    </div>
                </div>
    @endif




    @if (!empty(Auth::user()->pcAdmin))
        <div class="card p-2">
            <div class="card-body">
                <div id="barchart_material" style="width: 100%; height: 600px;"></div>

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Year', {{ TicketsController::alloraganization() }}],
                            ['<?php echo date('Y'); ?>', {{ TicketsController::yearlytickets() }}],

                        ]);

                        var options = {
                            chart: {
                                title: 'All Tickets',
                                subtitle: '<?php echo date('Y'); ?>',
                            },
                            bars: 'horizontal' // Required for Material Bar Charts.
                        };

                        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
            </div>
        </div>
    @endif






    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">

            <!-----------
<div class="row">

    @if (!empty(Auth::user()->pcAdmin) or !empty(Auth::user()->ticketview) or !empty(Auth::user()->ticketupdate))
<div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
               <div class="card-body">
                <h5 class="card-title">Tickt Invoice Pending <span>| <a href="/invoicable_Ticket"> All</a></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-ticket" aria-hidden="true"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ InvoiceController::invoicePending() }}</h6>
                </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Task Invoice Pending<span>|   <a href="/invoicable_Task Active"> All</a></span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="fa fa-bug" aria-hidden="true"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ DailyTaskController::taskinvoicePending() }}</h6>
                </div>
                </div>
              </div>
            </div>

          </div>
@endif
</div>
!-------------->
            <div class="row">
                @if (!empty(Auth::user()->hrAdmin))
                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Subsidiaries <span>| <a href=""> All</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-building-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $data['sbucount'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Employees<span>| Active</span></h5>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $data['profile_count_total'] }}/{{ $data['profile_count'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

                <!-- End Revenue Card -->


                @if (!empty(Auth::user()->invoice_permition) or !empty(Auth::user()->pcAdmin))
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Menu</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="invoicable_Ticket">All Pending</a></li>

                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">Pending Invoice <span>| Tickets</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tickets Number</th>
                                            <th scope="col">Organization</th>
                                            <th scope="col">Fault</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data['ticketDetails'] as $key => $ticketDetails)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td><a href="oneTicket/{{ $ticketDetails->tickets_number }}"
                                                        target="_blank">{{ $ticketDetails->tickets_number }}</a></td>
                                                <td>{{ $ticketDetails->subsidiaries_name }}</td>
                                                <td class="fw-bold">{{ $ticketDetails->equpment_name }} /
                                                    {{ $ticketDetails->issues_name }}</td>
                                                <td>
                                                    @if (!empty($ticketDetails->ticket_invoice_amount))
                                                        Rs:/
                                                        {{ number_format($ticketDetails->ticket_invoice_amount, 2) }}
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-success text-white">
                                            <th scope="row"></th>
                                            <td colspan="3" class="text-center"> Total</td>
                                            <td>{{ InvoiceController::sum() }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>


            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
            @endif












            <!-- Customers Card -->
            @if (!empty(Auth::user()->hrAdmin))
                <div class="col-xxl-4 col-xl-12">



                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Today Leaves <span>| <a href=""> All</a></span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="ri-logout-box-r-line"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><!--- 5005 !---></h6>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            @endif
            <!-- End Customers Card -->

            <!-------------
          <div class="col-12">
            <div class="card">



              <div class="card-body">
                <h5 class="card-title">Leave Requst<span>/Today</span></h5>


                <div id="reportsChart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        new ApexCharts(document.querySelector("#reportsChart"), {
                            series: [{
                                name: 'Sales',
                                data: [31, 40, 28, 51, 42, 82, 56],
                            }, {
                                name: 'Revenue',
                                data: [11, 32, 45, 32, 34, 52, 41]
                            }, {
                                name: 'Customers',
                                data: [15, 11, 32, 18, 9, 24, 11]
                            }],
                            chart: {
                                height: 350,
                                type: 'area',
                                toolbar: {
                                    show: false
                                },
                            },
                            markers: {
                                size: 4
                            },
                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                            fill: {
                                type: "gradient",
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.3,
                                    opacityTo: 0.4,
                                    stops: [0, 90, 100]
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 2
                            },
                            xaxis: {
                                type: 'datetime',
                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                    "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                    "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                    "2018-09-19T06:30:00.000Z"
                                ]
                            },
                            tooltip: {
                                x: {
                                    format: 'dd/MM/yy HH:mm'
                                },
                            }
                        }).render();
                    });
                </script>


              </div>

            </div>
          </div>
          !----------->

            <!-- Recent Sales -->
            <div class="col-12">

                @if (!empty(Auth::user()->hrAdmin))
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">Birthday List <span>| This Month</span></h5>

                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Age</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['profile_birth_day'] as $birthday)
                                        @if (date('m', strtotime($birthday->profile_bith_day)) == date('m'))
                                            <tr>
                                                <th scope="row"><a
                                                        href="/view-profile/{{ $birthday->profile_sug }}">{{ $birthday->profile_number }}</a>
                                                </th>
                                                <td>{{ $birthday->profile_Full_name }}
                                                    ({{ $birthday->profile_first_name }}
                                                    {{ $birthday->profile_last_name }})
                                                </td>
                                                <td>{{ $birthday->profile_bith_day }}</td>


                                            </tr>
                                        @endif
                                    @endforeach


                                </tbody>
                            </table>

                        </div>

                    </div>
                @endif

            </div><!-- End Recent Sales -->



            @if (!empty(Auth::user()->hrAdmin))
                <!-- Recent Activity -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item" href="/subsidiaries-leave">Today</a></li>
                            <!---
              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
              !--->
                        </ul>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Leave Requst<span>| Today</span></h5>

                        <div class="activity">

                            @foreach ($data['leave_requsts'] as $leave)
                                <div class="activity-item d-flex">
                                    <div class="activite-label"></div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        {{ $leave->profile_first_name . ' ' . $leave->profile_last_name }} /
                                        {{ $leave->leave_requsts_need_date }}
                                    </div>
                                </div><!-- End activity item-->
                            @endforeach





                        </div>

                    </div>
                </div><!-- End Recent Activity -->

            @endif

            <!-- Budget Report
        <div class="card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
          </div>

          <div class="card-body pb-0">
            <h5 class="card-title">Budget Report <span>| This Month</span></h5>

            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                        legend: {
                            data: ['Allocated Budget', 'Actual Spending']
                        },
                        radar: {
                            // shape: 'circle',
                            indicator: [{
                                    name: 'Sales',
                                    max: 6500
                                },
                                {
                                    name: 'Administration',
                                    max: 16000
                                },
                                {
                                    name: 'Information Technology',
                                    max: 30000
                                },
                                {
                                    name: 'Customer Support',
                                    max: 38000
                                },
                                {
                                    name: 'Development',
                                    max: 52000
                                },
                                {
                                    name: 'Marketing',
                                    max: 25000
                                }
                            ]
                        },
                        series: [{
                            name: 'Budget vs spending',
                            type: 'radar',
                            data: [{
                                    value: [4200, 3000, 20000, 35000, 50000, 18000],
                                    name: 'Allocated Budget'
                                },
                                {
                                    value: [5000, 14000, 28000, 26000, 42000, 21000],
                                    name: 'Actual Spending'
                                }
                            ]
                        }]
                    });
                });
            </script>

          </div>
        </div>
        Budget Report -->

            <!-- Website Traffic
        <div class="card">
          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>

              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
          </div>

          <div class="card-body pb-0">
            <h5 class="card-title">Website Traffic <span>| Today</span></h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            top: '5%',
                            left: 'center'
                        },
                        series: [{
                            name: 'Access From',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold'
                                }
                            },
                            labelLine: {
                                show: false
                            },
                            data: [{
                                    value: 1048,
                                    name: 'Search Engine'
                                },
                                {
                                    value: 735,
                                    name: 'Direct'
                                },
                                {
                                    value: 580,
                                    name: 'Email'
                                },
                                {
                                    value: 484,
                                    name: 'Union Ads'
                                },
                                {
                                    value: 300,
                                    name: 'Video Ads'
                                }
                            ]
                        }]
                    });
                });
            </script>

          </div>
        </div>

        End Website Traffic -->

            <!-- News & Updates Traffic -->
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>

                </div>

                <div class="card-body pb-0">
                    <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                    <div class="news">


                        {{ NewsAlertController::showDashbord() }}





                    </div><!-- End sidebar recent posts-->

                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </div>


    <div class="col">

    </div>



    <!-- Budget Report !-------->
    <div class="card">


    </div>


    <!-- Website Traffic
    <div class="card">


        <div class="card-body pb-0">
            <h5 class="card-title">Ticket <span>| Status</span></h5>

            <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            top: '5%',
                            left: 'center'
                        },
                        series: [{
                            name: 'Access From',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold'
                                }
                            },
                            labelLine: {
                                show: false
                            },
                            data: [{
                                    value: {{ ReportAllController::contmonthicket('Crate') }},
                                    name: 'Crate'
                                },
                                {
                                    value: {{ ReportAllController::contmonthicket('View') }},
                                    name: 'View'
                                },
                                {
                                    value: {{ ReportAllController::contmonthicket('Process') }},
                                    name: 'Process'
                                },
                                {
                                    value: {{ ReportAllController::contmonthicket('Finish') }},
                                    name: 'Finish'
                                },

                            ]
                        }]
                    });
                });
            </script>

        </div>
    </div>
!------------>

    <!-- News & Updates Traffic -->
    <div class="card">



    </div><!-- End News & Updates -->

    </div><!-- End Right side columns -->

</section>


<script>
    var today = new Date()
    var curHr = today.getHours()

    if (curHr >= 0 && curHr < 6) {
        document.getElementById("timedemo").innerHTML = 'What are you doing that early?';
    } else if (curHr >= 6 && curHr < 12) {
        document.getElementById("imedemo").innerHTML = 'Good Morning';
    } else if (curHr >= 12 && curHr < 17) {
        document.getElementById("imedemo").innerHTML = 'Good Afternoon';
    } else {
        document.getElementById("imedemo").innerHTML = 'Good Evening';
    }
</script>



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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
