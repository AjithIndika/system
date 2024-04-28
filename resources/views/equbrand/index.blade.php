<?php 
use App\Http\Controllers\EqupmentTypeController;
?>
<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            <button type="submit" class="btn btn-success mt-3" data-toggle="modal" data-target="#newbrand">Add Brand Name</button></br>


            <table class="table table-bordered mt-5 col-sm-7">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Lastname</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($data['equpment_brand'] as $key => $equpment_brand)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$equpment_brand->equ_brands_name }}</td>
                        <td>{{EqupmentTypeController::countbrand($equpment_brand->equ_brands_id)}}</td>
                        <td><button type="button" class="btn btn-success"  data-toggle="modal" data-target="#update{{$equpment_brand->equ_brands_id}}">Update</button></td>
                      </tr>


                      <div class="modal fade" id="update{{$equpment_brand->equ_brands_id}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                      
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">ad New Brand name</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                      
                            <!-- Modal body -->
                            <div class="modal-body">
                             
                                <form action="/updateequbrand" method="POST">
                                    @csrf
                                    <div class="form-group">
                                      <label for="email">Brand Name</label>
                                      <input type="text" class="form-control @error('equ_brands_name') is-invalid @enderror"  value="{{$equpment_brand->equ_brands_name }}"  name="equ_brands_name" id="email">
                                    </div>

                                    <input type="hidden" name="equ_brands_id" value="{{$equpment_brand->equ_brands_id}}" required/>
                    
                                </br>
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



                    @endforeach
                 
                 
                </tbody>
              </table>


</div>
                    
            



          </div>
        </div>
    </div>
</section>



<div class="modal fade" id="newbrand">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">ad New Brand name</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         
            <form action="/newequbrand" method="POST">
                @csrf
                <div class="form-group">
                  <label for="email">Brand Name</label>
                  <input type="text" class="form-control" placeholder="Brand Name"  name="equ_brands_name" id="email" required>
                </div>

            </br>
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