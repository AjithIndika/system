<?php 
use App\Http\Controllers\SubsidiariesController;
?>

<section class="section dashboard">
<!-- Recent Sales -->
<div class="col-12">
    <div class="card recent-sales overflow-auto">



      <div class="card-body">

        <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#newone" >New</button>

        <h5 class="card-title">Subsidiaries <span>  </span></h5>


        <div class="@error('subsidiaries_logo') is-invalid @enderror"></div>
        <div class="@error('subsidiaries_name') is-invalid @enderror"></div>
        <div class="@error('subsidiaries_address') is-invalid @enderror"></div>




        <table class="table table-borderless datatable">
          <thead>
            <tr>

              <th scope="col"></th>
              <th scope="col">Name</th>
              <th scope="col">Address</th>
              <th scope="col">Count</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data['sbu_names'] as $sbu_details)


            <tr>
              <th scope="row"><a href="#" data-toggle="modal" data-target="#viewLogo{{ $sbu_details->subsidiaries_id}}">

                @if (!empty($sbu_details->subsidiaries_logo))
                <img src="/sbu_logo/{{ $sbu_details->subsidiaries_logo}}" class="rounded-circle shadow-4-strong shadow-lg p-1 mb-1 bg-white rounded" width="100" height="100" ></a>
                @else
                <img src="/sbu_logo/empty_image/no_photo.png" class="rounded-circle shadow-4-strong shadow-lg p-1 mb-1 bg-white rounded" width="100" height="100" ></a>
                @endif





                    @if (!empty($sbu_details->subsidiaries_logo))
                    <button type="button" class="btn btn-danger mt-1" data-toggle="modal" data-target="#delete-Logo{{ $sbu_details->subsidiaries_id}}"><i class="ri-delete-bin-6-line "></i></button>
                    @else
                    <button type="button" class="btn btn-danger mt-1" data-toggle="modal" data-target="#uplode-Logo{{ $sbu_details->subsidiaries_id}}"> <i class="ri-upload-cloud-fill mt-2"></i></button>
                    @endif






            </th>
              <td>{{ $sbu_details->subsidiaries_name}}</td>
              <td><a href="#" class="text-primary">{{ $sbu_details->subsidiaries_address}}</a> </td>
              <td>{{SubsidiariesController::subdiariscount($sbu_details->subsidiaries_id)}}</td>
              <td> <button type="button" class="btn btn-danger mt-2"  data-toggle="modal" data-target="#editsbu{{ $sbu_details->subsidiaries_id}}"><i class="ri-edit-box-line"></i></button></td>

            </tr>




<!--------- uplode logo !---------->
<!-- The Modal -->
<div class="modal fade" id="uplode-Logo{{ $sbu_details->subsidiaries_id}}">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">D you need to add {{ $sbu_details->subsidiaries_name}} Logo ?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form action="/uplode_sbu_logo" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="email">Image:</label>
                  <input type="file" class="form-control" placeholder="Enter email" id="email" name="subsidiaries_logo" required>
                </div>

            <input type="hidden" name="subsidiaries_id" value="{{ $sbu_details->subsidiaries_id}}">
            <input type="hidden" name="subsidiaries_name" value="{{ $sbu_details->subsidiaries_name}}">

            <button type="submit" class="btn btn-primary">Yes I Need</button>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>


<!--------- deleatlogo !---------->
<!-- The Modal -->
<div class="modal fade" id="delete-Logo{{ $sbu_details->subsidiaries_id}}">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">D you nee to Deleat {{ $sbu_details->subsidiaries_name}} Logo ?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <form action="/delet_sbu_logo" method="post">

          @csrf
          <input type="hidden" name="subsidiaries_id" value="{{ $sbu_details->subsidiaries_id}}">
          <input type="hidden" name="subsidiaries_logo" value="{{ $sbu_details->subsidiaries_logo}}">
          <input type="hidden" name="subsidiaries_name" value="{{ $sbu_details->subsidiaries_name}}">

          <button type="submit" class="btn btn-primary">Yes I Need</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!---------- view logo !------------->
<!-- The Modal -->
<div class="modal fade" id="viewLogo{{ $sbu_details->subsidiaries_id}}">
    <div class="modal-dialog ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Logo of {{ $sbu_details->subsidiaries_name}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <img src="/sbu_logo/{{ $sbu_details->subsidiaries_logo}}" class="rounded-circle shadow-4-strong shadow-lg p-1 mb-1 bg-white rounded" width="250" height="250" >
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>




<!---------- Edit Sbu !------------->
<!-- The Modal -->
<div class="modal fade" id="editsbu{{ $sbu_details->subsidiaries_id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit of {{ $sbu_details->subsidiaries_name}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="/edit_subsidiaries" method="POST" enctype="multipart/form-data">
                @csrf

                <!---
                <div class="form-group">
                  <label for="email">Image:</label>
                  <input type="file" class="form-control" placeholder="Enter email" id="email" name="subsidiaries_logo" required>
                </div>
                !----->
                <div class="form-group">
                  <label for="pwd">Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Name" id="pwd" name="subsidiaries_name"  value="{{ $sbu_details->subsidiaries_name}}" required>
                </div>

                <div class="form-group">
                    <label for="pwd">Adderss : </label>
                    <input type="text" class="form-control" placeholder="Enter Address" id="pwd" name="subsidiaries_address" value="{{ $sbu_details->subsidiaries_address}}" required>
                  </div>

                  <div class="form-group">
                    <label for="pwd">Prefix : </label>
                    <input type="text" class="form-control" placeholder="Enter Address" id="pwd" name="prefix" value="{{ $sbu_details->prefix}}" disabled>
                  </div>


                  <input type="hidden" value="{{ $sbu_details->subsidiaries_id}}" name="subsidiaries_id">
               <br> </br>


               <div class="form-group">
                <label for="email">Asset Subsidiarie </label>
              </br>
                <select name="assetsubsidiarie" required class="custom-select col-2">
                    <option>{{ $sbu_details->assetsubsidiarie}}</option>
                    <option>Yes</option>
                    <option>No</option>
                </select>

              </div>



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
          <h5 class="modal-title">New Subsidiaries</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/new_subsidiaries" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="email">Image:</label>
                  <input type="file" class="form-control" placeholder="Enter email" id="email" name="subsidiaries_logo" required>
                </div>

                <div class="form-group">
                  <label for="pwd">Name:</label>
                  <input type="text" class="form-control" placeholder="Enter Name" id="pwd" name="subsidiaries_name" required>
                </div>

                <div class="form-group">
                    <label for="pwd">Adderss : </label>
                    <input type="text" class="form-control" placeholder="Enter Address" id="pwd" name="subsidiaries_address" required>
                  </div>

                  <div class="form-group">
                    <label for="pwd">Prefix : </label>
                    <input type="text" class="form-control" placeholder="Enter Address" id="pwd" name="prefix"  required>
                  </div>


                  <div class="form-group">
                    <label for="email">Asset Subsidiarie </label>
                  </br>
                    <select name="assetsubsidiarie" required class="custom-select col-2">
                        <option>Yes</option>
                        <option>No</option>
                    </select>

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
