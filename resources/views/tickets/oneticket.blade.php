<?php
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\RepairReceiveController;
use Illuminate\Support\Facades\Auth;

?>

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">

                @foreach ($data['ticketDetails'] as $ticketDetails)
                    <div class="row">


                        <div class="col-sm-3">





                            <div class="row">

                                <div class="card ">
                                    <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image">!--->
                                    <div class="bg-success">


                                        <div class="col position-fixed ">

                                            <div class="card position-fixed div">
                                               

                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $ticketDetails->ticket_user_name }}</h5>
                                                </div>


                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"> <i class="fa fa-phone text-success"
                                                            aria-hidden="true"></i> &nbsp;&nbsp;
                                                        {{ $ticketDetails->ticket_phone_number }}</li>
                                                    <li class="list-group-item"><i class="fa fa-envelope-o text-success"
                                                            aria-hidden="true"></i> &nbsp;&nbsp;
                                                        {{ $ticketDetails->ticket_email }}</li>
                                                    <li class="list-group-item"><i class="fa fa-sitemap text-success"
                                                            aria-hidden="true"></i> &nbsp;&nbsp;
                                                        {{ $ticketDetails->subsidiaries_name }}</li>
                                                    <li class="list-group-item"><i class="fa fa-users text-success"
                                                            aria-hidden="true"></i> &nbsp;&nbsp;
                                                        {{ $ticketDetails->department_name }}</li>
                                                </ul>
                                                <div class="card-body">
                                                    <a href="#" class="card-link">View Profile</a>
                                                    <a href="#" class="card-link">View Device Details</a>
                                                </div>





                                                @if (!empty(Auth::user()->ticketupdate))
                                                    {{ RepairReceiveController::repeireRecive($ticketDetails->tickets_id) }}
                                                @endif



                                                @if (!empty(Auth::user()->ticket_assign) and empty($ticketDetails->ticket_owner))
                                                    <i class="fa fa-user-circle-o fa-3x text-success p-3"
                                                        data-toggle="modal" data-target="#assignticket"
                                                        aria-hidden="true" title=" Ticket Assign"></i>


                                                  
                                                <button type="button" class="btn btn-primary mt-2 mb-2"  data-toggle="modal" data-target="#assignticket">
                                                    Ticket Assign
                                                </button>
                                               
                                                @endif




                                                @if (!empty($ticketDetails->ticket_invoice_number))
                                                @else
                                                    @if (!empty(Auth::user()->ticketupdate))
                                                        <i class="fa fa-money fa-3x text-success p-3" aria-hidden="true"
                                                            title="Update Ticket" data-toggle="modal"
                                                            data-target="#UpdateTicket"></i>

                                                      
                                                        <button type="button" class="btn btn-primary mt-2"
                                                            data-toggle="modal" data-target="#UpdateTicket">Update
                                                            Ticket </button>
                                                        
                                                    @endif
                                                @endif




                                                @if (!empty($ticketDetails->ticket_invoice_number))
                                                @else
                                                    @if (!empty(Auth::user()->ticketupdate))
                                                        <i class="fa fa-pencil-square-o fa-3x text-success p-3"
                                                            aria-hidden="true" data-toggle="modal"
                                                            data-target="#mysteps" title=" Action"></i>

                                                   
                                                        <button type="button" class="btn btn-primary mt-2"
                                                            data-toggle="modal" data-target="#mysteps">
                                                            Action
                                                        </button>
                                                      
                                                    @endif
                                                @endif




                                                @if (!empty(Auth::user()->ticketupdate))
                                                    <i class="fa fa-calendar fa-3x text-danger p-3" aria-hidden="true"
                                                        title=" Target Date" aria-hidden="true" data-toggle="modal"
                                                        data-target="#targetdate"></i>

                                                    <!-- The Modal -->
                                                @endif








                                            </div>




                                        </div>








                                        <!-----
                            <a href="#" class="btn btn-primary mt-5" data-toggle="modal" data-target="#UpdateTicket">Update Ticket</a>
!------->


                                        <!------------- Recive Form !------------->

                                        <!-- The Modal -->
                                        <div class="modal fade" id="reciveFrom">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Recive From</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="/reciveitems" method="post">
                                                            @csrf



                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="email">Ticket Number</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $ticketDetails->tickets_number }}"
                                                                            readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="email">Equpment Number</label>
                                                                        <input type="email" class="form-control"
                                                                            value="{{ DB::table('equipment')->where('equipment_id', $ticketDetails->tickets_equ_id)->value('equipment_number') }}"
                                                                            id="email" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>




                                                            <div class="row">

                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="email">Store location</label>
                                                                        </br>

                                                                        <select
                                                                            class="custom-select  @error('repair_receives_location') is-invalid @enderror repair_receives_location"
                                                                            name="repair_receives_location"
                                                                            style="width: 400px" required>
                                                                            <option value="">Select One</option>

                                                                            @foreach ($data['officeLocation'] as $officeLocation)
                                                                                <option
                                                                                    value="{{ $officeLocation->office_locations_id }}">
                                                                                    {{ $officeLocation->office_locations_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="email">Receiver Name</label>
                                                                        <input type="email" class="form-control"
                                                                            value="{{ Auth::user()->name }}"
                                                                            id="email" readonly>
                                                                    </div>
                                                                </div>



                                                            </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="email">Note:</label>
                                                                        <textarea class="form-control ckeditor @error('repair_receives_reson') is-invalid @enderror"
                                                                            name="repair_receives_reson" required rows="5" cols="3"></textarea>
                                                                        @error('repair_receives_reson')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <input type="hidden" name="repair_receives_ticket_id"
                                                                value="{{ $ticketDetails->tickets_id }}">
                                                            <input type="hidden" name="repair_receives_equpment_id"
                                                                value="{{ $ticketDetails->tickets_equ_id }}">
                                                            <input type="hidden" name="repair_receives_by"
                                                                value="{{ Auth::user()->name }}">
                                                            <input type="hidden" name="tickets_number"
                                                                value="{{ $ticketDetails->tickets_number }}">



                                                            <div>
                                                                <button type="submit"
                                                                    class="btn btn-success">Save</button>
                                                            </div>
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



                                        <!------ ticket_assign  !----------------->







                                        <div class="modal fade" id="assignticket">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">


                                                    <div class="modal-header">
                                                        <h4 class="modal-title"> Ticket Assign Owner</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>


                                                    <div class="modal-body">
                                                        <form action="/ticketOwner" method="post">
                                                            @csrf
                                                            <select name="ticket_owner" class="custom-select mb-3">
                                                                <option selected>Select One</option>
                                                                {{ TicketsController::ticket_acess_eploymee() }}
                                                            </select>

                                                            <input type="hidden" name="tickets_id"
                                                                value="{{ $ticketDetails->tickets_id }}">
                                                            <input type="hidden" name="tickets_number"
                                                                value="{{ $ticketDetails->tickets_number }}">

                                                            <button type="submit"
                                                                class="btn btn-success mt-3">Save</button>
                                                        </form>
                                                    </div>


                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>




                                        <!-- Update Ticket -->
                                        <div class="modal fade" id="UpdateTicket">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update
                                                            {{ $ticketDetails->tickets_number }}</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="/ticket_update" method="POST">
                                                            @csrf


                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="Yes" name="ticket_invoisable"
                                                                    onclick="invoiceable()"
                                                                    @if (!@empty($ticketDetails->ticket_invoisable)) checked @endif>
                                                                <label class="form-check-label"
                                                                    for="flexCheckDefault">
                                                                    Invoiceable
                                                                </label>
                                                            </div>

                                                            <div class="form-group mt-2 col-sm-5" id="myDIV">
                                                                <label for="email">Invoice amount</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Invoice amount"
                                                                    name="ticket_invoice_amount"
                                                                    value="{{ $ticketDetails->ticket_invoice_amount }}"
                                                                    id="email"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                                            </div>

                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="Yes" name="ticket_on_agriment"
                                                                    @if (!@empty($ticketDetails->ticket_on_agriment)) checked @endif>
                                                                <label class="form-check-label"
                                                                    for="flexCheckDefault">Agriment</label>
                                                            </div>

                                                            <input type="hidden"
                                                                value="{{ $ticketDetails->tickets_number }}"
                                                                name="tickets_number">
                                                            <input type="hidden"
                                                                value="{{ $ticketDetails->tickets_id }}"
                                                                name="tickets_id">
                                                            <input type="hidden"
                                                                value="{{ $ticketDetails->ticket_status }}"
                                                                name="ticket_status">

                                                            @if (!empty($ticketDetails->ticket_invoice_number))
                                                            @else
                                                                @if (!empty(Auth::user()->ticketupdate))
                                                                    <button type="submit"
                                                                        class="btn btn-success">Save</button>
                                                                @endif
                                                            @endif



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


                                        <script>
                                            function invoiceable() {
                                                var x = document.getElementById("myDIV");
                                                if (x.style.display === "block") {
                                                    x.style.display = "none";
                                                } else {
                                                    x.style.display = "block";
                                                }
                                            }
                                        </script>



                                        <!-- Update Ticket -->
                                    </div>
                                </div>



                            </div>






                            <!-- The Modal -->
                            <div class="modal fade" id="mysteps">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Could you update your action and status?</h4>
                                            <button type="button" class="close"
                                                data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">

                                            <form action="/ticket_step_save" method="">
                                                @csrf

                                                <div class="form-group">
                                                    <label for="email">Your Action</label>
                                                    <textarea class="form-control  @error('ticket_timelines_ticket_action') is-invalid @enderror"
                                                        name="ticket_timelines_ticket_action" required></textarea>

                                                </div>

                                                <div class="form-group ">
                                                    <label for="email">Your Action</label>
                                                    <select name="ticket_timelines_ticket_status"
                                                        class="custom-select  @error('ticket_timelines_ticket_status') is-invalid @enderror"
                                                        required>
                                                        <option selected>{{ $ticketDetails->ticket_status }}</option>
                                                        <option>View</option>
                                                        <option>Process</option>
                                                        <option>Finish</option>
                                                    </select>
                                                </div>



                                                <input type="hidden" value="{{ $ticketDetails->tickets_id }}"
                                                    name="tickets_id">
                                                <input type="hidden" value="{{ $ticketDetails->tickets_number }}"
                                                    name="tickets_number">

                                                <input type="hidden" value="{{ $ticketDetails->ticket_email }}"
                                                    name="ticket_email">
                                                <input type="hidden" value="{{ $ticketDetails->ticket_user_name }}"
                                                    name="ticket_user_name">
                                                <input type="hidden"
                                                    value="{{ $ticketDetails->ticket_issues_note }}"
                                                    name="tickets_issued">





                                                <button type="submit" class="btn btn-primary">Submit</button>
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



                        </div>
                        <div class="col">

                            <div class="row d-flex justify-content-center  mb-70">

                                <div class="col">

                                    <div class="main-card mb-3 card">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4>#{{ $ticketDetails->tickets_number }} </h4>

                                                    <h4>Equipment Number #
                                                        {{ DB::table('equipment')->where('equipment_id', $ticketDetails->tickets_equ_id)->value('equipment_number') }}
                                                    </h4>
                                                </div>


                                                {{ TicketsController::ticket_owner_view($ticketDetails->ticket_owner) }}


                                            </div>



                                            <a href="{{ TicketsController::equpmentlinkcrate($ticketDetails->tickets_equ_id) }}"
                                                target="_blank"
                                                title="View more details">{{ $ticketDetails->equpment_name }}</a>/
                                            {{ $ticketDetails->issues_name }}


                                            <div class="row">
                                                <div class="shadow p-3 mb-5 bg-white rounded mt-1">
                                                    {!! html_entity_decode($ticketDetails->ticket_issues_note) !!}</div>

                                                @if (!empty($ticketDetails->ticket_invoisable))
                                                    <div> Invoice : {{ $ticketDetails->ticket_invoisable }} </div>
                                                @endif

                                                @if (!empty($ticketDetails->ticket_on_agriment))
                                                    <div> Agreement : {{ $ticketDetails->ticket_on_agriment }} </div>
                                                @endif

                                                @if ($ticketDetails->ticket_status == 'Finish')
                                                    <i class="fa fa-clock-o text-success"
                                                        aria-hidden="true">&nbsp;{{ TicketsController::timecaluculate($ticketDetails->ticket_date_time, $ticketDetails->ticket_finish_datetime) }}</i>
                                                @else
                                                    <i class="fa fa-clock-o text-success"
                                                        aria-hidden="true">&nbsp;{{ TicketsController::timecaluculate($ticketDetails->ticket_date_time, $ticketDetails->ticket_finish_datetime) }}</i>
                                                @endif
                                            </div>

                                            @if (empty($ticketDetails->ticket_finish_datetime))
                                                <p id="demo" class="text-danger"></p>
                                            @endif










                                            <h5 class="card-title">Ticket Timeline</h5>
                                            <div
                                                class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                {{ ReportAllController::timeLine($ticketDetails->tickets_id) }}
                                                <div class="vertical-timeline-item vertical-timeline-element">
                                                    <div>
                                                        <span class="vertical-timeline-element-icon bounce-in">
                                                            <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                        </span>
                                                        <div class="vertical-timeline-element-content bounce-in">
                                                            <p> {{ $ticketDetails->equpment_name }} /
                                                                {{ $ticketDetails->issues_name }} <b
                                                                    class="text-danger"> &MediumSpace;
                                                                    {{ $ticketDetails->ticket_date_time }}</b></p>
                                                            <p> {!! html_entity_decode($ticketDetails->ticket_issues_note) !!}</p>
                                                            <span class="vertical-timeline-element-date">Crate</span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>





<div class="modal fade" id="targetdate">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Updating target date</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="/target_date_update">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Target Date:</label>
                        <input type="date" class="form-control" placeholder="Target Date" id="email"
                            name="ticket_target_finish_datetime">
                    </div>

                    <input type="hidden" value="{{ $ticketDetails->tickets_number }}" name="tickets_number">
                    <input type="hidden" value="{{ $ticketDetails->tickets_id }}" name="tickets_id">
                    <input type="hidden" value="{{ $ticketDetails->ticket_status }}" name="ticket_status">

                    @if (!empty($ticketDetails->ticket_invoice_number))
                    @else
                        @if (!empty(Auth::user()->ticketupdate))
                            <button type="submit" class="btn btn-success">Save</button>
                        @endif
                    @endif



                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>






<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>

<script>
    $(document).ready(function() {
        $('.repair_receives_location').select2();
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



<style>
    body {
        background-color: #eee;
    }

    .mt-70 {
        margin-top: 70px;
    }

    .mb-70 {
        margin-bottom: 70px;
    }

    .card {
        box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
        border-width: 0;
        transition: all .2s;
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(26, 54, 126, 0.125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

    .vertical-timeline {
        width: 100%;
        position: relative;
        padding: 1.5rem 0 1rem;
    }

    .vertical-timeline::before {
        content: '';
        position: absolute;
        top: 0;
        left: 67px;
        height: 100%;
        width: 4px;
        background: #e9ecef;
        border-radius: .25rem;
    }

    .vertical-timeline-element {
        position: relative;
        margin: 0 0 1rem;
    }

    .vertical-timeline--animate .vertical-timeline-element-icon.bounce-in {
        visibility: visible;
        animation: cd-bounce-1 .8s;
    }

    .vertical-timeline-element-icon {
        position: absolute;
        top: 0;
        left: 60px;
    }

    .vertical-timeline-element-icon .badge-dot-xl {
        box-shadow: 0 0 0 5px #fff;
    }

    .badge-dot-xl {
        width: 18px;
        height: 18px;
        position: relative;
    }

    .badge:empty {
        display: none;
    }


    .badge-dot-xl::before {
        content: '';
        width: 10px;
        height: 10px;
        border-radius: .25rem;
        position: absolute;
        left: 50%;
        top: 50%;
        margin: -5px 0 0 -5px;
        background: #fff;
    }

    .vertical-timeline-element-content {
        position: relative;
        margin-left: 90px;
        font-size: .8rem;
    }

    .vertical-timeline-element-content .timeline-title {
        font-size: .8rem;
        text-transform: uppercase;
        margin: 0 0 .5rem;
        padding: 2px 0 0;
        font-weight: bold;
    }

    .vertical-timeline-element-content .vertical-timeline-element-date {
        display: block;
        position: absolute;
        left: -90px;
        top: 0;
        padding-right: 10px;
        text-align: right;
        color: #adb5bd;
        font-size: .7619rem;
        white-space: nowrap;
    }

    .vertical-timeline-element-content:after {
        content: "";
        display: table;
        clear: both;
    }


    .div {
        display: flex;
        justify-content: center;
        align-items: center;

    }
</style>




<script>
    // Set the date we're counting down to
    var countDownDate = new Date("<?php echo $ticketDetails->ticket_date_time; ?>");

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = now - countDownDate;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>
