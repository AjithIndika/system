

<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <a href="/religions" class="text-decoration-none ml-3 mt-2 mb-2">GO Back</a>
          <div class="card-body">

            <h4 class="mt-2 mb-2">{{$data['title']}}</h4>


            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Titel</th>
                        <th>Date</th>
                        <th>Discription</th>
                        <th>News By</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($data['news'] as $key => $news)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td><a href="#" aria-hidden="true" data-toggle="modal" data-target="#view{{$news->news_id}}"> {{$news->news_titel}}</a></td>
                        <td>{{$news->news_add_date}}</td>
                        <td style="text-align: center;"><i class="fa fa-eye fa-4 text-success" aria-hidden="true" data-toggle="modal" data-target="#view{{$news->news_id}}"></i></td>
                        <td>{{$news->news_add_by}}</td>

                    </tr>





                    <!-- The Modal -->
<div class="modal fade" id="view{{$news->news_id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style="text-align: center;">{{$news->news_titel}}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">



<style>
    /* Make the image fully responsive */
    .carousel-inner img {
      width: 100%;
      height: 500px;
    }
    </style>

    <section class="section dashboard">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
              <div class="card-body mb-5 mt-5">



                <?php
                   $imgs = json_decode($news->news_image);


                    ?>

    <div id="demo" class="carousel slide" data-ride="carousel">


                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                      </ul>


                    <div class="carousel-inner">

                    @foreach ($imgs as $key=>$item)


                            <div class="carousel-item  <?php if($key ==0){echo 'active';} ?>">
                              <img class="d-block w-10" src="/{{'news_image/'}}{{$item}}" alt="First slide">
                              <div class="carousel-caption">
                                <h3 class="text-body font-weight-bold">{{ $news->news_titel}}</h3>

                              </div>
                            </div>


                    @endforeach
                </div>


                  <!-- Left and right controls -->
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>


    <div class="mt-5">  {!!  html_entity_decode($news->news_details) !!} </div>

                 </div>


              </div>
            </div>
        </div>
    </section>




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
                        <th>Titel</th>
                        <th>Date</th>
                        <th>Discription</th>
                        <th>News By</th>
                    </tr>
                </tfoot>
            </table>

          </div>
        </div>
    </div>
</section>



<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css">


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>


<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );

    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>









