<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>




<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
          <div class="card-body mt-5">
            <button type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#newspplier">Register New Supplier</button>

          </div>
        </div>
    </div>
</section>


<section class="section dashboard">
    <div class="col-12">
        <div class="card recent-sales overflow-auto">

          <div class="card-body">



          </br>


            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Organization</th>
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $data['suppliers'] as $key=>$suppliers)


                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td>{{$suppliers->suppliers_Organization }}</td>
                        <td>{{$suppliers->suppliers_Contact_person }}</td>
                        <td>{{$suppliers->suppliers_Contact_number }}</td>
                        <td><i class="fa fa-eye fa-2x" aria-hidden="true" data-toggle="modal" data-target="#view{{$suppliers->suppliers_id}}"></i></td>
                    </tr>



                     <!-- The Modal -->
<div class="modal fade" id="view{{$suppliers->suppliers_id}}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">{{$suppliers->suppliers_Organization }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form action="/update_venders" method="POST">
                @csrf
                <input type="hidden" class="form-control" value="{{$suppliers->suppliers_id }}" name="suppliers_id" >

                <div class="row">

                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="email">Organization Name:</label>
                            <input type="text" class="form-control" value="{{$suppliers->suppliers_Organization }}" name="suppliers_Organization" id="email" required>
                          </div>
                          @error('suppliers_Organization')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Contact Person:</label>
                            <input type="text" class="form-control" value="{{$suppliers->suppliers_Contact_person }}"  name="suppliers_Contact_person" id="email" required>
                          </div>
                          @error('suppliers_Contact_person')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Contact Number:</label>
                            <input type="text" class="form-control" value="{{$suppliers->suppliers_Contact_number }}" id="email" name="suppliers_Contact_number" required>
                          </div>
                          @error('suppliers_Contact_number')<div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Contact Email:</label>
                            <input type="text" class="form-control" value="{{$suppliers->suppliers_Contact_email }}"  name="suppliers_Contact_email" id="email" required>
                          </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <label for="pwd">Supply Items</label>
                                <textarea class="ckeditor form-control"  name="supply_items">{{$suppliers->suppliers_supply_things}}</textarea>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
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
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>

          </div>
        </div>
    </div>
</section>











<!-- The Modal -->
<div class="modal fade" id="newspplier">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">New Supplier</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

            <form action="/new_venders" method="POST">
                @csrf


                <div class="row">

                    <div class="col-sm-7">
                        <div class="form-group">
                            <label for="email">Organization Name:</label>
                            <input type="text" class="form-control" placeholder="Organization" name="suppliers_Organization" id="email" required>
                          </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Contact Person:</label>
                            <input type="text" class="form-control" placeholder="Suppliers Contact Person"  name="suppliers_Contact_person" id="email" required>
                          </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Contact Number:</label>
                            <input type="text" class="form-control" placeholder="Suppliers Contact Number" id="email" name="suppliers_Contact_number" required>
                          </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="email">Contact Email:</label>
                            <input type="text" class="form-control" placeholder="Suppliers Contact Email"  name="suppliers_Contact_email" id="email" required>
                          </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col">
                            <div class="form-group">
                                <label for="pwd">Supply Items</label>
                                <textarea class="ckeditor form-control"  name="supply_items"></textarea>
                            </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
              </form>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>



  <script>
    $('select').selectpicker();
</script>


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

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
