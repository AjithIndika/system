
<?php


use App\Http\Controllers\EquipmentController;

?>
<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mb-5 mt-5">


            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Organization</th>
                    <th>Device Details</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ( $data['subsidiaries'] as $subsidiaries )

                    <tr>
                        <td>{{$subsidiaries->subsidiaries_name}}</td>
                        <td>
                         
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Device Name</th>
                                    <th class="text-center">Using</th>
                                    <th class="text-center">Keeping Up</th>
                                    <th class="text-center">On Repair</th>
                                    <th class="text-center">Disposed</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data['equpment_types'] as $key=>$qupment_types)

                                    <tr @if ($subsidiaries->assetsubsidiarie == 'No')
                                        class="bg-success text-white"
                                        
                                    @endif>
                                        <td class="text-center">{{$key +1}}</td>
                                        <td>{{$qupment_types->equpment_name }}</td>
                                        <td class="text-center">{{EquipmentController::countEqupment($subsidiaries->subsidiaries_id,$qupment_types->equpment_types_id,'2')}}</td>
                                        <td class="text-center">{{EquipmentController::countEqupment($subsidiaries->subsidiaries_id,$qupment_types->equpment_types_id,'1')}}</td>
                                        <td class="text-center">{{EquipmentController::countEqupment($subsidiaries->subsidiaries_id,$qupment_types->equpment_types_id,'3')}}</td>
                                        <td class="text-center">{{EquipmentController::countEqupment($subsidiaries->subsidiaries_id,$qupment_types->equpment_types_id,'4')}}</td>
                                      </tr>

                                      

                                        
                                    @endforeach
                                  
                                 
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
</section>