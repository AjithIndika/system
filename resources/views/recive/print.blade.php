<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">





                <div class="ml-3" id="GFG">

                    <div class="row ml-3">
                        <div class="col-sm-6">
                            <img src="{{ url('assets/img/it_logo.png') }}">
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
                                    {{ env('IT_WEB') }}
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col "><i class="fa fa-phone" aria-hidden="true"></i>
                                    {{ env('IT_MOBILE') }} </div>
                            </div>



                        </div>
                    </div>


                    <div class="row border-1 ml-1" style="margin-top: -90px">
                        <div class="col-sm-4">

                            <h3># {{ $data['anrs'] }}</h3>
                            <h5>Repair order Number</h5>
                        </div>
                        <div class="col text-capitalize">
                            <h3>handed over note</h3>
                        </div>
                        <div class="col"></div>
                    </div>






                    <div class="row mt-3" style="margin-left: 7px">
                        <div class="row  ">

                            <div class="row">
                                <div class="col-sm-4">
                                    <h6 class="text-capitalize text-bold"> Service center Details</h6>
                                    @foreach ($data['repircenter'] as $repircenter)
                                        {{ $repircenter->suppliers_Organization }} </br>
                                        Att: {{ $repircenter->suppliers_Contact_person }} </br>
                                        <i class="fa fa-phone" aria-hidden="true">
                                            {{ $repircenter->suppliers_Contact_number }}</i> </br>
                                        <i class="fa fa-envelope-o" aria-hidden="true">
                                            {{ $repircenter->suppliers_Contact_email }} </i></br>
                                    @endforeach

                                </div>
                                <div class="col text-left">

                                </div>
                            </div>


                        </div>

                    </div>


                    <div>
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Ticket Number</th>
                                    <th class="text-center">Details of device</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data['repiritems'] as $key => $row)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->tickets_number }}</td>
                                        <td>Equipment : -{{ $row->equpment_name }} </br>
                                            Brand :- {{ $row->equ_brands_name }} </br>
                                            Model :- {{ $row->equipment_model_details }}</br>
                                            SN :- {{ $row->equipment_asset_sn }}

                                        </td>
                                        <td> {!! html_entity_decode($row->repair_receives_reson) !!}</td>
                                    </tr>
                                @endforeach


                                <tr>
                                    <td colspan="2">Prepared By : {{ Auth::user()->name }}</br>
                                        {{ date('Y-m-d H:i:s') }}</br>
                                        <em> No need to a signature This system-generated</em>
                                    </td>

                                    <td></td>
                                    <td>
                                        <li style="margin-top: 10px;list-style-type:none ;">
                                            -----------------------------------------</li></br>Receiver Signature </br>
                                        <li style="margin-top:20px;list-style-type:none ;">NIC
                                            .....................................</li>
                                    </td>
                                </tr>



                            </tbody>






                    </div>
                </div>




            </div>




        </div>
</section>

<table>
    <tr>
        <td>
            <div class="row">
                <div class="col">


                    <button class="btn btn-default printButton" id="printButton" onclick="printDiv('GFG')"><i
                            class="fa fa-print" style="font-size: 17px;"> Print</i></button>
                </div>
            </div>

        </td>
    </tr>
</table>


<script>
    function printDiv(GFG) {
        var printButton = document.getElementById("printButton");
        var printContents = document.getElementById(GFG).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        printButton.style.visibility = 'hidden';

        window.print();

        document.body.innerHTML = originalContents;

        printButton.style.visibility = 'hidden';
    }
</script>



<style>
    .printButton {
        visibility: visible;
    }

    body {

        text-size-adjust: 30%;
    }

    @media print {
        #printButton {
            visibility: hidden;
        }
    }
</style>
