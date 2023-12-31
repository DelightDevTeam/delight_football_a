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
 <p class="text-center mt-4 fw-bold">ဂိုးရလဒ်များ</p>

 <div>
  <div class="tab">
   <button class="tablinks active me-3 w-50 bet_styles" onclick="openTab(event, 'first_tab')">Yesterday</button>
   <button class="tablinks ms-3 w-50 bet_styles  " onclick="openTab(event, 'second_tab')">Today</button>
  </div>

  <div id="first_tab" class="tabcontent mt-4" style="display: block;">
   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold" style="margin-left: 20%;">FT</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>3 - 4</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold" style="margin-left: 20%;">FT</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>3 - 4</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold" style="margin-left: 20%;">FT</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>3 - 4</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold" style="margin-left: 20%;">FT</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>3 - 4</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold" style="margin-left: 20%;">FT</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>3 - 4</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold" style="margin-left: 20%;">FT</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>3 - 4</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>


  </div>

  <div id="second_tab" class="tabcontent mt-4">

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>v</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">AFC Cup</p>

    <div>
     <div class="d-flex justify-content-start align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p></p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
   </div>

   <div>
    <p class="py-2 px-3 fw-bold" style=" background: linear-gradient(6deg, rgba(102, 0, 149, 1) 0%, rgba(52, 0, 87, 1) 56%);
        border: 1px solid gold;">Australia A-league</p>

    <div>
     <div class="d-flex justify-content-around align-items-center">
      <p style="font-size: 12px;">12-12-2023 &nbsp; 12:00 AM</p>
      <p class="fw-bold ">FT</p>
      <p></p>
     </div>
     <div class="d-flex justify-content-around">
      <p>၀က်စတန်းဆစ်ဒနီ</p>
      <p>PP</p>
      <p>မဲဘုန်း V</p>
     </div>
    </div>
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