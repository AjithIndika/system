
<?php 
use Illuminate\Support\Carbon;
use App\Http\Controllers\TicketsController;

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            <div class="card-body">
             

               <div class="row">
                <div class="col">


                  <form method="POST" action="/ticket_get_report">
                    @csrf

                    <div class="row mt-3">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="email">Frist Date</label>
                          <input type="date" class="form-control" placeholder="Frist Date" id="email" name="start">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="email">Last Date</label>
                          <input type="date" class="form-control" placeholder="Frist Date" id="email" name="end">
                        </div>
                      </div>
                      <div class="col">

                        <div class="form-group">
                          <label for="email"> </label></br>
                          <button type="submit" class="btn btn-primary"  value="filter">Submit</button>
                        </div>


                        
                      </div>
                    </div>

                  </form>
                </div>
               </div>
            </div>
        </div>
    </div>




    <section class="section dashboard">
      <!-- Recent Sales -->
      <div class="col-12">
          <div class="card recent-sales overflow-auto">
  
              <div class="card-body">
               
  
                 
              </div>
          </div>
      </div>

      


      <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
      
                  <h4 class="mt-3 mb-3">Technical officer's Tickets</h4>
                 
      
                  <table class="table table-bordered mt-3 mb-3">
                    <thead>
                      <tr>
                        <th class="text-center">Technical officer</th>
                        <th class="text-center">Received Tickets</th>
                        <th class="text-center">View Tickets</th>
                        <th class="text-center">Progress Tikets</th>
                        <th class="text-center">Finish Tikets</th>
                        <th class="text-center">Total</th>
                      </tr>
                    </thead>
                    <tbody>
      
                      @foreach ($data['tecnical_officer'] as $key=>$tecnical_officer)
                      
                     
                      <tr>
                        <td class="">{{$tecnical_officer->profile_first_name.' '.$tecnical_officer->profile_last_name }}</td>
                        <td class="text-center">{{TicketsController::viewtickets_received($tecnical_officer->profile_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::viewtickets_view($tecnical_officer->profile_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::viewtickets_pending($tecnical_officer->profile_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::viewtickets_finish($tecnical_officer->profile_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::viewtickets_total($tecnical_officer->profile_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                      </tr>
      
                      @endforeach
                     
                    </tbody>
                  </table>
      
                </div>
            </div>
        </div>
      </section>
      
      
      <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
      
                  <h4 class="mt-3 mb-3">Organization Tickets</h4>
                 
      
                  <table class="table table-bordered mt-3 mb-3">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th class="text-center">Organization Name</th>
                        <th class="text-center">Received Tickets</th>
                        <th class="text-center">View Tickets</th>
                        <th class="text-center">Progress Tikets</th>
                        <th class="text-center">Finish Tikets</th>
                        <th class="text-center">Total</th>
                      </tr>
                    </thead>
                    <tbody>
      
                      @foreach ($data['subsidiaries'] as $key=>$subsidiaries)
                      
                     
                      <tr>
                        <th class="text-center"> {{$key+ 1}}</th>
                        <td class="">{{$subsidiaries->subsidiaries_name}}</td>
                        <td class="text-center">{{TicketsController::org_viewtickets_received($subsidiaries->subsidiaries_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::org_viewtickets_view($subsidiaries->subsidiaries_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::org_viewtickets_pending($subsidiaries->subsidiaries_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::org_viewtickets_finish($subsidiaries->subsidiaries_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                        <td class="text-center">{{TicketsController::org_total($subsidiaries->subsidiaries_id,date('Y-m-d 00:00:00', strtotime(Carbon::now()->subDay(7))),Carbon::now()->addDay(1))}}</td>
                      </tr>
      
                      @endforeach
                     
                    </tbody>
                  </table>
      
                </div>
            </div>
        </div>
      </section>
      
      
      



        <section class="section dashboard">
          <!-- Recent Sales -->
          <div class="col-12">
              <div class="card recent-sales overflow-auto">
      
                  <div class="card-body">

                    <h4 class="mt-3 mb-3">All Tickets</h4>


                    <table class="table table-bordered mt-2">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Ticket Number</th>
                            <th>User</th>
                            <th>Assing</th>
                            <th>Target Date</th>                            
                            <th>Organization</th>
                            <th>Status</th>
                         
                            
                          </tr>
                        </thead>
                        <tbody>

                        
                          @foreach ($data['ticket'] as $key=>$ticket)

                          <tr   @if($ticket->ticket_status=='Finish') class="bg-success text-light" @endif>
                            <td>{{$key + 1}}</td>
                            <td>{{date('Y-m-d', strtotime($ticket->ticket_date_time))}}</td>
                            <td><a href="/oneTicket/{{$ticket->tickets_number }}" target="_blank" @if($ticket->ticket_status=='Finish') style="color: white;" class="text-light text-decoration-none" @endif>{{$ticket->tickets_number }}</td>
                              <td>{{$ticket->ticket_user_name }}</td>
                            <td>{{TicketsController::tiket_asingname($ticket->ticket_owner)}}</td>
                            <td>
                               @if (!empty($ticket->ticket_target_finish_datetime))
                              <p id="demo"></p></td>

                              <script>
                                var countDownDate = new Date('<?php echo $ticket->ticket_target_finish_datetime  ?>');
                                var x = setInterval(function() {
                                  var now = new Date().getTime();
                                  var distance =countDownDate - now ;
                                  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                                  + minutes + "m " + seconds + "s ";
                                  if (distance < 0) {
                                    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                                  + minutes + "m " + seconds + "s ";
                                  }
                                }, 1000);
                                </script>
                              @else  
                                                             
                            @endif 
                            <td>{{$ticket->subsidiaries_name }}</td>
                            <td @if($ticket->ticket_status=='Finish') class="text-light" @endif>{{$ticket->ticket_status }}</td>
                          </tr>
                          @endforeach
                        
                          
                         
                          
                        </tbody>
                      </table>
                </div>
               </div>

            </div>
        </div>
 




