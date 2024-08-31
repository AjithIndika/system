<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">



          <div class="card-body">

            <button type="button" class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#newone" >New {{  $data['title']  }}</button>

            <h5 class="card-title">Subsidiaries <span>  </span></h5>



            <div class="@error('enrolment_leave_setups_id') is-invalid @enderror"></div>




            <table class="table  datatable">
              <thead>
                <tr>

                  <th scope="col">#</th>
                  <th scope="col">Employe Enrolment Type</th>
                  <th scope="col">Leave Type</th>
                  <th scope="col">Assigned dates</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
               <?php $i=1?>
                @foreach ($data['enrolment_leave_setups'] as $enrolment_leave_setups)


                <tr>
                  <th scope="row">{{$i++}} </th>
                  <td>{{ $enrolment_leave_setups->employee_enrolment_types_name}}  Update Date  </td>
                  <td>{{ $enrolment_leave_setups->leave_types_name}} </td>
                   <td>{{ $enrolment_leave_setups->enrolment_leave_total}} <!----{{ $enrolment_leave_setups->enrolment_leave_date_calculation}} --------!----></td>
                   <td><button type="button" class="btn btn-danger mt-2"  data-toggle="modal" data-target="#editsbu{{ $enrolment_leave_setups->enrolment_leave_setups_id  }}"><i class="ri-edit-box-line"></i></button></td>
                </tr>







    <!---------- Edit Sbu !------------->
    <!-- The Modal -->
    <div class="modal fade" id="editsbu{{ $enrolment_leave_setups->enrolment_leave_setups_id }}">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">


                    <form action="update_enrolmentLeave" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="pwd">Enrolment Name:</label>
                            <select name="enrolment_employee_enrolment_types_id" class="custom-select" required>
                                <option value="{{$enrolment_leave_setups->employee_enrolment_types_id}}">{{$enrolment_leave_setups->employee_enrolment_types_name}}</option>
                                @foreach ($data['enrolment_name'] as  $enrolment_name)
                                <option value="{{$enrolment_name->employee_enrolment_types_id}}">{{$enrolment_name->employee_enrolment_types_name}}</option>
                                @endforeach
                              </select>
                          </div>


                        <div class="form-group">
                            <label for="pwd">Leave Type:</label>
                            <select name="enrolment_leave_types_id" class="custom-select" required>
                                <option value="{{$enrolment_leave_setups->leave_types_id}}">{{$enrolment_leave_setups->leave_types_name}}</option>
                                @foreach ($data['leave_type'] as  $leave_type)
                                <option value="{{$leave_type->leave_types_id}}">{{$leave_type->leave_types_name}}</option>
                                @endforeach
                              </select>
                          </div>


                        <div class="form-group">
                            <label for="pwd">Calculation (> or < or = dates) exp: >365 :</label>
                            <input type="text" class="form-control col-sm-2 @error('enrolment_leave_date_calculation') is-invalid @enderror" value="{{$enrolment_leave_setups->enrolment_leave_date_calculation}}" id="pwd" name="enrolment_leave_date_calculation" required>
                          </div>

                          <div class="form-group">
                            <label for="pwd">Leve Dates:</label>
                            <input type="text" class="form-control col-sm-2 @error('enrolment_leave_total') is-invalid @enderror" value="{{$enrolment_leave_setups->enrolment_leave_total}}" id="pwd" name="enrolment_leave_total" required>
                          </div>


                                      <input type="hidden" value="{{ $enrolment_leave_setups->enrolment_leave_setups_id }}" name="enrolment_leave_setups_id">
                   <br> </br>


                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

          </div>
        </div>
      </div>

                @endforeach

              </tbody>
            </table>

          </div>

        </div>
      </div><!-- End Recent Sales -->





    <!---- new item crate modale !---------->

      <div class="modal fade" id="newone" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New {{ $data['title'] }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/new_enrolmentLeave" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="pwd">Enrolment Name:</label>
                        <select name="enrolment_employee_enrolment_types_id" class="custom-select" required>
                            <option selected>Select Enrolment</option>
                            @foreach ($data['enrolment_name'] as  $enrolment_name)
                            <option value="{{$enrolment_name->employee_enrolment_types_id}}">{{$enrolment_name->employee_enrolment_types_name}}</option>
                            @endforeach
                          </select>
                      </div>


                    <div class="form-group">
                        <label for="pwd">Leave Type:</label>
                        <select name="enrolment_leave_types_id" class="custom-select" required>
                            <option selected>Select Leave Type</option>
                            @foreach ($data['leave_type'] as  $leave_type)
                            <option value="{{$leave_type->leave_types_id}}">{{$leave_type->leave_types_name}}</option>
                            @endforeach
                          </select>
                      </div>


                    <div class="form-group">
                        <label for="pwd">Calculation (> or < or = dates) exp: >365 :</label>
                        <input type="text" class="form-control col-sm-2 @error('enrolment_leave_date_calculation') is-invalid @enderror" placeholder="Calculation" id="pwd" name="enrolment_leave_date_calculation" required>
                      </div>

                      <div class="form-group">
                        <label for="pwd">Leve Dates:</label>
                        <input type="text" class="form-control col-sm-2 @error('enrolment_leave_total') is-invalid @enderror" placeholder="Dates" id="pwd" name="enrolment_leave_total" required>
                      </div>


                    </br>


                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
             </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div><!-- End Large Modal-->


    </section>
