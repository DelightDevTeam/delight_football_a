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
        <li class="nav-item ">
            <a class="nav-link text-white " href="{{ route('home') }}">
                <span class="sidenav-mini-icon"> <i class="fas fa-dashboard"></i> </span>
                <span class="sidenav-normal  ms-2  ps-1"> Dashboard </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('admin.users.index') }}">
                <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                <span class="sidenav-normal  ms-2  ps-1"> User List </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('admin.transfer-logs.index') }}">
                <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                <span class="sidenav-normal  ms-2  ps-1"> Transfer Logs </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('admin.win-lose.index') }}">
                <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                <span class="sidenav-normal  ms-2  ps-1"> Win_Lose Report </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('admin.fixtures.index') }}">
                <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                <span class="sidenav-normal  ms-2  ps-1"> Fixtures </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('admin.transfer-logs.index') }}">
                <span class="sidenav-mini-icon"> <i class="fas fa-users"></i> </span>
                <span class="sidenav-normal  ms-2  ps-1">TODO Report </span>
            </a>
        </li>
        {{-- @if (auth()->user()->isAdmin())
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
        @endif --}}
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