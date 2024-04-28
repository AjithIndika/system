

<?php
use App\Http\Controllers\TicketsController;
?>




<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            <h5 class="card-title">Subsidiaries <span>  </span></h5>
            <div class="@error('profile_Full_name') is-invalid @enderror"></div>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Date</th>
                  <th scope="col">Number</th>
                  <th scope="col">Report By</th>
                  <th scope="col">Device / Error</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1 ?>
                @foreach ($data['daily_tasks_Details'] as $daily_tasks_Details)


                    <tr>
                        <th scope="row">{{ $i++}}</th>
                        <td>{{$daily_tasks_Details->daily_tasks_date_time}}</td>
                        <td>{{$daily_tasks_Details->daily_tasks_number}}</td>
                        <td>{{$daily_tasks_Details->daily_tasks_user_name}}</td>
                        <td>{{$daily_tasks_Details->equpment_name}} / {{$daily_tasks_Details->issues_name}}</td>
                        <td><a href="/oneDailyTask/{{$daily_tasks_Details->daily_tasks_number}}" ><button type="button" class="btn btn-success">Edit</button></a></td>

                    </tr>



             @endforeach




              </tbody>
            </table>

          </div>

        </div>
      </div><!-- End Recent Sales -->





    </section>


