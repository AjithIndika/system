<?php
use App\Http\Controllers\TicketsController;
?>


<div class="mb-4">
<form class="form-inline"  action="/ticketsummaryDate" method="POST">

    @csrf

    <label for="email">First Date:</label> &nbsp;&nbsp;
    <input type="date"  class="form-control" name="startDate" value="{{old('startDate')}}" required> &nbsp;&nbsp;

    <label for="pwd">Last Date:</label> &nbsp;&nbsp;

    <input type="date" class="form-control"  name="endDate" value="{{old('endDate')}}" required> &nbsp;&nbsp;&nbsp;

    <button type="submit" class="btn btn-primary">Filter</button>
  </form>

</div>
<!---------
<form>
    @csrf


    <input type="date" name="startDate" value="{{old('startDate')}}" required>
    <input type="date" name="endDate" value="{{old('endDate')}}" required>

    <input type="submit" value="Filter">
</form>

!----------->



<div  id="page_printer">

    <table class="table table-bordered" >
      <thead>
        <tr>
         <th>#</th>
          <th>Organization Name</th>
          <th colspan="2">Details of tickets</th>

        </tr>
      </thead>
      <tbody>
        @foreach ($data['subsidiaries'] as $key=>$subsidiaries)
        <tr>
            <td>{{$key + 1 }}</td>
            <td>{{$subsidiaries->subsidiaries_name}}</td>
            <td colspan="2">


                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Ticket Nu:</th>
                          <th>Requst By</th>
                          <th>Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>

{{TicketsController::ticketfilter($data['startDate'],$data['endDate'],$subsidiaries->subsidiaries_id)}}


                      </tbody>
                    </table>


            </td>
          </tr>
@endforeach
      </tbody>
    </table>

</div>

    





    <script>
        function printDiv(divID) {
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;

    //Reset the page's HTML with div's HTML only
    document.body.innerHTML =
        "<html><head><title></title></head><body>" + divElements + "</body>";

    //window.print();
    //document.body.innerHTML = oldPage;

    //Print Page
    setTimeout(function () {
        print_page();
    }, 2000);

    function print_page() {
        window.print();
    }

    //Restore orignal HTML
    setTimeout(function () {
        restore_page();
    }, 3000);

    function restore_page() {
        document.body.innerHTML = oldPage;
    }
}
     </script>

     <style>
        .ms-bodyareaframe {
    padding: 8px;
    border: none;
}
.text_transportation {
    font-size: large;
    color: red;
}
.text_approveStep {
    font-size: small;
    color: red;
}
.box {
    width: 750px !important;
}
.set_width {
    width: 350px !important;
}
.set_backgr {
    text-decoration: none !important;
    color: #0072BC !important;
    font-family: Verdana, Arial, sans-serif !important;
    border: none !important;
    background-color: #F6F6F6 !important;
}
.set_backgr:hover {
    text-decoration: none !important;
    cursor: pointer;
}
.readOnly {
    background-color: #F6F6F6 !important;
    color: #676767 !important;
    border: none !important;
    cursor: default;
}
     </style>



<input onclick="printDiv('page_printer');" type="button" value="Print" style="font-family: Verdana,Arial,sans-serif !important; font-size: 8pt !important; width: 150px !important;"></input>

