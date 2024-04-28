
<?php
use App\Http\Controllers\ReportChartController;

?>




<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([

                <?php
                foreach( $data['data'] as $dt){
                    ?>
                    [{'v':'{{ReportChartController::profileName($dt->profile_id)}}', 'f':' <img  id="myDIV" src="{{ReportChartController::profilim($dt->profile_id,$dt->profile_job_work_sbu)}}" height="100" width="100"  > </img>{{ReportChartController::profileName($dt->profile_id)}}<div style="color:red; font-style:italic">{{ReportChartController::profiljd($dt->profile_job_work_jd)}}</div> '},
                    '{{ReportChartController::reportmanagername($dt->profile_job_work_head_of_sbu)}}', '{{ReportChartController::profiljd($dt->profile_job_work_jd)}}'],
                    <?php  }  ?>


        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true});
      }
   </script>
    </head>
  <body>

    <div id="chart_div"></div>

  </body>
</html>

<script>
    document.getElementById("myDIV").style.borderRadius = "25px";
    </script>
<style>
img {
  border-radius: 50%;
}

td{
    width: 40px;
}
</style>
