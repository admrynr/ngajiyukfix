            <div class="bid-child">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="bid_type" class="control-label">Bidding Type :</label>
                        <select class="form-control bidding" name="bid_type" id="bid_type">
                                <option selected='selected' disabled>Select Bidding Type</option>
                                <option value="low">Low to High</option>
                                <option value="high">High to Low</option>
                        </select> 
                    </div>
                        <div class="form-row">
                <div class="col-4 col-md-4" text-left>
                        <div class="form-group">
                            <label for="min" class="control-label">Min Price :</label>
                            <input type="text" name="min" id="min" class="form-control rupiah" required>
                        </div>
                </div>
                <div class="col-4 col-md-4" text-center>
                        <div class="form-group">
                            <label for="max" class="control-label">Max Price :</label>
                            <input type="text" name="max" id="max" class="form-control rupiah" required>
                        </div>
                    </div>
                <div class="col-4 col-md-4" text-right>
                        <div class="form-group">
                            <label for="scale" class="control-label">Scale :</label>
                            <input type="text" name="scale" id="scale" class="form-control nomor" required>
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-md-12">
                        <div class="form-group">
                            <label for="fixed" class="control-label">Fixed Price :</label>
                            <input type="text" name="fixed" id="fixed" class="form-control rupiah">
                        </div>
                </div>    
            </div>
                    
    