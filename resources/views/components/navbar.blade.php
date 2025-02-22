<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo me-5" href="/home"><img src="/images/logo.svg" class="me-2" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="/home"><img src="/images/logo-mini.svg" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="ti-view-list"></span>
      </button>
      
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          {{-- <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
            <img src="images/faces/face28.jpg" alt="profile"/>
          </a> --}}
          <div class="d-flex justify-content-center align-self-center me-3">
            <i class="ti-user menu-icon mt- d-none d-sm-flex"></i>
            <p>{{auth()->user()->name}}</p>
          </div>
          <form action="/logout" method="POST" onsubmit="return confirm('Are you sure you want to sign out?');">
            @csrf
            <button type="submit" style="cursor: pointer; border: none; background-color: white; color: #9b9b9b; text-10px"><p>Sign Out</p></button>
          </form>
          
          
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="ti-view-list"></span>
      </button>
    </div>
  </nav>