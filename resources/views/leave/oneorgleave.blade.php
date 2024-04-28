<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<?php
use App\Http\Controllers\LeaveRequstController;
?>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12"  id="dvContainer">
        <div class="card recent-sales overflow-auto p-2">




            <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th>ORG</th>
                    @foreach ($data['leaverule'] as $leaverule)
                        <th >{{$leaverule->leave_types_name}} </br>
                            <span class="badge badge-pill badge-success">Approved</span>
                            <span class="badge badge-pill badge-info">Pending</span>
                            <span class="badge badge-pill badge-danger">Rejected</span>
                        </th>
                        @endforeach
                  </tr>
                </thead>
                <tbody>
               @foreach ($data['profile'] as $key=> $profile)

               <tr>
                <td> {{ $key + 1}}</td>
                <td title="{{$profile->profile_Full_name}}"><a href="/view-profile/{{$profile->profile_sug}}" title="Go to view Profile"><i class="bi bi-person-circle text-success"></i></a> {{$profile->profile_first_name .' '.$profile->profile_last_name  }} </td>
                @foreach ($data['leaverule'] as $leaverule)
                <td>
                    <span class="badge badge-pill badge-success">{{LeaveRequstController::reportsonesbu($data['date'],$profile->profile_id,$leaverule->leave_types_id,'Approved')}}</span>
                    <span class="badge badge-pill badge-info">{{LeaveRequstController::reportsonesbu($data['date'],$profile->profile_id,$leaverule->leave_types_id,'Pending')}}</span>
                    <span class="badge badge-pill badge-danger">{{LeaveRequstController::reportsonesbu($data['date'],$profile->profile_id,$leaverule->leave_types_id,'Rejected')}}</span>
                </td>
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

