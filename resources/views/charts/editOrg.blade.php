




@foreach ($data['jobWorking'] as $key=>$row)

<div class="row">


    <div class="col">
        <div class="form-group">
            <label for="email">Name</label>
            <input type="text" class="form-control"  value="{{$row->profile_call_name}}" id="email" readonly>
            <input type="hidden" class="form-control"  value="{{$row->profile_id}}" id="email" name="organization_profile_id[]">
            <input type="hidden" class="form-control"  value="{{ $data['subdiary']}}" id="email" name="organization_id[]">
          </div>
    </div>


    <div class="col">
        <div class="form-group">
            <label for="email">Job Rol</label>
            <input type="text" class="form-control"  value="{{$row->job_descriptions_name}}" id="email" readonly>
            <input type="hidden" class="form-control"  value="{{$row->job_descriptions_name}}" name="organization_job_rol[]" id="email" readonly>
            <input type="hidden" class="form-control"  value="{{$row->job_working_profile_id}}" name="organization_job_working_profile_id[]" id="email" readonly>

          </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Row</label>
            <input type="text" class="form-control"  value="{{$row->id}}" id="email" readonly>
          </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Col</label>
            <input type="text" class="form-control"  value="{{$row->pid}}" id="email" readonly>
          </div>
    </div>



    <div class="col">

        <i class="fa fa-pencil-square-o fa-2x mt-4" aria-hidden="true" data-toggle="modal" data-target="#edit{{$row->organization_charts_id}}"></i>





        <!-- The Modal -->
<div class="modal fade" id="edit{{$row->organization_charts_id}}">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Chart Location</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
         <form action="/updateOrganatiazion" method="POST">
            @csrf

            <input type="hidden" class="form-control" value="{{$row->organization_charts_id}}" name="organization_charts_id" id="email">
            <input type="hidden" class="form-control" value="{{$data['subdiary']}}" name="subdiary" id="email">

            <div class="col">
                <div class="col">
                    <div class="form-group">
                        <label for="email">Row</label>
                        <input type="text" class="form-control" placeholder="Row" value="{{$row->id}}" name="id" id="email">
                      </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="email">Colm</label>
                        <input type="text" class="form-control"  value="{{$row->pid}}" name="pid" id="email">
                      </div>
                </div>

            </div>


            <button type="submit" class="btn btn-success">Success</button>
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
</div>




@endforeach




