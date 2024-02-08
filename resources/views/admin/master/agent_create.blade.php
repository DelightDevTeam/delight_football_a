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
              <h5 class="mb-0">Agent Create Dashboards</h5>

            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <div class="ms-auto my-auto">
                <a class="btn btn-icon btn-2 btn-primary" href="{{ route('home') }}">
                  <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
                </a>

              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.agent-store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" readonly value="{{ Auth::user()->name }}">
                </div>
                @error('name')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">User Real Name</label>
                  <input type="text" class="form-control" name="username">

                </div>
                @error('username')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" name="phone">

                </div>
                @error('phone')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" name="password">


                </div>
                @error('password')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">ConfirmPassword</label>
                  <input type="password" class="form-control" name="password_confirmation">

                </div>
                @error('password_confirmation')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- max for mix bet  --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    Maximum Bet Amount For Mix Bet 0 *
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">Max For Mix Bet</label>
                  <input type="text" class="form-control" name="max_for_mix_bet">
                </div>
                @error('max_for_mix_bet')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    Maximum Bet Amount For Sigle Bet 0 *
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">Max For Sigle Bet</label>
                  <input type="text" class="form-control" name="max_for_single_bet" placeholder="0">

                </div>
                @error('max_for_single_bet')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- max for mix bet end --}}
            {{-- commission --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    Commission 0 *
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">Commission</label>
                  <input type="text" class="form-control" name="commission">
                </div>
                @error('commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    High Commission 0 *
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">High Commission</label>
                  <input type="text" class="form-control" name="high_commission">

                </div>
                @error('high_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- commission end --}}
            {{-- two d commitssion --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    2 D - Commission 0 * <span style="color: red">
                      <strong>Tax : 5% - High Tax : 8%</strong>
                    </span>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">Two D Commission</label>
                  <input type="text" class="form-control" name="two_d_commission">
                </div>
                @error('two_d_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    3 D - Commission 0 * <span style="color: red">
                      <strong>Tax : 5% - High Tax : 8%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">Three D Commission</label>
                  <input type="text" class="form-control" name="three_d_commission">
                </div>
                @error('three_d_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- two d 3 d commission end --}}
            {{-- 4 d 5 d commission --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    2 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 15% - High Tax : 15%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">2 Match Count Commission</label>
                  <input type="text" class="form-control" name="parlay_2_commission">
                </div>
                @error('parlay_2_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    3 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">3 Match Count Commission
                  </label>
                  <input type="text" class="form-control" name="parlay_3_commission">
                </div>
                @error('parlay_3_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- end --}}
            {{-- 4 d 5 d commission --}}

            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    4 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">4 Match Count Commission</label>
                  <input type="text" class="form-control" name="parlay_4_commission">
                </div>
                @error('parlay_4_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    5 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong> </span>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">5 Match Count Commission
                  </label>
                  <input type="text" class="form-control" name="parlay_5_commission">
                </div>
                @error('parlay_5_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- end --}}
            {{-- six 7 --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    6 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong> </span>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">6 Match Count Commission
                  </label>
                  <input type="text" class="form-control" name="parlay_6_commission">
                </div>
                @error('parlay_6_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    7 Match Count - Commission 0 *
                    <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <input type="text" class="form-control" name="parlay_7_commission">
                </div>
                @error('parlay_7_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>
            {{-- six 7 end --}}
            {{-- 8 9 --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    8 Match Count - Commission 0 *
                    <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">8 Match Count Commission</label>
                  <input type="text" class="form-control" name="parlay_8_commission">
                </div>
                @error('parlay_8_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    9 Match Count - Commission 0 *
                    <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">9 Match Count Commission</label>
                  <input type="text" class="form-control" name="parlay_9_commission">
                </div>
                @error('parlay_9_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>

            {{-- 8 9 end --}}
            {{-- 10 11 --}}
            <div class="row">
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    10 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong> </span>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">10 Match Count Commission</label>
                  <input type="text" class="form-control" name="parlay_10_commission">
                </div>
                @error('parlay_10_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <div class="mb-1 text-start">
                  <label class="form-label" style="color: #d33a9e">
                    11 Match Count - Commission 0 * <span style="color: red">
                      <strong>Tax : 20% - High Tax : 20%</strong> </span>
                  </label>
                </div>
                <div class="input-group input-group-outline is-valid my-3">
                  <label class="form-label">11 Match Count Commission</label>
                  <input type="text" class="form-control" name="parlay_11_commission">
                </div>
                @error('parlay_11_commission')
                <span class="d-block text-danger">*{{ $message }}</span>
                @enderror
              </div>
            </div>

            {{-- submit button --}}
            <div class="row">
              <div class="col-md-12">
                <div class="input-group input-group-outline is-valid my-3">
                  <button type="submit" class="btn btn-primary">ConfirmCreateMaster</button>
                </div>
              </div>
            </div>
          </form>
          {{-- <form action="{{ route('admin.agent-store') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-outline my-3">
                <label class="form-label">User Real Name</label>
                <input type="text" class="form-control" name="name">

              </div>
              @error('name')
              <span class="d-block text-danger">*{{ $message }}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-outline my-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone">

              </div>
              @error('phone')
              <span class="d-block text-danger">*{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="input-group input-group-outline is-valid my-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">


              </div>
              @error('password')
              <span class="d-block text-danger">*{{ $message }}</span>
              @enderror
            </div>
            <div class="col-md-6">
              <div class="input-group input-group-outline is-valid my-3">
                <label class="form-label">ConfirmPassword</label>
                <input type="password" class="form-control" name="password_confirmation">

              </div>
              @error('password_confirmation')
              <span class="d-block text-danger">*{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="input-group input-group-outline is-valid my-3">
                <button type="submit" class="btn btn-primary">ConfirmCreateAgent</button>
              </div>
            </div>
          </div>
          </form> --}}
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