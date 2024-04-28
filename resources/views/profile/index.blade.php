<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

<!---
                <a href="/new-profile" class="text-white mt-2"> <i class="bi bi-file-earmark-plus text-success mt-5" style="font-size: 1.5rem;"> New {{  $data['title']  }} </i>
                </a>
!------>

            <h5 class="card-title"> <span>  </span></h5>
            <div class="@error('profile_Full_name') is-invalid @enderror"></div>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">
                  </th>
                  <th scope="col">Number</th>
                  <th scope="col">Name</th>
                <!---  <th scope="col"></th> !------>
                </tr>
              </thead>
              <tbody>
                <?php $i=1 ?>
                @foreach ($data['profile'] as $profile)
                    <tr>
                  <th scope="row">
                    @if (!empty($profile->profile_image))
                    <img src="/profile-image/{{ $profile->profile_image}}" class="rounded-circle shadow-4-strong shadow-lg p-1 mb-1 bg-white rounded" width="50" height="50" ></a>
                    @else
                   <img src="/sbu_logo/empty_image/no_photo.png" class="rounded-circle shadow-4-strong shadow-lg p-1 mb-1 bg-white rounded" width="50" height="50" ></a>
                   @endif
                  </th>
                  <td>{{ $profile->profile_number}}</td>
                  <td><a href="/view-profile/{{ $profile->profile_sug }}">{{ $profile->profile_Full_name}} </a></td>
                 <!--- <td> <a href="/view-profile/{{ $profile->profile_sug }}"><button type="button" class="btn btn-danger mt-2"  ><i class="ri-edit-box-line"></i></button></a></td> !---->

                </tr>
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
                <form action="new_designations" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="pwd">Name:</label>
                      <input type="text" class="form-control @error('profile_Full_name') is-invalid @enderror" placeholder="Enter Name" id="pwd" name="profile_Full_name" required>
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
