
<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">

            <h4 class="mt-2 mb-2"></h4>


<form class="form-inline" action="/weeklyreportview" method="post">
    @csrf
    <label for="email">Start Date:  &nbsp; </label>
    <input type="date" class="form-control" id="date1"  name="date1" value="{{old('date1')}}" required>
    <label for="pwd">  &nbsp;   &nbsp;  End Date:  &nbsp; </label> &nbsp;  &nbsp;
    <input type="date" class="form-control"  id="date2" name="date2" value="{{old('date2')}}" required> &nbsp;  &nbsp;

    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
  </form>





          </div>
              </div>
                    </div>
                       </section>












