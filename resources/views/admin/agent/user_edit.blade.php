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
@endsection
@section('content')
<div class="container text-center mt-4">
 <div class="row">
  <div class="col-12 col-md-8 mx-auto">
   <div class="card">
    <!-- Card header -->
    <div class="card-header pb-0">
     <div class="d-lg-flex">
      <div>
       <h5 class="mb-0">User Edit Dashboards</h5>

      </div>
      <div class="ms-auto my-auto mt-lg-0 mt-4">
       <div class="ms-auto my-auto">
        <a class="btn btn-icon btn-2 btn-primary" href="{{ route('admin.agent-user-list') }}">
         <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
        </a>

       </div>
      </div>
     </div>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.agent-user-update', $user->id) }}" method="POST">
      @csrf
      @method('PUT')
  <div class="row">
    <div class="col-md-6">
      <div class="input-group input-group-outline my-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control" name="name" readonly value="{{ $user->name }}">

      </div>
      @error('username')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
     <div class="col-md-6">
      <div class="input-group input-group-outline my-3">
        <label class="form-label">User Real Name</label>
        <input type="text" class="form-control" name="username" value="{{ $user->username }}">

      </div>
      @error('username')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
    <div class="col-md-6">
      <div class="input-group input-group-outline my-3">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">

      </div>
      @error('phone')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="mb-1">
        <label class="form-label" style="color: #d33a9e">
          Current Password or New Password
        </label>
      </div>
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password">


      </div>
      @error('password')
         <span class="d-block text-danger">*{{ $message }}</span>
         @enderror
    </div>
    <div class="col-md-6">
            <div class="mb-1">
        <label class="form-label" style="color: #d33a9e">
          Current Password or New Password
        </label>
      </div>
      <div class="input-group input-group-outline is-valid my-3">
        <label class="form-label">ConfirmPassword</label>
        <input type="password" class="form-control" name="password_confirmation">

      </div>
      @error('password_confirmation')
        <span class="d-block text-danger">*{{ $message }}</span>
        @enderror
    </div>
  </div>
  
  {{-- submit button --}}
  <div class="row">
    <div class="col-md-12">
      <div class="input-group input-group-outline is-valid my-3">
        <button type="submit" class="btn btn-primary">ConfirmUpdateUser</button>
      </div>
    </div>
  </div>
</form>
    
    </div>
   </div>
  </div>
 </div>
</div>

<div class="row mt-4">
 <div class="col-12">

 </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<script src="{{ asset('admin_app/assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('admin_app/assets/js/plugins/quill.min.js') }}"></script>

@endsection
