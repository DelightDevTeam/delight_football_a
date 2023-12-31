@auth
<div class="sidebar" id="sidebar" style="padding-top: 70px;">
 <div class="container-fluid py-3 rounded-4 shadow">
  <!-- after login view -->
  <div class="d-flex justify-content-between">
   @if (Auth::user()->profile)
   <img src="{{ Auth::user()->profile }}" alt="">
   @else
   <i class="fa-regular fa-user-circle text-purple fa-2x"></i>
   @endif

   <div>
    <a href="#" class="login-btn">
     {{ Auth::user()->name }}
    </a>
    <small class="text-purple">
     <i class="fas fa-wallet text-purple"></i> : {{ Auth::user()->balance }} MMK
    </small>
   </div>
  </div>
  <!-- after login -->
 </div>
 <!-- nav-links -->
 <div class="nav-links" id="sideLink">
  @can('user_access')
  <a href="{{ route('home') }}" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-dashboard d-block me-2"></i>
    <p class="py-0">Admin Dashboard</p>
   </div>
  </a>
  @endcan
  <a href="#" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-award d-block me-2"></i>
    <p class="py-0">ကံထူးရှင်များ</p>
   </div>
  </a>
  <a href="#" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-award d-block me-2"></i>
    <p class="py-0">SlotGame</p>
   </div>
  </a>
  <a href="./sidebar/twoDthreeDhistory.html" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-list d-block me-2"></i>
    <p class="py-0">ထွက်ဂဏန်းများ</p>
   </div>
  </a>
  <a href="#" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-calendar d-block me-2"></i>
    <p class="py-0">3D ထီထိုးမှတ်တမ်း</p>
   </div>
  </a>
  <a href="#" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-tower-broadcast d-block me-2"></i>
    <p class="py-0">2D Live</p>
   </div>
  </a>
  <a href="#" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-calendar d-block me-2"></i>
    <p class="py-0">2D Calendar</p>
   </div>
  </a>
  <a href="#" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-calendar d-block me-2"></i>
    <p class="py-0">2D Holiday</p>
   </div>
  </a>
  <a href="{{ url('/user/three-d-play-index') }}" class="link shadow">
   <div class="d-flex">
    <i class="fas fa-tower-broadcast d-block me-2"></i>
    <p class="py-0">3D Live</p>
   </div>
  </a>

  <a href="" class="link shadow" onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
   <div class="d-flex">
    <i class="fas fa-right-from-bracket d-block me-2"></i>
    <p class="py-0">အကောင့်ထွက်ရန်</p>
   </div>
   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
   </form>
  </a>
 </div>
 <!-- nav-links -->
</div>
@endauth