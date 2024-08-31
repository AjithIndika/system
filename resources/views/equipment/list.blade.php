
<?php
use App\Http\Controllers\EquipmentController;
?>

<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">



          </br>


            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Control Number</th>
                        <th>Organization</th>
                        <th>Responsible Person</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

            @foreach ($data['equipment'] as $key=>$equipment )

            <tr>
                <td>{{$key +1}}</td>
                <td>{{$equipment->equipment_number}}</td>
                <td>{{$equipment->subsidiaries_name}}</td>
                <td>{{EquipmentController::responsiblePerson($equipment->equipment_user) }}</td>
                <td>{{ EquipmentController::status($equipment->equipment_status)}}</td>
                <td><a href="equpment/{{$equipment->equipment_number}}"><i class="fa fa-file-o fa-2x text-success" aria-hidden="true"></i></a></td>
            </tr>

            @endforeach






                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Control Number</th>
                        <th>Organization</th>
                        <th>Responsible Person</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>

          </div>
        </div>
    </div>
</section>









  <script>
    $('select').selectpicker();
</script>


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


