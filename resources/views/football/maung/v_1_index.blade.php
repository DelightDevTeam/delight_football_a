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

<div class="container-fluid pt-5 mt-5" style="min-height: 100vh; padding-bottom: 100px">
 <h5 class="text-center mt-4">မောင်း</h5>

 @section('content')
    @php $count = 0; @endphp

    @if($oddData->count() > 0)
        @foreach ($oddData as $odd)
            @php $count++; @endphp

            @php
                $mm_odd = "0";
                $mm_Todd = "0";

                // Calculations here...
                $tmpDiffer = $odd->spreads_p >= 0
                    ? round(100 * ($odd->spreads_a - $odd->spreads_h), -1)
                    : round(100 * ($odd->spreads_h - $odd->spreads_a), -1);
                $tmpSpread = $odd->spreads_p >= 0
                    ? $odd->spreads_p * (-1)
                    : $odd->spreads_p;
                $tmpDifferTotal = round(100 * ($odd->over - $odd->under), -1);

                // Switch statements to determine $mm_Todd and $mm_odd...
                switch (($odd->totals_point)) {
          case  1.5:
            if ($tmpDifferTotal < 0) {
              $mm_Todd = "2 +" . sprintf("%02d", 100 + $tmpDifferTotal);
            } else {
              $mm_Todd = "1 -" . sprintf("%02d", 100 - $tmpDifferTotal);
            }
            break;
          case  1.75:
            $mm_Todd = "2 +" . sprintf("%02d", 50 + $tmpDifferTotal);
            break;
          case  2:
            $mm_Todd = "2 " . sprintf("%+02d", $tmpDifferTotal);
            break;
          case  2.25:
            $mm_Todd = "2 -" . sprintf("%02d", 50 - $tmpDifferTotal);
            break;
          case  2.5:
            if ($tmpDifferTotal < 0) {
              $mm_Todd = "3 +" . sprintf("%02d", 100 + $tmpDifferTotal);
            } else {
              $mm_Todd = "2 -" . sprintf("%02d", 100 - $tmpDifferTotal);
            }
            break;
          case  2.75:
            $mm_Todd = "3 +" . sprintf("%02d", 50 + $tmpDifferTotal);
            break;
          case  3:
            $mm_Todd = "3 " . sprintf("%+02d", $tmpDifferTotal);
            break;
          case  3.25:
            $mm_Todd = "3 -" . sprintf("%02d", 50 - $tmpDifferTotal);
            break;
          case  3.5:
            if ($tmpDifferTotal < 0) {
              $mm_Todd = "4 +" . sprintf("%02d", 100 + $tmpDifferTotal);
            } else {
              $mm_Todd = "3 -" . sprintf("%02d", 100 - $tmpDifferTotal);
            }
            break;
          case  3.75:
            $mm_Todd = "4 +" . sprintf("%02d", 50 + $tmpDifferTotal);
            break;
          case  4:
            $mm_Todd = "4 " . sprintf("%+02d", $tmpDifferTotal);
            break;
          case  4.25:
            $mm_Todd = "4 -" . sprintf("%02d", 50 - $tmpDifferTotal);
            break;
          case  4.5:
            if ($tmpDifferTotal < 0) {
              $mm_Todd = "5 +" . sprintf("%02d", 100 + $tmpDifferTotal);
            } else {
              $mm_Todd = "4 -" . sprintf("%02d", 100 - $tmpDifferTotal);
            }
            break;
          case  4.75:
            $mm_Todd = "5 +" . sprintf("%02d", 50 + $tmpDifferTotal);
            break;
          case  5:
            $mm_Todd = "5 " . sprintf("%+02d", $tmpDifferTotal);
            break;
          case  5.25:
            $mm_Todd = "5 -" . sprintf("%02d", 50 - $tmpDifferTotal);
            break;
          case  5.5:
            if ($tmpDifferTotal < 0) {
              $mm_Todd = "6 +" . sprintf("%02d", 100 + $tmpDifferTotal);
            } else {
              $mm_Todd = "5 -" . sprintf("%02d", 100 - $tmpDifferTotal);
            }
            break;
          case  5.75:
            $mm_Todd = "6 +" . sprintf("%02d", 50 + $tmpDifferTotal);
            break;
          case  6:
            $mm_Todd = "6 " . sprintf("%+02d", $tmpDifferTotal);
            break;
        }

        switch (($tmpSpread)) {
          case  0:
            $mm_odd = "" . sprintf("%+02d", $tmpDiffer);
            break;
          case  -0.25:
            $mm_odd = "-" . sprintf("%02d", 50 - $tmpDiffer);
            break;
          case -0.5:
            if ($tmpDiffer < 0) {
              $mm_odd = "1 +" . strval(sprintf("%02d", 100 + $tmpDiffer));
            } else {
              $mm_odd = "-" . strval(sprintf("%02d", 100 - $tmpDiffer));
            }
            break;
          case  -0.75:
            $mm_odd = "1 +" . sprintf("%02d", 50 + $tmpDiffer);
            break;
          case  -1:
            $mm_odd = "1 " . sprintf("%+02d", $tmpDiffer);
            break;
          case  -1.25:
            $mm_odd = "1 -" . sprintf("%02d", 50 - $tmpDiffer);
            break;
          case  -1.5:
            if ($tmpDiffer < 0) {
              $mm_odd = "2 +" . sprintf("%02d", 100 + $tmpDiffer);
            } else {
              $mm_odd = "1 -" . sprintf("%02d", 100 - $tmpDiffer);
            }
            break;
          case  -1.75:
            $mm_odd = "2 +" . sprintf("%02d", 50 + $tmpDiffer);
            break;
          case  -2:
            $mm_odd = "2 " . sprintf("%+02d", $tmpDiffer);
            break;
          case  -2.25:
            $mm_odd = "2 -" . sprintf("%02d", 50 - $tmpDiffer);
            break;
          case  -2.5:
            if ($tmpDiffer < 0) {
              $mm_odd = "3 +" . sprintf("%02d", 100 + $tmpDiffer);
            } else {
              $mm_odd = "2 -" . sprintf("%02d", 100 - $tmpDiffer);
            }
            break;
          case  -2.75:
            $mm_odd = "3 +" . sprintf("%02d", 50 + $tmpDiffer);
            break;
          case  -3:
            $mm_odd = "3 " . sprintf("%+02d", $tmpDiffer);
            break;
          case  -3.25:
            $mm_odd = "3 -" . sprintf("%02d", 50 - $tmpDiffer);
            break;
          case  -3.5:
            if ($tmpDiffer < 0) {
              $mm_odd = "4 +" . sprintf("%02d", 100 + $tmpDiffer);
            } else {
              $mm_odd = "3 -" . sprintf("%02d", 100 - $tmpDiffer);
            }
            break;
          case  -3.75:
            $mm_odd = "4 +" . sprintf("%02d", 50 + $tmpDiffer);
            break;
          case  -4:
            $mm_odd = "4 " . sprintf("%+02d", $tmpDiffer);
            break;
          case  -4.25:
            $mm_odd = "4 -" . sprintf("%02d", 50 - $tmpDiffer);
            break;
          case  -4.5:
            if ($tmpDiffer < 0) {
              $mm_odd = "5 +" . sprintf("%02d", 100 + $tmpDiffer);
            } else {
              $mm_odd = "4 -" . sprintf("%02d", 100 - $tmpDiffer);
            }
            break;
          case  -4.75:
            $mm_odd = "5 +" . sprintf("%02d", 50 + $tmpDiffer);
            break;
          case  -5:
            $mm_odd = "5 " . sprintf("%+02d", $tmpDiffer);
            break;
          case  -5.25:
            $mm_odd = "5 -" . sprintf("%02d", 50 - $tmpDiffer);
            break;
          case  -5.5:
            if ($tmpDiffer < 0) {
              $mm_odd = "6 +" . sprintf("%02d", 100 + $tmpDiffer);
            } else {
              $mm_odd = "5 -" . sprintf("%02d", 100 - $tmpDiffer);
            }
            break;
          case  -5.75:
            $mm_odd = "6 +" . sprintf("%02d", 50 + $tmpDiffer);
            break;
          case  -6:
            $mm_odd = "6 " . sprintf("%+02d", $tmpDiffer);
            break;
        }
            @endphp

            <div class="pt-1 mt-2">
                <p><i class="fa fa-star pe-2"></i> {{ $odd->league_name }}</p>
            </div>
            <div class="card shadow bg-transparent px-2 pt-2 pb-3">
                <p class="text-white">ပွဲချိန် : {{ $odd->starts }}</p>

                {{-- Dynamic HTML based on conditions --}}
                <div class="d-flex">
                    <div class="box-1 d-flex justify-content-around">
                        <p class="d-flex align-items-center">{{ $odd->home }}</p>
                        <h5>
                            <span class="badge bg-primary">{{ $mm_odd }}</span>
                        </h5>
                    </div>
                    <div class="box-1">
                        <p>{{ $odd->away }}</p>
                    </div>
                </div>

                <div class="d-flex mt-1">
                    <div class="box-2" onclick="betOdd('{{ $odd->id }}','{{ $odd->league_name }}','{{ $odd->home }}','{{ $odd->away }}','o','{{ $mm_Todd }}','o_{{ $odd->id }}{{ $count }}','')">
                        <p>ဂိုးပေါ်</p>
                    </div>
                    <div class="box-3">
                        <p>{{ $mm_Todd }}</p>
                    </div>
                    <div class="box-2" onclick="betOdd('{{ $odd->id }}','{{ $odd->league_name }}','{{ $odd->home }}','{{ $odd->away }}','u','{{ $mm_Todd }}','u_{{ $odd->id }}{{ $count }}','')">
                        <p>ဂိုးအောက်</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No odds data available at the moment.</p>
    @endif
{{-- first list --}}
 {{-- <div class="pt-1 mt-2">
  <p><i class="fa fa-star pe-2"></i> AFC Cup</p>
 </div>
 <div class="card shadow bg-transparent px-2 pt-2 pb-3">
  <p class="text-white">ပွဲချိန် : 11-12-2023 4:30 PM</p>
  <div class="d-flex">
   <div class="box-1 d-flex justify-content-around">
    <p class="d-flex align-items-center">မာဇီယာ SRC</p>
    <h5>
     <span class="badge" style="background-color: #8b00dc;">1-10</span>
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
 </div> --}}
 {{-- first list --}}

</div>

@include('user_layouts.sub-footer')
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>


@endsection
