<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mt-5">



            <form action="/bonusBulkaddnew"  method="POST">

              @csrf

                <div class="form-group">
                  <label for="email">Rule Name:</label>
                  <input type="text" class="form-control" name="bonuses_reson" placeholder="Rule Name" id="email" required>
                </div>
                <div class="form-group ">
                  <label for="pwd">Percentage:</label>
                  <input type="number" class="form-control col-sm-3" name="bonuses_percentage" placeholder="Percentage" id="pwd" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
              </form>





          </div>
        </div>
    </div>
</section>


<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

@include('sweetalert::alert')




