
<?php
use App\Http\Controllers\OnbordController; ?>

<button class="btns" data-toggle="modal" data-target="#onbord">Register On board notification</button>




<table class="table table-bordered mt-5">
    <thead>
      <tr>
        <th>#</th>
        <th>Send to</th>
        <th>Email</th>
        <th>Note</th>
        <th></th>
      </tr>
    </thead>
    <tbody>


        <?php  
          $onbords= DB::table('onbords')->select('*')
        ->join('job_working','job_working.job_working_profile_id','=','onbords.onbords_job_working_profile_id')
        ->join('profiles','profiles.profile_id','=','job_working.profile_id')
        ->where('onbords.onbords_profile_id','=',$profile[0]->profile_id)
        ->get();
        ?>

@foreach($onbords as $key=> $onbords)
   
    <tr>
    <td>{{$key + 1 }}</td>
    <td>{{$onbords->profile_first_name.'   '.$onbords->profile_last_name }}</td>
    <td>{{$onbords->profile_job_work_email }}</td>
    <td>{!! html_entity_decode($onbords->onbords_requst) !!}</td>
    <td><button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#myModal{{$onbords->onbord_id}}">Remove</button></td>
  </tr>




  <div class="modal fade" id="myModal{{$onbords->onbord_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Do you need to Delete this?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          
        <form  method="POST" action="/removeonbord">

            @csrf
         <input type="hidden" name="onbord_id" value="{{$onbords->onbord_id}}">        
         <input type="hidden" name="profile_sug" value="{{$profile[0]->profile_sug}}">
        <button type="submit" class="btn btn-danger" >Yes Remove</button>
  
  
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



<!-- The Modal -->
<div class="modal fade" id="onbord">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Register on board notification.</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
        
            <form action="/newonbord" method="POST">
                @csrf

                <div class="row">
                    <div class="col"> 

                        <div class="form-group">
                            <label for="email">Notification Receive:</label></br>
                            <select class="custom-select  @error('onbords_job_working_profile_id') is-invalid @enderror onbords_job_working_profile_id"  name="onbords_job_working_profile_id" required style="width:100%">
                                @foreach ($data['workingprofile'] as $workingprofile)
                                <option value="{{$workingprofile->job_working_profile_id}}">{{$workingprofile->profile_first_name}}  {{$workingprofile->profile_last_name}} <em> {{$workingprofile->profile_job_work_email}}</em></option>
                                @endforeach
    
                            </select>
                            @error('onbords_job_working_profile_id')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="email">Assigning a Jobs</label>
                        <textarea class="form-control  ckeditor @error('onbords_requst') is-invalid @enderror" name="onbords_requst" required rows="5" cols="3" id="myInput" onkeyup="getInputValue();">{{ old('onbords_requst') }}</textarea>
                        @error('onbords_requst')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>
                </div>


                <input type="hidden" name="onbords_date" value="{{$profile[0]->profile_job_join_date }}">
                <input type="hidden" name="onbords_profile_id" value="{{$profile[0]->profile_id }}">
                <input type="hidden" name="profile_sug" value="{{$profile[0]->profile_sug }}">

                <button type="submit" class="btn btn-success" >Save</button>


            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>





  <script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>


  <script>

       $(document).ready(function() {
        $('.onbords_job_working_profile_id').select2();
    });


 </script>

 <style>
.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 40px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
 </style>



  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  

<style type="text/css">

.btns {
  background-color: #ddd;
  border: none;
  color: black;
  padding: 8px 8px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  transition: 0.3s;
  border-radius: 3px;
}

.btns:hover {
  background-color: #3e8e41;
  color: white;
}
</style>
