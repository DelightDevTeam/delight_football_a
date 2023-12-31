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

 <div class="my-3">
  <p class="fs-5 fw-bold p-2" style="color: gray;background: linear-gradient(6deg,rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);border: 1px solid goldenrod;">World - FIFA World Cup (Quata Final)</p>
  <div class="mt-3">
   <p>20 Nov 2023(Monday)</p>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>12<span class="mx-2">:</span>30PM</span>
    <h6>Spain <span class="text-primary fw-bold h5 mx-3">2 - 1</span> Netherlands</h6>
   </div>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>3<span class="mx-2">:</span>30PM</span>
    <h6>Japan <span class="text-primary fw-bold h5 mx-3">2 - 2</span> Sweden</h6>
   </div>
  </div>
  <div class="mt-3">
   <p>29 Nov 2023(Tuesday)</p>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>00<span class="mx-2">:</span>30PM</span>
    <h6>Korea <span class="text-primary fw-bold h5 mx-3">0 - 1</span> Spain</h6>
   </div>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>5<span class="mx-2">:</span>00PM</span>
    <h6>England <span class="text-primary fw-bold h5 mx-3">2 - 5</span> Japan</h6>
   </div>
  </div>
 </div>

 <div class="my-3">
  <p class="fs-5 fw-bold p-2" style="color: gray;background: linear-gradient(6deg,rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);border: 1px solid goldenrod;">Spain Lega (Quata Final)</p>
  <div class="mt-3">
   <p>12 Dec 2024 (Saturday)</p>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>12<span class="mx-2">:</span>30PM</span>
    <h6>Spain <span class="text-primary fw-bold h5 mx-3">2 - 1</span> Netherlands</h6>
   </div>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>3<span class="mx-2">:</span>30PM</span>
    <h6>Japan <span class="text-primary fw-bold h5 mx-3">2 - 2</span> Sweden</h6>
   </div>
  </div>
  <div class="mt-3">
   <p>10 Dec 2024(Thursday)</p>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>00<span class="mx-2">:</span>30PM</span>
    <h6>Korea <span class="text-primary fw-bold h5 mx-3">0 - 1</span> Spain</h6>
   </div>
   <div class="p-3 d-flex justify-content-around align-items-center" style="border-bottom: 1px solid gold;">
    <span>5<span class="mx-2">:</span>00PM</span>
    <h6>England <span class="text-primary fw-bold h5 mx-3">2 - 5</span> Japan</h6>
   </div>
  </div>
 </div>

</div>
@endsection