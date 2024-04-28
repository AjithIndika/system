



<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">

            <table class="table">
                <thead>
                  <tr>
                    <th>Subsidiaries</th>
                    <th>Active</th>
                    <th>Not Active</th>
                  </tr>
                </thead>
                <tbody>




                    @foreach ( $data['subsidiaries'] as $subdiaries)
                    <tr>
                        <td>{{$subdiaries->subsidiaries_name}}</td>
                        <td><a href="" data-toggle="modal" data-target="#active{{$subdiaries->subsidiaries_id}}">{{ DB::table('job_working')->where('profile_job_work_sbu','=',$subdiaries->subsidiaries_id)->where('profile_job_work_status','=','Active')->count() }}</a></td>
                        <td><a href="" data-toggle="modal" data-target="#innactive{{$subdiaries->subsidiaries_id}}">{{ DB::table('job_working')->where('profile_job_work_sbu','=',$subdiaries->subsidiaries_id)->where('profile_job_work_status','=','Stopped')->count() }}</a></td>
                      </tr>


                                <!-- Active Employees  -->
                                <div class="modal fade" id="active{{$subdiaries->subsidiaries_id}}">
                                    <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title"> {{$subdiaries->subsidiaries_name}} Active Employees</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                        <?php
                                        $frofiles= DB::table('job_working')
                                        ->select('*')
                                        ->join('profiles','profiles.profile_id','=','job_working.profile_id')
                                        ->where('job_working.profile_job_work_sbu','=',$subdiaries->subsidiaries_id)
                                        ->where('job_working.profile_job_work_status','=','Active')
                                        ->get();
                                            ?>



                                @if(count($frofiles) > 0)
                                @else
                                <div class="alert alert-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>View!</strong> Sorry no data to view.
                                </div>
                                @endif



                                            <div class="list-group">
                                                @foreach ($frofiles as $frofiles)
                                                <a href="/view-profile/{{$frofiles->profile_sug}}" class="list-group-item list-group-item-action" target="_blank">{{$frofiles->profile_Full_name}}</a>
                                            @endforeach
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                    </div>
                                </div>




                                <!-- InActive Employees  -->
                                <div class="modal fade" id="innactive{{$subdiaries->subsidiaries_id}}">
                                    <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                        <h4 class="modal-title"> {{$subdiaries->subsidiaries_name}} Inactive Employees</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                        <?php
                                        $frofiles=
                                        DB::table('job_working')
                                        ->select('*')
                                        ->join('profiles','profiles.profile_id','=','job_working.profile_id')
                                        ->where('job_working.profile_job_work_sbu','=',$subdiaries->subsidiaries_id)
                                        ->where('job_working.profile_job_work_status','=','Stopped')
                                        ->get();
                                          ?>


                                @if(count($frofiles) > 0)
                                @else
                                <div class="alert alert-info alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>View!</strong> Sorry no data to view.
                                </div>
                                @endif

                                            <div class="list-group">
                                                @foreach ($frofiles as $frofiles)
                                                <a href="/view-profile/{{$frofiles->profile_sug}}" class="list-group-item list-group-item-action" target="_blank">{{$frofiles->profile_Full_name}}</a>
                                            @endforeach
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                    </div>
                                </div>




                    @endforeach

                    <tr class="mt-2 bg-success  text-white">
                        <td class="text-right">Total </td>
                        <td class="text-left">{{$data['active_users']}}</td>
                        <td class="text-left">{{$data['in_active_users']}}</td>
                    </tr>
                </tbody>
              </table>







          </div>
        </div>
      </div><!-- End Large Modal-->


    </section>

