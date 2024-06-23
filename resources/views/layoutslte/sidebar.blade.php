  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
          <img src="{{ asset('img/logo705.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
          <span class="logo-name">705 Storage</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="mt-3 mb-3 d-flex justify-content-center align-items-center">
              <div>
                  <img src="{{ asset('img/profile.png') }}" width="40" height="40"
                      class="imgProfile rounded-circle" alt="User Image">
              </div>
              <div class="ms-3">
                  <a href="#" class="ms-0">{{ Auth::user()->name }}</a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item">
                      <a href="{{ route('produk') }}" class="nav-link {{ Request::routeIs('produk') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-house-user"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('history.page') }}"
                          class="nav-link {{ Request::routeIs('history.page') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-history"></i>
                          <p>
                              History
                          </p>
                      </a>
                  </li>
                  <li
                      class="nav-item has-treeview {{ Request::routeIs('permission.view', 'roles.view', 'assign.permission.view', 'active.roles.view') ? 'menu-open' : '' }}">
                      <a href="#"
                          class="nav-link {{ Request::routeIs('permission.view', 'roles.view', 'assign.permission.view', 'active.roles.view') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-user-secret"></i>
                          <p>
                              Role Management
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('permission.view') }}"
                                  class="nav-link {{ Request::routeIs('permission.view') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Permission</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('roles.view') }}"
                                  class="nav-link {{ Request::routeIs('roles.view') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Roles</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('assign.permission.view') }}"
                                  class="nav-link {{ Request::routeIs('assign.permission.view') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Assign Permission</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('active.roles.view') }}"
                                  class="nav-link {{ Request::routeIs('active.roles.view') ? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>
                                    Active Roles
                                  </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <i class="nav-icon  fas fa-arrow-alt-circle-right"></i>
                          <p>
                              Logout
                          </p>
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </li>


              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
