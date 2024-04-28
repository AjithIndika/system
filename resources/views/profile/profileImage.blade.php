

<?php
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\IncresmentController;
?>

 <!--- profile Image Start !---->
<div class="col-sm-2 ">
<!---------
<div class="col mt-2 ">
        <div class="container">
        <img src="@if (!empty( $profile[0]->profile_image))/profile-image/{{ $profile[0]->profile_image}}@else/sbu_logo/{{ $profile[0]->subsidiaries_logo}}@endif " alt="Avatar" class="image" style="width:90%">
        <div class="middle">
            <div class="text mt-1">
                @if (empty($profile[0]->profile_image))
                @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfileImage">
                    <i class="bi bi-cloud-upload"></i>
                </button>
                @endif
                @endif

                @if (!empty( $profile[0]->profile_image))
                @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ProfileImage">
                <i class="bi bi-trash-fill"></i>
                </button>
                @endif
                @endif

            </div>
        </div>


        </div>

!----------->


<style>
.h4-text{
    margin-top: 20px;
    margin-left: 40px
}
</style>



                  <!-- The ProfileImage -->
          <div class="modal" id="ProfileImage">
              <div class="modal-dialog">
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                  <h4 class="modal-title">Profile Image</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <!-- Modal body -->
                  <div class="modal-body">
                      @if (!empty( $profile[0]->profile_image))
                      <form action="/delet_profile_image" method="POST" enctype="multipart/form-data">
                          @csrf

                          <input  type="hidden"  name="profile_image"  value="{{ $profile[0]->profile_image}}">
                          <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                          <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                          <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                          <button type="submit" class="btn btn-success" name="joindetails">Remove It</button>
                  </form>
                  @else

                  <p class="text-danger">
                    Note : jpeg,png,jpg  Files only & Max 2MB only
                  </p>
                  <form action="/uplode_profile_image" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                      <label for="email">Image:</label>
                      <input type="file" class="form-control" placeholder="Profile Image" id="email" name="profile_image" required>
                      </div>
                      <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                      <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                      <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                      <button type="submit" class="btn btn-success" name="joindetails">Save</button>
                    </form>


                  @endif
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
              </div>
              </div>
          </div>


<!--------- ProfileImage-----------!--------->
</div>

</div>


    </div>




