
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

                    @foreach ( $data['office_locations'] as $office_locations)
                    <tr>
                        <td>{{$office_locations->office_locations_name}}</td>
                        <td>
                           <div class="col">{{ReportAllController::officeUsers($office_locations->office_locations_id) }}</div>
                        </td>
                      </tr>


                    @endforeach
                </tbody>
              </table>







          </div>
        </div>
      </div><!-- End Large Modal-->


    </section>

