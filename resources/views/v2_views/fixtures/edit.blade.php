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
 <div class="col-6 mx-auto">
  <div class="card py-3 px-3">
   <h5>Edit Goal & Status</h5>
   <form class="mx-4 my-4" action="{{ url('admin/fixtures/'. $fixture->id)}}" method="POST">
    @csrf

    <div class="input-group input-group-static">
     <label>Id</label>
     <input type="text" name="id" value="{{ $fixture->id}}" class="form-control">
    </div>
    <div class="input-group input-group-static">
     <label>Home Goal</label>
     <input type="text" name="home_goal" value="{{$fixture->ft_home_goal}}" class="form-control">
    </div>
    <div class="input-group input-group-static">
     <label>Away Goal</label>
     <input type="text" name="away_goal" value="{{$fixture->ft_away_goal}}" class="form-control">
    </div>
    <div class="form-check form-switch mt-3">
     <input class="form-check-input" name="active" type="checkbox" id="flexSwitchCheckDefault" {{ $fixture->active ? 'checked' : '' }}>
     <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
    </div>

    <div class="mt-3">
     <a href="{{ route('admin.fixtures.index')}}" class="btn bg-light">
      Cancle
     </a>
     <button type="submit" class="btn bg-gradient-primary">Save changes</button>
    </div>


   </form>
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