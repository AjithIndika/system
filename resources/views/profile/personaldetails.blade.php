<div class="mt-3"></div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email">Full Name :</label>
            <input type="email" class="form-control" id="email" value="{{ $profile[0]->profile_Full_name }}" disabled>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-6">
        <div class="form-group">
            <label for="email">First Name :</label>
            <input type="email" class="form-control col" value="{{ $profile[0]->profile_first_name }}" id="email"
                disabled>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="email">Surname :</label>
            <input type="email" class="form-control col" value="{{ $profile[0]->profile_last_name }}" id="email"
                disabled>
        </div>
    </div>


</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="email">Age:</label>
            <input type="email" class="form-control" id="result" disabled>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Gender:</label>
            <input type="email" class="form-control " value="{{ $profile[0]->profile_gender }}" id="email"
                disabled>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Marital Status:</label>
            <input type="email" class="form-control col" value="{{ $profile[0]->profile_marital_status }}"
                id="email" disabled>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="email">Birth Day:</label>
            <input type="email" class="form-control" value="{{ $profile[0]->profile_bith_day }}" disabled>
        </div>
    </div>
</div>



<div class="row">

    <div class="col">
        <div class="form-group">
            <label for="email">NIC:</label>
            <input type="email" class="form-control" value="{{ $profile[0]->profile_nic }}" id="email" disabled>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Province:</label>
            <input type="email" class="form-control " value="{{ $profile[0]->profile_living_province }}"
                id="email" disabled>
        </div>
    </div>




</div>


<div>
    <hr class="text-success">
    </hr>

    <h4>Personal Contact Details</h4>
</div>

<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="email">Personal Mobile Number:</label>
            <input type="email" class="form-control " value="{{ $profile[0]->profile_mobile_number }}" id="email"
                disabled>
        </div>
    </div>


    <div class="col-sm-4">
        <div class="form-group">
            <label for="email">Personal Email Address:</label>
            <input type="email" class="form-control " value="{{ $profile[0]->profile_email }}" id="email"
                disabled>
        </div>
    </div>

</div>


<div class="row mt-1">
    <div class="col">
        <div class="form-group">

            <hr>
            </hr>
            <label for="email"><strong>Permanent Address:</strong></label>
            <p> {!! html_entity_decode($profile[0]->profile_permant_address) !!}</p>
        </div>
    </div>

    <div class="col">
        <div class="form-group">

            <hr>
            </hr>
            <label for="email"><strong>Current Address:</strong></label>
            <p> {!! html_entity_decode($profile[0]->profile_current_address) !!}</p>
        </div>
    </div>
</div>

<div class="row mt-1">
    <hr>
    </hr>
    <div class="mt-3 mb-3">
        <h4>Emergency Contact Details</h4>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Emergency Contact Person Name</label>
            <input type="email" class="form-control "
                value="{{ $profile[0]->profile_emergency_contact_person_name }}" id="email" disabled>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Relationship:</label>
            <input type="email" class="form-control " value="{{ $profile[0]->profile_relationship }}"
                id="email" disabled>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Emergency Mobile Number:</label>
            <input type="email" class="form-control " value="{{ $profile[0]->profile_emergency_mobile_number }}"
                id="email" disabled>
        </div>
    </div>


</div>






@if ($profile[0]->profile_id ==Auth::user()->profile_id)
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-pencil-square-o  fa-1x" aria-hidden="true" title=""> Edit personal details </i>
    </button>
@endif



<!---- edit personl Details !------>

<!----- personal details update !----------->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $profile[0]->profile_Full_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/edit_profile_personal_details" method="post">
                    @csrf

                    <div class="mt-3">
                        <h4>Personal Details</h4>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label for="email">Full Name:</label>
                                <input type="text"
                                    class="form-control  @error('profile_Full_name') is-invalid @enderror @error('profile_Full_name') is-invalid @enderror "
                                    value="{{ $profile[0]->profile_Full_name }}" id="email"
                                    name="profile_Full_name" required >
                                @error('profile_Full_nam')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-group">
                                <label for="email">First Name:</label>
                                <input type="text"
                                    class="form-control  @error('profile_first_name') is-invalid @enderror"
                                    placeholder="Call Name" id="email"
                                    value="{{ $profile[0]->profile_first_name }}" required name="profile_first_name">
                                @error('profile_first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-group">
                                <label for="email">Last Name :</label>
                                <input type="text"
                                    class="form-control  @error('profile_last_name') is-invalid @enderror"
                                    placeholder="Call Name" id="email"
                                    value="{{ $profile[0]->profile_last_name }}" required name="profile_last_name">
                                @error('profile_last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>




                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">Gender:</label>
                                <select class="custom-select  @error('profile_gender') is-invalid @enderror"
                                    name="profile_gender" required>
                                    <option>{{ $profile[0]->profile_gender }}</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                                @error('profile_gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="email">Religion:</label>
                                <select class="custom-select  @error('religion_id') is-invalid @enderror"
                                    name="religion_id" required>

                                    <option value="{{ $profile[0]->religion_id }}">{{ $profile[0]->religion_name }}
                                    </option>
                                    @foreach ($data['religions'] as $religions)
                                        <option value="{{ $religions->religion_id }}">{{ $religions->religion_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('religion_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="email">Living Province:</label>
                                <select class="custom-select  @error('profile_living_province') is-invalid @enderror"
                                    name="profile_living_province" value="{{ old('profile_living_province') }}"
                                    required>
                                    <option>{{ $profile[0]->profile_living_province }}</option>
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
                                @error('profile_living_province')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>






                    <div class="row">




                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="email">Marital Status:</label>
                                <select class="custom-select  @error('profile_marital_status') is-invalid @enderror"
                                    name="profile_marital_status" required>
                                    <option>{{ $profile[0]->profile_marital_status }}</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Divorced</option>
                                </select>
                                @error('profile_marital_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="email">Nic:</label>
                                <input type="text" class="form-control  @error('profile_nic') is-invalid @enderror"
                                    value="{{ $profile[0]->profile_nic }}" id="email" name="profile_nic"
                                    required>
                                @error('profile_nic')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="email">Birth Day:</label>
                                <input type="date"
                                    class="form-control  @error('profile_bith_day') is-invalid @enderror"
                                    value="{{ $profile[0]->profile_bith_day }}" id="email"
                                    name="profile_bith_day" required>
                                @error('profile_bith_day')
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
                                <input type="tel"
                                    class="form-control  @error('profile_mobile_number') is-invalid @enderror"
                                    value="{{ $profile[0]->profile_mobile_number }}" id="email"
                                    name="profile_mobile_number" required maxlength="10">
                                @error('profile_mobile_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="email">Email address:</label>
                                <input type="email"
                                    class="form-control  @error('profile_email') is-invalid @enderror"
                                    value="{{ $profile[0]->profile_email }}" id="email" name="profile_email">
                                @error('profile_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Permanent address:</label>
                                <textarea class="form-control ckeditor @error('profile_permant_address') is-invalid @enderror"
                                    name="profile_permant_address" required rows="5" cols="3">{{ $profile[0]->profile_permant_address }}</textarea>
                                @error('profile_permant_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="email">Current address:</label>
                                <textarea class="form-control ckeditor  @error('profile_current_address') is-invalid @enderror"
                                    name="profile_current_address" required rows="5" cols="3">{{ $profile[0]->profile_current_address }}</textarea>
                                @error('profile_current_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="row">

                    </div>

                    <div class="mt-3"><h4>Emergency Contact Details</h4></div>
                    <div class="row">

                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="email">Emergency Contact Person Name:</label>
                            <input type="tel" class="form-control  @error('profile_emergency_contact_person_name') is-invalid @enderror"  id="email" name="profile_emergency_contact_person_name" value="{{ $profile[0]->profile_emergency_contact_person_name}}" required maxlength="100">
                            @error('profile_emergency_contact_person_name')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="email">Relationship:</label>
                            <input type="tel" class="form-control  @error('profile_relationship') is-invalid @enderror"  id="email" name="profile_relationship" value="{{ $profile[0]->profile_relationship }}" required maxlength="100">
                            @error('profile_relationship')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="form-group">
                            <label for="email">Emergency Mobile Number:</label>
                            <input type="tel" class="form-control  @error('profile_emergency_mobile_number') is-invalid @enderror"  id="email" name="profile_emergency_mobile_number" value="{{ $profile[0]->profile_emergency_mobile_number }}" id="email" required maxlength="10">
                            @error('profile_emergency_mobile_number')<div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        </div>




                    </div>



                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Reasons for request to change</label>
                                <textarea class="form-control ckeditor  @error('reasons_for_request_to_change') is-invalid @enderror"
                                    name="reasons_for_request_to_change" required rows="5" cols="3" required></textarea>
                                @error('reasons_for_request_to_change')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <input type="hidden" name="profile_id" value="{{ $profile[0]->profile_id }}">
                    <input type="hidden" name="profile_number" value="{{ $profile[0]->profile_number }}">



                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
