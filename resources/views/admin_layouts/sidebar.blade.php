<div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
  <ul class="navbar-nav">
    <li class="nav-item mb-2 mt-0">
      <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav" role="button" aria-expanded="false">
        <img src="{{ Auth::user()->profile }}" class="avatar">
        <span class="nav-link-text ms-2 ps-1">{{ Auth::user()->name }}</span>
      </a>
      <div class="collapse" id="ProfileNav">
        <ul class="nav ">
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('admin.profiles.index') }}">
              <span class="sidenav-mini-icon"> <i class="fas fa-user-circle"></i> </span>
              <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <hr class="horizontal light mt-0">
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white " aria-controls="dashboardsExamples" role="button" aria-expanded="false">
        <i class="material-icons-round opacity-10">dashboard</i>
        <span class="nav-link-text ms-2 ps-1">Dashboards</span>
      </a>
      <div class="collapse " id="dashboardsExamples">
        <ul class="nav ">
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('home') }}">
              <span class="sidenav-mini-icon"> <i class="fas fa-dashboard"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Dashboard </span>
            </a>
          </li>
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.banners.index') }}">
              <span class="sidenav-mini-icon"> <i class="fa-solid fa-panorama"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Banner </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.games.index') }}">
              <span class="sidenav-mini-icon"> <i class="fa-solid fa-gamepad"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Game Links </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.text.index') }}">
              <span class="sidenav-mini-icon"> <i class="fa-solid fa-bullhorn"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Banner Text </span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('admin.promotions.index') }}">
              <span class="sidenav-mini-icon"> <i class="fas fa-gift"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Promotions </span>
            </a>
          </li>
          @endcan

        </ul>
      </div>
    </li>
    @foreach (Auth::user()->roles as $role)
    @if($role->title == "Admin")
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#masterControl" class="nav-link text-white" aria-controls="pagesExamples" role="button" aria-expanded="false">
        <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">manage_accounts</i>
        <span class="nav-link-text ms-2 ps-1">Admin Control</span>
      </a>
      <div class="collapse show" id="pagesExamples">
        <ul class="nav">
          <li class="nav-item ">
            <div class="collapse " id="masterControl">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/real-live-master-list')}}">
                    <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Master Lists </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/real-live-master-create')}}">
                    <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Master Create </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/get-all-admin-to-master-transfer-log') }}">
                    <span class="sidenav-mini-icon"> T L </span>
                    <span class="sidenav-normal  ms-2  ps-1"> TransferLog </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/get-all-admin-to-master-daily-status-transfer-log') }}">
                    <span class="sidenav-mini-icon"> D S </span>
                    <span class="sidenav-normal  ms-2  ps-1">Daily Status </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/get-all-admin-to-master-monthly-status-transfer-log') }}">
                    <span class="sidenav-mini-icon"> M S </span>
                    <span class="sidenav-normal  ms-2  ps-1">Monthly Status </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </li>
    @elseif($role->title == "Master")
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#masterControl" class="nav-link text-white" aria-controls="pagesExamples" role="button" aria-expanded="false">
        <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">manage_accounts</i>
        <span class="nav-link-text ms-2 ps-1">Master Control</span>
      </a>
      <!-- <div class="collapse show" id="pagesExamples">
          <ul class="nav">
            <li class="nav-item ">
              <div class="collapse " id="masterControl">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('admin.agent-list')}}">
                      <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                      <span class="sidenav-normal  ms-2  ps-1"> Agent Lists </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link text-white " href="{{ route('admin.agent-create')}}">
                      <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                      <span class="sidenav-normal  ms-2  ps-1"> Agent Create </span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin/get-all-master-to-agent-transfer-log') }}">
                      <span class="sidenav-mini-icon"> T L </span>
                      <span class="sidenav-normal  ms-2  ps-1"> TransferLog </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin/get-all-master-to-agent-daily-status-transfer-log') }}">
                      <span class="sidenav-mini-icon"> D S </span>
                      <span class="sidenav-normal  ms-2  ps-1">Daily Status </span>
                    </a>
                  </li>

                   <li class="nav-item">
                    <a class="nav-link text-white " href="{{ url('/admin/get-all-master-to-agent-monthly-status-transfer-log') }}">
                      <span class="sidenav-mini-icon"> M S </span>
                      <span class="sidenav-normal  ms-2  ps-1">Monthly Status </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div> -->
    </li>
    @elseif($role->title == "Agent")
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#masterControl" class="nav-link text-white" aria-controls="pagesExamples" role="button" aria-expanded="false">
        <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">manage_accounts</i>
        <span class="nav-link-text ms-2 ps-1">Agent Control</span>
      </a>
      <div class="collapse show" id="pagesExamples">
        <ul class="nav">
          <li class="nav-item ">
            <div class="collapse " id="masterControl">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ route('admin.agent-user-list')}}">
                    <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                    <span class="sidenav-normal  ms-2  ps-1"> User Lists </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/get-all-agent-to-user-transfer-log') }}">
                    <span class="sidenav-mini-icon"> T L </span>
                    <span class="sidenav-normal  ms-2  ps-1"> TransferLog </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/get-all-agent-to-user-daily-status-transfer-log') }}">
                    <span class="sidenav-mini-icon"> D S </span>
                    <span class="sidenav-normal  ms-2  ps-1">Daily Status </span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('/admin/get-all-agent-to-user-monthly-status-transfer-log') }}">
                    <span class="sidenav-mini-icon"> M S </span>
                    <span class="sidenav-normal  ms-2  ps-1">Monthly Status </span>
                  </a>
                </li>

              </ul>
            </div>
          </li>
        </ul>
      </div>
    </li>
    @endif
    @endforeach

    @can('admin_access')
    <li class="nav-item mt-3">
      <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder text-white">Management</h6>
    </li>
    @endcan
    @can('admin_access')
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#profileExample" class="nav-link text-white" aria-controls="pagesExamples" role="button" aria-expanded="false">
        <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">manage_accounts</i>
        <span class="nav-link-text ms-2 ps-1">User Control</span>
      </a>
      <div class="collapse show" id="pagesExamples">
        <ul class="nav">
          <li class="nav-item ">
            <div class="collapse " id="profileExample">
              <ul class="nav nav-sm flex-column">
                @can('admin_access')
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ route('admin.permissions.index')}}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Permissions </span>
                  </a>
                </li>
                @endcan
                @can('admin_access')
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ route('admin.roles.index') }}">
                    <span class="sidenav-mini-icon"> U R </span>
                    <span class="sidenav-normal  ms-2  ps-1"> User's Roles </span>
                  </a>
                </li>
                @endcan
                @can('admin_access')
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ route('admin.users.index')}}">
                    <span class="sidenav-mini-icon"> U </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Users </span>
                  </a>
                </li>
                @endcan
                @can('admin_access')
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('  http://ag.gsoftbb.com')}}">
                    <span class="sidenav-mini-icon"> U </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Agent System </span>
                  </a>
                </li>
                @endcan

                @can('admin_access')
                <li class="nav-item">
                  <a class="nav-link text-white " href="{{ url('https://bbinbo.gsoft688.com/Account/Login.aspx')}}">
                    <span class="sidenav-mini-icon"> U </span>
                    <span class="sidenav-normal  ms-2  ps-1"> SlotAccDashboard </span>
                  </a>
                </li>
                @endcan

                @can('admin_access')
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> S P </span>
                    <span class="sidenav-normal  ms-2  ps-1"> SlotPlayer </span>
                  </a>
                </li>
                @endcan
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </li>
    @endcan
    {{-- lottery --}}
    {{-- lottery --}}
    @can('admin_access')
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#applicationsExamples" class="nav-link text-white " aria-controls="applicationsExamples" role="button" aria-expanded="false">
        {{-- <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">apps</i> --}}
        <i class="fas fa-list-check" style="font-size: 16px;"></i>
        <span class="nav-link-text ms-2 ps-1">2D Control</span>
      </a>
      <div class="collapse " id="applicationsExamples">
        <ul class="nav ">
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D Users </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-list"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D History </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-plus-circle"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Create 2D|No </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> MS </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (9:30AM) </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> MS </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (12:00PM) </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-award"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (9:30AM) Winner </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-award"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (12:00PM) Winner </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> ES </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (02:30PM) </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> ES </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (04:30PM) </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-award"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (02:30PM) Winner </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-award"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D (04:30PM) Winner </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-wallet"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Balance Accept </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-wallet"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Balance Withdraw </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-hourglass-end"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> CloseTwoD </span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-rotate-left"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> SessionReset</span>
            </a>
          </li>
          @endcan
          @can('admin_access')
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> <i class="fas fa-bell"></i> </span>
              <span class="sidenav-normal  ms-2  ps-1"> Notifications</span>
            </a>
          </li>
          @endcan
        </ul>
      </div>
    </li>
    @endcan
    {{-- end lottery --}}
    {{-- end lottery --}}

    {{-- 2d over amount limit --}}
    @can('admin_access')
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#ecommerceExamplesOver" class="nav-link text-white " aria-controls="ecommerceExamplesOver" role="button" aria-expanded="false">
        {{-- <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">shopping_basket</i> --}}
        <i class="fas fa-paper-plane" style="font-size: 16px;"></i>
        <span class="nav-link-text ms-2 ps-1">2D OverLimit</span>
      </a>
      <div class="collapse " id="ecommerceExamplesOver">
        <ul class="nav ">
          <li class="nav-item ">
            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false" href="#productsExample">
              <span class="sidenav-mini-icon"> P </span>
              <span class="sidenav-normal  ms-2  ps-1"> 2D Over AmountLimit <b class="caret"></b></span>
            </a>
            <div class="collapse " id="productsExample">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 2D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> 9:30 OverLimit </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 2D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> 12:1 OverLimit </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 2D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> 2 : OverLimit </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 2D </span>
                    <span class="sidenav-normal  ms-2  ps-1">4:30 OverLimit </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false" href="#ordersExample">
              <span class="sidenav-mini-icon"> O </span>
              <span class="sidenav-normal  ms-2  ps-1"> Orders <b class="caret"></b></span>
            </a>
            <div class="collapse " id="ordersExample">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> O </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Order List </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> O </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Order Details </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> R </span>
              <span class="sidenav-normal  ms-2  ps-1"> Referral </span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    @endcan
    {{-- 2d over amount limit --}}
    @can('admin_access')
    <li class="nav-item">
      <a data-bs-toggle="collapse" href="#ecommerceExamples" class="nav-link text-white " aria-controls="ecommerceExamples" role="button" aria-expanded="false">
        <i class="fas fa-list-check" style="font-size: 16px;"></i>
        <span class="nav-link-text ms-2 ps-1">3D Control</span>
      </a>
      <div class="collapse " id="ecommerceExamples">
        <ul class="nav ">
          <li class="nav-item ">
            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false" href="#productsExample">
              <span class="sidenav-mini-icon"> P </span>
              <span class="sidenav-normal  ms-2  ps-1"> ThreeDManagement <b class="caret"></b></span>
            </a>
            <div class="collapse " id="productsExample">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 3D H </span>
                    <span class="sidenav-normal  ms-2  ps-1"> 3D History </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> OD </span>
                    <span class="sidenav-normal  ms-2  ps-1"> OpeninDate </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 3D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> PrizeNoCreate </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 3D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> List </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> 3D </span>
                    <span class="sidenav-normal  ms-2  ps-1"> WinnerList </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false" href="#ordersExample">
              <span class="sidenav-mini-icon"> O </span>
              <span class="sidenav-normal  ms-2  ps-1"> Orders <b class="caret"></b></span>
            </a>
            <div class="collapse " id="ordersExample">
              <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> O </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Order List </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white " href="">
                    <span class="sidenav-mini-icon"> O </span>
                    <span class="sidenav-normal  ms-2  ps-1"> Order Details </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-white " href="">
              <span class="sidenav-mini-icon"> R </span>
              <span class="sidenav-normal  ms-2  ps-1"> Referral </span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    @endcan

    <li class="nav-item">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-white">
        <span class="sidenav-mini-icon"> <i class="fas fa-right-from-bracket"></i> </span>
        <span class="sidenav-normal ms-2 ps-1">Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </li>
  </ul>