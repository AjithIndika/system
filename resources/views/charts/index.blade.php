<?php

use App\Http\Controllers\OrganizationChartController;

?>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">


            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Organatiazion</th>
                    <th scope="col">Setup</th>
                    <th scope="col">View</th>
                    <th scope="col">Edit</th>

                  </tr>
                </thead>
                <tbody>

                    @foreach ($data['subsidiaries'] as $key=>$rows)
                  <tr>
                    <th scope="row">{{$key ++}}</th>
                    <td>{{$rows->subsidiaries_name}}</td>
                    <td>{{ OrganizationChartController::setuporg($rows->subsidiaries_id)}}</td>
                    <td>{{ OrganizationChartController::viewporg($rows->subsidiaries_id)}}</td>
                    <td> {{ OrganizationChartController::editorg($rows->subsidiaries_id)}}</td>                    
                  </tr>







                  <!-- The Modal -->
<div class="modal fade" id="deletorg{{$rows->subsidiaries_id}}">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Do you Need Delet This Organization</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
         <form action="/deletOrganatiazion" method="post">
            @csrf
            <input type="hidden" value="{{$rows->subsidiaries_id}}" name="organization_id">
            <input type="submit" value="Yes Remove it" class="btn btn-secondary">
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

    </div>

</section>
