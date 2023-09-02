@extends('admin.layouts.master')

@section('title', 'Add Category')

@section('admin_content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="category_form" enctype="multipart/form-data" >
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputCategory">Category</label>
                                <input type="text" name="category_name" class="form-control" id="inputCategory" placeholder="New Category">
                                <span class="text-danger" id="error-category_name"></span>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">File input</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="inputFile" accept="image/*">
                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <span class="text-danger" id="error-image"></span>
                            </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" >Submit</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@once
    @push('scripts')
        <script>
            $(function(){
                 function create(){
                    $('#category_form').on('submit',  function(e){
                        e.preventDefault();

                        axios.post('{{ route('admin.categories.store') }}', {
                            category_name: $('#inputCategory').val(),
                            image: $('#inputFile')[0].files[0]
                        }, {
                            headers: {
                            'Content-Type': 'multipart/form-data'
                            }
                        })
                    
                        .then(function (response) {
                            console.log(response);
                            if(response.status === 200 && response.statusText === 'OK' ){
                                toastr.success(response.data.message);
                                $('#inputCategory').val('');
                                $('#error-message').text('');
                            }                        
                        })
                        .catch(function (error) {
                            if(error.response.data.errors){
                                $.each(error.response.data.errors, function(key, value){
                                    $('#error-' + key).html(value);
                                }); 
                            }
                        });
                    })
                }
                create()
            })
        </script>
    @endpush
@endonce
@endsection