<?php
use App\Http\Controllers\OrganizationChartController;
?>

<?php // print_r($data['orgchart']);  ?>

<?php

$list = null;
$i=0;
//$list[1] = array();

foreach ($data['orgchart'] as $row){



   //print_r($row->id);
  $list[$i]= array('id' => $row->id, 'pid' => $row->pid ,'name' => $row->profile_call_name,'title'=>$row->designations_name, 'img'=> "/profile-image".'/'.$row->profile_image );
  $i++;

//'title' => $row->designations,
}

$all = json_encode($list);



?>
  <?php //print_r($all); ?>

<script src="https://balkan.app/js/OrgChart.js"></script>

<div id="tree"></div>


<script>



var chart = new OrgChart(document.getElementById("tree"), {
    mouseScrool: OrgChart.action.none,
    template: "olivia",

    nodeContextMenu: {
      //  edit: { text: "Edit", icon: OrgChart.icon.edit(18, 18, '#039BE5') },
      //  add: { text: "Add", icon: OrgChart.icon.add(18, 18, '#FF8304') }
    },
    menu: {
        pdf: { text: "Export PDF" },
        png: { text: "Export PNG" },
        svg: { text: "Export SVG" },
        csv: { text: "Export CSV" }
    },
    nodeBinding: {
        field_0: "name",
        field_1: "title",
        img_0: "img"
    },
    nodes:
    <?php print_r($all); ?>
    /* [


        { id: 1, name: "Billy Moore", title: "CEO", img: "https://cdn.balkan.app/shared/2.jpg" },
        { id: 2, pid: 1, name: "Billie Rose", title: "Dev Team Lead", img: "https://cdn.balkan.app/shared/5.jpg" },
        { id: 3, pid: 1, name: "Glenn Bell", title: "HR", img: "https://cdn.balkan.app/shared/10.jpg" },
        { id: 4, pid: 1, name: "Blair Francis", title: "HR", img: "https://cdn.balkan.app/shared/11.jpg" },

        { id: 5, pid: 3, name: "Skye Terrell", title: "Manager", img: "https://cdn.balkan.app/shared/12.jpg" },
        { id: 6, pid: 3, name: "Jordan Harris", title: "JS Developer", img: "https://cdn.balkan.app/shared/6.jpg" },
        { id: 7, pid: 3, name: "Will Woods", title: "JS Developer", img: "https://cdn.balkan.app/shared/7.jpg" }

    ] */
});


/*

var chart = new OrgChart(document.getElementById("tree"), {
    enableSearch: false,
    enableDragDrop: true,
    mouseScrool: OrgChart.none,
    tags: {
        "assistant": {
            template: "olivia"
        }
    },
    nodeMenu: {
     //   details: { text: "Details" },
   //    edit: { text: "Edit" },
      //  add: { text: "Add" },
      //  remove: { text: "Remove" }
    },
    nodeBinding: {
        field_0: "name",
        field_1: "title",
          img_0: "img"
    }
});


chart.load(
   <?php print_r($all); ?>
);


*/



</script>

<style>

    /*CSS*/
html, body{
  width: 100%;
  height: 100%;
  padding: 0;
  margin:0;
  overflow: hidden;
  font-family: Helvetica;
}
#tree{
  width:100%;
  height:100%;
}
#boc-form-fieldset{
    display:block;
}
</style>
