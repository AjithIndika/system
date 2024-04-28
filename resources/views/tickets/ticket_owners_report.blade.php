<?php
use App\Http\Controllers\TicketsController;
?>
<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body mt-5">





                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Last Week Tickets</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Ticket Owner</th>
                                                <th class="text-center">New</th>
                                                <th class="text-center">View</th>
                                                <th class="text-center">Process</th>
                                                <th class="text-center">Finish</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($data['tiket_owers'] as $tiket_owers)
                                                <tr>
                                                    <td>{{ $tiket_owers->profile_first_name . ' ' . $tiket_owers->profile_last_name }}
                                                    </td>
                                                    <td class="text-center bg-danger"><a href="#"
                                                            class="text-light" data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'Crate' }}">{{ TicketsController::lastweekCountofstatus($tiket_owers->profile_id, 'Crate') }}
                                                        </a></td>
                                                    <td class="text-center bg-warning"><a href="#"
                                                            class="text-light" data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'View' }}">{{ TicketsController::lastweekCountofstatus($tiket_owers->profile_id, 'View') }}</a>
                                                    </td>
                                                    <td class="text-center bg-info"><a href="#" class="text-light"
                                                            data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'Process' }}">{{ TicketsController::lastweekCountofstatus($tiket_owers->profile_id, 'Process') }}</a>
                                                    </td>
                                                    <td class="text-center bg-success "><a href="#"
                                                            class="text-light" data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'Finish' }}">{{ TicketsController::lastweekCountofstatus($tiket_owers->profile_id, 'Finish') }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </td>
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>
</section>



<!---- last month !-------------->


<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body mt-5">





                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Last Month Tickets</th>
                                

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Ticket Owner</th>
                                                <th class="text-center">New</th>
                                                <th class="text-center">View</th>
                                                <th class="text-center">Process</th>
                                                <th class="text-center">Finish</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($data['tiket_owers'] as $tiket_owers)
                                                <tr>
                                                    <td>{{ $tiket_owers->profile_first_name . ' ' . $tiket_owers->profile_last_name }}
                                                    </td>
                                                    <td class="text-center bg-danger"><a href="#"
                                                            class="text-light" data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'Crate' }}">{{ TicketsController::lastMonthCountofstatus($tiket_owers->profile_id, 'Crate') }}
                                                        </a></td>
                                                    <td class="text-center bg-warning"><a href="#"
                                                            class="text-light" data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'View' }}">{{ TicketsController::lastMonthCountofstatus($tiket_owers->profile_id, 'View') }}</a>
                                                    </td>
                                                    <td class="text-center bg-info"><a href="#" class="text-light"
                                                            data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'Process' }}">{{ TicketsController::lastMonthCountofstatus($tiket_owers->profile_id, 'Process') }}</a>
                                                    </td>
                                                    <td class="text-center bg-success "><a href="#"
                                                            class="text-light" data-toggle="modal"
                                                            data-target="#myModal{{ $tiket_owers->profile_id . 'Finish' }}">{{ TicketsController::lastMonthCountofstatus($tiket_owers->profile_id, 'Finish') }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </td>
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>
</section>

