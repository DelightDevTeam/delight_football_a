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
    @php
        $type = request()->get("type", "credit");
        if ($type == 'credit') {
            $label = 'ငွေလွဲပေးမည်';
            $input_label = 'ငွေလွဲပေးမည့်ပမာဏ';
        } else {
            $label = 'ငွေထုတ်ယူမည်';
            $input_label = 'ငွေနုတ်ယူမည့်ပမာဏ';
        }
    @endphp
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">{{ $label }}</h5>
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
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{!! $user->id !!}</td>
                                </tr>
                                <tr>
                                    <th>User Name</th>
                                    <td>{!! $user->name !!}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{!! $user->phone !!}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>
                                        <span class="badge badge-pill badge-primary">{{ $user->type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Balance</th>
                                    <td><strong>{!! $user->balanceFloat !!}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('admin.transfer-points.store', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $type }}" name="type">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group input-group-outline is-valid my-3">
                                    <label class="form-label">{{ $input_label }}</label>
                                    @php
                                        $max = '';

                                        if ($type == 'debit') {
                                            $max = $user->balanceFloat;
                                        }
                                    @endphp
                                    <input type="number" class="form-control" name="amount" max="{{ $max }}">
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
                                    <button type="submit" class="btn btn-primary">{{ $label }}</button>
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
            @if (session('success'))
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
