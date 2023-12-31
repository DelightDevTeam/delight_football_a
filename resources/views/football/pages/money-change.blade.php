@extends('user_layouts.master')

@section('style')
<style>
 /* Style the tab */
 .tab {
  overflow: hidden;


  display: flex;
  justify-content: center;
  align-items: center;
  /* border: 1px solid #ccc;
  background-color: #f1f1f1; */
 }

 /* Style the buttons inside the tab */
 .tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;

 }

 /* Create an active/current tablink class */
 .tab button.active {
  /* background-color: #ccc; */
  border-bottom: 3px dashed goldenrod;
 }

 /* Style the tab content */
 .tabcontent {
  display: none;
  padding: 6px 12px;
  /* border: 1px solid #ccc; */
  border-top: none;
 }
</style>
@endsection


@section('content')
@include('user_layouts.navbar')
<div class="container-fluid py-5 mt-5 " style="min-height: 100vh;">
 <p class="text-center fw-bold">ငွေအကြောင်း / ကြား</p>

 <div>
  <div class="tab">
   <button class="tablinks active me-3 w-50 bet_styles" onclick="openTab(event, 'first_tab')">ငွေသွင်း</button>
   <button class="tablinks ms-3 w-50 bet_styles  " onclick="openTab(event, 'second_tab')">ငွေထုတ်</button>
  </div>

  <div id="first_tab" class="tabcontent mt-4" style="display: block;">

   <div class="d-flex">
    <p>အေးဂျင့် : </p>
    <p>mkzzymzmm</p>
   </div>

   <div>
    <p>ငွေလွဲမည့်နည်းလမ်း</p>
    <input type="text" style="height: 50px;" class="w-100 bg-transparent border border-2">
   </div>

   <div>
    <p>ငွေလွဲရမည့်အကောင့်</p>
    <div class="p-5 rounded" style="background:linear-gradient(rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%)">
     <div class="d-flex justify-content-between">
      <p>နာမည် </p>
      <input type="text" class="w-50 border border-none outline-none bg-transparent">
     </div>
     <div class="d-flex justify-content-between mt-1" style="position: relative;">
      <p>အကောင့် ( သို့ ) ဖုန်း </p>
      <input type="text" class="w-50 border border-none outline-none bg-transparent">
      <i class="fa-regular fa-copy fa-xl " style="position: absolute;top: 15px;right: 3px;"></i>
     </div>
    </div>
   </div>

   <div class="d-flex justify-content-between mt-4">
    <p class="text-center w-50">ငွေပမာဏ</p>
    <input type="text" class="w-50 rounded border border-none outline outline-none bg-transparent">
   </div>

   <div style="background: linear-gradient(rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);height: 200px;" class="rounded d-flex justify-content-center align-items-center mt-5">
    <p>ပြေစာပုံစံရွေးရန်</p>
   </div>

  </div>

  <div id="second_tab" class="tabcontent mt-4">
   <div class="d-flex">
    <p>အေးဂျင့် : </p>
    <p>mkzzymzmm</p>
   </div>

   <div>
    <p>ငွေထုတ်မည့်နည်းလမ်း</p>
    <input type="text" style="height: 50px;" class="w-100 bg-transparent border border-2">
   </div>

   <div>
    <p>ငွေထုတ်ရမည့်အကောင့်</p>
    <div class="p-3 rounded" style="background-color: linear-gradient(rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);">
     <div class="d-flex justify-content-between">
      <p>နာမည် </p>
      <input type="text" class="w-50 border border-none outline-none bg-transparent">
     </div>
     <div class="d-flex justify-content-between mt-1" style="position: relative;">
      <p>အကောင့် ( သို့ ) ဖုန်း </p>
      <input type="text" class="w-50 border border-none outline-none bg-transparent">
      <i class="fa-regular fa-copy fa-xl " style="position: absolute;top: 15px;right: 3px;"></i>
     </div>
    </div>
   </div>

   <div class="d-flex justify-content-between mt-4">
    <p class="text-center w-50">ငွေပမာဏ</p>
    <input type="text" class="w-50 rounded border border-none outline outline-none bg-transparent">
   </div>

   <div style="background: linear-gradient(rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);height: 200px;" class="rounded d-flex justify-content-center align-items-center mt-5">
    <p>ပြေစာပုံစံရွေးရန်</p>
   </div>
  </div>
 </div>
</div>
@endsection

@section('script')
<script>
 function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
   tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
   tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
 }
</script>
@endsection