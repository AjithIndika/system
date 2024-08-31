
<?php 
use App\Http\Controllers\EquipmentController;
?>

 <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>
<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body"  >

                <table class="table table-bordered mt-2" >
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Organization </th>
                        <th class="text-center">Equipment list</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data['office_locations'] as $key=> $office_locations)
             <th class="text-center"> </th>
                        <tr>
                            <td>{{$key+ 1}}</td>
                            <td>{{$office_locations->office_locations_name}} </br><button id="exporttable{{$office_locations->office_locations_id}}" class="btn btn-primary">Export</button></td>
                            <td>
                            
                                <table class="table table-bordered" id="htmltable{{$office_locations->office_locations_id}}">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Control Number</th>
                                        <th>Name</th>
                                        <th>Brand / Manufacturer</th>
                                        <th>Model</th>
                                        <th>SN</th>
                                        <th>Equipment Location </th>                                        
                                        <th>Equipment Status</th>
                                        <th>Market value</th>
                                        <th>Organization </th>
                                        <th>Responsible person</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>

                                        {{EquipmentController::location_equ_list($office_locations->office_locations_id)}}
                                     
                                    </tbody>
                                  </table>
     
                            </td>                        
                          </tr>

                         
<script>

$(function() {
        $("#exporttable<?php echo $office_locations->office_locations_id ?>").click(function(e){
          var table = $("#htmltable<?php echo $office_locations->office_locations_id ?>");
          if(table && table.length){
            $(table).table2excel({
              exclude: ".noExl",
              name: "Excel Document Name",
              filename: "<?php echo $office_locations->office_locations_name ?> :- <?php echo date('Y-m-d')?>" + ".xls",
              fileext: ".xls",
              exclude_img: true,
              exclude_links: true,
              exclude_inputs: true,
              preserveColors: false
            });
          }
        });
        
      });



</script>

                            
                        @endforeach
                     
                     
                    </tbody>
                  </table>


                 
                  <table class="table table-bordered mt-5" id="htmltable">
                    <button id="exporttable" class="btn btn-primary">Export</button>
                    
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Control Number</th>
                        <th>Name</th>
                        <th>Brand / Manufacturer</th>
                        <th>Model</th>
                        <th>SN</th>
                        <th>Equipment Location </th>
                        <th>Equipment Status</th>
                        <th>Market value</th>
                        <th>Organization </th>
                        <th>Responsible person</th>
                        
                      </tr>
                    </thead>
                    <tbody> 
                       {{EquipmentController::no_location_equ_list()}}
                      </tbody>
                  </table>


            </div>
        </div>
    </div>
</section>

<script>

  $(function() {
          $("#exporttable").click(function(e){
            var table = $("#htmltable");
            if(table && table.length){
              $(table).table2excel({
                exclude: ".noExl",
                name: "Excel Document Name",
                filename: "No Location:- <?php echo date('Y-m-d')?>" + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: false
              });
            }
          });
          
        });
  
  
  
  </script>


