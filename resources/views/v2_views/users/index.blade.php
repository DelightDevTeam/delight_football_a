@extends('v2_views.layouts.app')
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
</style>
@endsection
@section('content')
@php
use App\Enums\UserStatus;
@endphp
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">User List</h5>

                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href="{{ route('admin.users.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                Create User</a>
                            <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-flush" id="users-search">
                        <thead class="thead-light">
                            <th>#</th>
                            <th>UserName</th>
                            <th>Phone</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Action</th>
                            <th>Transfer</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <span class="d-block">{{ $user->name }}</span>
                                    </td>
                                    <td>{{ $user->phone }}</td>
                                    <td><strong>{{ $user->balanceFloat }}</strong></td>
                                    <td>
                                        <small
                                            class="badge badge-{{ $user->status == UserStatus::Active ? 'success' : 'danger' }}">{{ $user->status == UserStatus::Active ? 'active' : 'ban' }}</small>
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        @if ($user->status == UserStatus::Active)
                                        <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();" href="#" data-bs-toggle="tooltip" data-bs-original-title="Ban User">
                                            <i class="fas fa-user-slash text-danger" style="font-size: 17px;"></i>
                                        </a>
                                        @else
                                        <a onclick="event.preventDefault(); document.getElementById('banUser-{{ $user->id }}').submit();" href="#" data-bs-toggle="tooltip" data-bs-original-title="Active User">
                                            <i class="fas fa-user-check text-success" style="font-size: 17px;"></i>
                                        </a>
                                        @endif
                                        <form class="d-none" id="banUser-{{ $user->id }}" action="{{ route('admin.users.ban', $user->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Edit Agent">
                                            <i class="fas fa-pen text-info" style="font-size:17px;"></i>
                                        </a>
                                        <a href="{{ route('admin.agent-show', $user->id) }}" data-bs-toggle="tooltip" data-bs-original-title="Preview Agent Detail">
                                            <i class="fas fa-eye text-warning" style="font-size:17px;"></i>
                                        </a>
                                        <form class="d-inline" action="{{ route('admin.agent-delete', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="transparent-btn" data-bs-toggle="tooltip" data-bs-original-title="Delete Agent">
                                                <i class="fas fa-trash text-danger" style="font-size:17px;"></i>
                                            </button>
        
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.transfer-points.create', ["user" => $user->id, "type" => "credit"] ) }}" data-bs-toggle="tooltip"
                                            data-bs-original-title="Transfer To Agent" class="btn btn-info btn-sm"><i
                                                class="fas fa-right-left text-white me-1"></i>ငွေလွဲမည်</a>
                                        <a href="{{ route('admin.transfer-points.create', ["user" => $user->id, "type" => "debit"]) }}" data-bs-toggle="tooltip"
                                            data-bs-original-title="Cash Out From Agent" class="btn btn-warning btn-sm">
                                            <i class="fas fa-right-left text-white me-1"></i>ငွေထုတ်မည်
                                        </a>
                                    </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- <script src="{{ asset('admin_app/assets/js/plugins/datatables.js') }}"></script> -->
{{-- <script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: true
    });
  </script> --}}
<script>
    if (document.getElementById('users-search')) {


        document.querySelectorAll(".export").forEach(function(el) {
            el.addEventListener("click", function(e) {
                var type = el.dataset.type;

                var data = {
                    type: type,
                    filename: "material-" + type,
                };

                if (type === "csv") {
                    data.columnDelimiter = "|";
                }

                dataTableSearch.export(data);
            });
        });
    };
</script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
@endsection