
<?php
use App\Http\Controllers\ReportAllController;



?>


<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">

            <table class="table">
                <thead>
                  <tr>
                    <th>Busnuss Name</th>
                    <th>Department</th>

                  </tr>
                </thead>
                <tbody>

                    @foreach ( $data['subsidiaries'] as $subsidiaries)
                    <tr>
                        <td>{{$subsidiaries->subsidiaries_name}}</td>
                        <td>

                            @foreach ($data['departments'] as $departments)
                            <div class="row border  mb-1">
                            <div class="col border ">{{$departments->department_name}}</div>
                            <div class="col border ">

                                {{ReportAllController::subdepart($subsidiaries->subsidiaries_id,$departments->department_id)}}
                            </div>
                        </div>
                            @endforeach



                        </td>

                      </tr>


                    @endforeach
                </tbody>
              </table>







          </div>
        </div>
      </div><!-- End Large Modal-->


    </section>

