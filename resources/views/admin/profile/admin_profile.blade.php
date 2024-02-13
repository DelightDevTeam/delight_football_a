@extends('admin_layouts.app')
@section('styles')
<style>
    .image-container {
        position: absolute;
        top: 0;
        left: 0;
    }

    .image {
        max-width: 20%;
        height: auto;
        opacity: 0.8;
        /* Adjust the opacity as needed */
    }
</style>
@endsection
@section('content')
<div class="container-fluid my-3 py-3">
    <div class="row mb-5">
        <div class="col-lg-9 mx-auto mt-lg-0 mt-4">
            <!-- Card Profile -->
            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">

                    <div class="col-sm-auto col-8 my-auto">
                        <div class="h-100">
                            <h5 class="mb-1 font-weight-bolder">
                                Total Balance
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ Auth::user()->balance }} MMK
                            </p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Card Basic Info -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mt-4" id="basic-info">
                        <div class="card-header">
                            <h5>Basic Info</h5>
                        </div>
                        <form action="{{ route('admin.changePhoneAddress', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="input-group input-group-static">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>Phone Number</label>
                                        <input type="number" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>New password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>Confirm New password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class=" mt-1 mb-3 me-4">
                                <button type="submit" class="btn bg-gradient-dark btn-sm float-end">Update Account
                                    Info
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mt-4 pb-5" id="password">
                        <div class="card-header">
                            <h5>Add Payment No</h5>
                        </div>
                        <form action="{{ route('admin.changeKpayNo', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="input-group input-group-static">
                                        <label>Kpay No</label>
                                        <input type="text" name="kpay_no" class="form-control" value="{{ Auth::user()->kpay_no }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>CB Pay No</label>
                                        <input name="cbpay_no" type="text" class="form-control" value="{{ Auth::user()->cbpay_no }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>Wave Pay No</label>
                                        <input type="text" name="wavepay_no" class="form-control" value="{{ Auth::user()->wavepay_no }}">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="input-group input-group-static">
                                        <label>AYA Pay No</label>
                                        <input type="number" name="ayapay_no" class="form-control" value="{{ Auth::user()->ayapay_no }}">
                                    </div>
                                </div>
                                <div class=" mt-3 mb-3 me-4">
                                    <button type="submit" class="btn bg-gradient-dark btn-sm float-end">Add Payment No
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection