
<div class="modal" id="editCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="updateCategoryForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="inputCategoryId" value="">
                    <div class="form-group">
                        <label for="inputCategory">Category</label>
                        <input type="text" name="category_name" class="form-control" id="inputCategoryValue" value=""/>
                        <span class="text-danger" id="error-category_name"></span>
                    </div>
                    <div class="form-group">
                        <label for="inputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="inputFile" accept="image/*">
                                <input type="hidden" class="form-control" id="oldImageValue" name="old_image" value="">
                                <label class="custom-file-label" for="inputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div id="categoryImageShow">
                        
                    </div>
                    <span class="text-danger" id="error-image"></span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
  </div>


