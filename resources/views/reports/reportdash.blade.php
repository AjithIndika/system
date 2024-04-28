<style>

</style>

<div class="row">

   <!---- Organization  reports  !---------->
    <div class="column">
        <div class="card container">
            <h4>Organization</h4>
            <ul class="myUL">
                <li><a  href="subwice-profile" title="Employees All">Employees All</a></li>
                <li><a  href="reportOrg" title="Employees All">Report ORG</a></li>
            </ul>
        </div>
    </div>





 <!---- Department reports  !---------->
    <div class="column">
        <div class="card container">
            <h4>Department</h4>
            <ul class="myUL">
                <li><a  href="deparmrnt-wice" title="Employees All">Employees All</a> </li>
                <li><a  href="sbu-deparmrnt-wice" title="Department Employees All">Department Employees All</a> </li>
            </ul>
        </div>
    </div>


    <!---- Designation reports  !---------->
    <div class="column">
        <div class="card container">
            <h4>Designation</h4>
            <ul class="myUL">
                <li><a  href="" title=""><span class="label warning">Not Ready</span></a></li>
            </ul>
        </div>
    </div>


     <!---- Office Location reports  !---------->
    <div class="column">
        <div class="card container">
            <h4>Office Location</h4>
            <ul class="myUL">
                <li><a  href="/office-location-wice" title="Locations">Locations Employees</a></li>
            </ul>
        </div>
    </div>


     <!---- Leave reports  !---------->

    <div class="column">
        <div class="card container">
            <h4>Leave</h4>
            <ul class="myUL">
                <li><a  href="/leveallorg/{{date('Y')}}" title="">{{date('Y')}} Leaves</a></li>
                <li><a  href="/leveallorg/{{now()->subYear()->year}}" title="">{{ now()->subYear()->year}} Leaves</a></li>
                <li><a  href="/leveallorg/{{date('Y-m')}}" title="">{{ date('Y-m')}} Leaves</a></li>
                <li><a  href="/leveallorg/{{ date('Y-m', strtotime(now()->subMonth()->year.'-'.now()->subMonth()->month));}}" title="">{{ date('Y-m', strtotime(now()->subMonth()->year.'-'.now()->subMonth()->month));}} Leaves</a></li>



            </ul>
        </div>
    </div>



    <!---- Employee Enrolment reports  !---------->


    <div class="column">
        <div class="card container">
            <h4>Employee Enrolment</h4>

            <ul class="myUL">
                <li><a  href="" title=""><span class="label warning">Not Ready</span></a></li>
            </ul>
        </div>
    </div>


    <!---- Job Description reports  !---------->

    <div class="column">
        <div class="card container">
            <h4>Job Description</h4>
            <ul class="myUL">
                <li><a  href="" title=""><span class="label warning">Not Ready</span></a></li>
            </ul>
        </div>
    </div>


<!---- Salary reports
    <div class="column">
        <div class="card container">
            <h4>Salary</h4>
            <ul class="myUL">
                <li><a  href="/SalaryReport" title="Salary">Organization's Salary</a></li>
            </ul>
        </div>
    </div>

!---------->

    <!---- religen reports  !---------->
    <div class="column">
        <div class="card container">
            <h4>Religions</h4>
            <ul class="myUL">
                <li><a  href="/religions" title="Religions">Religions</a></li>
            </ul>
        </div>
    </div>


     <!---- tickt reports  !---------->
     <div class="column">
        <div class="card container">
            <h4>Tickets</h4>
            <ul class="myUL">
                <li><a  href="/ticketsummaryDate" title="Religions">Ticket Summary With date's</a></li>
            </ul>

            <ul class="myUL">
                <li><a t href="/ticket_ownerWice" title="Religions">Ticket Owners Report</a></li>
            </ul>


        </div>
    </div>




       <!---- Office Location reports  !---------->
       <div class="column">
        <div class="card container">
            <h4>Custom Report</h4>
            <ul class="myUL">
                <li><a  href="/CustomReport" title="Custom Report">Custom Report</a></li>
            </ul>
        </div>
    </div>




</div>




























<style>


div.container {
        text-align: center;
    }

    ul.myUL {
        display: inline-block;
        text-align: left;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    h5{
        color: #253d1f;
        font-weight: bolder;
        text-align: left;
        padding: 4px;
    }


    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    /* Float four columns side by side */
    .column {
        float: left;
        width: 25%;
        padding: 0 10px;
    }

    /* Remove extra left and right margins, due to padding */
    .row {
        margin: 0 -5px;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    /* Style the counter cards */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        text-align: center;
        background-color: #99adad;
    }

    a {
        text-decoration: none;
        color: whitesmoke;
        font-weight: bolder;
    }

    a:hover {
        text-decoration: none;
        color: whitesmoke;
        font-weight: bolder;
    }
</style>
