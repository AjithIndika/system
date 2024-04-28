<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
<!-------- test !------>


          <div class="card-body">
            <h5 class="card-title">Users <span>  </span></h5>
            <div class="@error('profile_Full_name') is-invalid @enderror"></div>
            <table class="table table-borderless datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Equpment add</th>
                  <th scope="col">IT Setting</th>
                  <th scope="col">Ticket Update</th>
                  <th scope="col">Ticket Assing</th>
                  <th scope="col">Ticket View</th>
                  <th scope="col">Report</th>
                  <th scope="col">User </th>
                  <th scope="col">Invoice </th>
                  <th scope="col">IT Executive</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1 ?>
                @foreach ( $data['userDetails'] as $userDetails)

                <tr>
                    <td scope="col">{{$i++}}</td>
                    <td scope="col">{{$userDetails->name}}</td>
                    <td scope="col">{{$userDetails->itequipmentadd}}</td>
                    <td scope="col">{{$userDetails->itsetting}}</td>
                    <td scope="col">{{$userDetails->ticketupdate}}</td>
                    <td scope="col">{{$userDetails->ticket_assign}}</td>
                    <td scope="col">{{$userDetails->ticketview}}</td>
                    <td scope="col">{{$userDetails->report}}</td>
                    <td scope="col">{{$userDetails->userpermition}}</td>
                    <td scope="col">{{$userDetails->invoice_permition}}</td>
                    <td scope="col">{{$userDetails->sbuPcAdmin}}</td>
                    
                    <td scope="col">

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#userUpdate{{$userDetails->id}}">Permition Update</button>

                    </td>
                  </tr>




                  <!-- The Modal -->
<div class="modal fade" id="userUpdate{{$userDetails->id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Do you need Edit {{$userDetails->name}} permittion ? </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form action="/userupdate" method="post">
                @csrf


                <div class="row">


                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="defaultCheck"  name="itequipmentadd" value="on" @if (!empty($userDetails->itequipmentadd)) checked  @endif>
                           <label for="defaultCheck">IT Equpment Add</label>
                          </div>
                    </div>

                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="defaultCheck" name="itsetting" value="on" @if (!empty($userDetails->itsetting)) checked  @endif>
                           <label for="defaultCheck">IT Setting</label>
                          </div>
                    </div>


                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="defaultCheck" name="ticket_assign" value="on" @if (!empty($userDetails->ticket_assign)) checked  @endif>
                            <label for="defaultCheck">Ticket Assign</label>
                          </div>
                    </div>


                    <div class="col">
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" id="defaultCheck" name="ticketupdate" value="on" @if (!empty($userDetails->ticketupdate)) checked  @endif>
                          <label for="defaultCheck">Ticket Update</label>
                        </div>
                  </div>




                  


                </div>


                <div class="row">

                  <div class="col">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="defaultCheck"  name="ticketview" value="on" @if (!empty($userDetails->ticketview)) checked  @endif>
                        <label for="defaultCheck">Ticket View</label>
                      </div>
                </div>


                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="defaultCheck"  name="report" value="on" @if (!empty($userDetails->report)) checked  @endif>
                            <label for="defaultCheck">Report</label>
                        </div>
                    </div>

                    <div class="col">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="defaultCheck"  name="userpermition" value="on" @if (!empty($userDetails->userpermition)) checked  @endif>
                            <label for="defaultCheck">User Permition</label>
                          </div>
                    </div>

                    <div class="col">
                      <div class="custom-control custom-checkbox">
                              <input type="checkbox" id="defaultCheck"  name="invoice_permition" value="on" @if (!empty($userDetails->invoice_permition)) checked  @endif>
                              <label for="defaultCheck">Invoice</label>
                        </div>
                  </div>
                   
                </div>



                <div class="row">

                  <div class="col">
                    <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="defaultCheck"  name="sbuPcAdmin" value="on" @if (!empty($userDetails->sbuPcAdmin)) checked  @endif>
                            <label for="defaultCheck">IT Executive</label>
                      </div>
                </div>

               

              

                 
              </div>



                <input type="hidden" value="{{$userDetails->id}}" name="id">

                 <input type="submit" value="Save" class="mt btn btn-success">
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




    </section>
