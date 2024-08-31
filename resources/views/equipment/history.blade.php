


<?php

use App\Http\Controllers\TicketsController;


$equipments = DB::table('equipment_histories')
    ->join('equipment', 'equipment.equipment_id', '=', 'equipment_histories.equipment_histories_equipment_number')
    ->join('equpment_types', 'equpment_types.equpment_types_id', '=', 'equipment.equipment_type')
    ->join('profiles', 'profiles.profile_id', '=', 'equipment_histories.equipment_user')
    ->join('subsidiaries', 'subsidiaries.subsidiaries_id', '=', 'equipment.equipment_organization')
    ->orderBy('equipment.equipment_number', 'asc')
    ->where('equipment_histories.equipment_histories_equipment_number', '=', $equipment->equipment_id)
   // ->where('equipment_histories.equipment_user', '=', $profile[0]->profile_id)
    ->get();
?>


<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Using By</th>
            <th>From </th>
            <th>To</th>
            <th>All Date</th>
            <th>Reson to remove</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($equipments as $key=>$row)


        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$row->profile_first_name}}  {{$row->profile_last_name}}</td>
            <td>{{ \Carbon\Carbon::parse($row->equipment_histories_issued_day)->format('Y-m-d')}}</td>
            <td>{{ \Carbon\Carbon::parse($row->equipment_histories_remove_date)->format('Y-m-d') }}</td>
            <td>{{TicketsController::timecaluculate($row->equipment_histories_issued_day, $row->equipment_histories_remove_date)}}</td>
            <td>$320,800</td>
        </tr>

        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Using By</th>
            <th>From </th>
            <th>To</th>
            <th>All Date</th>
            <th>Reson to remove</th>
        </tr>
    </tfoot>
</table>


<script type="text/javascript">
    new DataTable('#example');
</script>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

