<?php 
use App\Http\Controllers\DepartmentController;
?>
<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#newone" >New {{  $data['title']  }}</button>

            <h5 class="card-title">Subsidiaries <span>  </span></h5>



            <div class="@error('department_name') is-invalid @enderror"></div>




            <table class="table table-borderless datatable">
              <thead>
                <tr>

                  <th scope="col">#</th>
                  <th scope="col">Department</th>
                  <th scope="col">Count</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1 ?>
                @foreach ($data['departments'] as $department_details)


                <tr>
                  <th scope="row"> {{$i++}}</th>
                  <td>{{ $department_details->department_name}}</td>
                  <td>{{ DepartmentController::count($department_details->department_id )}}</td>
                  <td> <button type="button" class="btn btn-danger mt-2"  data-toggle="modal" data-target="#editsbu{{ $department_details->department_id}}"><i class="ri-edit-box-line"></i></button></td>

                </tr>







    <!---------- Edit Sbu !------------->
    <!-- The Modal -->
    <div class="modal fade" id="editsbu{{ $department_details->department_id}}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit of {{ $department_details->department_name}}</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="edit_department" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!---
                    <div class="form-group">
                      <label for="email">Image:</label>
                      <input type="file" class="form-control" placeholder="Enter email" id="email" name="subsidiaries_logo" required>
                    </div>
                    !----->
                    <div class="form-group">
                      <label for="pwd">Name:</label>
                      <input type="text" class="form-control @error('department_name') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="department_name"  value="{{ $department_details->department_name}}" required>
                    </div>


                      <input type="hidden" value="{{ $department_details->department_id}}" name="department_id">
                   <br> </br>


                    <button type="submit" class="btn btn-primary">Submit</button>
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
      </div><!-- End Recent Sales -->





    <!---- new item crate modale !---------->

      <div class="modal fade" id="newone" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New {{ $data['title'] }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="new_department" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                      <label for="pwd">Name:</label>
                      <input type="text" class="form-control @error('department_name') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="department_name" required>
                    </div>



                    </br>


                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
             </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div><!-- End Large Modal-->


    </section>
