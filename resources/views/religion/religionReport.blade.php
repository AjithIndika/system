<?php
use App\Http\Controllers\ReligionController;

?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <div class="row ">

                @foreach ( $data['religions'] as $religions)
                     <div class="col mt-3 text-center shadow-lg p-3 mb-5 bg-white rounded ml-3 mr-3 border border-success">
                     <h3>   {{$religions->religion_name}}</h3>
                        <div class="mt-1 text-center">
                         <h4> <a href="/religenCount/{{$religions->religion_id}}"> {{ReligionController::religeinCount($religions->religion_id)}}</a> </h4>
                        </div>
                     </div>
                     @endforeach
            </div>








<div class="col mt-3 text-center shadow-lg p-3 mb-5 bg-white rounded ml-1 mr-1 border border-success">
    <div> <th><h4>Organization / Religion</h4></th></div>

            <table class="table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Organization</th>
                        <th>Religion</th>

                      </tr>
                </thead>
                <tbody>
                    @foreach ($data['Organitizon'] as $orkey => $Organitizon )
                  <tr>
                    <td>{{$orkey +1}}</td>
                    <td class="text-left"> {{$Organitizon->subsidiaries_name}}</td>
                    <td>


                        <table class="table">

                            <thead>
                              <tr>
                                @foreach ( $data['religions'] as $rekey => $religions)
                                <th>{{$religions->religion_name}}</th>
                                @endforeach
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                @foreach ( $data['religions'] as $rekey => $religions)
                                <td><a href="#" data-toggle="modal" data-target="#Organitizon{{$Organitizon->subsidiaries_id}}-{{$religions->religion_id}}">{{ReligionController::organdorganaz($religions->religion_id,$Organitizon->subsidiaries_id)}}</a></td>




                  <!-- The Modal -->
<div class="modal fade" id="Organitizon{{$Organitizon->subsidiaries_id}}-{{$religions->religion_id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Report of {{$Organitizon->subsidiaries_name}} and  {{$religions->religion_name}} religion</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <div class="text-left">
           {{ ReligionController::organdorganazprofile($religions->religion_id,$Organitizon->subsidiaries_id)}}
        </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
 <!-- The Modal -->


                                @endforeach
                              </tr>

                            </tbody>

                          </table>


                    </td>

                  </tr>


                  @endforeach
                </tbody>

              </table>
            </div>



          </div>

</div>
        </div>
    </div>
</section>



<style>
    /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
.flip-card {
  background-color: transparent;
  width: 300px;
  height: 200px;
  border: 1px solid #f1f1f1;
  perspective: 1000px; /* Remove this if you don't want the 3D effect */
}

/* This container is needed to position the front and back side */
.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

/* Do an horizontal flip when you move the mouse over the flip box container */
.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

/* Position the front and back side */
.flip-card-front, .flip-card-back {
  position: absolute;
  font-weight: 900;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden; /* Safari */
  backface-visibility: hidden;
}

/* Style the front side (fallback if image is missing) */
.flip-card-front {
  background-color: #bbb;
  color: black;
}

/* Style the back side */
.flip-card-back {
  background-color: dodgerblue;
  color: white;
  transform: rotateY(180deg);
}
</style>
