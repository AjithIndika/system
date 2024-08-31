<?php 

use App\Http\Controllers\RepairReceiveController;
use Illuminate\Support\Facades\Cookie;



       
?>

<section class="section dashboard">
    
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">

                <div class="row">
                    <h3 class="headtitel"> Add Iems to </h3>
                    <div class="col-sm-8">
                        <form action="/addsendingItems" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email">Select Items:</label> </br>

                                <select class="custom-select form-control @error('repair_receives_id') is-invalid @enderror repair_receives_id" name="repair_receives_id" style="width: 700px" required>
                                    <option value="">Select One</option>

                                    @foreach ( $data['device'] as $device)
                                    <option value="{{$device->repair_receives_ticket_id}}">{{$device->tickets_number}}</option>
                                        
                                    @endforeach                                  
                                   
                                    
                                 </select>


                                 <div class="row mt-2">

                                    <input type="hidden" name="service_center_id" value="{{Cookie::get('service_center_id')}}">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Add This</button>
                                    </div>
                                 </div>
                                

                              </div>

                        </form>
                    </div>                   
                </div>






                <div class="container">
                    <h4>Item List of Sending : <em> {{ RepairReceiveController::supplier_name(Cookie::get('service_center_id'))}}</em></h4>
                    <p></p>
                    <table class="table table-bordered table-sm">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Ticket Number</th>
                          <th>Equipment and  Details</th>
                          <th>Fault</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($data['tempary_keeping'] as $key=>$tempary_keeping)
                            
                       
                            
                        
                        <tr>
                          <td>{{$key + 1}}</td>
                          <td>{{$tempary_keeping->tickets_number}}/{{$tempary_keeping->tickets_number}}</td>
                          <td>{{RepairReceiveController::equpmentDetails($tempary_keeping->repair_receives_equpment_id)}}   	 </td>
                          <td> {!!  html_entity_decode(RepairReceiveController::equpmentFaulit($tempary_keeping->repair_teparry_keeping_id)) !!}</td>
                          <td><i class="fa fa-trash-o fa-2x" aria-hidden="true" data-toggle="modal" data-target="#delet{{$tempary_keeping->repair_teparry_keeping_id}}"></i> </td>
                         
                        </tr>


                        <!-- The Modal -->
<div class="modal fade" id="delet{{$tempary_keeping->repair_teparry_keeping_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Do you need to remove this equipment?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form action="/addsendingItemsremove" method="POST">
            @csrf
            <input type="hidden" name="repair_teparry_keeping_id" value="{{$tempary_keeping->repair_teparry_keeping_id}}">
            <button type="submit" class="btn btn-warning">Yes I Need</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No,  Please Keep</button>
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
                    <form action="addsendingItemsprocess" method="post">
                        @csrf

                    <button type="submit" class="btn btn-warning">Go Print Sheet</button>  
                    </form>
                  </div>




            </div>
        </div>
    </div>
</section>

<style>
    .headtitel{
        margin-top: 10px !important;
        font-size: 20px   !important;
        font-weight: bolder !important;
    }
</style>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    
    $(document).ready(function() {
        $('.service_center_id').select2();
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




