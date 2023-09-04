<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="category_form" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputCategory">Category</label>
                        <input type="text" name="category_name" class="form-control" id="inputCategory" placeholder="New Category">
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
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </div>
      </form>
    </div>
</div>

