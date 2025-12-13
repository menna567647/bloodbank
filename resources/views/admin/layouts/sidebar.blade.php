  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href={{ route('admin.home') }} class="brand-link">
          <span class="brand-text font-weight-light ml-2">
              {{ __('messages.bloodbank') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="info">
                  <a href="#" class="d-block">{{ auth()->user()->name }}</a>
              </div>
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              @can('read bloodtypes')
                  <li class="nav-item">
                      <a href="{{ route('admin.bloodtypes.index') }}" class="nav-link">
                          <p>
                              <i class="fa-solid fa-droplet"></i>
                              {{ __('messages.bloodtypes') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read governorates')
                  <li class="nav-item">
                      <a href="{{ route('admin.governorates.index') }}" class="nav-link">
                          <p>
                              <i class="fa-solid fa-location-dot"></i>
                              {{ __('messages.Governorates') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read cities')
                  <li class="nav-item">
                      <a href="{{ route('admin.cities.index') }}" class="nav-link">
                          <p>
                              <i class="fa-solid fa-city"></i>
                              {{ __('messages.cities') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read categories')
                  <li class="nav-item">
                      <a href="{{ route('admin.categories.index') }}" class="nav-link">
                          <p>
                              <i class="fa-solid fa-layer-group"></i>
                              {{ __('messages.categories') }}
                          </p>
                      </a>
                  </li>
              @endcan

              @can('read posts')
                  <li class="nav-item">
                      <a href="{{ route('admin.posts.index') }}" class="nav-link">
                          <i class="fa-solid fa-newspaper"></i>
                          <p>
                              {{ __('messages.posts') }}
                          </p>
                      </a>
                  </li>
              @endcan

              @can('read donations')
                  <li class="nav-item">
                      <a href="{{ route('admin.donations.index') }}" class="nav-link">
                          <p>
                              <i class="fa-solid fa-hand-holding-heart"></i>
                              {{ __('messages.DonationRequests') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read users')
                  <li class="nav-item">
                      <a href="{{ route('admin.users.index') }}" class="nav-link">
                          <p>
                              <i class="fas fa-users"></i>
                              {{ __('messages.users') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read clients')
                  <li class="nav-item">
                      <a href="{{ route('admin.clients.index') }}" class="nav-link">
                          <p>
                              <i class="fas fa-user-friends"></i>
                              {{ __('messages.clients') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read messages')
                  <li class="nav-item">
                      <a href="{{ route('admin.messages.index') }}" class="nav-link">
                          <p>
                              <i class="fa-solid fa-envelope"></i>
                              {{ __('messages.messages') }}
                          </p>
                      </a>
                  </li>
              @endcan
              @can('read roles')
                  <li class="nav-item">
                      <a href="{{ route('admin.roles.index') }}" class="nav-link">
                          <p>
                              <i class="fas fa-user-shield"></i>
                              {{ __('messages.role') }}
                          </p>
                      </a>
                  </li>
              @endcan
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
