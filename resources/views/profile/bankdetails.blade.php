<div class="row mt-3 mb-2">
    <div class="row mb-3">
      <div class="col">
          <button type="button" class="btn btn-success mb-5 mt-3" class="btn btn-primary" data-toggle="modal" data-target="#newbankdetails">  <i class="bi bi-plus" style=""> New Account</i></button>

      <!-------  <i class="bi  bi-file-earmark-plus text-success" style="font-size: 1rem; color:" data-toggle="modal" data-target="#newbankdetails"> New Account</i> ----!---->
    </div>



<table class="table table-hover mt-2">
  <thead>
    <tr>
      <th>Bank Name</th>
      <th>Branch</th>
      <th>Account Number</th>
      <th>Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>



      @foreach ( $data['accountdetails'] as $account_details)


    <tr>
      <td>{{ $account_details->account_bank_name}}</td>
      <td>{{ $account_details->account_bank_branch}}</td>
      <td>{{ $account_details->account_bank_number}}</td>
      <td>{{ $account_details->account_status}}</td>
      <td>
          <i class="bi bi-pencil-square text-success" style="font-size: 1.5rem;" data-toggle="modal" data-target="#updatebankdetails{{ $account_details->account_id}}"></i>

       <!--   <button type="button" class="btn btn-success"  >Edit</button></td>!---->
    </tr>



    <!-- Account details upddate !-------->
 <div class="modal fade" id="updatebankdetails{{ $account_details->account_id}}">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Account Details:</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">

          <form action="/update_bank_account" method="post">
              @csrf


          <div class="row">

                  <div class="col">
                      <div class="form-group">
                        <label for="email">Bank Name:</label>
                         <input type="tel" name="account_bank_name" class="form-control  @error('account_bank_name') is-invalid @enderror" value="{{ $account_details->account_bank_name}}"  required >
                        @error('account_bank_name')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                  </div>


                  <div class="col">
                      <div class="form-group">
                        <label for="email">Branch Name:</label>
                         <input type="tel" name="account_bank_branch" class="form-control  @error('account_bank_branch') is-invalid @enderror" value="{{ $account_details->account_bank_branch}}"  required >
                        @error('account_bank_branch')<div class="text-danger">{{ $message }}</div> @enderror
                      </div>
                  </div>

          </div>

          <div class="row">
              <div class="col">
                  <div class="form-group">
                    <label for="email">Account Number:</label>
                     <input type="tel" name="account_bank_number" class="form-control  @error('account_bank_number') is-invalid @enderror" value="{{ $account_details->account_bank_number}}"  required >
                    @error('account_bank_number')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <div class="form-group">
                    <label for="email">Reason:</label>
                     <input type="tel" name="account_reson_to_ad" class="form-control  @error('account_reson_to_ad') is-invalid @enderror" value="{{ $account_details->account_reson_to_ad}}"  required >
                    @error('account_reson_to_ad')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <div class="form-group">
                    <label for="email">Updated Reason:</label>
                     <input type="tel" name="account_reson_to_update" class="form-control  @error('account_reson_to_update') is-invalid @enderror" value="{{ $account_details->account_reson_to_update}}"  required >
                    @error('account_reson_to_update')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
              </div>
          </div>



          <div class="row">
              <div class="col-sm-3">
                  <div class="form-group">
                    <label for="email">Account Status:</label>
                    <select  name="account_status" class="custom-select @error('account_reson_to_update') is-invalid @enderror" required>
                      <option>{{ $account_details->account_status}}</option>
                      <option>Active</option>
                      <option>Deactive</option>

                    </select>

                    @error('account_status')<div class="text-danger">{{ $message }}</div> @enderror
                  </div>
              </div>
          </div>




          <div class="row">
              <div class="col mt-3">
               Last Edited : {{$account_details->account_update_by}}  /  {{$account_details->account_update_date}}
              </div>
            </div>

            <div class="row">
              <div class="col mb-3">
               Created : {{$account_details->account_add_by}}  /  {{$account_details->account_add_date}}
              </div>
            </div>


          <input type="hidden" value="{{$account_details->account_id}}" name="account_id">
          <input type="hidden" value="{{$profile[0]->profile_id}}" name="account_profile_id">
          <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
          <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
          <button type="submit" class="btn btn-success" name="joindetails">Save</button>
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





      <div class="modal fade" id="newbankdetails">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">New Account Details:</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">

                <form action="/new_bank_account" method="post">
                    @csrf


                <div class="row">

                        <div class="col">
                            <div class="form-group">
                              <label for="email">Bank Name:</label>
                               <input type="tel" name="account_bank_name" class="form-control  @error('account_bank_name') is-invalid @enderror" value=""  required >
                              @error('account_bank_name')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-group">
                              <label for="email">Branch Name:</label>
                               <input type="tel" name="account_bank_branch" class="form-control  @error('account_bank_branch') is-invalid @enderror" value=""  required >
                              @error('account_bank_branch')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label for="email">Account Number:</label>
                           <input type="tel" name="account_bank_number" class="form-control  @error('account_bank_number') is-invalid @enderror" value=""  required >
                          @error('account_bank_number')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label for="email">Reason For Adding:</label>
                           <input type="tel" name="account_reson_to_ad" class="form-control  @error('account_reson_to_ad') is-invalid @enderror" value=""  required >
                          @error('>account_reson_to_ad')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <input type="hidden" value="{{$profile[0]->profile_id}}" name="account_profile_id">
                <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                <button type="submit" class="btn btn-success">Save</button>
                </form>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </div>
          </div>
        </div>


</div>




    <!-- Display the countdown timer in an element -->


