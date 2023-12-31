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
    <h4>Agent Information -- <span>
    Agent ID : {{ $transfer_user->id }}
    </span></h4>
    <a class="btn btn-icon btn-2 btn-primary" href="{{ url('/admin/agent-list') }}">
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
        <td>{!! $transfer_user->name !!}</td>
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
       <h5 class="mb-0">Agent ထံသို့ ငွေလွဲပေးမည်</h5>

      </div>
      <div class="ms-auto my-auto mt-lg-0 mt-4">
       <div class="ms-auto my-auto">
        <a class="btn btn-icon btn-2 btn-primary" href="{{ url('/admin/agent-list') }}">
         <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
        </a>

       </div>
      </div>
     </div>
    </div>
    <div class="card-body">
    <form action="{{ route('admin.agent-transfer-store') }}" method="POST">
      @csrf
  <div class="row">
    <div class="col-md-6">
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Agent Real Name</label>
        <input type="text" class="form-control" name="name" value="{{ $transfer_user->name }}" readonly>

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
  <div class="row">
    <div class="col-md-6">
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Agent ထံသို့ ငွေလွဲပေးမည့်ပမာဏ</label>
        <input type="text" class="form-control" name="cash_in">


      </div>
      @error('cash_in')
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
        <button type="submit" class="btn btn-primary">Agent ထံသို့ ငွေလွဲပေးမည်</button>
      </div>
    </div>
  </div>
</form>
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
      title: 'Success! သင်၏ User ထံသို့ ငွေလွဲပေးမှု အောင်မြင်ပါသည်',
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

@endsection
