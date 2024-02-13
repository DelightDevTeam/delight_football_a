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
            <h5 class="mb-0">Transfer Log</h5>

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
          <th>#</th>
          <th>League</th>
          <th>Home Team</th>
          <th>Away Team</th>
          <th>Score</th>
          <th>FT Status</th>
          <th>Status</th>
          <th>Stop</th>
          <th>Edit</th>
        </tr>
        <!-- </thead> -->
        <tbody class="text-sm">
          @foreach ($fixtures as $index => $fixture)
          <tr>
            <td>{{ $fixture->id}}</td>
            <td>{{ $fixture->league->name }}</td>
            <td>{{ $fixture->homeTeam->name }}</td>
            <td>{{ $fixture->awayTeam->name }}</td>
            <td>{{$fixture->ft_home_goal}} - {{$fixture->ft_away_goal}}</td>
            <td>{{ $fixture->ft_status }}</td>
            @if($fixture->active === 1)
            <td><button class="btn btn-sm btn-primary">Active</button></td>
            @else
            <td><button class="btn btn-sm btn-success">InActive</button></td>
            @endif
            <td>{{ $fixture->stop_update}}</td>
            <td>
              <button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-pen text-info" style="font-size:17px;"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="mx-3">
      {{ $fixtures->links() }}
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

@endsection


@section('scripts')
<script>
  if (document.getElementById('users-search')) {
    // const dataTableSearch = new simpleDatatables.DataTable("#users-search", {
    //     searchable: true,
    //     fixedHeight: false,
    //     perPage: 7
    // });

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