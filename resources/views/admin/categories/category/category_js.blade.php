@once
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {               
               

                // Retrieved All Category data
                var table = $('#ydatatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.categories.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        { data: 'category_name', name: 'category_name'},
                        { data: 'slug', name: 'slug'},
                        // { data: 'home', name: 'home'},
                        { data: 'image', name: 'image', orderable:false, searchable:true },
                        { data: 'action', name: 'action', orderable:false, searchable:false},               
                    ]
                });

                // Create a new category
                function create(){
                    $('#category_form').on('submit',  function(e){
                        const formData = new FormData(this);
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
                            table.draw();
                            $('#createCategoryModal').hide();
                            $('.modal-backdrop').remove();
                            if(response.status === 200 && response.statusText === 'OK' ){
                                toastr.success(response.data.message);                                
                                $('#category_form').trigger('reset')
                            }                        
                        })
                        .catch(function (error) {
                            const errorMessageLength = Object.keys(error.response.data.errors).length
                            if(errorMessageLength > 0) {
                                $.each(error.response.data.errors, function(key, value){                                  
                                    toastr.error(value);                                    
                                });
                            }
                        });
                    })
                }
                create()


                // Edit a category
                function edit(){
                    $('body').on('click', '.edit', function(){
                        const id = $(this).data('id');
                        axios.get("categories/"+id+"/edit", {
                           id:id,
                           _token: '{{ csrf_token() }}'
                        })
                        
                        .then(function(response){
                            $('#inputCategoryId').val(response.data.id);
                            $('#inputCategoryValue').val(response.data.category_name);
                            $('#oldImageValue').val(response.data.image);   
                            const imageLink = "{{ asset('files/category') }}" + '/' + response.data.image;
                            $("#categoryImageShow").html(`<img src="${imageLink}" alt="Image Not Found!" />`);
                        })
                    });
                }
                edit()

                // Update a category
                function update(){
                    $('#updateCategoryForm').on('submit', function(e){
                        const formData = new FormData(this);
                        e.preventDefault();
                        const id = $('#inputCategoryId').val();

                        axios.post("{{ route('admin.categories.update', '') }}" + '/' + id, formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            }
                        })                    
                        .then(function(response) {
                            table.draw();
                            $('#editCategoryModal').hide();
                            $('.modal-backdrop').remove();
                            if(response.status === 200 && response.statusText === 'OK' ){
                                toastr.success(response.data.message);     
                            }                                                     
                        })
                        .catch(function (error) {                            
                            const errorMessageLength = Object.keys(error.response.data.errors).length
                            if(errorMessageLength > 0) {
                                $.each(error.response.data.errors, function(key, value){                                  
                                    toastr.error(value);                                    
                                });
                            }
                        });
                    })
                }
                update()

                // Delete a Category
                function deleteCategory(){
                    $('body').on('click', '#delete', function(){                       
                        const id = $(this).data('id');

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {  
                                axios.delete("{{ route('admin.categories.destroy', '') }}" + '/' + id, {
                                    id:id,
                                    _token: "{{ csrf_token() }}"
                                })
                                .then(function(response){
                                    table.draw();
                                    Swal.fire(
                                        'Deleted!',
                                        'Category has been deleted.',
                                        'success'
                                    )
                                })
                            }
                        })
                    })
                }
                deleteCategory()
            });
        </script>
    @endpush
@endonce