<?php
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\DailyTaskController;

?>


  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/home">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="nav-item">










      @if(!empty(Auth::user()->hrAdmin) Or !empty(Auth::user()->hr))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-folder-user-fill"></i><span>Employees Profiles</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/profile">
              <i class="bi bi-circle"></i><span>People</span>
            </a>

            <a href="/new-profile">
                <i class="bi bi-circle"></i><span>New Profiles</span>
              </a>
          </li>



        </ul>
      </li>

      @endif

      @if(!empty(Auth::user()->sbuhead))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Leave</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/subsidiaries-leave">
              <i class="bi bi-circle"></i><span>Leaves</span>
            </a>
          </li>

        </ul>
      </li>
      @endif




@if(!empty(Auth::user()->hrAdmin) Or !empty(Auth::user()->hr))


<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#HR-System-primary-Setting" data-bs-toggle="collapse" href="#">
    <i class="bi bi-sliders"></i><span>System Setting </span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="HR-System-primary-Setting" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    @if(!empty(Auth::user()->hrAdmin))
      <li>
          <a href="/subsidiaries/">
            <i class="fa fa-sitemap text-success fa-3x"></i><span>Organization</span>
          </a>
        </li>
        @endif

        <li>
      <a href="/departments/">
        <i class="fa fa-users text-succes"></i><span>Departments</span>
      </a>
    </li>
    <li>
      <a href="/designations/">
        <i class="fa fa-sitemap text-success"></i><span>Designations</span>
      </a>
    </li>


    <li>
        <a href="/documentType/">
          <i class="fa fa-file-text text-success"></i><span>Document Types</span>
        </a>
      </li>


      <li>
        <a href="/officelocation/">
          <i class="fa fa-map-marker text-success"></i><span>Office Location</span>
        </a>
      </li>






      <li>
        <a href="/project/">
          <i class="fa fa-question text-success"></i><span>Project Name</span>
        </a>
      </li>


      <li>
        <a href="/leaveRequestAlert">
          <i class="fa fa-map-marker text-success"></i><span>leave request alert</span>
        </a>
      </li>

      @if(!empty(Auth::user()->hrAdmin))
      <li>
        <a href="/leaveType/">
          <i class="fa fa-frown-o text-success"></i><span>Leave Type</span>
        </a>
      </li>

      <li>
        <a href="/enrolmentType/">
          <i class="fa fa-user-md text-success"></i><span>Employee enrolment type</span>
        </a>
      </li>

      <li>
        <a href="/enrolmentLeave">
          <i class="fa fa-linux text-success"></i><span>Enrolment Leave Setup</span>
        </a>
      </li>

      @endif

      <li>
        <a href="/religion/">
          <i class="fa fa-question text-success"></i><span>Religion</span>
        </a>
      </li>







      <li>
        <a href="/jd/">
          <i class="fa fa-briefcase text-success"></i><span>Job Descriptions</span>
        </a>
      </li>



  </ul>
</li>

@endif





@if(!empty(Auth::user()->hrAdmin) Or !empty(Auth::user()->hr))

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#email" data-bs-toggle="collapse" href="#">
    <i class="bi bi-envelope"></i><span>Emails</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="email" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="/one_email">
        <i class="bi bi-circle"></i><span>One Email</span>
      </a>
    </li>
    <li>
      <a href="/activeuseremail">
        <i class="bi bi-circle"></i><span>Active Users email</span>
      </a>
    </li>
    <li>
      <a href="/sbu-deparmrnt-wice">
        <i class="bi bi-circle"></i><span>All Users (Active/ Inactive)</span>
      </a>


    </li>
  </ul>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#news" data-bs-toggle="collapse" href="#">
      <i class="bi bi-newspaper"></i><span>News</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="news" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="/new_news">
          <i class="bi bi-circle"></i><span>New News</span>
        </a>
      </li>
      <li>
        <a href="/allNews">
          <i class="bi bi-circle"></i><span>All News</span>
        </a>
      </li>

    </ul>
  </li>

@endif



<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#valublelink" data-bs-toggle="collapse" href="#">
      <i class="bi bi-link-45deg"></i><span>Useful link</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="valublelink" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="/allactivecontact">
                <i class="bi bi-circle"></i><span>Contact Details</span>
                </a>
            </li>
    </ul>
  </li>



@if(!empty(Auth::user()->hrAdmin) Or !empty(Auth::user()->hr))

<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
    <i class="bi bi-reception-4"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
      <a href="/subwice-profile">
        <i class="bi bi-circle"></i><span>Organization</span>
      </a>
    </li>
    <li>
      <a href="/deparmrnt-wice">
        <i class="bi bi-circle"></i><span>Department</span>
      </a>
    </li>
    <li>
      <a href="/sbu-deparmrnt-wice">
        <i class="bi bi-circle"></i><span>Company & Department</span>
      </a>


      <a href="/office-location-wice">
          <i class="bi bi-circle"></i><span>Office Location </span>
        </a>


        <a href="/religions">
          <i class="bi bi-circle"></i><span>Religions</span>
        </a>

        <a href="/reportDashbord">
            <i class="bi bi-circle"></i><span>Report Dashbord  <span class="label warning">New Beta</span></span>
          </a>



    </li>
  </ul>
</li>
@endif







      @if(
        !empty(Auth::user()->pcAdmin) OR
        !empty(Auth::user()->itsetting) OR
        !empty(Auth::user()->userpermition) OR
        !empty(Auth::user()->report) OR
        !empty(Auth::user()->ticketview) OR
        !empty(Auth::user()->ticketupdate) OR
        !empty(Auth::user()->itequipmentadd)
        )

      <hr color="read"> </hr>
      <li class="nav-item">
        <a class="nav-link " href="/dashbord">
          <i class="bi bi-grid"></i>
          <span>IT Ticket System</span>
        </a>
      </li>


      @if(!empty(Auth::user()->itsetting) OR !empty(Auth::user()->pcAdmin))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-IT" data-bs-toggle="collapse" href="#">
          <i class="fa fa-wrench"></i><span>IT Setting</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-IT" class="nav-content collapse " data-bs-parent="#sidebar-nav">

            <li>
                <a href="/new_equpment_type">
                  <i class="bi bi-circle"></i><span>Equpment Type</span>
                </a>
              </li>

          <li>
            <a href="/equpmentBrand">
              <i class="bi bi-circle"></i><span>Equpment Brand</span>
            </a>
          </li>

          <li>
            <a href="new_qupment">
              <i class="bi bi-circle"></i><span>New Equpment</span>
            </a>
          </li>
          <!------

          <li>
            <a href="#">
              <i class="bi bi-circle"></i><span>Equpment List</span>
            </a>
          </li>
!------------->
          <li>
            <a href="/venders_rejestration">
              <i class="bi bi-circle"></i><span>Venders Rejestration</span>
            </a>
          </li>


          <li>
            <a href="/new_issue">
              <i class="bi bi-circle"></i><span>Issues</span>
            </a>
          </li>

        </ul>
      </li>


      @endif





      @if(!empty(Auth::user()->pcAdmin) OR !empty(Auth::user()->sbuPcAdmin))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Devices" data-bs-toggle="collapse" href="#">
          <i class="fa fa-laptop"></i><span>Devices</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Devices" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/equlist">
                  <i class="bi bi-circle"></i><span>Equpment List</span>
                </a>
              </li>
          <li>
            <a href="/new_qupment">
              <i class="bi bi-circle"></i><span>New Equpment</span>
            </a>
          </li>

          <li>
            <a href="/to_repair_receive">
              <i class="bi bi-circle"></i><span>To Repair Receive</span>
            </a>
          </li>
        </ul>
      </li>
      @endif














      @if(!empty(Auth::user()->ticketview) OR !empty(Auth::user()->ticketupdate) OR !empty(Auth::user()->pcAdmin))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Ticket" data-bs-toggle="collapse" href="/tickt_dashbord">
          <i class="fa fa-ticket"></i><span>Ticket</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Ticket" class="nav-content collapse " data-bs-parent="#sidebar-nav">

    @if (!empty(Auth::user()->ticketupdate) OR !empty(Auth::user()->pcAdmin))
    <li>
      <a href="/sedtoRepirForm">
        <i class="bi bi-circle"></i><span>Send To Repair From</span>
      </a>
    </li>

    @endif




                <li>
                    <a href="/ticketstatus"><i class="bi bi-circle"></i><span>Pending Ticket</span></a>
                </li>

                <li>
                    <a href="/donetickets"><i class="bi bi-circle"></i><span>Finish Ticket</span></a>
                </li>
                <li>
                    <a href="/allticket"><i class="bi bi-circle"></i><span>All Ticket</span></a>
                </li>

        </ul>
      </li>
@endif



<!----------

@if(!empty(Auth::user()->ticketview) OR !empty(Auth::user()->ticketupdate) OR !empty(Auth::user()->pcAdmin))
<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#dailytask" data-bs-toggle="collapse" href="#">
    <i class="bi bi-layout-text-window-reverse"></i><span>Task</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="dailytask" class="nav-content collapse " data-bs-parent="#sidebar-nav">

      <li>
          <a href="/ticket_dashbord">
            <i class="bi bi-circle"></i><span>Dashbord</span>
          </a>
        </li>



        <li>
            <a href="/newtask">
              <i class="bi bi-circle"></i><span>New Task <span class="badge bg-danger badge-number"></span> </span>
            </a>
          </li>

      <li>
          <a href="/pending_daily_tasks">
            <i class="bi bi-circle"></i><span>Crate  <span class="badge bg-danger badge-number">{{ DailyTaskController::countdalytask('Crate')}}</span> </span>
          </a>
        </li>

        <li>
          <a href="/pending_Viewd_daily_tasks">
            <i class="bi bi-circle"></i><span>View <span class="badge bg-danger badge-number">{{ DailyTaskController::countdalytask('View')}}</span> </span>
          </a>
        </li>

        <li>
          <a href="/process_daily_tasks">
            <i class="bi bi-circle"></i><span>Process <span class="badge bg-danger badge-number">{{ DailyTaskController::countdalytask('Process')}}</span> </span>
          </a>
        </li>


        <li>
          <a href="/finsh_daily_tasks">
            <i class="bi bi-circle"></i><span>Finish</span>
          </a>
        </li>


        <li>
            <a href="/">
              <i class="bi bi-circle"></i><span>Report</span>
            </a>
          </li>


          <li>
            <a href="/allticket"><i class="bi bi-circle"></i><span>All Ticket</span></a>
       </li>

       <li>
        <a href="/ticketstatus"><i class="bi bi-circle"></i><span>All Ticket</span></a>
       </li>


  </ul>
</li>
@endif



      @if( !empty(Auth::user()->pcAdmin))


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#IT-Reports" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Reports </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="IT-Reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/allticket">
                  <i class="bi bi-circle"></i><span>All Ticket</span>
                </a>

              </li>

        </ul>
      </li>

@endif
!---------->

      @if(!empty(Auth::user()->userpermition) OR !empty(Auth::user()->pcAdmin))

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#users" data-bs-toggle="collapse" href="#">
          <i class="fa fa-users"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="/userlist">
                  <i class="bi bi-circle"></i><span>User Permition </span>
                </a>
              </li>


          

          <li>


        </ul>
      </li>


      @endif




      @if(!empty(Auth::user()->invoice_permition) OR !empty(Auth::user()->pcAdmin) OR !empty(Auth::user()->ticketupdate))
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Invoice" data-bs-toggle="collapse" href="#">
          <i class="fa fa-btc" aria-hidden="true"></i>
          <span>Invoice </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Invoice" class="nav-content collapse " data-bs-parent="#sidebar-nav">



            <li>
                <a href="/invoicable_Ticket">
                  <i class="bi bi-circle"></i><span>Ticket to Invoice</span>
                </a>
              </li>

<!----------
              <li>
                <a href="/invoicable_Task">
                  <i class="bi bi-circle"></i><span>Task to Invoice</span>
                </a>
              </li>
!--------->
        </ul>
      </li>

     @endif




     @if(!empty(Auth::user()->pcAdmin) OR !empty(Auth::user()->sbuPcAdmin) AND !empty(Auth::user()->report))


     <li class="nav-item">
       <a class="nav-link collapsed" data-bs-target="#itreports" data-bs-toggle="collapse" href="#">
         <i class="bi bi-layout-text-window-reverse"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
       </a>
       <ul id="itreports" class="nav-content collapse " data-bs-parent="#sidebar-nav">



           <li>
               <a href="/equlist">
                 <i class="bi bi-circle"></i><span>Equpment List All</span>
               </a>
             </li>


             <li>
              <a href="/organization_it_equipment_list">
                <i class="bi bi-circle"></i><span>Organization's IT Equipment list</span>
              </a>
            </li>

            <li>
              <a href="/location_it_equipment_list">
                <i class="bi bi-circle"></i><span>location's IT Equipment list</span>
              </a>
            </li>





             <li>
               <a href="/allorganizationpc">
                 <i class="bi bi-circle"></i><span>Organization Device List</span>
               </a>
             </li>


             <li>
              <a href="/ticket_report">
                <i class="bi bi-circle"></i><span>Ticket Report</span>
              </a>
            </li>




             <li>
                 <a href="/organization_pc">
                   <i class="bi bi-circle"></i><span>My Organization</span>
                 </a>
               </li>

               <li>
                    <a href="/allticket"><i class="bi bi-circle"></i><span>All Ticket</span></a>
               </li>
<!--------
               <li>
                <a href="/ticketstatus"><i class="bi bi-circle"></i><span>All Ticket</span></a>
               </li>

               <li>
                <a href="/ticket_dashbord"><i class="bi bi-circle"></i><span>Tickets Report</span></a>
               </li>

!-------->

       </ul>
     </li>




     @endif

     @endif











    <ul class="sidebar-nav mt-1" id="sidebar-nav">

        <li class="nav-item">
          <a class="nav-link " href="/home">
            <i class="bi bi-grid"></i>
            <span>My Profile</span>
          </a>


    </ul>

        </li>






<!-----------
            @if(!empty(Auth::user()->profileUser))
            <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#leave-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-folder-user-fill"></i><span>Leave</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="leave-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                <a href="/leaveFrom">
                    <i class="bi bi-circle"></i><span>Request</span>
                </a>
                <a href="/new-profile">
                    <i class="bi bi-circle"></i><span>Report</span>
                    </a>
                </li>

                @if(!empty(Auth::user()->leveApprovalUser))
                <a href="/subsidiaries-leave">
                    <i class="bi bi-circle"></i><span>Requsted Leaves</span>
                    </a>
                </li>

                <a href="/approved-leave">
                    <i class="bi bi-circle"></i><span>Approved Leaves</span>
                    </a>
                </li>

                <a href="/reject-leave">
                    <i class="bi bi-circle"></i><span>Reject Leaves</span>
                    </a>
                </li>




                @endif


            </ul>
            </li>
            @endif

!--------->


    </ul>

  </aside>



  <style>
    a{
      text-decoration: none;
    }
    .label {
      color: white;
      padding: 2px;
      font-family: Arial;
      border-radius: 2px;
    }
    .success {background-color: #04AA6D;} /* Green */
    .info {background-color: #2196F3;} /* Blue */
    .warning {background-color: #ff9800;} /* Orange */
    .danger {background-color: #f44336;} /* Red */
    .other {background-color: #e7e7e7; color: black;} /* Gray */
</style>
