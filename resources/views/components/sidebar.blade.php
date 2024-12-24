<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('home.index') }}">
          <i class="ti-home menu-icon"></i>
          <span class="menu-title">Home</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}" >
          <i class="ti-gift menu-icon"></i>
          <span class="menu-title">Products</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="ti-pie-chart menu-icon"></i>
          <span class="menu-title">Categories</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="ti-user menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('orders.index') }}">
          <i class="ti-agenda menu-icon"></i>
          <span class="menu-title">Purchased Orders</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('contactmessages.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('contactmessages.index') }}">
          <i class="ti-comment-alt menu-icon"></i>
          <span class="menu-title">Contact Messages</span>
        </a>
      </li>
      <li class="nav-item {{ request()->routeIs('info.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('info.edit') }}">
          <i class="ti-shield menu-icon"></i>
          <span class="menu-title">Admin Info</span>
        </a>
      </li>
    </ul>
  </nav>