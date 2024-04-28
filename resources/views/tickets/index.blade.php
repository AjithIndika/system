
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> {{ config('app.name') }} | {{ $data['title']  }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('assets/img/favicon.png')}}" rel="icon">
  <link href="{{url('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">




  <!-- Template Main CSS File -->
  <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>









        <!-- Recent Sales -->
        <div class="col-sm-12   ">
            <div class="card recent-sales overflow-auto">
              <div class="card-body ">


                <div class="d-inline-flex p-3  col">
                    <div class="p-2  col-sm-3"></div>
                    <div class="p-2  col">
                <div class="row"><img  src="{{url('assets/img/Asset_network_banner.png')}}" ></div>


                <form action="/new_save" method="POST" >
                    @csrf

                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                            <label for="email">Name:</label>
                            <input type="text" class="form-control @error('ticket_user_name') is-invalid @enderror" placeholder="Name" id="email" name="ticket_user_name" required>
                          </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control @error('ticket_email') is-invalid @enderror" placeholder="Enter email" id="email" name="ticket_email" required>
                          </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Phone Number :</label>
                                <input type="text" class="form-control  @error('ticket_phone_number') is-invalid @enderror" placeholder="Phone Number" id="email" name="ticket_phone_number" required>
                              </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Organization:</label>
                                <select class="custom-select  @error('ticket_organization') is-invalid @enderror" name="ticket_organization" required>
                                    @foreach ($data['busnus'] as $busnus)
                                    <option value="{{$busnus->subsidiaries_id}}">{{$busnus->subsidiaries_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>



                    <div class="row ">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Department:</label>
                                <select class="custom-select  @error('ticket_department_name') is-invalid @enderror" name="ticket_department_name" required>
                                    @foreach ($data['departments'] as $departments)
                                    <option value="{{$departments->department_id}}">{{$departments->department_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="email">Device:</label>
                                <select class="custom-select  @error('ticket_equpment_types') is-invalid @enderror" name="ticket_equpment_types" required>
                                    @foreach ($data['equpment_types'] as $equpment_types)
                                    <option value="{{$equpment_types->equpment_types_id}}">{{$equpment_types->equpment_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="email">Issue:</label>
                                <select class="custom-select  @error('ticket_issues_id') is-invalid @enderror" name="ticket_issues_id" required>
                                    @foreach ($data['issues'] as $issues)
                                    <option value="{{$issues->issues_id }}">{{$issues->issues_name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Problem Text (Describe Your Issue) :</label>
                                <textarea class="ckeditor form-control @error('ticket_issues_note') is-invalid @enderror"  name="ticket_issues_note"  required></textarea>
                            <!---    <textarea class="form-control @error('ticket_issues_note') is-invalid @enderror" name="ticket_issues_note" required></textarea> !---->
                              </div>
                        </div>
                    </div>

                <button type="submit" class="btn btn-primary">Save</button>
              </form>




                    </div>
                    <div class="p-2 col-sm-3"></div>
                  </div>
                <section class="section dashboard ">




              </div>
            </div>
          </div>
        
        </section>

</body>






<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>{{ env('APP_OWNER') }}</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://assetnetworks.net/">Asset Networks (Pvt)Ltd</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>


  <!-- Vendor JS Files -->
  <script src="{{url('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{url('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('assets/js/main.js')}}"></script>
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

  @include('sweetalert::alert')

</html>
