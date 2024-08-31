
<nav class="navbar navbar-expand-sm">

    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/home">Home</a>
      </li>

      @if(!empty(Auth::user()->hrAdmin) Or !empty(Auth::user()->hr))

   
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Profile
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/profile">Profiles</a>
          <a class="dropdown-item" href="/new-profile">New Profiles</a>
        </div>
      </li>

      @endif


      @if(!empty(Auth::user()->sbuhead))
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            Leave
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/subsidiaries-leave">Leaves</a>

        </div>
      </li>

      @endif

      @if(!empty(Auth::user()->hrAdmin) Or !empty(Auth::user()->hr))

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            System Setting
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Link 1</a>
          <a class="dropdown-item" href="#">Link 2</a>
          <a class="dropdown-item" href="#">Link 3</a>
        </div>
      </li>
      @endif

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Profile
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Link 1</a>
          <a class="dropdown-item" href="#">Link 2</a>
          <a class="dropdown-item" href="#">Link 3</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Profile
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Link 1</a>
          <a class="dropdown-item" href="#">Link 2</a>
          <a class="dropdown-item" href="#">Link 3</a>
        </div>
      </li>
    </ul>
  </nav>

