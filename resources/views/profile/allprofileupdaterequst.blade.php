<div class="col">
    <div class="card recent-sales overflow-auto">



        <div class="card-body">



            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-sm-3">Firstname / Lastname</th>
                        <th>Reason for request</th>
                        <th class="col-sm-1"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data['profile'] as $key => $row)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->waiting_approvel_profile_first_name . '  ' . $row->waiting_approvel_profile_last_name }}
                            </td>
                            <td> {!! html_entity_decode($row->waiting_reasons_for_request_to_change) !!}</td>
                            <td><i class="bi bi-pencil-square text-success"
                                    style="font-size: 1.5rem; color: cornflowerblue;"  data-toggle="modal" data-target="#update{{ $row->waiting_approvel_profile_id  }}"></i></td>
                        </tr>





                        <div class="modal fade" id="update{{ $row->waiting_approvel_profile_id  }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            {{ $row->waiting_approvel_profile_Full_name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/updaterequst" method="post">
                                            @csrf
                                            <div class="mt-3">
                                                <h4>Personal Details</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <label for="email">Full Name:</label>
                                                        <input   disabled type="text"
                                                            class="form-control  @error('waiting_approvel_profile_Full_name') is-invalid @enderror @error('waiting_approvel_profile_Full_name') is-invalid @enderror "
                                                            value="{{ $row->waiting_approvel_profile_Full_name }}"
                                                            id="email"
                                                            required>
                                                        @error('waiting_approvel_profile_Full_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">First Name:</label>
                                                        <input   disabled type="text"
                                                            class="form-control  @error('waiting_approvel_profile_first_name') is-invalid @enderror"
                                                            placeholder="Call Name" id="email"
                                                            value="{{ $row->waiting_approvel_profile_first_name }}"
                                                            required name="waiting_approvel_profile_first_name">
                                                        @error('waiting_approvel_profile_first_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Last Name :</label>
                                                        <input   disabled type="text"
                                                            class="form-control  @error('waiting_approvel_profile_last_name') is-invalid @enderror"
                                                            placeholder="Call Name" id="email"
                                                            value="{{ $row->waiting_approvel_profile_last_name }}"
                                                            required name="waiting_approvel_profile_last_name">
                                                        @error('waiting_approvel_profile_last_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>




                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email">Gender:</label>
                                                        <select   disabled
                                                            class="custom-select  @error('waiting_approvel_profile_gender') is-invalid @enderror"
                                                            name="waiting_approvel_profile_gender" required>
                                                            <option>{{ $row->waiting_approvel_profile_gender }}</option>
                                                            <option>Female</option>
                                                            <option>Male</option>
                                                        </select>
                                                        @error('waiting_approvel_profile_gender')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Religion:</label>
                                                        <select   disabled
                                                            class="custom-select  @error('waiting_approvel_religion_id') is-invalid @enderror"
                                                            name="waiting_approvel_religion_id" required>

                                                            <option value="{{ $row->waiting_approvel_religion_id }}">
                                                                {{ $row->religion_name }}
                                                            </option>
                                                            @foreach ($data['religions'] as $religions)
                                                                <option value="{{ $religions->religion_id }}">
                                                                    {{ $religions->religion_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('waiting_approvel_religion_id')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Living Province:</label>
                                                        <select   disabled
                                                            class="custom-select  @error('waiting_approvel_profile_living_province') is-invalid @enderror"
                                                            name="waiting_approvel_profile_living_province"
                                                            value="{{ old('waiting_approvel_profile_living_province') }}"
                                                            required>
                                                            <option>
                                                                {{ $row->waiting_approvel_profile_living_province }}
                                                            </option>
                                                            <option>Central</option>
                                                            <option>East</option>
                                                            <option>Northcentral</option>
                                                            <option>North</option>
                                                            <option>Northwest</option>
                                                            <option>Sabaragamuwa</option>
                                                            <option>South</option>
                                                            <option>Uva</option>
                                                            <option>West</option>
                                                        </select>
                                                        @error('waiting_approvel_profile_living_province')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>






                                            <div class="row">




                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Marital Status:</label>
                                                        <select   disabled
                                                            class="custom-select  @error('waiting_approvel_profile_marital_status') is-invalid @enderror"
                                                            name="waiting_approvel_profile_marital_status" required>
                                                            <option>{{ $row->waiting_approvel_profile_marital_status }}
                                                            </option>
                                                            <option>Single</option>
                                                            <option>Married</option>
                                                            <option>Divorced</option>
                                                        </select>
                                                        @error('waiting_approvel_profile_marital_status')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Nic:</label>
                                                        <input   disabled type="text"
                                                            class="form-control  @error('waiting_approvel_profile_nic') is-invalid @enderror"
                                                            value="{{ $row->waiting_approvel_profile_nic }}"
                                                            id="email" name="waiting_approvel_profile_nic" required>
                                                        @error('waiting_approvel_profile_nic')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Birth Day:</label>
                                                        <input   disabled type="date"
                                                            class="form-control  @error('waiting_approvel_profile_bith_day') is-invalid @enderror"
                                                            value="{{ $row->waiting_approvel_profile_bith_day }}"
                                                            id="email" name="waiting_approvel_profile_bith_day"
                                                            required>
                                                        @error('waiting_approvel_profile_bith_day')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">

                                            </div>




                                            <div class="mt-3">
                                                <h4>Contact Details</h4>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Mobile Number:</label>
                                                        <input   disabled type="tel"
                                                            class="form-control  @error('waiting_approvel_profile_mobile_number') is-invalid @enderror"
                                                            value="{{ $row->waiting_approvel_profile_mobile_number }}"
                                                            id="email"
                                                            name="waiting_approvel_profile_mobile_number" required
                                                            maxlength="10">
                                                        @error('waiting_approvel_profile_mobile_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email">Email address:</label>
                                                        <input   disabled type="email"
                                                            class="form-control  @error('waiting_approvel_profile_email') is-invalid @enderror"
                                                            value="{{ $row->waiting_approvel_profile_email }}"
                                                            id="email" name="waiting_approvel_profile_email">
                                                        @error('waiting_approvel_profile_email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Permant address:</label>
                                                        <textarea class="form-control ckeditor @error('waiting_approvel_profile_permant_address') is-invalid @enderror"
                                                            name="waiting_approvel_profile_permant_address" required rows="5" cols="3">{{ $row->waiting_approvel_profile_permant_address }}</textarea>
                                                        @error('waiting_approvel_profile_permant_address')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Current address:</label>
                                                        <textarea class="form-control ckeditor  @error('waiting_approvel_profile_current_address') is-invalid @enderror"
                                                            name="waiting_approvel_profile_current_address" required rows="5" cols="3">{{ $row->waiting_approvel_profile_current_address }}</textarea>
                                                        @error('waiting_approvel_profile_current_address')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">

                                            </div>

                                            <div class="mt-3">
                                                <h4>Emergency Contact Details</h4>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Emergency Contact Person Name:</label>
                                                        <input   disabled type="tel"
                                                            class="form-control  @error('waiting_approvel_profile_emergency_contact_person_name') is-invalid @enderror"
                                                            id="email"
                                                            name="waiting_approvel_profile_emergency_contact_person_name"
                                                            value="{{ $row->waiting_approvel_profile_emergency_contact_person_name }}"
                                                            required maxlength="100">
                                                        @error('waiting_approvel_profile_emergency_contact_person_name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Relationship:</label>
                                                        <input   disabled type="tel"
                                                            class="form-control  @error('waiting_approvel_profile_relationship') is-invalid @enderror"
                                                            id="email"
                                                            name="waiting_approvel_profile_relationship"
                                                            value="{{ $row->waiting_approvel_profile_relationship }}"
                                                            required maxlength="100">
                                                        @error('waiting_approvel_profile_relationship')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="email">Emergency Mobile Number:</label>
                                                        <input   disabled type="tel"
                                                            class="form-control  @error('waiting_approvel_profile_emergency_mobile_number') is-invalid @enderror"
                                                            id="email"
                                                            name="waiting_approvel_profile_emergency_mobile_number"
                                                            value="{{ $row->waiting_approvel_profile_emergency_mobile_number }}"
                                                            id="email" required maxlength="10">
                                                        @error('waiting_approvel_profile_emergency_mobile_number')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>




                                            </div>



                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="email">Reasons for request to change</label>
                                                        <textarea class="form-control ckeditor  @error('waiting_reasons_for_request_to_change') is-invalid @enderror"
                                                            name="waiting_reasons_for_request_to_change" required rows="5" cols="3" required>{{ $row->waiting_reasons_for_request_to_change }}</textarea>
                                                        @error('waiting_reasons_for_request_to_change')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>


                                            <input type="hidden" name="waiting_approvel_profile_id"  value="{{ $row->waiting_approvel_profile_id }}">

                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </tbody>
            </table>


        </div>
    </div>
</div>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
