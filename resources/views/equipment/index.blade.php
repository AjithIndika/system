<?php
use App\Http\Controllers\EquBrandController;

?>

<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mb-5 mt-5">

            <form action="/equpment_crate" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                @csrf


                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Organization:</label>
                        <select class="custom-select  @error('organization') is-invalid @enderror  organization h-4" name="organization" required >
                            <option value="">Select your organization</option>
                            @foreach ($data['subsidiaries'] as  $subsidiaries)
                            <option value="{{$subsidiaries->subsidiaries_id}}">{{$subsidiaries->subsidiaries_name}}</option>
                            @endforeach
                        </select>
                        @error('organization')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Device name:</label>
                        <select class="custom-select  @error('device') is-invalid @enderror  device h-4" name="device" required >
                            <option value="">Select device name</option>
                            @foreach ($data['equpment_types'] as  $equpment_types)
                            <option value="{{$equpment_types->equpment_types_id }}">{{$equpment_types->equpment_name}}</option>
                            @endforeach
                        </select>
                        @error('device')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Manufacture:</label>
                        <select class="custom-select  @error('equ_brands_name') is-invalid @enderror  equ_brands_name h-4" name="equ_brands_name" required >
                            <option value="">Select device manufacture name</option>
                            {{EquBrandController::brandlist()}}
                        </select>
                        @error('equ_brands_name')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="email">Model details</label>
                                <input type="text" class="form-control" id="customFile" name="equipment_model_details" >
                          </div>
                       </div>

                       <div class="col-sm-5">
                        <div class="form-group">
                            <label for="email">SN</label>
                                <input type="text" class="form-control" placeholder="Serial" name="equipment_asset_sn" >
                          </div>
                       </div>
                </div>

                <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="pwd">Device Details</label>
                        <textarea class="ckeditor form-control"  name="device_details" required  @error('device_details') is-invalid @enderror></textarea>
                        @error('device_details')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                </div>

                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Location:</label>
                        <select class="custom-select  @error('equpment_location') is-invalid @enderror  equpment_location h-4" name="equpment_location"  required >
                            <option value="">Select Vender name</option>
                            @foreach ( $data['location'] as  $location)
                            <option value="{{$location->office_locations_id }}">{{$location->office_locations_name}}</option>
                            @endforeach
                        </select>
                        @error('equpment_location')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>

                    
                </div>




                <!--- start vender details !------>

                @if(!empty(Auth::user()->pcAdmin))
                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label for="email">Vender Name:</label>
                        <select class="custom-select  @error('vender_name') is-invalid @enderror  vender_name h-4" name="vender_name"  required >
                            <option value="">Select Vender name</option>
                            @foreach ( $data['suppliers'] as  $suppliers)
                            <option value="{{$suppliers->suppliers_id }}">{{$suppliers->suppliers_Organization}}</option>
                            @endforeach
                        </select>
                        @error('vender_name')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    </div>



                   <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email">Vender Invoice</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input " id="customFile" name="venderInvoice" >
                            <label class="custom-file-label" for="customFile">Vender Invoice</label>
                          </div>
                      </div>
                   </div>

                   <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email">Vendor Price</label>
                        <input type="text" class="form-control" placeholder="Vendor Price" id="email" name="vendorPrice">
                      </div>
                   </div>

                   <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email">Amount (Asset Networks) </label>
                            <input type="text" class="form-control" id="customFile" name="equipment_asset_value"  >
                      </div>
                   </div>


                </div>

                @endif

            <!--- end  vender details !------>



                    <!--- start Organization details !------>

                    <!---
                    @if(!empty(Auth::user()->sbuPcAdmin))
                    <div class="row">



                   <div class="col-sm-3">
                    <div class="form-group">
                        <label for="email">Vender Invoice</label>
                        <div class="custom-file ">
                            <input type="file" class="custom-file-input " id="customFile" name="venderOrganizationInvoice" >
                            <label class="custom-file-label" for="customFile">Vender Invoice</label>
                          </div>
                      </div>
                   </div>


                       <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Vendor Price</label>
                            <input type="text" class="form-control" placeholder="Vendor Price" id="email" name="vendorOrganizationPrice">
                          </div>
                       </div>

                    </div>

                    @endif
                    !----->
                <!--- end  Organization details !------>



                <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="email">Warranty period</label>
                                <input type="text" class="form-control" id="customFile" name="warranty" >
                          </div>
                       </div>


                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>


          </div>
        </div>
    </div>
</section>







<script>
    $(document).ready(function() {
        $('.vender_name').select2();
        });


        

        $(document).ready(function() {
        $('.equpment_location').select2();
        });

        $(document).ready(function() {
        $('.equ_brands_name').select2();
        });


        $(document).ready(function() {
        $('.organization').select2();
        });


        $(document).ready(function() {
        $('.device').select2();
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




<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(".custom-files-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-files-label").addClass("selected").html(fileName);
    });
    </script>




<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



