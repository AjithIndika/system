<?php
use Illuminate\Support\Carbon;
use App\Http\Controllers\TicketTimelineController;
?>

<style>

    .success-all{
        background: rgb(238,231,141);
        background: linear-gradient(90deg, rgba(238,231,141,1) 5%, rgba(133,180,75,0.41220238095238093) 35%, rgba(133,180,75,0.5494572829131652) 66%, rgba(216,219,78,0.8463760504201681) 90%);
        text-decoration: none;
    }



    .error-all{
        background: rgb(232,63,63);
        background: linear-gradient(90deg, rgba(232,63,63,0.896796218487395) 5%, rgba(133,180,75,0.41220238095238093) 35%, rgba(133,180,75,0.5494572829131652) 66%, rgba(232,63,63,0.8463760504201681) 90%);
        color: rgb(253, 253, 255);
        text-decoration: none;

}

.text-decoration-none{
    color: rgb(253, 253, 255);
}

.text-decoration-none:hover{
    color: rgb(255, 255, 255);
}



</style>





<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

            &nbsp;   &nbsp; &nbsp;   &nbsp;   <a href="{{ redirect()->back()->getTargetUrl() }}" class="m-2 text-decoration-none">GO Back</a>

          <div class="card-body">

            <h4 class="mt-2 mb-2"></h4>


            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ticket Number</th>
                        <th>Invoice Number</th>
                        <th>Report By</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Finish Date</th>
                        <th>Time </th>

                    </tr>
                </thead>
                <tbody>


                    @foreach ( $data['tickets'] as $key=>$tickets )
                    <tr   @if (!empty($tickets->ticket_finish_datetime))  class="success-all" @else   class="error-all"   @endif>
                    <td>{{$key + 1}}</td>
                    <td><a href="/oneTicket/{{$tickets->tickets_number}}" target="_blank" class="text-decoration-none" >{{$tickets->tickets_number}}</a></td>
                    <td>{{ $tickets->ticket_invoice_number}}</td>
                    <td>{{ $tickets->ticket_user_name}}</td>
                    <td>{{ $tickets->ticket_status}}</td>
                    <td>{{ $tickets->ticket_date_time}}</td>
                    <td>{{ $tickets->ticket_finish_datetime}}   <td>


                        @if (!empty($tickets->ticket_finish_datetime))
                        <label >  {{  Carbon::parse($tickets->ticket_finish_datetime)->diff( Carbon::parse($tickets->ticket_date_time))->format('D:%d  %H:%I:%S') }}</label>
                        @else
                       <label > {{  Carbon::parse($tickets->ticket_date_time)->diff( Carbon::parse(date('y-m-d H:m:s')))->format('D:%d  %H:%I:%S') }}</label>
                        @endif
                       </td>

                </tr>
                @endforeach



                @foreach ($data['dailywork']  as $keycount=>$dtickets )
                <tr  @if (!empty($dtickets->daily_tasks_number))  class="success-all" @else   class="error-all"   @endif>
                <td>{{$keycount + 1}}</td>
                <td><a href="/oneTicket/{{$dtickets->daily_tasks_number}}" target="_blank" class="text-decoration-none" >{{$dtickets->daily_tasks_number}}</a></td>
                <td>{{ $dtickets->daily_tasks_invoice_number}}</td>
                <td>{{ $dtickets->daily_tasks_user_name}}</td>
                <td>{{ $dtickets->daily_tasks_status}}</td>
                <td>{{ $dtickets->daily_tasks_date_time}}</td>
                <td>{{ $dtickets->daily_tasks_finish_datetime}}</td>
                <td>

                    @if (!empty($dtickets->daily_tasks_finish_datetime))
                    <label >  {{  Carbon::parse($dtickets->daily_tasks_finish_datetime)->diff( Carbon::parse($dtickets->daily_tasks_date_time))->format('D:%d  %H:%I:%S') }}</label>
                    @else
                   <label > {{  Carbon::parse(date('y-m-d H:m:s'))->diff( Carbon::parse($dtickets->daily_tasks_date_time))->format('D:%d  %H:%I:%S') }}</label>
                    @endif
                   </td>

            </tr>
            @endforeach








                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Ticket Number</th>
                        <th>Invoice Number</th>
                        <th>Report By</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Finish Date</th>
                        <th>Time </th>

                    </tr>
                </tfoot>
            </table>

          </div>
        </div>
    </div>
</section>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>


<script>

    $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>













