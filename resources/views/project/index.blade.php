
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>


<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mb-5">

            <div class="mt-4 mb-4"><h4>Project Names</h4></div>

            <div><button type="button" class="btn btn-success mb-4"  data-toggle="modal" data-target="#NewProjectName"><i class="fa fa-plus" aria-hidden="true"></i>
                  New Project Name</button></div>


            <table id="example" class="display mt-6" style="width:100%" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Organization</th>
                        <th>Project Name</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['project'] as $key=>$project)
                        
                   
                    <tr>
                        <td>{{ $key + 1}}</td> 
                        <td>{{$project->subsidiaries_name}}</td>
                        <td>{{$project->project_name}}</td>
                        <td><button type="button" class="btn btn-success"  data-toggle="modal" data-target="#edit{{$project->projctnames_id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                        </td>                        
                    </tr>


                    <!-- The Modal -->
<div class="modal fade" id="edit{{$project->projctnames_id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Do you need to edit {{$project->project_name}} ? </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          


            <form method="post" action="/editproject">
                @csrf

                <input type="hidden" name="projctnames_id" value="{{$project->projctnames_id}}">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Organization:</label></br>
                            <select
                                class="custom-select  @error('subsidiaries_id') is-invalid @enderror profile_job_work_sbu"
                                name="subsidiaries_id" required style="width: 400px">
                                <option value="{{$project->subsidiaries_id}}"> {{$project->subsidiaries_name}} </option>
                                @foreach ($data['subsidiaries'] as $subsidiaries)
                                    <option value="{{ $subsidiaries->subsidiaries_id }}">
                                        {{ $subsidiaries->subsidiaries_name }}</option>
                                @endforeach

                            </select>
                            @error('subsidiaries_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Project Name:</label>
                            <input type="text" class="form-control @error('project_name') is-invalid @enderror project_name" name="project_name" value="{{$project->project_name}}" id="email">
                          </div>
                          @error('project_name')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>



                </div>

                <div>
                    <input type="submit" name="submit"  class="btn btn-success" >
                </div>
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
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Organization</th>
                        <th>Project Name</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>


        

          </div>
        </div>
    </div>
</section>



<div class="modal fade" id="NewProjectName">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New Project</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         

            <form method="post" action="/saveproject">
                @csrf

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Organization:</label></br>
                            <select
                                class="custom-select  @error('subsidiaries_id') is-invalid @enderror profile_job_work_sbu"
                                name="subsidiaries_id" required style="width: 400px">
                                <option value=""> Select Organization </option>

                                @foreach ($data['subsidiaries'] as $subsidiaries)
                                    <option value="{{ $subsidiaries->subsidiaries_id }}">
                                        {{ $subsidiaries->subsidiaries_name }}</option>
                                @endforeach

                            </select>
                            @error('subsidiaries_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Project Name:</label>
                            <input type="text" class="form-control @error('project_name') is-invalid @enderror project_name" name="project_name" placeholder="Project Name" id="email">
                          </div>
                          @error('project_name')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>



                </div>

                <div>
                    <input type="submit" name="submit"  value="Save" class="btn btn-success" >
                </div>
            </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>



<style>
    div.container {
        width: 80%;
    }
</style>

<script type="text/javascript">
new DataTable('#example');
</script>




<script>
    $(document).ready(function() {
        $('.profile_job_work_sbu').select2();
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>