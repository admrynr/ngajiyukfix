<form class="dataForm" method="POST" id="dataForm" enctype="multipart/form-data" action="#">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="control-label">Video Title :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="category" class="control-label">Category :</label>
                    <input type="text" name="category" id="category" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="url" class="control-label">Video URL :</label>
                    <input type="text" name="url" id="url" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="control-label">Content :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="type" class="control-label">Type :</label>
                    <select class="form-control type" name="type" id="type" required>
                            <option selected='selected' disabled>Select Type</option>
                            <option value="regular">Regular</option>
                            <option value="bidding">Bidding</option>
                    </select> 
                </div>
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="base" class="control-label">Base Price :</label>
                        <input type="text" name="base" id="base" class="form-control rupiah" required>
                    </div>
            </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="final" class="control-label">Final Price :</label>
                        <input type="text" name="final" id="final" class="form-control rupiah" required>
                    </div>
                </div>
            <div class="col-md-4">
                    <div class="form-group">
                        <label for="stock" class="control-label">Stock :</label>
                        <input type="text" name="stock" id="stock" class="form-control nomor" required>
                    </div>
                </div>
        </div>
        
            <input type="hidden" id="method">
            <input type="hidden" id="id">
            <input type="hidden" id="isbid">

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-success waves-effect waves-light">Simpan</button>
    </div>
</form>
    
