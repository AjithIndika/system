<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<?php
use App\Http\Controllers\LeaveRequstController;
?>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto p-2">




            <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th>ORG</th>
                    @foreach ($data['leaverule'] as $leaverule)
                        <th>{{$leaverule->leave_types_name}}</th>
                        @endforeach
                  </tr>
                </thead>
                <tbody>

                    @foreach ($data['allorg'] as $key=>$allorg)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td><a href="/subdiaryleavereport/{{$allorg->subsidiaries_id}}/{{$data['year']}}">{{$allorg->subsidiaries_name}}</a></td>
                    @foreach ($data['leaverule'] as $leaverule)
                    <td>{{LeaveRequstController::reportsone($allorg->subsidiaries_id,$leaverule->leave_types_id,$data['year'])}}</td>
                    @endforeach
                  </tr>
                  @endforeach

                </tbody>
              </table>







        </div>
    </div>
</section>

<script>
    new DataTable('#example', {
        columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            },
            {
                targets: [1],
                orderData: [1, 0]
            },
            {
                targets: [4],
                orderData: [4, 0]
            }
        ]
    });
</script>
