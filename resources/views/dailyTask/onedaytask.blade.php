<?php
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\DailyTaskController;

?>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">

@foreach ($data['daily_tasksDetails'] as $daily_tasksDetails)


            <div class="row">

                <div class="col-sm-5">



                    <div class="row">
                        <div class="col"> <h4>Task Number : {{$daily_tasksDetails->daily_tasks_number}} </h4></div>
                    </div>

                    <div class="row">

                        <div class="card" >
                           <!-- <img class="card-img-top" src="img_avatar1.png" alt="Card image">!--->
                            <div class="card-body">

                                <div class="col-sm-8">
                                    <div>Report By : {{$daily_tasksDetails->daily_tasks_user_name}}</div>
                                    <div>Phone Numbe : {{$daily_tasksDetails->daily_tasks_phone_number}}</div>
                                    <div>Organization: {{$daily_tasksDetails->subsidiaries_name}}</div>
                                    <div>Department: {{$daily_tasksDetails->department_name}}</div>
                                    <div>Device : {{$daily_tasksDetails->equpment_name}} / {{$daily_tasksDetails->issues_name}}</div>
                                    <div>Note : {{$daily_tasksDetails->daily_tasks_issues_note}}</div>

                                    @if(!empty($daily_tasksDetails->daily_tasks_invoisable))
                                     <div> Invoice : {{$daily_tasksDetails->daily_tasks_invoisable}} </div>
                                     @endif

                                    @if(!empty($daily_tasksDetails->daily_tasks_on_agriment))
                                     <div> Agreement : {{$daily_tasksDetails->daily_tasks_on_agriment}} </div>

                                    @endif



                                    <div>Time count : {{ DailyTaskController::timecaluculate($daily_tasksDetails->daily_tasks_date_time,$daily_tasksDetails->daily_tasks_finish_datetime)}}</div>
                                    <div>Status :{{$daily_tasksDetails->daily_tasks_status}}</div>
                                </div>

                                @if(!empty(Auth::user()->ticketupdate))
                                @if(!empty($daily_tasksDetails->daily_tasks_invoice_number))
                                @else
                                <a href="#" class="btn btn-primary mt-5" data-toggle="modal" data-target="#UpdateTicket">Update Ticket</a>
                                 @endif
                                 @endif






                    <!-- Update Ticket -->
                    <div class="modal fade" id="UpdateTicket">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modal-title">Update {{$daily_tasksDetails->daily_tasks_number}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="/daily_tasks_update" method="POST">
                                    @csrf


                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Yes" name="daily_tasks_invoisable" onclick="invoiceable()" @if (!@empty($daily_tasksDetails->daily_tasks_invoisable))   checked    @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Invoiceable
                                        </label>
                                      </div>

                                    <div class="form-group mt-2 col-sm-5" id="myDIV">
                                        <label for="email">Invoice amount</label>
                                        <input type="text" class="form-control" placeholder="Invoice amount" name="daily_tasks_invoice_amount" value="{{$daily_tasksDetails->daily_tasks_invoice_amount}}" id="email"    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"     >
                                      </div>

                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Yes" name="daily_tasks_on_agriment"  @if (!@empty($daily_tasksDetails->daily_tasks_on_agriment))checked  @endif>
                                        <label  class="form-check-label" for="flexCheckDefault">Agriment</label>
                                      </div>

                                      <input type="hidden" value="{{$daily_tasksDetails->daily_tasks_number}}" name="daily_tasks_number">
                                      <input type="hidden" value="{{$daily_tasksDetails->daily_tasks_id}}" name="daily_tasks_id">
                                      <input type="hidden" value="{{$daily_tasksDetails->daily_tasks_status}}" name="daily_tasks_status">

                                      @if (!empty($daily_tasksDetails->daily_tasks_invoice_number))
                                      @else
                                      @if(!empty(Auth::user()->ticketupdate))
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



                    @if (!empty($daily_tasksDetails->daily_tasks_invoice_number))
                    @else
                    @if(!empty(Auth::user()->ticketupdate))
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mysteps">Steps </button>
                    @endif
                    @endif





                      <!-- The Modal -->
<div class="modal fade" id="mysteps">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Could you update your action and status?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

<form action="/daily_tasks_step_save" method="post">
    @csrf

        <div class="form-group">
          <label for="email">Your Action</label>
          <textarea  class="form-control  @error('daily_tasks_timelines_daily_tasks_action') is-invalid @enderror" name="daily_tasks_timelines_daily_tasks_action" required></textarea>

        </div>

        <div class="form-group ">
            <label for="email">Your Action</label>
        <select name="daily_tasks_status" class="custom-select  @error('daily_tasks_status') is-invalid @enderror" required>
            <option >{{$daily_tasksDetails->daily_tasks_status}}</option>
            <option >View</option>
            <option >Process</option>
            <option >Finish</option>
          </select>
        </div>



         <input type="hidden" value="{{$daily_tasksDetails->daily_tasks_id}}" name="daily_tasks_id">
         <input type="hidden" value="{{$daily_tasksDetails->daily_tasks_number}}" name="daily_tasks_number">
         <input type="hidden" value="{{$daily_tasksDetails->daily_tasks_id}}" name="daily_tasks_id">



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



                </div>
                <div class="col">

                    <div class="row d-flex justify-content-center mt-70 mb-70">

                        <div class="col">

                          <div class="main-card mb-3 card">
                                                      <div class="card-body">
                                                          <h5 class="card-title">Ticket Timeline</h5>
                                                          <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                       {{DailyTaskController::timeLine($daily_tasksDetails->daily_tasks_id)}}
                                                              <div class="vertical-timeline-item vertical-timeline-element">
                                                                <div>
                                                                    <span class="vertical-timeline-element-icon bounce-in">
                                                                        <i class="badge badge-dot badge-dot-xl badge-warning"> </i>
                                                                    </span>
                                                                    <div class="vertical-timeline-element-content bounce-in">
                                                                        <p> {{$daily_tasksDetails->equpment_name}} / {{$daily_tasksDetails->issues_name}} <b class="text-danger"> &MediumSpace; {{$daily_tasksDetails->daily_tasks_date_time}}</b></p>
                                                                        <p> {{$daily_tasksDetails->daily_tasks_issues_note}}</p>
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


  <style>
    body{
     background-color: #eee;
}

.mt-70{
     margin-top: 70px;
}

.mb-70{
     margin-bottom: 70px;
}

.card {
    box-shadow: 0 0.46875rem 2.1875rem rgba(4,9,20,0.03), 0 0.9375rem 1.40625rem rgba(4,9,20,0.03), 0 0.25rem 0.53125rem rgba(4,9,20,0.05), 0 0.125rem 0.1875rem rgba(4,9,20,0.03);
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
    border: 1px solid rgba(26,54,126,0.125);
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
  </style>



