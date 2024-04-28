<?php

$data['busnus'] = DB::table('subsidiaries')
    ->select('*')
    ->get();
$data['departments'] = DB::table('departments')
    ->select('*')
    ->get();
$data['equpment_types'] = DB::table('equpment_types')
    ->select('*')
    ->get();
$data['issues'] = DB::table('issues')
    ->select('*')
    ->get();

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketsController;

?>

<div class="card-body bg-white">


    @if($profile[0]->profile_id==Auth::user()->profile_id) 
    <div class="mb-3">
        <i class="fa fa-ticket-o" aria-hidden="true" data-toggle="modal" data-target="#newTicket"> New Ticket </i>


        <svg width="30" data-toggle="modal" data-target="#newTicket" height="30" viewBox="0 0 48 48" fill="none"
            xmlns="http://www.w3.org/2000/svg" id="IconChangeColor">
            <path
                d="M34 30V28.989C34 27.3382 35.3382 26 36.989 26V26C38.6381 26 39.9756 27.3356 39.978 28.9847L39.99 37.1853C39.9955 40.9473 36.9473 44 33.1853 44H25.6472C21.2342 44 17.0822 41.9088 14.4552 38.363L10.19 32.6062C9.46968 31.6339 9.40592 30.3235 10.0285 29.2858V29.2858C11.0299 27.6168 13.3332 27.3332 14.7096 28.7096L16 30V16C16 14.3431 17.3431 13 19 13V13C20.6569 13 22 14.3431 22 16V27.875V21.0263C22 19.3549 23.3549 18 25.0263 18V18C26.6977 18 28.0526 19.3549 28.0526 21.0263V29V27.8987C28.0526 26.2564 29.384 24.925 31.0263 24.925V24.925C32.6686 24.925 34 26.2564 34 27.8987V30Z"
                stroke="#00f028" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                id="mainIconPathAttribute" fill="#ffffff"></path>
            <path d="M32 4V12" stroke="#00f028" stroke-width="1" stroke-linecap="round" id="mainIconPathAttribute"
                fill="#ffffff"></path>
            <path
                d="M16 20H6V16C8 16 10 14.5 9.97403 12C9.94805 9.5 8 8 6 8V4H42V8C40 8 38.0519 9.5 38.026 12C38 14.5 40 16 42 16V20H28"
                stroke="#00f028" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                id="mainIconPathAttribute" fill="#ffffff"></path>
        </svg>
    </div>

@endif
    <h4 class="p-2">Current using equipment list</h4>




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
                ->where('equipment_histories.equipment_user', '=', $profile[0]->profile_id)
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





                        @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-eraser" viewBox="0 0 16 16" style="color: red" data-toggle="modal"
                                data-target="#changeStatus{{ $equipment->equipment_id }}">
                                <path
                                    d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z" />
                            </svg>
                        @endif


                        <!-- The Modal -->
                        <div class="modal fade" id="changeStatus{{ $equipment->equipment_id }}">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Responsibility</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <p>
                                            {{ $equipment->equipment_number }} Do you need to remove this one of
                                            responsibility?
                                        </p>


                                        <div class="container">

                                            <form action="/removeEqu" method="post">

                                                @csrf
                                                <input type="hidden" value="{{ $equipment->equipment_id }}"
                                                    name="equipment_id">
                                                <input type="hidden" value="{{ $profile[0]->profile_sug }}"
                                                    name="profile_sug">
                                                <input type="hidden" value="{{ $equipment->equipment_histories_id }}"
                                                    name="equipment_histories_id">


                                                <div class="form-group">
                                                    <label for="email">Reson:</label>
                                                    <input type="text" class="form-control"
                                                        name="equipment_histories_remove_reson" required>
                                                </div>

                                                </br>
                                                <button type="submit" class="btn btn-success">Success</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>


                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>





                        <svg width="30" data-toggle="modal" data-target="#newTicket{{ $equipment->equipment_id }}"
                            height="30" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"
                            id="IconChangeColor">
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

                        <svg data-toggle="modal" data-target="#myticket{{ $equipment->equipment_id }}"
                            id="changeColor" fill="#DC7633" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="38" zoomAndPan="magnify"
                            viewBox="0 0 375 374.9999" height="38" preserveAspectRatio="xMidYMid meet"
                            version="1.0">
                            <defs>
                                <path id="pathAttribute"
                                    d="M 33 37.5 L 342 37.5 L 342 345.75 L 33 345.75 Z M 33 37.5 ">
                                </path>
                                <path id="pathAttribute"
                                    d="M 272 42 L 358.730469 42 L 358.730469 341 L 272 341 Z M 272 42 "></path>
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
                            <g id="inner-icon" transform="translate(85, 75)"> <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-list-details" width="203" height="203"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" id="IconChangeColor">
                                    <path stroke="#52f019" d="M0 0h24v24H0z" fill="#ffffff"
                                        id="mainIconPathAttribute">
                                    </path>
                                    <path d="M13 5h8" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
                                    </path>
                                    <path d="M13 9h5" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
                                    </path>
                                    <path d="M13 15h8" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
                                    </path>
                                    <path d="M13 19h5" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
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
</div>



@foreach ($equipments as $key => $equipment)
    <!-- The Modal -->
    <div class="modal fade" id="history{{ $equipment->equipment_id }}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">History</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>







    <!-- new ticket !---->
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

                            <input type="hidden" class="form-control " value="{{ $equipment->equipment_type }}"
                                id="email" name="ticket_equpment_types" readonly>


                            <input type="hidden" class="form-control " value="{{ $profile[0]->profile_sug }}"
                                id="email" name="profile_sug" readonly>
                            <input type="hidden" class="form-control " value="{{ $equipment->equipment_id }}"
                                id="email" name="equipment_id" readonly>
                            <input type="hidden" class="form-control @error('ticket_user_name') is-invalid @enderror"
                                value="{{ $profile[0]->profile_first_name }}  {{ $profile[0]->profile_last_name }}"
                                id="email" name="ticket_user_name" readonly>
                            <input type="hidden" class="form-control " id="email" name="ticket_profile_id"
                                value="{{ $profile[0]->profile_id }}">
                            <input type="hidden" class="form-control " id="email" name="ticket_email"
                                value="@foreach ($data['workingJobportal'] as $work){{ $work->profile_job_work_email }} @endforeach">
                            <input type="hidden" class="form-control " id="email" name="ticket_phone_number"
                                value="{{ EquipmentController::workmobile_equ_org($profile[0]->profile_id) }}">
                            <input type="hidden" class="form-control " id="email" name="ticket_organization"
                                value="{{ DB::table('subsidiaries')->where('subsidiaries_id', $equipment->equipment_organization)->value('subsidiaries_id') }}">
                            <div class="row ">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Department:</label>
                                        <select
                                            class="custom-select  @error('ticket_organization') is-invalid @enderror"
                                            name="ticket_organization" required>
                                            {{ ProfileController::workingCompanys($profile[0]->profile_id) }}
                                        </select>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="email">Issue:</label>
                                        <select class="custom-select  @error('ticket_issues_id') is-invalid @enderror"
                                            name="ticket_issues_id" required>
                                            @foreach ($data['issues'] as $issues)
                                                <option value="{{ $issues->issues_id }}">{{ $issues->issues_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email">Problem Text (Describe Your Issue) :</label>
                                        <textarea class="ckeditor form-control @error('ticket_issues_note') is-invalid @enderror" name="ticket_issues_note"
                                            required></textarea>

                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit a ticket</button>
                        </form>
                    </div>
                </div>

                <!-- Modal footer !---->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>






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
                            {{ TicketsController::myticket($profile[0]->profile_id, $equipment->equipment_id) }}

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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endforeach



<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">







<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });



    new DataTable('#example');
</script>



<div class="card-body bg-white mt-5 " style="background-color: rosybrown">
    <h4 class="p-2">Used equipment list</h4>



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
            $equipments_history = DB::table('equipment_histories')
                ->join('equipment', 'equipment.equipment_id', '=', 'equipment_histories.equipment_histories_equipment_number')
                ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'equipment.equipment_type')
                ->join('profiles', 'profiles.profile_id', '=', 'equipment_histories.equipment_user')
                ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
                ->orderBy('equipment.equipment_number', 'asc')
                ->where('equipment_histories.equipment_histories_status', '=', 0)
                ->where('equipment_histories.equipment_user', '=', $profile[0]->profile_id)
                ->get();
            ?>


            @foreach ($equipments_history as $key => $equipmenthis)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td> {{ $equipmenthis->equipment_number }}</td>
                    <td>{{ $equipmenthis->equpment_name }}</td>
                    <td>{{ $equipmenthis->equipment_asset_sn }}</td>
                    <td></td>

                    <td>


                        <svg data-toggle="modal" data-target="#myticket{{ $equipment->equipment_id }}"
                            id="changeColor" fill="#DC7633" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="38" zoomAndPan="magnify"
                            viewBox="0 0 375 374.9999" height="38" preserveAspectRatio="xMidYMid meet"
                            version="1.0">
                            <defs>
                                <path id="pathAttribute"
                                    d="M 33 37.5 L 342 37.5 L 342 345.75 L 33 345.75 Z M 33 37.5 ">
                                </path>
                                <path id="pathAttribute"
                                    d="M 272 42 L 358.730469 42 L 358.730469 341 L 272 341 Z M 272 42 "></path>
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
                            <g id="inner-icon" transform="translate(85, 75)"> <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-list-details" width="203" height="203"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round" id="IconChangeColor">
                                    <path stroke="#52f019" d="M0 0h24v24H0z" fill="#ffffff"
                                        id="mainIconPathAttribute">
                                    </path>
                                    <path d="M13 5h8" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
                                    </path>
                                    <path d="M13 9h5" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
                                    </path>
                                    <path d="M13 15h8" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
                                    </path>
                                    <path d="M13 19h5" id="mainIconPathAttribute" fill="#ffffff" stroke="#52f019">
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



</div>




@foreach ($equipments_history as $key => $equipment)
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
                            {{ TicketsController::myticket($profile[0]->profile_id, $equipment->equipment_id) }}

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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endforeach




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

                       
                        <input type="hidden" class="form-control " value="{{ $profile[0]->profile_sug }}"
                            id="email" name="profile_sug" readonly>
                        <input type="hidden" class="form-control " value="" id="email"
                            name="equipment_id" readonly>
                        <input type="hidden" class="form-control @error('ticket_user_name') is-invalid @enderror"
                            value="{{ $profile[0]->profile_first_name }}  {{ $profile[0]->profile_last_name }}"
                            id="email" name="ticket_user_name" readonly>
                        <input type="hidden" class="form-control " id="email" name="ticket_profile_id"
                            value="{{ $profile[0]->profile_id }}">
                        <input type="hidden" class="form-control " id="email" name="ticket_email"
                            value="@foreach ($data['workingJobportal'] as $work){{ $work->profile_job_work_email }} @endforeach">
                        <input type="hidden" class="form-control " id="email" name="ticket_phone_number"
                            value="{{ EquipmentController::workmobile_equ_org($profile[0]->profile_id) }}">
                       <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Organization:</label></br>
                                    <select class="custom-select  @error('ticket_organization')  is-invalid @enderror ticket_organization"
                                        name="ticket_organization" required style="width: 100%">
                                        {{ ProfileController::workingCompanys($profile[0]->profile_id) }}
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="email">Device:</label>
                                </br>
                                    <select class="custom-select  @error('ticket_equpment_types') is-invalid @enderror ticket_equpment_types"
                                        name="ticket_equpment_types" required style="width: 100%">
                                        @foreach ($data['equpment_types'] as $equpment_types)
                                            <option value="{{ $equpment_types->equpment_types_id }}">
                                                {{ $equpment_types->equpment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="form-group">



                                    <label for="email">Issue:</label>
                                </br>
                                    <select class="custom-select  @error('ticket_issues_id') is-invalid @enderror ticket_issues_id"
                                        name="ticket_issues_id" required style="width:100%">
                                        @foreach ($data['issues'] as $issues)
                                            <option value="{{ $issues->issues_id }}">{{ $issues->issues_name }}
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
                                    <label for="email">Problem Text (Describe Your Issue) :</label>
                                    <textarea class="ckeditor form-control @error('ticket_issues_note') is-invalid @enderror" name="ticket_issues_note"
                                        required></textarea>

                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit a ticket</button>
                    </form>
                </div>
            </div>

            <!-- Modal footer !---->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
