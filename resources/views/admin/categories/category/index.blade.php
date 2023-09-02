@extends('admin.layouts.master')

@section('title', 'Category')

@section('admin_content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <div class="float-left">
                    <h3 class="card-title">Category List</h3>
                  </div>
                  <div class="float-right">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">Add New Category</a>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="ydatatable"  class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      
                      <th>SL No</th>
                      <th>Category Name</th>
                      <th>Category Slug</th>
                      {{-- <th>Home</th>
                      <th>Icon</th> --}}
                      <th>Action</th>
                    </tr>
                    </thead>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

@once
    @push('scripts')
        <script type="text/javascript">
        $(document).ready(function() {
              
            var table = $('#ydatatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.categories.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    { data: 'name', name: 'name'},
                    { data: 'slug', name: 'slug'},
                    // { data: 'home', name: 'home'},
                    // { data: 'icon', name: 'icon'},
                    { data: 'action', name: 'action', orderable:false, searchable:false},               
                ]
            });

        });
        </script>
    @endpush
@endonce

@endsection