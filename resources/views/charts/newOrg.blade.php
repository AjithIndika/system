

<form action="/orgChartCrate" method="POST">
    @csrf

 
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
            <input type="text" class="form-control" placeholder="Row" value="{{$key + 1}}" name="id[]" id="email">
          </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="email">Colm</label>
            <input type="text" class="form-control"  value="1" name="pid[]" id="email">
          </div>          
    </div>
</div>




@endforeach

 
<input type="submit" value="Submit" class="btn btn-success">
</form>

