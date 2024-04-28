<?php
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\DailyTaskController;
use App\Http\Controllers\NotificationController;

?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>




<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="/home">
        <i class="bi bi-house"></i>
    </a>
</li>


@if (!empty(Auth::user()->profileUser))
    <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="/view-profile/{{ DB::table('profiles')->where('profile_id',Auth::user()->profile_id)->value('profile_sug') }}">
            <i class="bi bi-person-circle"></i>
        </a>
    </li>
@endif

<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-link-45deg"></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="#">Useful link</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/allactivecontact"> <i
                    class="fa fa-sitemap text-success" aria-hidden="true"></i> Contact Details</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>
        @if (!empty(Auth::user()->hrAdmin) or !empty(Auth::user()->hr))
            <li class="dropdown-footer">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/new_news"><i
                        class="bi bi-newspaper text-success" aria-hidden="true"></i>New News</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/allNews"><i
                        class="bi bi-newspaper text-success" aria-hidden="true"></i>All News</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>


            <li class="dropdown-footer">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/activeuseremail"><i
                        class="bi bi-envelope text-success" aria-hidden="true"></i>Active users email</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
        @endif
    </ul>
</li>
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











@if (!empty(Auth::user()->hrAdmin))
    <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-people animated shake"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="#">Profile</a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/profile"> <i
                        class="fa fa-sitemap text-success" aria-hidden="true"></i> People</a>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/new-profile"><i
                        class="fa fa-users text-success" aria-hidden="true"></i> New Profiles</a>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>
        </ul>
    </li>




    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-sliders2-vertical"></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="#">HR System primary
                Setting</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/subsidiaries/"> <i
                    class="fa fa-sitemap text-success" aria-hidden="true"></i> Organization</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/departments/"><i
                    class="fa fa-users text-success" aria-hidden="true"></i> Departments</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/designations/"><i
                    class="fa fa-sitemap text-success" aria-hidden="true"></i> Designations</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/documentType/"><i
                    class="fa fa-file-text text-success" aria-hidden="true"></i> Document Types</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/officelocation/"><i
                    class="fa fa-map-marker text-success" aria-hidden="true"></i>Office Location</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/leaveType/"><i
                    class="fa fa-frown-o text-success" aria-hidden="true"></i>Leave Type</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/religion/"><i
                    class="fa fa-question text-success" aria-hidden="true"></i>Religion</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/enrolmentType/"><i
                    class="fa fa-user-md text-success" aria-hidden="true"></i>Employee enrolment type</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/enrolmentLeave/"><i
                    class="fa fa-linux text-success" aria-hidden="true"></i>Enrolment Leave Setup</a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/jd/"><i
                    class="fa fa-briefcase text-success" aria-hidden="true"></i>Job Descriptions</a>
        </li>

        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/leaveRequestAlert"><i
                    class="fa fa-briefcase text-success" aria-hidden="true"></i>leave request alert</a>
        </li>


        <li>
            <hr class="dropdown-divider">
        </li>
    </ul>
    </li>
@endif



<li class="nav-item dropdown">
    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-file-earmark-bar-graph"></i>
    </a>

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
        <li class="dropdown-header">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="#">Reports</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="dropdown-footer">
            <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/reportDashbord"> <i
                    class="fa fa-sitemap text-success" aria-hidden="true"></i> <span>Report Dashbord <span
                        class="label warning">New Beta</span></span></a>
        </li>
    </ul>
</li>







@if (!empty(Auth::user()->ticketupdate))
    <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="/ticketstatus" data-bs-toggle="dropdown">
            <i class="bi bi-ticket-perforated"></i>
            <span class="badge bg-primary badge-number">{{ ReportAllController::ticketallert('Crate') }}</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
                You have {{ ReportAllController::ticketallert('Crate') }} new notifications
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/ticketstatus"><span
                        class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            {{ ReportAllController::ticketdetails() }}

            <li>
                <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/ticketstatus">Show all
                    notifications</a>
            </li>

        </ul>
    </li>
@endif



@if (!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))

{{NotificationController::prfilenotification()}}

@endif






<style>
    .navbar .dropdown-toggle,
    .navbar .dropdown-menu a {
        cursor: pointer;
    }

    .navbar .dropdown-item.active,
    .navbar .dropdown-item:active {
        color: inherit;
        text-decoration: none;
        background-color: inherit;
    }

    .navbar .dropdown-item:focus,
    .navbar .dropdown-item:hover {
        color: #16181b;
        text-decoration: none;
        background-color: #f8f9fa;
    }

    @media (min-width: 767px) {
        .navbar .dropdown-toggle:not(.nav-link)::after {
            display: inline-block;
            width: 0;
            height: 0;
            margin-left: .5em;
            vertical-align: 0;
            border-bottom: .3em solid transparent;
            border-top: .3em solid transparent;
            border-left: .3em solid;
        }
    }

    li {
        color: #16181b;
        text-decoration: none;

    }

    li:hover {
        color: #16181b;
        text-decoration: none;
    }
</style>

<script>
    $(document).ready(function() {

        $('.navbar .dropdown-item').on('click', function(e) {
            var $el = $(this).children('.dropdown-toggle');
            var $parent = $el.offsetParent(".dropdown-menu");
            $(this).parent("li").toggleClass('open');

            if (!$parent.parent().hasClass('navbar-nav')) {
                if ($parent.hasClass('show')) {
                    $parent.removeClass('show');
                    $el.next().removeClass('show');
                    $el.next().css({
                       "top": -999,
                       "left": -999
                    });
                } else {
                    $parent.parent().find('.show').removeClass('show');
                    $parent.addClass('show');
                    $el.next().addClass('show');
                    $el.next().css({
                       "top": $el[0].offsetTop,
                       "left": $parent.outerWidth() - 4
                    });
                }
                e.preventDefault();
                e.stopPropagation();
            }
        });

        $('.navbar .dropdown').on('hidden.bs.dropdown', function() {
            $(this).find('li.dropdown').removeClass('show open');
            $(this).find('ul.dropdown-menu').removeClass('show open');
        });

    });
</script>
