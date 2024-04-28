<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">

                <div class="row">
                    <h3 class="headtitel"> Select Service Center</h3>
                    <div class="col-sm-8">
                        <form action="/addservicecenter" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email">Service Center name:</label> </br>

                                <select class="custom-select form-control @error('service_center_id') is-invalid @enderror service_center_id" name="service_center_id" style="width: 700px" required>
                                    <option value="">Select One</option>

                                    @foreach ( $data['suppliers'] as $suppliers)
                                    <option value="{{$suppliers->suppliers_id}}">{{$suppliers->suppliers_Organization}}</option>
                                        
                                    @endforeach                                  
                                   
                                    
                                 </select>


                                 <div class="row mt-2">
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Go Next</button>
                                    </div>
                                 </div>
                                

                              </div>

                        </form>
                    </div>                   
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