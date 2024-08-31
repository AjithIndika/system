<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<section class="section dashboard">
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body mb-4">
<!---------
                <form action="" method="POST">

                    <div class="row mt-5">
                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Organization:</label>

                                <select class="custom-select organization" name="organization">
                                    <option>Select One</option>
                                    @foreach ($data['subsidiaries'] as $subsidiaries)
                                    <option value="{{$subsidiaries->subsidiaries_id}}">{{$subsidiaries->subsidiaries_name}}</option> 
                                    @endforeach
                                   
                                </select>
                               
                              </div>
                        </div>

                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Department:</label>
                                <select class="custom-select   department" name="department">
                                    <option>Select One</option>
                                    @foreach ($data['departments'] as $departments)
                                    <option value="{{$departments->department_id}}">{{$departments->department_name}}</option> 
                                    @endforeach
                                </select>
                              </div>
                        </div>


                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Designations:</label>
                                <select class="custom-select   designations" name="designations">
                                    <option>Select One</option>
                                    @foreach ($data['designations'] as $designations)
                                    <option value="{{$designations->designations_id}}">{{$designations->designations_name}}</option> 
                                    @endforeach
                                </select>
                              </div>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Living Province:</label>
                                <select  class="custom-select  @error('profile_living_province') is-invalid @enderror" name="profile_living_province" value="{{ old('profile_living_province') }}" required>
                                    <option>Select One</option>
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
                                @error('profile_living_province')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                        </div>

                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Office location:</label>
                                <select class="custom-select   office_location" name="office_location">
                                  
                                        <option>Select One</option>
                                        @foreach ($data['office_locations'] as $office_locations)
                                        <option value="{{$office_locations->office_locations_id}}">{{$office_locations->office_locations_name}}</option> 
                                        @endforeach
                                   
                                </select>
                              </div>
                        </div>


                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Gender:</label>
                                <select  class="custom-select  @error('profile_gender') is-invalid @enderror" name="profile_gender" value="{{ old('profile_gender') }}" required>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                              </div>
                        </div>                        
                    </div>


                    <div class="row">
                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Marital Status:</label>
                                <select  class="custom-select  @error('profile_marital_status') is-invalid @enderror" name="profile_marital_status" value="{{ old('profile_marital_status') }}" required>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Divorced</option>
                                </select>
                                @error('profile_marital_status')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                        </div>

                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">Reporting Manager:</label>
                                <select class="custom-select  @error('profile_job_join_head_of_sbu') is-invalid @enderror profile_job_join_head_of_sbu" name="profile_job_join_head_of_sbu" >
                                    @foreach ($data['sbu_head'] as $sbu_head)
                                    <option value="{{$sbu_head->profile_id}}">{{$sbu_head->profile_Full_name}}</option>
                                    @endforeach
                                </select>
                                @error('profile_job_join_head_of_sbu')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                        </div>


                        <div class="col"> 
                            <div class="form-group">
                                <label for="email">This Profile Reporting Manager:</label>
                                <select  class="custom-select  @error('profile_head_of_departmrnt_this_account') is-invalid @enderror" name="profile_head_of_departmrnt_this_account" value="{{ old('profile_head_of_departmrnt_this_account') }}" required>
                                    <option value="Deactivate">Deactivate</option>
                                    <option value="Active">Active</option>
        
                                </select>
                                @error('profile_head_of_departmrnt_this_account')<div class="text-danger">{{ $message }}</div> @enderror
                              </div>
                        </div>                        
                    </div>


                </form>
!--------------->
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('.organization').select2();
    });

    $(document).ready(function() {
        $('.department').select2();
    });

    $(document).ready(function() {
        $('.designations').select2();
    });

    $(document).ready(function() {
        $('.profile_living_province').select2();
    });

    $(document).ready(function() {
        $('.office_location').select2();
    });

    $(document).ready(function() {
        $('.profile_living_province').select2();
    });



    

</script>

<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }
</style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.min.css" rel="stylesheet">

<link href="//rawgit.com/vitalets/x-editable/master/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.0/bootstrap-table.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/editable/bootstrap-table-editable.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/export/bootstrap-table-export.js"></script>

<script src="//rawgit.com/hhurz/tableExport.jquery.plugin/master/tableExport.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.js"></script>



<div >
 
    <div id="toolbar">
            <select class="form-control">
                    <option value="">Export Basic</option>
                    <option value="all">Export All</option>
                    <option value="selected">Export Selected</option>
            </select>
    </div>
    
    <table id="table" 
                 data-toggle="table"
                 data-search="true"
                 data-filter-control="true" 
                 data-show-export="true"
                 data-click-to-select="true"
                 data-toolbar="#toolbar">
        <thead>
            <tr>
                <th >#</th>
                <th data-field="state" data-checkbox="true"></th>                
                <th data-field="prenom" data-filter-control="input" data-sortable="true">Full Name:</th>
                <th data-field="date" data-filter-control="input" data-sortable="true">First Name:</th>
                <th data-field="examen" data-filter-control="input" data-sortable="true"> Last Name :</th>
                <th data-field="Religion" data-filter-control="input" data-sortable="true" >Religion:</th>
                <th data-field="birthday" data-filter-control="input" data-sortable="true" >Birth Day</th>
                <th data-field="nic" data-filter-control="input" data-sortable="true" >NIC</th>
                <th data-field="profile_living_province" data-filter-control="input" data-sortable="true" >Province </th>
                <th data-field="profile_marital_status" data-filter-control="input" data-sortable="true" >Marital Status</th>
                <th data-field="profile_gender" data-filter-control="input" data-sortable="true" >Gender</th>
                <th data-field="profile_permant_address" data-filter-control="input" data-sortable="true" >Permant Address</th>
                <th data-field="profile_current_address" data-filter-control="input" data-sortable="true" >Current Address</th>
                <th data-field="profile_mobile_number" data-filter-control="input" data-sortable="true" >Personal Mobile Number</th>
            </tr>
        </thead>
        <tbody>

            @foreach ( $data['profile'] as  $key =>$profile)
                
           
            <tr>
                <td>{{$key+1}}</td>
                <td class="bs-checkbox "><input data-index="{{$key++}}" name="btSelectItem" type="checkbox">{{$key+1}}</td>
                <td>{{$profile->profile_Full_name }}</td>
                <td>{{$profile->profile_first_name }}</td>
                <td>{{$profile->profile_last_name }}</td>
                <td>{{$profile->religion_name }}</td>
                <td>{{$profile->profile_bith_day }}</td>
                <td>{{$profile->profile_nic }}</td>               
                <td>{{$profile->profile_living_province }}</td>
                <td>{{$profile->profile_marital_status }}</td>
                <td>{{$profile->profile_gender}}</td>
                <td>{{ strip_tags($profile->profile_permant_address) }}</td>
                <td>{{ strip_tags($profile->profile_current_address) }}</td>
                <td>{{ strip_tags($profile->profile_mobile_number) }}</td>
            </tr>

            @endforeach
            
        </tbody>
    </table>
    </div>

    <style>
        .container {
	width: 100%;
	padding: 2em;
}

.bold-blue {
	font-weight: bold;
	color: #0277BD;
}
    </style>