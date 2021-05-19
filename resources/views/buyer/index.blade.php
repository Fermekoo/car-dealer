@extends('home.template')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection
@section('content')

  <div class="table-responsive">
  <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">Add Buyer</button>
  <br>
  <br>
    @include('alert')
    <table id="authors" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Car</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('buyer.create') }}" method="post" autocomplete="off" id="formCreate">
            @csrf
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Car</label>
                <select class="form-control" name="carId" required>
                    <option value="">-Select-</option>
                    @foreach($cars as $car) 
                    <option value="{{ $car->id }}">{{ $car->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email</label>
                <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Phone</label>
                <input type="number" class="form-control" id="phone" value="{{ old('phone') }}" name="phone" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
<script>
    $(document).ready(function() {
    $('#authors').DataTable({
        proccessing: true,
        serverSide: true,
        ajax: '{{ route("buyer.data") }}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'car', name: 'car'},
        ]
    });
} );
</script>
@endsection
