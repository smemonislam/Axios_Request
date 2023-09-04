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
              <button  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#createCategoryModal">+ Add New Category</button>
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
                {{-- <th>Home</th> --}}
                <th>Logo</th>
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


@include('admin.categories.category.create')
@include('admin.categories.category.edit')

@include('admin.categories.category.category_js')

@endsection