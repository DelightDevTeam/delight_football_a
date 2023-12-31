@extends('user_layouts.master')

@section('style')
<style>
 .card {
  background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
  border: 1px solid gold;
  margin: 0px 2px 2px 2px;
  border-radius: 5px;
 }
</style>
@endsection
@section('content')

@include('user_layouts.navbar')

<div class="container-fluid py-5 mt-5">

 <h5 class="text-center text-white mt-4">နည်းနည်းလောင်း များများနိုင်</h5>
 <marquee behavior="" class="mt-3 text-white" direction="left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore, numquam.</marquee>
 <div class="card px-3 pb-3 fs-5 fw-bold ">
  Balance
  <h5 class="mt-1  fw-bold">246.76 Ks</h5>
 </div>
 <div class="d-flex justify-content-around mt-2 align-items-center text-center">
  <a href="{{ url('/football-maung') }}" class="card w-100 text-decoration-none me-1">
   <img src="{{ asset('football_app/img/football/pitch.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>မောင်း</p>
  </a>
  <a href="{{ url('/football-bodygoal') }}" class="card w-100 text-decoration-none">
   <img src="{{ asset('football_app/img/football/football.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>ဘော်ဒီ/ဂိုးပေါင်း</p>
  </a>
 </div>
 <div class="d-flex justify-content-around mt-2 align-items-center text-center">
  <a href="#" class="card w-100 text-decoration-none me-1">
   <img src="{{ asset('football_app/img/football/history.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>လောင်းထားသောပွဲစဉ်</p>
  </a>
  <a href="{{ url('/football-matches') }}" class="card w-100 text-decoration-none">
   <img src="{{ asset('football_app/img/football/schedule.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>ပွဲစဉ်ဟောင်းများ</p>
  </a>
 </div>
 <div class="d-flex justify-content-around mt-2 align-items-center text-center">
  <a href="{{ url('/football-moneylist') }}" class="card w-100 text-decoration-none me-1">
   <img src="{{ asset('football_app/img/football/coins.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>ငွေစာရင်း</p>
  </a>
  <a href="{{ url('/football-goalresult') }}" class="card w-100 text-decoration-none">
   <img src="{{ asset('football_app/img/football/medical-result.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>ပွဲပြီးရလဒ်များ</p>
  </a>
 </div>
 <div class="d-flex justify-content-around mt-2 align-items-center text-center">
  <a href="#" class="card w-100 text-decoration-none me-1">
   <img src="{{ asset('football_app/img/football/pitch.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>3D/4D</p>
  </a>
  <a href="{{ url('/football-moneychange') }}" class="card w-100 text-decoration-none">
   <img src="{{ asset('football_app/img/football/cash-flow.png') }}" class="mx-auto" width="40px" height="40px" alt="">
   <p>ငွေ/အကြောင်းကြား</p>
  </a>
 </div>

</div>

@endsection