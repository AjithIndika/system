

<?php
use App\Http\Controllers\TicketsController;
?>




<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            <h5 class="card-title">{{$data['title']}} <span>  </span></h5>
            <div class="@error('profile_Full_name') is-invalid @enderror"></div>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Date</th>
                  <th scope="col">Number</th>
                  <th scope="col">Report By</th>
                  <th scope="col">Device / Error</th>
                  <th scope="col">Total</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1 ?>
                @foreach ($data['ticketDetails'] as $ticketDetails)


                    <tr>
                        <th scope="row">{{ $i++}}</th>
                        <td>{{$ticketDetails->ticket_date_time}}</td>
                        <td><a href="oneTicket/{{$ticketDetails->tickets_number}}" target="_blank">{{$ticketDetails->tickets_number}}</a></td>
                        <td>{{$ticketDetails->ticket_user_name}}</td>
                        <td>{{$ticketDetails->equpment_name}} / {{$ticketDetails->issues_name}}</td>
                        <td>{{$ticketDetails->ticket_invoice_amount}}</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invoice{{$ticketDetails->tickets_id}}">
                            Invoice Issue
                          </button>
                        </td>
                    </tr>


                    <!-- The Modal -->
<div class="modal fade" id="invoice{{$ticketDetails->tickets_id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Invoice dvv{{$ticketDetails->tickets_number}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form action="/invoicenumberupdate" method="post">
                @csrf
                <div class="form-group">
                  <label for="email">Invoice Number:</label>
                  <input type="text" class="form-control" placeholder="Enter Invoice Number" id="email" value="{{$ticketDetails->ticket_invoice_number}}" name="ticket_invoice_number" required>
                </div>

                <input type="hidden" value="{{$ticketDetails->tickets_id}}" name="tickets_id">
                <input type="hidden" value="{{$ticketDetails->tickets_id}}" name="daily_tasks_status">
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
 @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div><!-- End Recent Sales -->





    </section>


