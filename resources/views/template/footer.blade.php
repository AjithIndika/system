






 <!-------- Delet Account !-------->
 <div class="modal fade" id="passwordupdate">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
   
      <div class="modal-header">
        <h4 class="modal-title">Password Change:</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
      <div class="modal-body">

          <form action="/password_chage" method="post">
              @csrf

          <div class="row">
              <div class="col">
                  <div class="form-group">
                      <label for="email">Password: </label>
                     <input type="password" class="form-control ml-2 @error('password') is-invalid @enderror" name="password"  required>
                    </div>
              </div>

          </div>
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          </form>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>








<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


<script src="{{url('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{url('assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>


<script src="{{url('assets/js/main.js')}}"></script>
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

@include('sweetalert::alert')


</html>
