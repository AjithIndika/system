

<?php 
use App\Http\Controllers\TraningDevelopController;
use Carbon\Carbon;
?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Poppins:400,500,600,700" rel="stylesheet"> 
<section class="experience pt-100 pb-100" id="experience">
		<div class="container">

         <div class="m-3">

        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newtrining"><i
                class="fa fa-plus" aria-hidden="true"></i></button>
        <button type="button" class="btn btn-outline-secondary"  data-toggle="modal" data-target="#traningList"><i class="fa fa-list" aria-hidden="true"></i></button>
    </div>


			<div class="row">
				<div class="col-xl-8 mx-auto text-center">
					<div class="section-title">
						<h4>Training and development</h4>
						<p>__________________________________-</p>
					</div>
				</div>
			</div>
			<div class="row">
               <div class="col-xl-12">
                  <ul class="timeline-list">
                    
                    {{TraningDevelopController::training($profile[0]->profile_id)}}
                     
                    
                  </ul>
               </div>
            </div>
		</div>
	  </section>






<!-- The Modal -->
<div class="modal fade" id="newtrining">
  <div class="modal-dialog modal-xl" >
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Training & Development</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        


        <form action="/new_traning_divelopment" method="POST">
                    @csrf
            <div class="form-group">
                <label for="email">Trained subject</label>
                <input type="text" class="form-control" placeholder="Trained subject"  name="trained_subject" id="email" >
            </div>
            
            
               
            
            <div class="row">

			
				<div class="col">
					<div class="form-group">
						<label for="pwd">Training Start</label>
						<input type="date" class="form-control" placeholder="Training Start" id="startDate" name="training_start" onkeypress="myFunction()">
					</div>
				</div>

				<div class="col">
					<div class="form-group">
						<label for="pwd">Training End</label>
						<input type="date" class="form-control" placeholder="Training End" id="endtDate" name="training_end" onkeypress="myFunction()">
					</div>
				</div>

            </div>


			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="email">Description</label>
						<textarea class="form-control ckeditor  @error('training_description') is-invalid @enderror" name="training_description"
							required rows="5" cols="3" required></textarea>
						@error('training_description')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
			</div>


			<input type="hidden" name="profile_sug" value="{{$profile[0]->profile_sug}}">
			<input type="hidden" name="traning_develops_profile_id" value="{{$profile[0]->profile_id}}">

			
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







<!-- The Modal -->
<div class="modal fade " id="traningList">
	<div class="modal-dialog modal-xl">
	  <div class="modal-content">
  
		<!-- Modal Header -->
		<div class="modal-header">
		  <h4 class="modal-title">Training and development List</h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
  
		<!-- Modal body -->
		<div class="modal-body">
		  
			<table class="table table-bordered">
				<thead>
				  <tr>
					<th>#</th>
					<th>Trained subject</th>
					<th>Time</th>
					<th></th>
				  </tr>
				</thead>
				<tbody>

				<?php
					  $data= DB::table('traning_develops')
                        ->select('*')
                        ->where('traning_develops_profile_id','=',$profile[0]->profile_id)
                        ->orderBy('traning_develops', 'DESC')->get();
                        $count=1;
						 ?>

						 @foreach ( $data as $row)

						 <tr>
							<td>{{$count ++}}</td>
							<td>{{$row->trained_subject}}</td>
							<td>{{$row->training_start.' to '.$row->training_end}}</td>
							<td>
								@if(!empty(Auth::user()->hrAdmin))
								<i class="fa fa-trash" aria-hidden="true" data-toggle="modal" data-target="#delet{{$row->traning_develops}}"></i>
								@endif
							</td>
						  </tr>





                        <!-- The Modal -->
       <div class="modal fade" id="delet{{$row->traning_develops}}">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Do you Nedd to delet this ?</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <form action="/deletetraning" method="post">
            @csrf

            <input type="hidden" value="{{$row->traning_develops}}" name="traning_develops">
            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">

            </br>
            <button type="submit" class="btn btn-outline-success">Yes</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">No</button>
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
  
		<!-- Modal footer -->
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
  
	  </div>
	</div>
  </div>






<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>


      <style>
      .pt-100{
    padding-top:100px;
}
.pb-100{
    padding-bottom:100px;
}
.section-title {
  margin-bottom: 60px;
}
.section-title p {
	color: #777;
	font-size: 16px;
}
.section-title h4 {
	text-transform: capitalize;
	font-size: 40px;
	position: relative;
	padding-bottom: 20px;
	margin-bottom: 20px;
	font-weight: 600;
}
.section-title h4:before {
	position: absolute;
	content: "";
	width: 60px;
	height: 2px;
	background-color: #ff3636;
	bottom: 0;
	left: 50%;
	margin-left: -30px;
}
.section-title h4:after {
	position: absolute;
	background-color: #ff3636;
	content: "";
	width: 10px;
	height: 10px;
	bottom: -4px;
	left: 50%;
	margin-left: -5px;
	border-radius: 50%;
}
ul.timeline-list {
	position: relative;
	margin: 0;
	padding: 0
}
ul.timeline-list:before {
	position: absolute;
	content: "";
	width: 2px;
	height: 100%;
	background-color: #ff3636;
	left: 50%;
	top: 0;
	-webkit-transform: translateX(-50%);
	        transform: translateX(-50%);
}
ul.timeline-list li {
	position: relative;
	clear: both;
	display: table;
}
.timeline_content {
	border: 2px solid #ff3636;
	background-color:#fff
}
ul.timeline-list li .timeline_content {
	width: 45%;
	color: #333;
	padding: 30px;
	float: left;
	text-align: right;
}
ul.timeline-list li:nth-child(2n) .timeline_content {
	float: right;
	text-align: left;
}
.timeline_content h4 {
	font-size: 22px;
	font-weight: 600;
	margin: 10px 0;
}
ul.timeline-list li:before {
	position: absolute;
	content: "";
	width: 25px;
	height: 25px;
	background-color: #ff3636;
	left: 50%;
	top: 50%;
	-webkit-transform: translate(-50%, -50%);
	        transform: translate(-50%, -50%);
	border-radius: 50%;
}
.timeline_content span {
	font-size: 18px;
	font-weight: 500;
	font-family: poppins;
	color: #ff3636;
}
</style>