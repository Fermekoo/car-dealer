@extends('home.template')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection
@section('content')

  <div class="table-responsive">
  <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal">Create Car</button>
  <br>
  <br>
    @include('alert')
    <table id="authors" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th width="15%">Action</th>
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
        <form action="{{ route('car.create') }}" method="post" autocomplete="off" id="formCreate">
            @csrf
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="car_name" value="{{ old('carName') }}" name="carName" required>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Price</label>
                <input type="number" class="form-control" id="car_price" value="{{ old('carPrice') }}" name="carPrice" required>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Stock</label>
                <input type="number" class="form-control" id="car_stock" value="{{ old('carStock') }}" name="carStock" required>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" autocomplete="off" id="formEdit">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" id="e_car_name" value="{{ old('carName') }}" name="carName" required>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Price</label>
                <input type="number" class="form-control" id="e_car_price" value="{{ old('carPrice') }}" name="carPrice" required>
            </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Stock</label>
                <input type="number" class="form-control" id="e_car_stock" value="{{ old('carStock') }}" name="carStock" required>
            </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" autocomplete="off" id="formDelete">
            @csrf
            @method('DELETE')
          <p>Are you sure you want to delete this data?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Yes</button>
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
        ajax: '{{ route("car.data") }}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'stock', name: 'stock'},
            {data: 'action', name: 'action', render: function(data, type, row){
                return "<button data-bs-toggle='modal' data-bs-target='#editModal' data-id='"+row.id+"' data-name='"+row.name+"' data-price='"+row.price+"' data-stock='"+row.stock+"' id='editBtn' class='btn btn-outline-info btn-sm'>Detail</button> <button id='delBtn' data-id='"+row.id+"' data-bs-toggle='modal' data-bs-target='#deleteModal' class='btn btn-outline-danger btn-sm'>Delete</button>"
            },searchable: false, orderable:false }
        ]
    });

    $(document).on('click','#editBtn', function(){
        let id    = $(this).data('id'); 
        let name  = $(this).data('name');
        let price = $(this).data('price');
        let stock = $(this).data('stock');

        $('#formEdit #e_car_name').val(name)
        $('#formEdit #e_car_price').val(price)
        $('#formEdit #e_car_stock').val(stock)

        let action   = '{{ route("car.update",":id")}}';
            action   = action.replace(':id', id);
            $('#formEdit').prop('action', action);
    });

    $(document).on('click','#delBtn', function(){
        let id      = $(this).data('id');
        let action   = '{{ route("car.delete",":id")}}';
            action   = action.replace(':id', id);
            $('#formDelete').prop('action', action);
    })
} );
</script>
@endsection
