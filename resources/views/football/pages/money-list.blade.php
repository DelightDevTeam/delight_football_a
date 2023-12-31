@extends('user_layouts.master')

@section('style')
<style>
 hr {
  border: 1px solid gold;
 }
</style>
@endsection


@section('content')
@include('user_layouts.navbar')
<div class="container-fluid py-5 mt-5">

 <div class="row d-flex justify-content-around align-items-center">
  <div class="col-3 mx-2">
   <h6 class="fw-bold">Pick</h6>
  </div>
  <div class="col-3 mx-2">
   <h6 class="fw-bold">Amount bet</h6>
  </div>
  <div class="col-3 mx-2">
   <h6 class="fw-bold">Amount Won</h6>
  </div>
 </div>

 <div class="my-3">
  <div class="d-flex justify-content-around align-items-center">
   <div class="col-3 mx-2">
    <h6>Los Angelese Dodgers(-165)</h6>
   </div>
   <div class="col-3 mx-2">
    <h6>1000</h6>
   </div>
   <div class="col-3 mx-2">
    <h6 class="fw-bold h5">Won</h6>
   </div>
  </div>
  <div class="ms-4">
   <p>Los Angelese Dodgers <span class="text-primary fw-bold mx-2">VS</span>San Dego Padress</p>
   <p>Dec 23 2023 (12:30PM)</p>
  </div>
  <hr>
 </div>

 <div class="my-3">
  <div class="d-flex justify-content-around align-items-center">
   <div class="col-3 mx-2">
    <h6>Los Angelese Dodgers(-165)</h6>
   </div>
   <div class="col-3 mx-2">
    <h6>1000</h6>
   </div>
   <div class="col-3 mx-2">
    <h6 class="fw-bold h5">Won</h6>
   </div>
  </div>
  <div class="ms-4">
   <p>Los Angelese Dodgers <span class="text-primary fw-bold mx-2">VS</span>San Dego Padress</p>
   <p>Dec 23 2023 (12:30PM)</p>
  </div>
  <hr>
 </div>

 <div class="my-3">
  <div class="d-flex justify-content-around align-items-center">
   <div class="col-3 mx-2">
    <h6>Los Angelese Dodgers(-165)</h6>
   </div>
   <div class="col-3 mx-2">
    <h6>2000</h6>
   </div>
   <div class="col-3 mx-2">
    <h6 class="fw-bold h5">Lost</h6>
   </div>
  </div>
  <div class="ms-4">
   <p>Los Angelese Dodgers <span class="text-primary fw-bold mx-2">VS</span>San Dego Padress</p>
   <p>Dec 23 2023 (12:30PM)</p>
  </div>
  <hr>
 </div>

 <div class="my-3">
  <div class="d-flex justify-content-around align-items-center">
   <div class="col-3 mx-2">
    <h6>Los Angelese Dodgers(-165)</h6>
   </div>
   <div class="col-3 mx-2">
    <h6>2000</h6>
   </div>
   <div class="col-3 mx-2">
    <h6 class="fw-bold h5">Won</h6>
   </div>
  </div>
  <div class="ms-4">
   <p>Los Angelese Dodgers <span class="text-primary fw-bold mx-2">VS</span> San Dego Padress</p>
   <p>Dec 23 2023 (12:30PM)</p>
  </div>
  <hr>
 </div>

</div>
@endsection