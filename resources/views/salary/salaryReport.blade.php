<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SubsidiariesController;
use App\Http\Controllers\ProfileController;




?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">





            <table class="table m-2">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Organization</th>
                    <th>Active Employees</th>
                    <th>Monthly Current Cost</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ( $data['organization'] as $key =>$organization)
                  <tr>
                    <td>{{ $key + 1}}</td>
                    <td><em data-toggle="modal" data-target="#organization{{$organization->subsidiaries_id}}">{{$organization->subsidiaries_name}}</em></td>
                    <td>{{SalaryController::organizationCount($organization->subsidiaries_id)}}</td>
                    <td>{{ env('APP_CURRENCY') }}  &nbsp; {{SalaryController::organizationsalarysum($organization->subsidiaries_id)}}</td>
                  </tr>
                  <tr>






            <!--- 2nd option !------->

                <!-- The organization -->
                <div class="modal fade" id="organization{{$organization->subsidiaries_id}}">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">{{$organization->subsidiaries_name}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-1">#</div>
                                <div class="col">Employees Name</div>
                                <div class="col">Basic Salary</div>
                                <div class="col">Allowances</div>
                                <div class="col"></div>
                              </div>

                          {{SalaryController::activeorganizationusers($organization->subsidiaries_id)}}


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



<style>
    /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
.flip-card {
  background-color: transparent;
  width: 300px;
  height: 200px;
  border: 1px solid #f1f1f1;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  font-weight: 900;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #bbb;
  color: black;
}

/* Style the back side */
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}
</style>
