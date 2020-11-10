<form class="dataForm" method="POST" id="dataForm" action="#">
    {{ csrf_field() }}
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="nama_client" class="control-label">Product :</label>
                    <select class="form-control select2" name="product_id" id="product_id">
                        @if($product->count() == 0)
                        <option disabled>No Product Available</option>
                        @else 
                            @foreach($product as $keys)
                                <option value="{{ $keys->id }}">{{ $keys->product_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="bid_type" class="control-label">Auction Type :</label>
                    <select class="form-control bidding" name="auction_type" id="auction_type">
                            <option selected='selected' disabled>Select Bidding Type</option>
                            <option value="low">Low to High</option>
                            <option value="high">High to Low</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="min" class="control-label">Min Price :</label>
                    <input type="text" name="min_price" id="min_price" class="form-control rupiah" required>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="max" class="control-label">Max Price :</label>
                    <input type="text" name="max_price" id="max_price" class="form-control rupiah" required>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="scale" class="control-label">Scale :</label>
                    <input type="text" name="scale" id="scale" class="form-control nomor" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="fixed" class="control-label">Fixed Price : <span class="text-info">( Fill if you want to show fixed price on your auction )</span></label>
                    <input type="text" name="fixed_price" id="fixed_price" class="form-control rupiah">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fixed" class="control-label">Auction Start :</label>
                    <input type="text" name="bid_start" id="bid_start" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fixed" class="control-label">Auction End :</label>
                    <input type="text" name="bid_end" id="bid_end" class="form-control">
                </div>
            </div>
        </div>
            <input type="hidden" id="method">
            <input type="hidden" id="id">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        <button type="submit"  class="btn btn-success waves-effect waves-light">Simpan</button>
    </div>
</form>
    
