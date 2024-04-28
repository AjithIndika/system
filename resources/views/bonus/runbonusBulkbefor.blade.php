
<?php
use App\Http\Controllers\BonusController;
?>
<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">

            <h4 class="mt-2 mb-2"></h4>


            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Total Basic Salary</th>
                        <th>Allowance</th>
                        <th>Incresment</th>
                        <th>Total</th>
                        <th>Bounece %</th>
                        <th>Bounece </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ( $data['allprofile'] as $key => $allprofile )
                    <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $allprofile->profile_Full_name}}</td>
                    <td>{{ $allprofile->subsidiaries_name}}</td>
                    <td>{{ BonusController::BasicSalary($allprofile->profile_id)}}</td>
                    <td>{{ BonusController::bonace($allprofile->profile_id)}}</td>
                    <td>{{ BonusController::incresment($allprofile->profile_id)}}</td>
                    <td> {{ BonusController::totalsalary($allprofile->profile_id)}}</td>
                    <td> {{$data['bounes']}}</td>
                    <td>{{ BonusController::bounescount($allprofile->profile_id,$data['bounes'])}}</td>
                </tr>
                    @endforeach


                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Total Basic Salary</th>
                        <th>Allowance</th>
                        <th>Incresment</th>
                        <th>Total</th>
                        <th>Bounece %</th>
                        <th>Bounece </th>
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









