<div class="col-12">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">

@foreach ( $data['salary'] as $salaries)



<form action="/updatetosalary" method="post">
    @csrf


<div class="row">

        <div class="col-sm-5">
            <div class="form-group">
              <label for="email">Salary:</label>
               <input type="text" name="salary_salary" class="form-control  @error('salary_salary') is-invalid @enderror" value="{{ $salaries->salary_salary}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   required >
              @error('salary_salary')<div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

</div>
<div class="row">
    <div class="form-group">
      <label for="email">Reason:</label>
       <input type="text" name="salary_reson" class="form-control  @error('salary_reson') is-invalid @enderror" value="{{ $salaries->salary_reson}}"  disabled>
      @error('salary_reson')<div class="text-danger">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Effective Data:</label>
           <input type="date" name="salary_add_date" class="form-control  @error('salary_add_date') is-invalid @enderror" value="{{ $salaries->salary_add_date}}"  required >
          @error('salary_add_date')<div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col">
        <div class="form-group">
          <label for="email">Created:</label>
           <input type="text" name="salary_add_by" class="form-control  @error('salary_add_by') is-invalid @enderror" value="{{ $salaries->salary_add_by}}"  required >
          @error('salary_add_by')<div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Reason Fo Updating:</label>
           <input type="text" name="salary_update_reson" class="form-control  @error('salary_update_reson') is-invalid @enderror" value="{{ $salaries->salary_update_reson}}"  required >
          @error('salary_update_reson')<div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>
</div>


<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Edited:</label>
          {{ $salaries->salary_update_by}} / {{ $salaries->salary_update_date}}
             </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Created:</label>
          {{ $salaries->salary_add_by}} / {{ $salaries->created_at}}
             </div>
    </div>
</div>


<input type="hidden" value="{{$salaries->profile_id}}" name="profile_id">
<input type="hidden" value="{{$salaries->profile_number}}" name="profile_number">
<input type="hidden" value="{{$salaries->profile_sug}}" name="profile_sug">
<input type="hidden" value="{{$salaries->salary_id}}" name="salary_id">


<button type="submit" class="btn btn-success">Save</button>
</form>

</div>

@endforeach

    </div>
</div>

