<div class="col-8">
    <div class="card recent-sales overflow-auto">
      <div class="card-body">

@foreach ( $data['incresment'] as $incresment)



<form action="/updatetoincresment" method="post">
    @csrf


<div class="row mt-5">

        <div class="col-sm-5">
            <div class="form-group">
              <label for="email">Salary:</label>
               <input type="text" name="incresments_salary" class="form-control  @error('incresments_salary') is-invalid @enderror" value="{{ $incresment->incresments_salary}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"   required >
              @error('incresments_salary')<div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

</div>
<div class="row">
    <div class="form-group">
      <label for="email">Reason:</label>
       <input type="text" name="incresments_reson" class="form-control  @error('incresments_reson') is-invalid @enderror" value="{{ $incresment->incresments_reson}}"  disabled>
      @error('incresments_reson')<div class="text-danger">{{ $message }}</div> @enderror
    </div>
</div>


<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Effective Data:</label>
           <input type="date" name="incresments_add_date" class="form-control  @error('incresments_add_date') is-invalid @enderror" value="{{ $incresment->incresments_add_date}}"  required >
          @error('incresments_add_date')<div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="col">
        <div class="form-group">
          <label for="email">Created:</label>
           <input type="text" name="incresments_add_by" class="form-control  @error('incresments_add_by') is-invalid @enderror" value="{{ $incresment->incresments_add_by}}"  required >
          @error('incresments_add_by')<div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Reason Fo Updating:</label>
           <input type="text" name="incresments_update_reson" class="form-control  @error('incresments_update_reson') is-invalid @enderror" value="{{ $incresment->incresments_update_reson}}"  required >
          @error('incresments_update_reson')<div class="text-danger">{{ $message }}</div> @enderror
        </div>
    </div>
</div>


<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Edited:</label>
          {{ $incresment->incresments_update_by}} / {{ $incresment->incresments_update_date}}
             </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
          <label for="email">Created:</label>
          {{ $incresment->incresments_add_by}} / {{ $incresment->created_at}}
             </div>
    </div>
</div>


<input type="hidden" value="{{$incresment->profile_id}}" name="profile_id">
<input type="hidden" value="{{$incresment->profile_number}}" name="profile_number">
<input type="hidden" value="{{$incresment->profile_sug}}" name="profile_sug">
<input type="hidden" value="{{$incresment->incresments_id}}" name="incresments_id">


<button type="submit" class="btn btn-success">Save</button>
</form>

</div>

@endforeach

    </div>
</div>

