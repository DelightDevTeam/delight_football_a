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

 .active-button {
  background-color: #4CAF50;
  /* or any color you prefer */
  color: white;
  /* optional: change text color if needed */
 }

 #search {
  margin-top: 40px;
 }

 #clear {
  margin-top: 40px;
 }
</style>
@endsection
@section('content')
<div class="row mt-4">
 <div class="col-12">
  <div class="card">
   <!-- Card header -->
   <div class="card-header pb-0">
    <div class="d-lg-flex">
     <div>
      <h5 class="mb-0">Win Lose Report</h5>

     </div>
     <div class="ms-auto my-auto mt-lg-0 mt-4">
      <div class="ms-auto my-auto">
       {{-- TODO: export --}}
       <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1 " data-type="csv" type="button" name="button">Export</button>
      </div>
     </div>
    </div>
   </div>
   <div class="container mx-3">
    <form action="" method="GET">
     <div class="row">
      <div class="col-md-3">
       <div class="input-group input-group-static my-3">
        <label>From</label>
        <input type="date" class="form-control" id="fromDate" name="from" value="{{ request()->query('from') }}">
       </div>
      </div>
      <div class="col-md-3">
       <div class="input-group input-group-static my-3">
        <label>To</label>
        <input type="date" class="form-control" id="toDate" name="to" value="{{ request()->query('to') }}">
       </div>
      </div>
      <div class="col-md-3">
       <button type="submit" class="btn btn-sm btn-warning" id="search">Search</button>
      </div>
    </form>
   </div>
  </div>
  <div class="table-responsive">
   <table class="table" id="users-search">
    <!-- <thead class="me-auto"> -->
    <tr>
     <th>ID</th>
     <th>User Id</th>
     <th>Date</th>
     <th>Turnover</th>
     <th>Payout</th>
     <th>Commission</th>
    </tr>
    <!-- </thead> -->
    <tbody class="text-sm">
     @foreach ($finicals as $index => $finical)
     <tr>
      <td>{{ $finical->id}}</td>
      <td>{{ $finical->user_id }}</td>
      <td>{{ $finical->date }}</td>
      <td>{{ $finical->turnover }}</td>
      <td>{{ $finical->payout }}</td>
      <td>{{ $finical->commission }}</td>
     </tr>
     @endforeach
    </tbody>
   </table>

  </div>
  <div class="mx-3">
   {{ $finicals->links() }}
  </div>
 </div>
</div>
@endsection


@section('scripts')
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