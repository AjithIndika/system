

<?php
use App\Http\Controllers\ReportAllController;

?>
 <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

 <div class="col col-md-6 text-right">
    <button type="button" id="export_button" class="btn btn-success btn-sm">Export</button>
</div>



<script>
    function html_table_to_excel(type)
    {
        var data = document.getElementById('employee_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'file.' + type);
    }

    const export_button = document.getElementById('export_button');

    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });

</script>
<div class="card-body bg-white" id="employee_data">

    <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Organization Name</th>
            <th>Contact Details</th>
          </tr>
        </thead>
        <tbody>

            @foreach ( $data['subsidiaries'] as $key=>$subsidiaries )


          <tr>
            <td>{{$key + 1}}</td>
            <td>{{$subsidiaries->subsidiaries_name}}</td>
            <td>

                <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                      </tr>
                    </thead>
                    <tbody>

                        {{ReportAllController::contactlist($subsidiaries->subsidiaries_id)}}

                    </tbody>
                  </table>



            </td>
          </tr>

          @endforeach

        </tbody>
      </table>

</div>
