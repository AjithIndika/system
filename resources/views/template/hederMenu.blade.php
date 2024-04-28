
<?php
use App\Http\Controllers\ReportAllController;
use App\Http\Controllers\DailyTaskController;

?>

<script>
    function showResult(str) {
      if (str.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("livesearch").innerHTML=this.responseText;
          document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
      }
      xmlhttp.open("GET","/live-serch?q="+str,true);
      xmlhttp.send();
    }
    </script>


<script>
    function pcview(str) {
      if (str.length==0) {
        document.getElementById("pcliveview").innerHTML="";
        document.getElementById("pcliveview").style.border="0px";
        return;
      }
      var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("pcliveview").innerHTML=this.responseText;
          document.getElementById("pcliveview").style.border="1px solid #A5ACB2";
        }
      }
      xmlhttp.open("GET","/live_pcview?q="+str,true);
      xmlhttp.send();
    }
    </script>

    </head>



 
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a  class="dropdown-item d-flex align-items-center text-decoration-none" href="/home" class="logo d-flex align-items-center">
        <img src="{{url('assets/img/logo.png')}}" alt="">
        <span class="d-none d-lg-block"></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    @if(!empty(Auth::user()->hrAdmin) OR !empty(Auth::user()->hr))
    <div class="search-bar">
      <form class="search-form d-flex align-items-center">
        <input type="text" placeholder="Search" title="Enter search keyword"  onkeyup="showResult(this.value)">


      </form>
      <div  class="position-absolute border-1  bg-success rounded-sm mt-1 front-comme col-sm-5 text-light" id="livesearch" aria-hidden="true"></div>
    </div>
@endif


@if(!empty(Auth::user()->pcAdmin) OR !empty(Auth::user()->sbuPcAdmin))
<div class="search-bar">
  <form class="search-form d-flex align-items-center">
    <input type="text" placeholder="Search PC" title="Enter search keyword"  onkeyup="pcview(this.value)" >


  </form>
  <div  class="position-absolute border-1  bg-success rounded-sm mt-1 front-comme col-sm-5 text-light" id="pcliveview" aria-hidden="true"></div>
</div>
@endif

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>

        </li>

@include('template/notification')


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">

            @if (!empty(DB::table('profiles')->where('profile_id',Auth::user()->profile_id)->value('profile_image')))
            <img src="{{url('profile-image/'.DB::table('profiles')->where('profile_id',Auth::user()->profile_id)->value('profile_image'))}}" alt="Profile" class="rounded-circle">
            @else

            @if (!empty($profile[0]->subsidiaries_logo))
            <img src="{{url('sbu_logo/'.$profile[0]->subsidiaries_logo)}}" alt="Profile" class="rounded-circle">
            @endif

            @endif




            <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()->name }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6> {{ Session::get('name') }}</h6>
              <span>


              </span>
            </li>
            <!-------
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center text-decoration-none" href="">
                <i class="bi bi-person"></i>
                <span>Account Settings {{Session::get('profileUser')}} {{ Auth::user()->profileUser }}</span>
              </a>
            </li>
            !------>
            <li>
              <hr class="dropdown-divider">
            </li>


            @if(!empty(Auth::user()->profileUser))

            <li>
                <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/view-profile/{{ DB::table('profiles')->where('profile_id',Auth::user()->profile_id)->value('profile_sug') }}">
                  <i class="bi bi-gear"></i>
                  <span>My Profile</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>

            @endif


            @if(!empty(Auth::user()->profileUser))
            <li>
              <a class="dropdown-item d-flex align-items-center text-decoration-none" href="#" data-toggle="modal" data-target="#passwordupdate">
                <i class="bi bi-question-circle"></i>
                <span>Pasword Change</span>
              </a>
            </li>
            @endif
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center text-decoration-none" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul>
        </li>

      </ul>
    </nav>




  </header>

