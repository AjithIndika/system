<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#newone" >New {{  $data['title']  }}</button>

            <h5 class="card-title">Subsidiaries <span>  </span></h5>



            <div class="@error('job_descriptions_name') is-invalid @enderror"></div>




            <table class="table table-borderless datatable">
              <thead>
                <tr>

                  <th scope="col">#</th>
                  <th scope="col">Department</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1 ?>
                @foreach ($data['JobDescription'] as $JobDescription)


                <tr>
                  <th scope="row"> {{ $i++ }}</th>
                  <td>{{ $JobDescription->job_descriptions_name}}</td>
                  <td>

                    @if (!empty( $JobDescription->job_descriptions_note))
                    <button type="button" class="btn btn-success mt-2"  data-toggle="modal" data-target="#view{{ $JobDescription->job_descriptions_id }}"><i class="ri-eye-line"></i></button>
                    <button type="button" class="btn btn-info mt-2"  data-toggle="modal" data-target="#remove{{ $JobDescription->job_descriptions_id }}"><i class="ri-delete-bin-line"></i></button>
                    @else
                    <button type="button" class="btn btn-info mt-2"  data-toggle="modal" data-target="#uplode{{ $JobDescription->job_descriptions_id }}"><i class="ri-upload-2-line"></i></button>

                    @endif



                <!--    <button type="button" class="btn btn-danger mt-2"  data-toggle="modal" data-target="#editsbu{{ $JobDescription->job_descriptions_id }}"><i class="ri-edit-box-line"></i></button> !---->

                </td>

                </tr>







    <!---------- view !------------->
    <!-- The Modal -->
    <div class="modal fade" id="view{{ $JobDescription->job_descriptions_id }}">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">View of {{ $JobDescription->job_descriptions_name}}</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <iframe src="/jds_uplode/{{$JobDescription->job_descriptions_note}}" class="col" height="800px">
                </iframe>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>




    <!---------- Image Remove !------------->
    <!-- The Modal -->
    <div class="modal fade" id="remove{{ $JobDescription->job_descriptions_id }}">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Did you need to remove  {{ $JobDescription->job_descriptions_name}} Pdf ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form action="/jd_image_remove" method="POST">
                    @csrf

                    <input type="hidden" value="{{ $JobDescription->job_descriptions_id}}" name="job_descriptions_id">
                    <input type="hidden" value="{{ $JobDescription->job_descriptions_note}}" name="job_descriptions_note">
                    <input type="hidden" value="{{ $JobDescription->job_descriptions_name}}" name="job_descriptions_name">
                    <input type="submit" value="Yes Remove It"  class="btn btn-danger">
                </form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>



    <!---------- Image uplode !------------->
    <!-- The Modal -->
    <div class="modal fade" id="uplode{{ $JobDescription->job_descriptions_id }}">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Did you need to uplode  {{ $JobDescription->job_descriptions_name}} Pdf ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form action="/jd_image_uplode" enctype="multipart/form-data" method="POST">
                    @csrf

                    <input type="hidden" value="{{ $JobDescription->job_descriptions_id}}" name="job_descriptions_id">
                    <input type="hidden" value="{{ $JobDescription->job_descriptions_name}}" name="job_descriptions_name">

                    <div class="form-group">
                        <label for="pwd">Document:</label>
                        <input type="file" class="form-control @error('job_descriptions_note') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="job_descriptions_note" required accept="application/pdf">
                      </div>
                    <input type="submit" value="Save PDF"  class="btn btn-success">
                </form>

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
    <div class="modal fade" id="editsbu{{ $JobDescription->job_descriptions_id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit of {{ $JobDescription->job_descriptions_name}}</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="update_JobDescription" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!---
                    <div class="form-group">
                      <label for="email">Image:</label>
                      <input type="file" class="form-control" placeholder="Enter email" id="email" name="subsidiaries_logo" required>
                    </div>
                    !----->
                    <div class="form-group">
                      <label for="pwd">Name:</label>
                      <input type="text" class="form-control @error('job_descriptions_name') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="job_descriptions_name"  value="{{ $JobDescription->job_descriptions_name}}" required>
                    </div>


                      <input type="hidden" value="{{ $JobDescription->job_descriptions_id }}" name="job_descriptions_id">
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
                <form action="new_jd" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="form-group">
                      <label for="pwd">Name:</label>
                      <input type="text" class="form-control @error('job_descriptions_name') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="job_descriptions_name" required>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Document:</label>
                        <input type="file" class="form-control @error('job_descriptions_note') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="job_descriptions_note" required accept="application/pdf">
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
