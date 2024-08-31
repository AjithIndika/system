<script>
            function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            }
            </script>

<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body" id="GFG">

                <table border="1" style="widows:1000px">
                    <tr>
                        <td> <img src="{{url('assets/img/it_logo.png')}}" width="150px" height="80px" style="margin-top: -150px"></td>
                        <td style="width: 700px"></td>
                        <td style="width: 200px"> 
                            <table style="margin-top: 70px">
                                <tr>
                                    <td>{{ env('IT_NAME') }}</td>
                                </tr>

                                <tr>
                                    <td>{{ env('IT_LANE') }}</td>
                                </tr>

                                <tr>
                                    <td>{{ env('IT_CITY') }}</td>
                                </tr>

                                <tr>
                                    <td>{{ env('IT_POSTCORD') }}</td>
                                </tr>

                                <tr>
                                    <td><i class="fa fa-envelope-o" aria-hidden="true">{{ env('IT_EMAIL') }} </i></td>
                                </tr>

                                <tr>
                                    <td><i class="fa fa-globe" aria-hidden="true">{{ env('IT_WEB') }}</i></td>
                                </tr>

                                <tr>
                                    <td><i class="fa fa-phone" aria-hidden="true">{{ env('IT_MOBILE') }} </i></td>
                                </tr>


                            </table> </td>
                    </tr>

                    <tr>
                        <td>
                            <h3># {{$data['anrs']}}</h3>
                            <h5>Repair order Number</h5>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>



                <div  class="m-2">

                    <div class="row">
                        <div class="col-sm-6">
                            <img src="{{url('assets/img/it_logo.png')}}">
                        </div>
                        <div class="col"></div>
                        <div class="col">

                            <div class="row mt-2">
                                  <div class="col ">
                                        {{ env('IT_NAME') }} </div>                                
                            </div>

                            <div class="row mt-2">
                                <div class="col ">{{ env('IT_LANE') }} </div>                                
                          </div>

                          <div class="row mt-2">
                            <div class="col ">{{ env('IT_CITY') }} </div>                                
                      </div>

                      <div class="row mt-2">
                        <div class="col ">{{ env('IT_POSTCORD') }} </div>                                
                    </div>

                  <div class="row mt-2">
                    <div class="col "><i class="fa fa-envelope-o" aria-hidden="true"></i>

                         {{ env('IT_EMAIL') }} </div>                                
              </div>


              <div class="row mt-2">
                <div class="col ">
                    <i class="fa fa-globe" aria-hidden="true"></i>
{{ env('IT_WEB') }} </div>                                
          </div>


          <div class="row mt-2">
            <div class="col "><i class="fa fa-phone" aria-hidden="true"></i>
                 {{ env('IT_MOBILE') }} </div>                                
      </div>
   


                        </div>
                    </div>


                    <div class="row border-1 ml-1" style="margin-top: -90px">
                        <div class="col-sm-4">

                            <h3># {{$data['anrs']}}</h3>
                            <h5>Repair order Number</h5>
                        </div>
                        <div class="col text-capitalize"><h3>handed over note</h3></div>
                        <div class="col"></div>
                    </div>






                    <div class="row mt-3">
                        <div class="row  ">
                            
                            <div class="row">
                                <div class="col-sm-4">
                                  <h6 class="text-capitalize text-bold">  Service center Details</h6>
                                    @foreach ($data['repircenter'] as $repircenter)

                                    {{ $repircenter->suppliers_Organization}} </br>
                                  Att:   {{ $repircenter->suppliers_Contact_person}} </br>
                                  <i class="fa fa-phone" aria-hidden="true">   {{ $repircenter->suppliers_Contact_number}}</i>  </br>
                                  <i class="fa fa-envelope-o" aria-hidden="true">  {{ $repircenter->suppliers_Contact_email}} </i></br>
                                        
                                    @endforeach
                                
                                </div>
                                <div class="col text-left">
                                    
                                </div>
                            </div>
                            
                           
                    </div>

                </div>


                <div>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th class="text-center">Ticket Number</th>
                            <th class="text-center">Details of device</th>
                            <th class="text-center"></th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($data['repiritems'] as $key=>$row)
                                
                           
                          <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->tickets_number }}</td>
                            <td>Equipment : -{{$row->equpment_name  }} </br> 
                                Brand :- {{$row->equ_brands_name }} </br> 
                                Model :- {{$row->equipment_model_details }}</br> 
                                SN :- {{$row->equipment_asset_sn }}
                            
                            </td>
                            <td> {!!  html_entity_decode($row->repair_receives_reson) !!}</td>
                          </tr>

                          @endforeach


                          <tr>
                            <td colspan="2">Prepared By : {{Auth::user()->name}}</br> {{date('Y-m-d H:i:s')}}</br>
                              <em>  No need to a signature This system-generated</em></td>
                           
                            <td></td>
                            <td><em class="mt-3">-----------------------------------------</em></br>Signature </br><em class="mt-3">NIC .....................................</em></td>
                          </tr>
                         
                        </tbody>



                </div>
            </div>
        </div>

        <button id="print" onclick="printContent('GFG');" >Print</button>
    </div>
</section>


<style>

body {

  text-size-adjust: 30%;
}

@media{
    body{
        text-size-adjust: 30%;   
    }
}
</style>