
<?php 
use App\Http\Controllers\EquipmentController;
?>

 <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.table2excel.min.js"></script>
<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">

                <table class="table table-bordered mt-2" >
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Organization </th>
                        <th class="text-center">Equipment list</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data['subsidiaries'] as $key=> $subsidiaries)
             <th class="text-center"> </th>
                        <tr>
                            <td>{{$key+ 1}}</td>
                            <td>{{$subsidiaries->subsidiaries_name}} </br><button id="exporttable{{$subsidiaries->subsidiaries_id}}" class="btn btn-primary">Export</button></td>
                            <td>
                            
                                <table class="table table-bordered" id="htmltable{{$subsidiaries->subsidiaries_id}}">
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
                                        <th>Responsible person</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>

                                        {{EquipmentController::org_equ_list($subsidiaries->subsidiaries_id)}}
                                    
                                      
                                    </tbody>
                                  </table>
                            
                            </td>                        
                          </tr>

                         
<script>

$(function() {
        $("#exporttable<?php echo $subsidiaries->subsidiaries_id ?>").click(function(e){
          var table = $("#htmltable<?php echo $subsidiaries->subsidiaries_id ?>");
          if(table && table.length){
            $(table).table2excel({
              exclude: ".noExl",
              name: "Excel Document Name",
              filename: "<?php echo $subsidiaries->subsidiaries_name ?> :- <?php echo date('Y-m-d')?>" + ".xls",
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


            </div>
        </div>
    </div>
</section>


