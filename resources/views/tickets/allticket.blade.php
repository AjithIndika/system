<?php
use App\Http\Controllers\TicketsController;
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" rel="stylesheet">


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>




<table  id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Number</th>
            <th>Organization</th>
            <th>Device</th>
            <th>Request</th>
            <th>User</th>
            <th>R Date</th>
            <th>F Date</th>
            <th>Time to Finish</th>
            <th>Status</th>
            <th>Cost</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data['all']  as $key=>$rows )


        <tr>
            <td>{{$key+1}}</td>
            <td><a href="/oneTicket/{{$rows->tickets_number}}" target="_blank" style="text-decoration: none">{{$rows->tickets_number}}</a></td>
            <td>{{$rows->subsidiaries_name}}</td>
            <td>{{$rows->equpment_name}}</td>
            <td>{{$rows->issues_name}}</td>
            <td>{{$rows->ticket_user_name}}</td>
            <td title="{{date('H:m a', strtotime($rows->ticket_date_time))}}">{{date('Y-m-d', strtotime($rows->ticket_date_time))}}</td>
            <td title="@if (!empty($rows->ticket_finish_datetime))  {{date('H:m a', strtotime($rows->ticket_finish_datetime))}} @endif">
                @if (!empty($rows->ticket_finish_datetime))
                {{date('Y-m-d', strtotime($rows->ticket_finish_datetime))}}
                  @endif
            </td>
            <td>{{TicketsController::timecaluculate($rows->ticket_date_time,$rows->ticket_finish_datetime)}}</td>
            <td>{{$rows->ticket_status}}</td>
            <td>{{$rows->ticket_invoice_amount}}</td>


        </tr>

        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Number</th>
            <th>Organization</th>
            <th>Device</th>
            <th>Request</th>
            <th>User</th>
            <th>R Date</th>
            <th>F Date</th>
            <th>Time to Finish</th>
            <th>Status</th>
            <th>Cost</th>
           
        </tr>
    </tfoot>
</table>

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
