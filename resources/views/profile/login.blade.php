

        <?php
        $user_permition_details = DB::table('users')
            ->select('*')
            ->where('profile_id', '=', $profile[0]->profile_id)
            ->get();
        ?>

        @if (!$user_permition_details->isEmpty())
        @else
            <div class="row mb-1 mt-1">
                <div class="col-sm-3">

                    <button type="button" class="btn btn-success mb-5 " class="btn btn-primary" data-toggle="modal"
                        data-target="#accountcrate"> <i class="bi bi-plus" style=""> Account crate</i></button>
                    <!---  <i class="bi bi-file-earmark-plus text-success" style="font-size: 2rem;" data-toggle="modal" data-target="#accountcrate" title="New Account crate"></i> !---->
                </div>
            </div>
        @endif






            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>HR Admin</th>
                  <th>Subsidiaries HR</th>
                  <th>Profile Owner</th>
                  <th>IT Admin</th>
                  <th>Leave Approval</th>
                  <th>Report View</th>
                  <th>Subsidiaries Head</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user_permition_details as $user_permition)

                <tr>
                  <td> @if (!empty($user_permition->hrAdmin)) Yes @else No @endif</td>
                  <td> @if (!empty($user_permition->hr)) Yes @else No @endif</td>
                  <td> @if (!empty($user_permition->profileUser)) Yes @else No @endif</td>
                  <td> @if (!empty($user_permition->pcAdmin)) Yes @else No @endif</td>
                  <td> @if (!empty($user_permition->leveApprovalUser)) Yes @else No @endif</td>
                  <td> @if (!empty($user_permition->reportView)) Yes @else No @endif </td>
                  <td> @if (!empty($user_permition->sbuhead)) Yes @else No @endif</td>
                  <td>
                    <button type="button" class="btn " data-toggle="modal" data-target="#editaccount"><i  class="bi bi-pencil-square text-success" style="font-size: 1.5rem;"></i></button>
                    <button type="button" class="btn " data-toggle="modal" data-target="#deletaccount"><i  class="bi bi-trash3 text-danger" style="font-size: 1.5rem;"></i></button>

                  </td>
                </tr>




                <div class="modal fade" id="deletaccount">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delet Account :</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">

                                <form action="/deletaccount" method="post">
                                    @csrf


                                    <input type="hidden" value="{{ $user_permition->id }}" name="id">
                                    <input type="hidden" value="{{ $profile[0]->profile_first_name }}"
                                        name="profile_first_name">
                                    <input type="hidden" value="{{ $profile[0]->profile_email }}" name="email">
                                    <input type="hidden" value="{{ $profile[0]->profile_id }}" name="profile_id">
                                    <input type="hidden" value="{{ $profile[0]->profile_number }}"
                                        name="profile_number">
                                    <input type="hidden" value="{{ $profile[0]->profile_sug }}" name="profile_sug">
                                    <button type="submit" class="btn btn-success">Yes I need to delet this.</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                </form>

                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>









                <div class="modal fade" id="editaccount">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Account :</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">

                            <form action="/editaccount" method="post">
                                @csrf


                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">HR Admin: </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('hrAdmin') is-invalid @enderror" name="hrAdmin" @if(!empty($user_permition->hrAdmin)) checked  @endif>
                                          </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">Subsidiaries HR : </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('hr') is-invalid @enderror" name="hr" @if(!empty($user_permition->hr)) checked  @endif>
                                          </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">Profile Owner: </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('profileUser') is-invalid @enderror" name="profileUser" @if(!empty($user_permition->profileUser)) checked  @endif>
                                          </div>
                                    </div>

                                </div>






                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">Leave Approval: </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('leveApprovalUser') is-invalid @enderror" name="leveApprovalUser" @if(!empty($user_permition->leveApprovalUser)) checked  @endif>
                                          </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">Report View: </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('reportView') is-invalid @enderror" name="reportView" @if(!empty($user_permition->reportView)) checked  @endif>
                                          </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">Subsidiaries Head: </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('sbuhead') is-invalid @enderror" name="sbuhead" @if(!empty($user_permition->sbuhead)) checked  @endif>
                                          </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email" class="form-check-label">IT Admin: </label>
                                           <input type="checkbox" class="form-check-input ml-2 @error('pcAdmin') is-invalid @enderror" name="pcAdmin" @if(!empty($user_permition->pcAdmin)) checked  @endif>
                                          </div>
                                    </div>

                                </div>

                            <input type="hidden" value="{{ $user_permition->id}}" name="id">
                            <input type="hidden" value="{{ $profile[0]->profile_first_name}}" name="profile_first_name">
                            <input type="hidden" value="{{ $profile[0]->profile_email}}" name="email">
                            <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                            <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                            <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                            <button type="submit" class="btn btn-success">Update Account</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
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



            <div class="modal fade" id="accountcrate">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Create Account :</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">

                        <form action="/newaccount" method="post">
                            @csrf


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">HR Admin: </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('hrAdmin') is-invalid @enderror" name="hrAdmin">
                                      </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">Subsidiaries HR : </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('hr') is-invalid @enderror" name="hr">
                                      </div>
                                </div>


                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">Profile Owner: </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('profileUser') is-invalid @enderror" name="profileUser">
                                      </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">IT Admin: </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('pcAdmin') is-invalid @enderror" name="pcAdmin">
                                      </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">Leave Approval: </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('leveApprovalUser') is-invalid @enderror" name="leveApprovalUser">
                                      </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">Report View: </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('reportView') is-invalid @enderror" name="reportView">
                                      </div>
                                </div>

                            </div>


                            <div class="row">



                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="form-check-label">Subsidiaries Head: </label>
                                       <input type="checkbox" class="form-check-input ml-2 @error('sbuhead') is-invalid @enderror" name="sbuhead" >
                                      </div>
                                </div>

                            </div>


                        <input type="hidden" value="{{ $profile[0]->profile_first_name}}" name="profile_first_name">
                        <input type="hidden" value="{{ $profile[0]->profile_email}}" name="email">
                        <input type="hidden" value="{{$profile[0]->profile_id}}" name="profile_id">
                        <input type="hidden" value="{{$profile[0]->profile_number}}" name="profile_number">
                        <input type="hidden" value="{{$profile[0]->subsidiaries_logo}}" name="subsidiaries_logo">
                        <input type="hidden" value="{{$profile[0]->profile_sug}}" name="profile_sug">
                        <button type="submit" class="btn btn-success">Crate A Account</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </form>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                  </div>
                </div>
            




