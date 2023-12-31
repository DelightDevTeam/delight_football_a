@extends('admin_layouts.app')
@section('styles')

@endsection
@section('content')
<div class="row align-items-center">
        <div class="col-lg-12 col-sm-8">
          <div class="nav-wrapper position-relative end-0">
            {{-- <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-primary" href="{{ url('/admin/agent-create') }}" aria-selected="true" style="color: aliceblue">
                  + New Agent Create
                </a>
              </li>
              <li class="nav-item ms-1">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-info" href="{{ url('/admin/agent-list') }}" aria-selected="true" style="color: aliceblue">
                   Agent List
                </a>
              </li>
              <li class="nav-item ms-1">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-info btn-sm" href="{{ url('/admin/agent-user-play-early-morning') }}" aria-selected="true" style="color: aliceblue">
                 2D - 9:30 AM
                </a>
              </li>

              <li class="nav-item ms-1">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-info btn-sm" href="{{ url('/admin/agent-user-play-morning') }}" aria-selected="true" style="color: aliceblue">
                 2D - 12:1 PM
                </a>
              </li>
              <li class="nav-item ms-1">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-info btn-sm" href="{{ url('/admin/agent-user-play-early-evening-digit') }}" aria-selected="true" style="color: aliceblue">
                 2D - 2 PM
                </a>
              </li>

              <li class="nav-item ms-1">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-info btn-sm" href="{{ url('/admin/agent-user-play-evening-digit') }}" aria-selected="true" style="color: aliceblue">
                 2D - 4:30 PM
                </a>
              </li>
              <li class="nav-item ms-1">
                <a class="nav-link mb-0 px-0 py-2 active btn btn-primary btn-sm" href="{{ url('/admin/agent-three-d-list') }}" aria-selected="true" style="color: aliceblue">
                 3D
                </a>
              </li>

            </ul> --}}
          </div>
        </div>
      </div>
<div class="row mt-4">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold"></p>
                  <h5 class="font-weight-bolder mb-0 text-capitalize">
                    Master Dashboard
                  </h5>
                  <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">{{ Auth::user()->name }}<span class="font-weight-normal text-secondary"></span></span>
                </div>
                <div class="col-5">
                  <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="text-xs text-secondary">6 May - 7 May</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers1">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7 days</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30 days</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-7 text-start">
                    <p class="text-sm mb-1 text-capitalize font-weight-bold">
                        <i class="fas fa-users"></i>
                        Agents
                    </p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ $agents }}
                  </h5>
                  {{-- <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">+12% <span class="font-weight-normal text-secondary">since last month</span></span> --}}
                </div>
                {{-- <div class="col-5">
                  <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="text-xs text-secondary">6 May - 7 May</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers2">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7 days</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30 days</a></li>
                    </ul>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Avg. Revenue</p>
                  <h5 class="font-weight-bolder mb-0">
                    $1.200
                  </h5>
                  <span class="font-weight-normal text-secondary text-sm"><span class="font-weight-bolder text-success">+$213</span> since last month</span>
                </div>
                <div class="col-5">
                  <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="text-xs text-secondary">6 May - 7 May</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers3">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 7 days</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last week</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Last 30 days</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
           <div class="row mt-5">

            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">weekend</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Bookings</p>
                    <h4 class="mb-0">281</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-sm-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">leaderboard</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                    <h4 class="mb-0">2,300</h4>
                  </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                  <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
              <div class="card  mb-2">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">store</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Revenue</p>
                    <h4 class="mb-0 ">34k</h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <p class="mb-0 "><span class="text-success text-sm font-weight-bolder">+1% </span>than yesterday</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 mt-lg-0 mt-4">
              <div class="card ">
                <div class="card-header p-3 pt-2 bg-transparent">
                  <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="material-icons opacity-10">person_add</i>
                  </div>
                  <div class="text-end pt-1">
                    <p class="text-sm mb-0 text-capitalize ">Followers</p>
                    <h4 class="mb-0 ">+91</h4>
                  </div>
                </div>
                <hr class="horizontal my-0 dark">
                <div class="card-footer p-3">
                  <p class="mb-0 ">Just updated</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
        <div class="col-md-3 col-sm-6 col-6">
          <div class="card">
            <div class="card-body text-center">
              <h1 class="text-gradient text-primary"><span id="status1" countto="21">21</span> <span class="text-lg ms-n2">°C</span></h1>
              <h6 class="mb-0 font-weight-bolder">Living Room</h6>
              <p class="opacity-8 mb-0 text-sm">Temperature</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6">
          <div class="card">
            <div class="card-body text-center">
              <h1 class="text-gradient text-primary"> <span id="status2" countto="44">44</span> <span class="text-lg ms-n1">%</span></h1>
              <h6 class="mb-0 font-weight-bolder">Outside</h6>
              <p class="opacity-8 mb-0 text-sm">Humidity</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mt-4 mt-md-0">
          <div class="card">
            <div class="card-body text-center">
              <h1 class="text-gradient text-primary"><span id="status3" countto="87">87</span> <span class="text-lg ms-n2">m³</span></h1>
              <h6 class="mb-0 font-weight-bolder">Water</h6>
              <p class="opacity-8 mb-0 text-sm">Consumption</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-6 mt-4 mt-md-0">
          <div class="card">
            <div class="card-body text-center">
              <h1 class="text-gradient text-primary"><span id="status4" countto="417">417</span> <span class="text-lg ms-n2">GB</span></h1>
              <h6 class="mb-0 font-weight-bolder">Internet</h6>
              <p class="opacity-8 mb-0 text-sm">All devices</p>
            </div>
          </div>
        </div>
      </div> --}}
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/chartjs.min.js')}}"></script>
{{-- pie chart --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js">
</script>
<script src="{{ asset('admin_app/assets/js/dashboard.js')}}"></script>
<script src="{{ asset('admin_app/assets/js/v_1_dashboard.js')}}"></script>



{{-- first chart end --}}
@endsection
