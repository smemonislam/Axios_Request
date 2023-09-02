@extends('admin.layouts.master')

@section('title', 'Update Category')

@section('admin_content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Update Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="category_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                          
                        <input type="hidden" value="{{ $category->id }}" id="categoryId">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputCategory">Category</label>
                                <input type="text" name="category_name" class="form-control" id="inputCategory" value="{{ $category->name }}">
                                <span class="text-danger" id="error-category_name"></span>
                            </div>
                            <div class="form-group">
                                <label for="inputFile">File input</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="inputFile" accept="image/*">
                                    <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{ $category->icon }}">
                                    <label class="custom-file-label" for="inputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <div>
                                <img src="{{ asset('files/category/'.$category->icon) }}" alt="">
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

                        let id = $('#categoryId').val()
                        let category_name = $('#inputCategory').val()
                        let old_image = $('#old_image').val()
                        let new_iamge = $('#inputFile')[0].files[0]
                        let image = btoa(new_iamge);
                        
                        // console.log(id, category_name, old_image,new_iamge)

                        // Ajax request
                        $.ajax({ 
                            url: "{{ route('admin.categories.update', '') }}" + '/' + id,
                            method: "PUT",
                            data: {
                                id: id,
                                category_name: category_name,
                                old_image: old_image,
                                image: image,
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(response){    
                                console.log(response);
                            },
                            error: function(error){
                                console.log(error);
                            }

                         })

                        // Axios Request
                        // axios.put("{{ route('admin.categories.update', '') }}" + '/' + id, {
                        //     id: id,
                        //     category_name: $('#inputCategory').val(),
                        //     image: $('#inputFile')[0].files[0],
                        //     old_image: $('#old_image').val(),
                        // }, {
                        //     headers: {
                        //         'Content-Type': 'multipart/form-data',
                        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //     }
                        // })
                    
                        // .then(function (response) {
                        //     console.log(response);
                        //     // if(response.status === 200 && response.statusText === 'OK' ){
                        //     //     toastr.success(response.data.message);
                        //     //     $('#inputCategory').val('');
                        //     //     $('#error-message').text('');
                        //     // }                        
                        // })
                        // .catch(function (error) {
                        //     console.log(error);
                        //     // if(error.response.data.errors){
                        //     //     $('#error-message').text(error.response.data.errors.category_name[0]);
                        //     // }
                        //     // if(error.response.data.errors){
                        //     //     $.each(error.response.data.errors, function(key, value){
                        //     //         $('#error-' + key).html(value);
                        //     //     }); 
                        //     // }
                        // });
                    })
                }
                create()
            })
        </script>
    @endpush
@endonce

@endsection