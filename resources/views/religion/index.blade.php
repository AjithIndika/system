

<?php 
use App\Http\Controllers\ReligionController;
?>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <button type="button" class="btn btn-success mt-2 mb-2" data-toggle="modal" data-target="#newreligion" > New {{  $data['title']  }}</button>

            <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Religion Name</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($data['religions'] as $religions )


                  <tr>
                    <td></td>
                    <td>{{$religions->religion_name}}</td>
                    <td>{{ReligionController::count($religions->religion_id)}}</td>
                    <td><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#religionedit{{$religions->religion_id}}">Edit</button></td>
                  </tr>





<!-- The Modal -->
<div class="modal fade" id="religionedit{{$religions->religion_id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit {{$religions->religion_name}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">


            <form action="/edit-religon" method="POST">
                @csrf

                <div class="form-group">
                  <label for="email">{{  $data['title']  }}:</label>
                  <input type="text" class="form-control @error('religion_name') is-invalid @enderror" value="{{$religions->religion_name}}" name="religion_name" id="email" required>
                  @error('religion_name')<div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <input type="hidden" name="religion_id" value="{{$religions->religion_id}}">

                <button type="submit" class="btn btn-primary">Save</button>
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
      </div><!-- End Large Modal-->


    </section>



<!-- The Modal -->
<div class="modal fade" id="newreligion">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New {{  $data['title']  }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">


            <form action="/new-religon" method="POST">
                @csrf

                <div class="form-group">
                  <label for="email">{{  $data['title']  }}:</label>
                  <input type="text" class="form-control @error('religion_name') is-invalid @enderror" placeholder="{{  $data['title']  }}" name="religion_name" id="email" required>
                  @error('religion_name')<div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
              </form>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

