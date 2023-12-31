@extends('user_layouts.master')

@section('style')
<style>
 .fa-star {
  color: gold;
 }

 .box-1 {
  background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
  border: 1px solid gold;
  color: #fff;
  margin: 0px 2px 2px 2px;
  border-radius: 5px;
  width: 50%;
 }

 .box-2 {
  background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
  border: 1px solid gold;
  color: #fff;
  border-radius: 5px;
  width: 40%;
  align-items: center;
  text-align: center;
 }

 .box-3 {
  background: #8b00dc;
  color: #fff;
  width: 20%;
  align-items: center;
  text-align: center;
 }
</style>
@endsection


@section('content')
@include('user_layouts.navbar')

<div class="container-fluid pt-5 mt-5" style="min-height: 120vh;padding-bottom: 100px">
 <h5 class="text-center mt-4">ဘော်ဒီ/ဂိုးပေါင်း</h5>
 <div class="pt-1 mt-4 ">
  <p><i class="fa fa-star pe-2"></i> AFC Cup</p>
 </div>
 <div class="card shadow text-center bg-transparent px-2 pt-2 pb-3">
  <p class="text-white">ပွဲချိန် : 11-12-2023 4:30 PM</p>
  <div class="d-flex">
   <div class="box-1 d-flex justify-content-around">
    <p class="d-flex align-items-center">မာဇီယာ SRC</p>
    <h5>
     = -5
    </h5>
   </div>
   <div class="box-1">
    <p>ATK မိုဟန် B</p>
   </div>
  </div>
  <div class="d-flex mt-1">
   <div class="box-2">
    <p>ဂိုးပေါ်</p>
   </div>
   <div class="box-3">
    <p>4 + 60</p>
   </div>
   <div class="box-2">
    <p>ဂိုးအောက်</p>
   </div>
  </div>
 </div>
 <div class="pt-1">
  <p><i class="fa fa-star pe-2"></i> Turkiye Lig3</p>
 </div>
 <div class="card shadow text-center bg-transparent px-2 pt-2 pb-3">
  <p class="text-white">ပွဲချိန် : 11-12-2023 4:30 PM</p>
  <div class="d-flex">
   <div class="box-1 d-flex justify-content-around">
    <p>မာဇီယာ SRC</p>
    <h5>
     = -25
    </h5>
   </div>
   <div class="box-1">
    <p>ATK မိုဟန် B</p>
   </div>
  </div>
  <div class="d-flex mt-1">
   <div class="box-2">
    <p>ဂိုးပေါ်</p>
   </div>
   <div class="box-3">
    <p>4 + 60</p>
   </div>
   <div class="box-2">
    <p>ဂိုးအောက်</p>
   </div>
  </div>
 </div>
 <div class="pt-1">
  <p><i class="fa fa-star pe-2"></i> Bulgaria B PFG</p>
 </div>
 <div class="card shadow text-center bg-transparent px-2 pt-2 pb-3">
  <p class="text-white">ပွဲချိန် : 11-12-2023 4:30 PM</p>
  <div class="d-flex">
   <div class="box-1">
    <p>မာဇီယာ SRC</p>

   </div>
   <div class="box-1 d-flex justify-content-around">
    <p>ATK မိုဟန် B</p>
    <h5>
     = -5
    </h5>
   </div>
  </div>
  <div class="d-flex mt-1">
   <div class="box-2">
    <p>ဂိုးပေါ်</p>
   </div>
   <div class="box-3">
    <p>4 + 60</p>
   </div>
   <div class="box-2">
    <p>ဂိုးအောက်</p>
   </div>
  </div>
 </div>
 <div class="pt-1">
  <p><i class="fa fa-star pe-2"></i> Turkiye Lig3</p>
 </div>
 <div class="card shadow text-center bg-transparent px-2 pt-2 pb-4">
  <p class="text-white">ပွဲချိန် : 11-12-2023 4:30 PM</p>
  <div class="d-flex">
   <div class="box-1 d-flex justify-content-around align-items-center">
    <p>မာဇီယာ SRC</p>
    <h5>
     1 - 25
    </h5>
   </div>
   <div class="box-1">
    <p>ATK မိုဟန် B</p>
   </div>
  </div>
  <div class="d-flex mt-1">
   <div class="box-2">
    <p>ဂိုးပေါ်</p>
   </div>
   <div class="box-3">
    <p>4 + 60</p>
   </div>
   <div class="box-2">
    <p>ဂိုးအောက်</p>
   </div>
  </div>
 </div>
</div>

@include('user_layouts.sub-footer')
@endsection