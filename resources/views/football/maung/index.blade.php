@extends('user_layouts.master')

@section('style')
<style>
 .fa-star {
  color: gold;
 }
.bg-home {
    background-color: #f00; /* Change this to the color you want for the home team */
}

.bg-away {
    background-color: #0f0; /* Change this to the color you want for the away team */
}
.highlighted {
    background-color: #f0e68c !important; /* Use important sparingly */
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

    <div class="d-flex">
        {{-- Home Team --}}
        <div class="box-1 d-flex justify-content-around" onclick="betOdd('{{ $odd->id }}', '{{ $odd->league_name }}', '{{ $odd->home }}', '{{ $odd->away }}', 'h', '{{ $mm_odd }}', 'h_{{ $odd->id }}{{ $count }}', 'h')" id="h_{{ $odd->id }}{{ $count }}">
            <p class="d-flex align-items-center">{{ $odd->home }}</p>
            <h5>
                <span class="badge bg-primary">{{ $mm_odd }}</span>
            </h5>
        </div>
        {{-- Away Team --}}
        <div class="box-1" onclick="betOdd('{{ $odd->id }}', '{{ $odd->league_name }}', '{{ $odd->home }}', '{{ $odd->away }}', 'a', '{{ $mm_odd }}', 'a_{{ $odd->id }}{{ $count }}', 'a')" id="a_{{ $odd->id }}{{ $count }}">
            <p>{{ $odd->away }}</p>
        </div>
    </div>

    <div class="d-flex mt-1">
        {{-- Over Button --}}
        <div class="box-2" id="homeTeam" onclick="betOdd('{{ $odd->id }}', '{{ $odd->league_name }}', '{{ $odd->home }}', '{{ $odd->away }}', 'o', '{{ $mm_Todd }}', 'o_{{ $odd->id }}{{ $count }}', '')" id="o_{{ $odd->id }}{{ $count }}">
            <p>ဂိုးပေါ်</p>
        </div>
        <div class="box-3">
            <p>{{ $mm_Todd }}</p>
        </div>
        {{-- Under Button --}}
        <div class="box-2" id="awayTeam" onclick="betOdd('{{ $odd->id }}', '{{ $odd->league_name }}', '{{ $odd->home }}', '{{ $odd->away }}', 'u', '{{ $mm_Todd }}', 'u_{{ $odd->id }}{{ $count }}', '')" id="u_{{ $odd->id }}{{ $count }}">
            <p>ဂိုးအောက်</p>
        </div>
    </div>
</div>

        @endforeach
    @else
        <p>No odds data available at the moment.</p>
    @endif
</div>
   <footer id="footer" class="fixed-bottom">
    <div class="row">
     <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3 col-12 footer-border-purple pt-3 pb-1 footer-border">
      <div class="d-flex justify-content-around align-items-center text-center py-2">
       <p class="text-white">Selected Matches</p>
       <p>|</p>
       <p class="text-white">Amount</p>

       {{-- <input type="text" class="form-control w-25" />
       <button class="btn btn-success">Play</button> --}}
        <input type="number" class="form-control  w-50"  min="1" id="bet_amount" name="bet_amount" value="0" onchange ="getEstimate(this.value);">
      <button class="btn btn-success" onclick="bet_Confirm();">လောင်းမည်</button>
      </div>
     </div>
    </div>
   </footer>

   <div class="modal fade col-sm-12" id="betPnl" tabindex="-1" role="dialog" aria-labelledby="bet" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title  text-dark" id="exampleModalLongTitle">Selected Matches</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>
      <div class="modal-body" id="divBetPlace" style="background-colorLre;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Reselect</button>
        <button id="btnBet" type="button" class="btn btn-primary">Play</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
  var mmOddBet;
  var betObjLst = [];

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  function betOdd(id, l_name, home, away, bet, rate, d_id, bd) {
     // Prevent event bubbling if nested
    event.stopPropagation();
    var htmlExpand = '';
    mmOddBet = {};
    mmOddBet.odd_id = id;
    mmOddBet.league_name = l_name;
    mmOddBet.home = home;
    mmOddBet.away = away;
    mmOddBet.bet = bet;
    mmOddBet.rate = rate;
    mmOddBet.amount = 0.00;
    mmOddBet.d_id = d_id;
    mmOddBet.bd = bd;

    // Remove highlight from all elements
    $('.box-1').removeClass('highlighted');
    $('.box-2').removeClass('highlighted');

    // Add highlight to the selected element
    $('#' + d_id).addClass('highlighted');

    // Filter out the current match from the bet list
    let tmp = betObjLst.filter((item) => item.odd_id == id);
    tmp.forEach((element) => $('#' + element.d_id).removeClass("bg-warning"));

    // Filter out current match and add new selection
    betObjLst = betObjLst.filter((item) => item.odd_id !== id);
    betObjLst.push(mmOddBet);

    // Update the count display
    $("#toggleCount").text(betObjLst.length);
}

$("#deleteBtn").on("click", function() {
    // Remove highlight and reset the list
    $('.box-1, .box-2').removeClass("highlighted");
    betObjLst.forEach((element) => $('#' + element.d_id).removeClass("bg-info"));
    betObjLst = [];
});


</script>
<script>
    function bet_Confirm() {
    if (betObjLst.length < 1) {
      alert("မောင်းလောင်းမည့် အသင်းများရွေးပါ");
      return;
    }
    if(parseInt($('#bet_amount').val())< 1){
      alert("လောင်းမည့်ငွေပမာဏထည်");
      return;

    }
    $('#divBetPlace').empty();

    estimate_val = Math.trunc((parseInt($('#bet_amount').val()) * (betObjLst.length * betObjLst.length)) - (parseInt($('#bet_amount').val())));
    htmlExpand = '';
    htmlExpand = '<div class=" p-3  d-flex justify-content-between text-dark" style="font-size:small;"><div class="row g-1 p-1 text-center" style="font-weight:bold;">';
    for (let i = 0; i < betObjLst.length; i++) {
      console.log(betObjLst[i]);
      htmlExpand += '<div class="border p-2 border-3">';
      if (betObjLst[i].bd == 'h') {
        htmlExpand += '<div class="bg-info">' + betObjLst[i].league_name + '</div><div class="p-1 border" style="font-weight:bold;"><div>' + betObjLst[i].home + '( ' + betObjLst[i].rate + ')</div><div>vs</div><div>' + betObjLst[i].away + '</div></div>';
      } else if (betObjLst[i].bd == 'a') {
        htmlExpand += '<div class="bg-info">' + betObjLst[i].league_name + '</div><div class="p-1 border" style="font-weight:bold;"><div>' + betObjLst[i].home + '</div><div>vs</div><div>' + betObjLst[i].away + '( ' + betObjLst[i].rate + ')</div></div>';
      } else {
        htmlExpand += '<div class="bg-info">' + betObjLst[i].league_name + '</div><div class="p-1 border" style="font-weight:bold;"><div>' + betObjLst[i].home + '</div><div>vs</div><div>' + betObjLst[i].away + '</div><div class="p-1 border bg-success" style="font-weight:bold;">Total : ' + betObjLst[i].rate + '</div></div>';
      }

      if (betObjLst[i].bet == 'h') {
        htmlExpand += '<div class="bg-warning" style="font-size:medium;font-weight:bold;">' + betObjLst[i].home + ' </div>';
      }
      if (betObjLst[i].bet == 'a') {
        htmlExpand += '<div  class="bg-warning" style="font-size:medium;font-weight:bold;">' + betObjLst[i].away + ' </div>';
      }
      if (betObjLst[i].bet == 'o') {
        htmlExpand += '<div  class="bg-warning" style="font-size:medium;font-weight:bold;">Over </div>';
      }
      if (betObjLst[i].bet == 'u') {
        htmlExpand += '<div class="bg-warning"  style="font-size:medium;font-weight:bold;">Under</div>';
      }
      htmlExpand += '</div>';

    }
    htmlExpand += '</div></div>';
    htmlExpand += '<div  class="row g-1 p-1 text-center" style="font-weight:bold;"><label id="est_amt" class="form-label bg-success" style="font-size:medium;font-weight:bold;">'+estimate_val+'</div>';

    $('#divBetPlace').append(htmlExpand);
    $('#betPnl').modal('show');

  }

  function getEstimate(betAmt) {
    $('#est_amt').text('Estimate Win - ' + Math.trunc((betAmt * (betObjLst.length * betObjLst.length)) - betAmt));
    mmOddBet.amount = betAmt;

  }
  $("#btnBet").click(function(event) {
    event.preventDefault();
    var postData = {
      values: betObjLst,
      amount: $('#bet_amount').val()
    };

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      //url: 'http://localhost/laravel60/pet/petupdate',
      url: "{{  route('user.mixparlay.bet') }}",
      type: 'POST',
      data: postData,
      cache: false,
      success: function(data) {
        console.log(data);
        if (data.resCode == 200) {
          alert(data.resDesc);
          mmOddBet = {};
          betObjLst = [];
          $('#divBetPlace').empty();
          $('#betPnl').modal('hide');
          location.reload();
        } else {
          alert(data.resDesc);
        }
      },
      error: function(data, ajaxOptions, thrownError) {
        var status = data.status;
        console.log(data);
        alert(status);
        if (data.status === 422) {
          $.each(data.responseJSON.errors, function(key, value) {
            console.log(value);
          });
        }
      }
    });
  });
</script>
@endsection
