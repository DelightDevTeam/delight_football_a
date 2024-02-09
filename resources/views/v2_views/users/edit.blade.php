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
                            <h5 class="mb-0">Master Edit</h5>

                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a class="btn btn-icon btn-2 btn-primary" href="{{ route('admin.users.index') }}">
                                    <span class="btn-inner--icon mt-1"><i class="material-icons">arrow_back</i>Back</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body col-md-12 mx-auto">
                    <form action="{{ route('admin.users.update', ["user" => $user->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" value="{{old("username", $user->username)}}">
                                </div>
                                @error('username')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{old("phone", $user->phone)}}">

                                </div>
                                @error('phone')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                @error('password')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">ConfirmPassword</label>
                                    <input type="password" class="form-control" name="password_confirmation">

                                </div>
                                @error('password_confirmation')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- max for mix bet  --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Max For Mix Bet</label>
                                    <input type="text" class="form-control" name="max_for_mix_bet" value="{{old("max_for_mix_bet", $user->max_for_mix_bet)}}">
                                </div>
                                @error('max_for_mix_bet')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Max For Sigle Bet</label>
                                    <input type="text" class="form-control" name="max_for_single_bet" value="{{old("max_for_single_bet", $user->max_for_single_bet)}}">

                                </div>
                                @error('max_for_single_bet')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- max for mix bet end --}}
                        {{-- commission --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Commission</label>
                                    <input type="text" class="form-control" name="commission" value="{{old("commission", $user->commission)}}">
                                </div>
                                @error('commission')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">High Commission</label>
                                    <input type="text" class="form-control" name="high_commission" value="{{old("high_commission", $user->high_commission)}}">

                                </div>
                                @error('high_commission')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- commission end --}}
                        {{-- two d commitssion --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Two D Commission</label>
                                    <input type="text" class="form-control" name="two_d_commission" value="{{old("two_d_commission", $user->two_d_commission)}}">
                                </div>
                                @error('two_d_commission')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Three D Commission</label>
                                    <input type="text" class="form-control" name="three_d_commission" value="{{old("three_d_commission", $user->three_d_commission)}}">
                                </div>
                                @error('three_d_commission')
                                <span class="d-block text-start text-danger">*{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            @php
                            $message = '';
                            if ($errors->has('single_commission')) {
                            $message = $errors->first('single_commission');
                            }

                            $single_commission = old("single_commission", $user->single_commission);
                            @endphp
                            <x-user_commission_selectbox label="Single Commission" name="single_commission" :message="$message" :max="$max_commissions['single_commission']" :value="$single_commission" />
                        </div>
                        {{-- two d 3 d commission end --}}
                        {{-- fb commission --}}
                        @for ($i = 3; $i < 12; $i +=2) <div class="row">
                            @php
                            $label_1 = $i - 1 . ' Match Count Commission';
                            $name_1 = 'parlay_' . ($i - 1) . '_commission';
                            $message_1 = '';
                            if ($errors->has($name_1)) {
                            $message_1 = $errors->first($name_1);
                            }

                            $label_2 = $i . ' Match Count Commission';
                            $name_2 = 'parlay_' . $i . '_commission';
                            $message_2 = '';
                            if ($errors->has($name_1)) {
                            $message_2 = $errors->first($name_1);
                            }
                            @endphp
                            <x-user_commission_selectbox :label="$label_1" :name="$name_1" :message="$message_1" :max="$max_commissions[$name_1]" value="{{old($name_1, $user->{$name_1})}}" />
                            <x-user_commission_selectbox :label="$label_2" :name="$name_2" :message="$message_2" :max="$max_commissions[$name_2]" value="{{old($name_2, $user->{$name_2})}}" />
                </div>
                @endfor
                {{-- submit button --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3">
                            <button type="submit" class="btn btn-primary">Update</button>
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