<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<?php
use App\Http\Controllers\EquipmentController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\EquBrandController;
?>




@foreach ($data['equipment'] as $equipment)

    <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body mb-5 mt-5">

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#qrview">QR
                        Corde</button>


                        <h1 class="mt-2">{{ $equipment->equipment_number}}</h1>




                    <!-- The Modal -->
                    <div class="modal fade" id="qrview">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title"> QR </h4>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>


                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div id="printdiv">
                                        <div class="row">
                                            <div class="col ">
                                                {!! QrCode::size(300)->generate(
                                                    'PC Number:' .
                                                        $equipment->equipment_number .
                                                        'SN:' .
                                                        $equipment->equipment_asset_sn .
                                                        ' \n Organization :' .
                                                        $equipment->subsidiaries_name .
                                                        '',
                                                ) !!}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <h1>{{ $equipment->equipment_number }}</h1>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class=" row d-flex justify-content-center align-content-center ">

                                    <button id="print" class="btn btn-success col-sm-3"
                                        onclick="printDiv('printdiv');">Print</button>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>




                    <form action="/equpment_update" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
                        @csrf


                        <input type="hidden" value="{{ $equipment->equipment_id }}" name="equipment_id">
                        <input type="hidden" value="{{ $equipment->equipment_number }}" name="equipment_number">


                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Organization:</label>
                                    <input type="text" class="form-control"
                                        placeholder="{{ $equipment->subsidiaries_name }}" readonly>
                                </div>
                            </div>


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Device name:</label>

                                    <select class="custom-select  @error('device') is-invalid @enderror  device h-4" name="device" required >
                                        <option value="{{ $equipment->equpment_types_id }}">{{ $equipment->equpment_name }}</option>
                                        @foreach ($data['equpment_types'] as  $equpment_types)
                                        <option value="{{$equpment_types->equpment_types_id }}">{{$equpment_types->equpment_name}}</option>
                                        @endforeach
                                    </select>

                                        <!-------
                                    <input type="text" class="form-control"
                                        placeholder="{{ $equipment->equpment_name }}" readonly>
                                        !-------->
                                </div>


                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                <label for="email">Manufacture:</label>
                                <select class="custom-select  @error('equ_brands_name') is-invalid @enderror  equ_brands_name h-4" name="equ_brands_name" required  @if (empty(Auth::user()->pcAdmin) OR empty(Auth::user()->sbuPcAdmin)) @else  @readonly(true)  @endif >
                                    {{EquBrandController::brandname($equipment->equ_brand_id)}}
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
                                        <input type="text" class="form-control" id="customFile" value="{{$equipment->equipment_model_details}}" name="equipment_model_details"  @if (empty(Auth::user()->pcAdmin) OR empty(Auth::user()->sbuPcAdmin)) @else  @readonly(true)  @endif>
                                  </div>
                               </div>

                               <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="email">SN</label>
                                        <input type="text" class="form-control" placeholder="Serial" value="{{$equipment->equipment_asset_sn}}" name="equipment_asset_sn" @if (empty(Auth::user()->pcAdmin) OR empty(Auth::user()->sbuPcAdmin)) @else  @readonly(true)  @endif>
                                  </div>
                               </div>
                        </div>



                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="pwd">Device Details</label>
                                    @if (!empty(Auth::user()->pcAdmin) or !empty(Auth::user()->sbuPcAdmin))
                                        <textarea class="ckeditor form-control" name="device_details"> {{ $equipment->equipment_details }}</textarea>
                                    @else
                                        {!! html_entity_decode($equipment->equipment_details) !!}
                                    @endif


                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                <label for="email">Location:</label>
                                <select class="custom-select  @error('equpment_location') is-invalid @enderror  equpment_location h-4" name="equpment_location"  required >
                                    
                                    <option value="{{$equipment->equpment_location }}">{{ DB::table('office_locations')->where('office_locations_id','=',$equipment->equpment_location)->value('office_locations_name')}}</option>
                                    @foreach ( $data['location'] as  $location)
                                    <option value="{{$location->office_locations_id }}">{{$location->office_locations_name}}</option>
                                    @endforeach
                                </select>
                                @error('equpment_location')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            </div>
        
                            
                        </div>



                        <!--- start vender details !------>

                        @if (!empty(Auth::user()->pcAdmin))
                            <div class="row">

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="email">Vender Name:</label>


                                        @if (!empty(Auth::user()->pcAdmin) or !empty(Auth::user()->sbuPcAdmin))
                                            <select
                                                class="custom-select  @error('vender_name') is-invalid @enderror  vender_name h-4"
                                                name="vender_name" required>
                                                <option value="{{ $equipment->equipment_vender_id }}">
                                                    {{ EquipmentController::vendername($equipment->equipment_vender_id) }}
                                                </option>
                                                @foreach ($data['suppliers'] as $suppliers)
                                                    <option value="{{ $suppliers->suppliers_id }}">
                                                        {{ $suppliers->suppliers_Organization }}</option>
                                                @endforeach
                                            </select>
                                            @error('vender_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        @else
                                            <input type="text" class="form-control"
                                                placeholder=" {{ EquipmentController::vendername($equipment->equipment_vender_id) }}"
                                                readonly>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-sm-3">
                                    @if (!empty(Auth::user()->pcAdmin))
                                        @if (!empty($equipment->equipment_vender_invoice))
                                            <div class="form-group">
                                                <label for="email">View File</label>
                                                <div class="custom-file">
                                                    <i class="fa fa-file fa-2x" aria-hidden="true" data-toggle="modal"
                                                        data-target="#equipment_vender_invoice"></i>
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="email">Vender Invoice</label>
                                                <div class="custom-file">
                                                    <li class="fa fa-cloud-upload fa-2x" data-toggle="modal"
                                                        data-target="#uplode_equipment_vender_invoice"></li>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>


                                <div class="col-sm-3">

                                    @if (!empty(Auth::user()->pcAdmin))
                                        <div class="form-group">
                                            <label for="email">Vendor Price</label>
                                            <input type="text" class="form-control"
                                                placeholder="{{ $equipment->equipment_vender_value }}" id="email"
                                                name="vendorPrice">
                                        </div>
                                    @endif

                                </div>



                            </div>
                        @endif
                        <!--- end  vender details !------>






                        <!--- start Organization details !------>

                        <!---
                    @if (!empty(Auth::user()->sbuPcAdmin))
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
                                    <input type="text" class="form-control" id="customFile" name="warranty"
                                        value="{{ $equipment->equipment_warranty }}">
                                </div>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="email">Amount</label>
                                    <input type="text" class="form-control" id="customFile"
                                        name="equipment_asset_value" value="{{ $equipment->equipment_asset_value }}">
                                </div>
                            </div>

                            <div class="col-sm-3">


                                @if (!empty($equipment->equipment_asset_invoice))
                                    <div class="form-group">
                                        <label for="email">View File</label>
                                        <div class="custom-file">
                                            <i class="fa fa-file fa-2x" aria-hidden="true" data-toggle="modal"
                                                data-target="#equipment_asset_invoice"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="email">Invoice</label>
                                        <div class="custom-file">
                                            <li class="fa fa-cloud-upload fa-2x" data-toggle="modal"
                                                data-target="#uplode_equipment_asset_invoice"></li>
                                        </div>
                                    </div>
                                @endif

                            </div>


                        </div>


                        <div class="row">

                            <div class="col">

                                <div class="form-group">
                                    <label for="email">Responsible Person:</label>
                                    @if (!empty($equipment->equipment_user))
                                        <input type="text" class="form-control col-sm-5"
                                            value="{{ EquipmentController::responsiblePerson($equipment->equipment_user) }}"
                                            readonly>
                                    @endif
                                    </br>

                                    @if(!empty(Auth::user()->pcAdmin) OR !empty(Auth::user()->sbuPcAdmin)  )
                                    @if(empty($equipment->equipment_user))
                                    <button type="button" class="btn btn-primary col-sm-3" data-toggle="modal"
                                        data-target="#reperson">Responsible Person Update </button>
                                        @endif
                                        @endif
                                </div>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-3">
                                <div class="form-group">
                                <label for="email">Status:</label>
                                <select class="custom-select  @error('equipment_status') is-invalid @enderror  equipment_status h-4" name="equipment_status" required  @if (empty(Auth::user()->pcAdmin) or empty(Auth::user()->sbuPcAdmin))  readonly @endif >
                                    @if (!empty($equipment->equipment_status))

                                    

                                    <option value="{{$equipment->equipment_status}}">
                                    
                                    @if ($equipment->equipment_status==1)
                                    Keeping Up  
                                    @elseif ($equipment->equipment_status==2)
                                    Using 
                                    @elseif ($equipment->equipment_status==3)
                                    On Repair
                                    @elseif($equipment->equipment_status==4)
                                    Disposed
                                    @else
                                    @endif
                                        
                                    

                                    </option>
                                        
                                    @else
                                        
                                    @endif
                                   
                                    <option value="1">Keeping Up</option>
                                    <option value="2">Using</option>
                                    <option value="3">On Repair</option>
                                    <option value="4">Disposed</option>  
                                </select>
                                @error('equipment_status')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            </div>


                          
                                                                    
                              
                        </div>







                        @if (!empty(Auth::user()->pcAdmin) or !empty(Auth::user()->sbuPcAdmin))
                            <button type="submit" class="btn btn-primary" name="submit">Update Now</button>
                        @endif
                    </form>














                    <!-- The Modal -->
                    <div class="modal fade" id="equipment_vender_invoice">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">View Invoice</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <embed src="{{ url('invoice/' . $equipment->equipment_vender_invoice . '') }}"
                                        width="100%" height="2100px" />
                                </div>


                                <form action="/venderInvoiceDelete" method="post">
                                    @csrf

                                    <input type="hidden" value="{{ $equipment->equipment_id }}"
                                        name="equipment_id">
                                    <input type="hidden" value="{{ $equipment->equipment_number }}"
                                        name="equipment_number">
                                    <input type="hidden" value="{{ $equipment->equipment_vender_invoice }}"
                                        name="equipment_vender_invoice">

                                    @if (!empty(Auth::user()->pcAdmin) or !empty(Auth::user()->sbuPcAdmin))
                                        <button type="submit" class="btn btn-success" name="submit"
                                            value="submit">Delete PDF</button>
                                    @endif

                                </form>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!------ !-------------->



                    <!---------start asset Invoice !-------------->



                    <!-- The Modal -->
                    <div class="modal fade" id="equipment_asset_invoice">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">View Invoice</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <embed src="{{ url('invoice/' . $equipment->equipment_asset_invoice . '') }}"
                                        width="100%" height="2100px" />
                                </div>


                                <form action="/assetInvoiceDelete" method="post">
                                    @csrf

                                    <input type="hidden" value="{{ $equipment->equipment_id }}"
                                        name="equipment_id">
                                    <input type="hidden" value="{{ $equipment->equipment_number }}"
                                        name="equipment_number">
                                    <input type="hidden" value="{{ $equipment->equipment_asset_invoice }}"
                                        name="equipment_asset_invoice">

                                    @if (!empty(Auth::user()->pcAdmin) or !empty(Auth::user()->sbuPcAdmin))
                                        <button type="submit" class="btn btn-success" name="submit"
                                            value="submit">Delete PDF</button>
                                    @endif

                                </form>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!---------end asset Invoice !-------------->



                    <!-- The Modal -->
                    <div class="modal fade" id="uplode_equipment_vender_invoice">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Invoice Uploade </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <form action="/vander_invoice_upload" enctype="multipart/form-data"
                                        method="POST" accept-charset="utf-8">
                                        @csrf


                                        <input type="hidden" value="{{ $equipment->equipment_id }}"
                                            name="equipment_id">
                                        <input type="hidden" value="{{ $equipment->equipment_number }}"
                                            name="equipment_number">

                                        <div class="form-group">
                                            <label for="email">Vender Invoice</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input " id="customFile"
                                                    name="venderInvoice" type=".pdf" accept="application/pdf">
                                                <label class="custom-file-label" for="customFile">Vender
                                                    Invoice</label>
                                            </div>
                                        </div>

                                        <input type="submit" value="submit" name="submit">
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>





                    <!-------- asset invoice upload --------------!------------->

                    <!-- The Modal -->
                    <div class="modal fade" id="uplode_	equipment_asset_invoice">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Invoice Uploade </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <form action="/asset_invoice_upload" enctype="multipart/form-data" method="POST"
                                        accept-charset="utf-8">
                                        @csrf


                                        <input type="hidden" value="{{ $equipment->equipment_id }}"
                                            name="equipment_id">
                                        <input type="hidden" value="{{ $equipment->equipment_number }}"
                                            name="equipment_number">

                                        <div class="form-group">
                                            <label for="email">Vender Invoice</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input " id="customFile"
                                                    name="venderInvoice" type=".pdf" accept="application/pdf">
                                                <label class="custom-file-label" for="customFile">Vender
                                                    Invoice</label>
                                            </div>
                                        </div>

                                        <input type="submit" value="submit" name="submit">
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
                      <div class="modal fade" id="reperson">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Responsible Person</h4>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">

                                    <form action="/equpmentuserupdate" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label for="email">Responsible Person:</label> </br>
                                            <select class="custom-select  Responsible_Person h-4 "
                                                name="profile_id" style="width: 100%">
                                                @if (!empty($equipment->equipment_user))
                                                    <option value="{{ $equipment->equipment_user }}">
                                                        {{ EquipmentController::responsiblePerson($equipment->equipment_user) }}
                                                    </option>
                                                @else
                                                    <option value="">Select Responsible Person</option>
                                                @endif

                                                @foreach ($data['profile'] as $profile)
                                                    <option value="{{ $profile->profile_id }}">
                                                        {{ $profile->profile_first_name }} {{ $profile->profile_last_name }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div>

                                            <input type="hidden" value="{{$equipment->equipment_id}}" name="equipment_id">
                                            <input type="hidden" value="{{$equipment->equipment_number}}" name="equipment_number">


                                        </div>

                                        <input type="submit" value="SAVE"  class="btn btn-primary" name="userupdate">
                                    </form>

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>




@endforeach

</div>
</div>
</div>
</section>



<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body mb-5 mt-5">
               <h3>History</h3>

               @include('equipment/history')
            </div>
        </div>
    </div>


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



<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>



<script type="text/javascript">
    new DataTable('#example');
</script>



<script>
    $(document).ready(function() {
        $('.vender_name').select2();
        });

        $(document).ready(function() {
        $('.equipment_status').select2();
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



        $(document).ready(function() {
        $('.Responsible_Person').select2();
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



<style>
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 3px solid rgba(0, 0, 0, 0.1);
    }
</style>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

