<form class="dataForm" method="POST" id="dataForm" enctype="multipart/form-data" action="#">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="control-label">Name :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fotoimage" class="control-label">Image :</label>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="form-group">
                    <img class="rounded" alt="200x200" id="fotoimage" width="80%" src="{{ asset('images/default-user.png') }}" data-holder-rendered="true">
                </div>
                <button type="button" class="btn btn-secondary" id="resetfoto" style="margin-top:10px">Reset Image</button>
                <input type="hidden" name="resetfoto" id="valueresetfoto">
            </div>
            <div class="col-md-8 text-left">
                <div class="form-group">
                    <input type="file" class="form-control" name="foto" id="foto" accept=".jpg, .png, .jpeg">
                    <span class="help-block">
                        <strong>Max file size: 5MB</strong>
                    </span>
                    <span class="invalid-feedback" role="alert">
                        <strong>File size is too large. Please change with another image.</strong>
                    </span>
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
            <div class="col-md-12" id="bidding"></div>
            <div class="col-md-12">
                    <div class="form-group">
                        <label for="category" class="control-label">Category :</label>
                        <select class="form-control" name="category" id="category" required>
                                <option selected='selected' disabled>Select Category</option>
                            @foreach ($categories as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
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
    
