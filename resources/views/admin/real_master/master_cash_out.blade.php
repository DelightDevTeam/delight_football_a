@extends('admin_layouts.app')
@section('styles')
<style>
.transparent-btn {
 background: none;
 border: none;
 padding: 0;
 outline: none;
 cursor: pointer;
 box-shadow: none;
 appearance: none;
 /* For some browsers */
}


.custom-form-group {
 margin-bottom: 20px;
}

.custom-form-group label {
 display: block;
 margin-bottom: 5px;
 font-weight: bold;
 color: #555;
}

.custom-form-group input,
.custom-form-group select {
 width: 100%;
 padding: 10px 15px;
 border: 1px solid #e1e1e1;
 border-radius: 5px;
 font-size: 16px;
 color: #333;
}

.custom-form-group input:focus,
.custom-form-group select:focus {
 border-color: #d33a9e;
 box-shadow: 0 0 5px rgba(211, 58, 158, 0.5);
}

.submit-btn {
 background-color: #d33a9e;
 color: white;
 border: none;
 padding: 12px 20px;
 border-radius: 5px;
 cursor: pointer;
 font-size: 18px;
 font-weight: bold;
}

.submit-btn:hover {
 background-color: #b8328b;
}
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
@endsection
@section('content')
<div class="row justify-content-center">
 <div class="col-lg-12">
  <div class="container mt-2">
   <div class="d-flex justify-content-between">
    <h6>Master Information -- <span>
    Master ID : {{ $transfer_user->id }}
    </span>
   <span>
    Master Balance :
   </span>
   </h6>
    <a class="btn btn-icon btn-2 btn-primary" href="{{ url('/admin/real-live-master-list') }}">
     <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
    </a>
   </div>
   <div class="card">
    <div class="table-responsive">
     <table class="table align-items-center mb-0">
      <tbody>
       <tr>
        <th>ID</th>
        <td>{!! $transfer_user->id !!}</td>
       </tr>
       <tr>
        <th>User Name</th>
        <td>{!! $transfer_user->name ?? "" !!}</td>
       </tr>
       <tr>
        <th>Phone</th>
        <td>{!! $transfer_user->phone !!}</td>
       </tr>
       <tr>
        <th>Role</th>
        <td>
         @foreach ($transfer_user->roles as $role)
         <span class="badge badge-pill badge-primary">{{ $role->title }}</span>
         @endforeach
        </td>
       </tr>

       <tr>
        <th>Create Date</th>
        <td>{!! $transfer_user->created_at !!}</td>
       </tr>
       <tr>
        <th>Update Date</th>
        <td>{!! $transfer_user->updated_at !!}</td>
       </tr>
      </tbody>
     </table>
    </div>
   </div>
  </div>
 </div>


</div>
<div class="row mt-4">
 <div class="col-lg-12">
   <div class="card">
    <!-- Card header -->
    <div class="card-header pb-0">
     <div class="d-lg-flex">
      <div>
       <h5 class="mb-0">Master - {{ $logs->name ?? "" }} ထံမှ ငွေထုတ်ယူမည် ||
        <span>Current Balance - {{ $logs->cash_balance }} MMK ||
          <span id="current_date"></span>
        </span>
       </h5>

      </div>
      <div class="ms-auto my-auto mt-lg-0 mt-4">
       <div class="ms-auto my-auto">
        <a class="btn btn-icon btn-2 btn-primary" href="{{ url('/admin/real-live-master-list') }}">
         <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
        </a>

       </div>
      </div>
     </div>
    </div>
    <div class="card-body">
    <form action="{{ route('admin.real-master-cash-out-update', $logs->id) }}" method="POST">
      @csrf
      @method('PUT')
  <div class="row">
    <div class="col-md-6">
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Master Real Name</label>
        <input type="text" class="form-control" name="name" value="{{ $transfer_user->name ?? "" }}" readonly>

      </div>
      @error('name')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6">
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{{ $transfer_user->phone }}" readonly>

      </div>
      @error('phone')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
  </div>
  <input type="hidden" name="from_user_id" value="{{ Auth::user()->id }}">
  <input type="hidden" name="to_user_id" value="{{ $transfer_user->id }}">
  {{-- cash_in hidden --}}
  <div class="row">
   <div class="col-md-6">
    <input type="hidden" name="cash_balance" value="{{ $logs->cash_balance }}">
   </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Master ထံမှငွေနုတ်ယူမည့်ပမာဏ</label>
        <input type="text" class="form-control" name="cash_out" required>
      </div>
      @error('cash_out')
         <span class="d-block text-danger">*{{ $message }}</span>
         @enderror
    </div>
    <div class="col-md-6">
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Addition Note (optional)</label>
        <input type="text" class="form-control" name="note">

      </div>
      @error('note')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
  </div>
  {{-- submit button --}}
  <div class="row">
    <div class="col-md-12">
      <div class="input-group input-group-outline is-valid my-3">
        <button type="submit" class="btn btn-primary">Master ထံမှ ငွေထုတ်ယူမည်</button>
      </div>
    </div>
  </div>
</form>
    </div>
   </div>
 </div>
</div>
<div class="row mt-4">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">
     <h4>Admin To Master Transfer History</h4>
    </div>
    <div class="card-body">

    <table class="table">
      <tr>
        <th>#</th>
        <th>From</th>
        <th>To</th>
        <th>Cash In</th>
        <th>Cash Out</th>
        <th>Profit</th>
        <th>CurrentCashBalance</th>
        <th>Date</th>
      </tr>
     <tbody>
       @foreach ($transfer_logs as $index => $log)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $log->fromUser->name }} </td>
                <td>{{ $log->toUser->name }}</td>
                <td>
                  @if ($log->cash_in == null)
                      ----
                  @else
                      {{ $log->cash_in }}
                  @endif
                </td>
                <td>
                  @if ($log->cash_out == null)
                      ----
                  @else
                      {{ $log->cash_out }}
                  @endif
                </td>
                <td>
                @php

                $profit = $log->cash_in - $log->cash_out;
                  @endphp
                  {{-- if profit value is -, show span red color. else profit value is +, show profit value with green color --}}
                  @if ($profit < 0)
                      <span class="text-danger">{{ $profit }}</span>
                  @else
                      <span class="text-success">{{ $profit }}</span>
                  @endif
                </td>
                <td>{{ $log->cash_balance }}</td>
                <td>{{ $log->created_at->format('d-m-Y H:i:s') }}</td>
            </tr>
        @endforeach
     </tbody>
    </table>

    </div>
   </div>
  </div>
 </div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Success! သင်၏ User ထံမှ ငွေနုတ်ယူမှု အောင်မြင်ပါသည်',
      text: '{{ session('
      SuccessRequest ') }}',
      timer: 3000,
      showConfirmButton: false
    });
    @endif
  });
</script>

<script>
if (document.getElementById('choices-tags-edit')) {
 var tags = document.getElementById('choices-tags-edit');
 const examples = new Choices(tags, {
  removeItemButton: true
 });
}
</script>
<script>
var d = new Date();
var date = d.getDate();
var month = d.getMonth() + 1;
var year = d.getFullYear();
var output = date + '-' + (month<10 ? '0' : '') + month + '-' + year;
document.getElementById('current_date').innerHTML = output;
</script>
@endsection
