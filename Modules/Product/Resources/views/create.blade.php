@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/morris/morris.css')}}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $title }}</h4>

                <div class="state-information d-none d-sm-block">
                        <ol class="breadcrumb m-t-15">
                                <li class="breadcrumb-item ">
                                    <a href="#">Product Management</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Product
                                </li>
                            </ol>
                    {{-- <div class="state-graph">
                        <div style="font-size: 20pt;margin-bottom: -5px;color:black" id="total"></div>
                        <div class="info">Total {{ $title }}</div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6 text-left">
                        <h4 class="header-title">{{ $title }}</h4>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">Product Media</h4>
                            <hr>
                        </div>
                        <div class='col-md-6 col-xl-12'>
                            <div class="form-group">
                                <label>Main Product's Photo</label>
                                <img id="fotoimage" src="{{ asset('images/default.png') }}" style="width:100%;margin-bottom:20px">
                                <button id="uploadfoto" type="button" class="btn btn btn-secondary" >Upload Image</button>
                                <button id="resetfoto" type="button" class="btn btn btn-danger" >Reset Image</button>
                                <br>
                                <input type="file" class="form-control" name="foto" id="foto" accept=".jpg, .png, .jpeg" style="display:none">
                                <span class="help-block">
                                    <strong>Max file size: 15MB</strong>
                                </span>
                                <span class="invalid-feedback" role="alert">
                                    <strong>File size is too large. Please change with another image.</strong>
                                </span>
                            </div>

                            <input type="hidden" name="resetfoto" id="valueresetfoto">
                        </div>
                        <div class="col-md-6 col-xl-12 m-t-10">
                            <h4 class="header-title">Product's Gallery</h4>
                            <hr>
                            <div class="form-group">
                                <label>Upload your images</label><br>
                                <button id="uploadfile" type="button" class="btn btn btn-secondary" >Upload Image</button>
                                <input type="file" class="form-control" id="files" name="album[]" accept=".jpg, .png, .jpeg" multiple style="display:none" />
                            </div>
                        </div>
                        <div id="imagecontainer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">Product's Detail</h4>
                            <hr>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input class="form-control" type="text" name="product_name" required>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea id="elm1" name="product_description" rows="10"></textarea>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control"  name="categories_id" required>
                                    @foreach($category as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Brand</label>
                                    <input class="form-control" type="text" name="brand" required>
                                </div>
                            </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">Product's Pricing</h4>
                            <hr>
                        </div>
                        {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type" class="control-label">Type :</label>
                                    <select class="form-control type" name="product_type" id="product_type" required>
                                            <option selected='selected' disabled>Select Type</option>
                                            <option value="regular">Regular</option>
                                            <option value="bidding">Bidding</option>
                                    </select>
                                </div>
                            </div> --}}
                    </div>
                    {{-- <div class="row" id="bidding" style="display:none">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="bid_type" class="control-label">Bidding Type :</label>
                                <select class="form-control bidding" name="bid_type" id="bid_type">
                                        <option selected='selected' disabled>Select Bidding Type</option>
                                        <option value="low">Low to High</option>
                                        <option value="high">High to Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                <label for="min" class="control-label">Min Price :</label>
                                <input type="text" name="min_price" id="min_price" class="form-control rupiah" >
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                <label for="max" class="control-label">Max Price :</label>
                                <input type="text" name="max_price" id="max_price" class="form-control rupiah" >
                            </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="form-group">
                                <label for="scale" class="control-label">Scale :</label>
                                <input type="text" name="scale" id="scale" class="form-control nomor" >
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="fixed" class="control-label">Fixed Price :</label>
                                <input type="text" name="fixed_price" id="fixed_price" class="form-control rupiah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fixed" class="control-label">Bid Start :</label>
                                <input type="text" name="fixed_price" id="fixed_price" class="form-control rupiah">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fixed" class="control-label">Bid End :</label>
                                <input type="text" name="fixed_price" id="fixed_price" class="form-control rupiah">
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="base" class="control-label">Base Price :</label>
                                <input type="text" name="base_price" id="base_price" class="form-control rupiah" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="final" class="control-label">Final Price :</label>
                                <input type="text" name="final_price" id="final_price" class="form-control rupiah" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">Product's Stock</h4>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock" class="control-label">SKU Code :</label>
                                <input type="text" name="sku_code" id="sku_code" class="form-control " required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock" class="control-label">Stock :</label>
                                <input type="number" name="stock" id="stock" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">Product's Shipping</h4>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock" class="control-label">Weight (gram) :</label>
                                <input type="number" name="weight" id="weight" class="form-control " required>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock" class="control-label">Free Shipping :</label>
                                <select type="text" name="freeshipping_status" id="freeshipping_status" class="form-control nomor" required>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="row" id="freeshipping_condition" style="display:none">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock" class="control-label">Free Shipping's Condition :</label>
                                <select type="text" name="free_condition" id="free_condition" class="form-control nomor" required>
                                    <option>No Condition</option>
                                    <option>By Total Quantity</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock" class="control-label">Value :</label>
                                    <input type="number" name="value_condition" id="value_condition" class="form-control nomor" required>
                                </div>
                            </div>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">SEO</h4>
                            <hr>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input class="form-control" name="seo_title">
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="seo_description" rows="10"></textarea>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input class="form-control" name="seo_keyword">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" id="submitbutton" class="btn btn-info">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
    <!-- end row -->

</div> <!-- end container-fluid -->
@endsection
@section('data-content')
    {{-- @include('management::form.management') --}}
@endsection

@section('script-bottom')
        {{-- <script type="text/javascript" src="{{ asset("js/management.js") }}"></script> --}}
        <script src="{{ URL::asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(".rupiah").bind('click keyup', function(event) {
                    format = $(this).val().replace(/[^,\d]/g, "").toString();
                    // $(".price-value").val(format);
                    $(this).val(formatRupiah(this.value, 'Rp. '));
                });
                $('#uploadfoto').on('click',function(){
                    $('#foto').click();
                });
                $('#uploadfile').on('click',function(){
                    $('#files').click();
                });
                $('#product_type').on('change',function(){
                    val = $(this).val();
                    if(val == 'bidding'){
                        $('#bidding').slideDown();
                    }else{
                        $('#bidding').slideUp();
                    }
                })

                $('#freeshipping_status').on('change',function(){
                    val = $(this).val();
                    if(val == '1'){
                        $('#freeshipping_condition').slideDown();
                    }else{
                        $('#freeshipping_condition').slideUp();
                    }
                })

                if (window.File && window.FileList && window.FileReader) {
                    $("#files").on("change", function(e) {
                    var files = e.target.files,
                        filesLength = files.length;
                    for (var i = 0; i < filesLength; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                        var file = e.target;
                        $("<div class=\"pip col-xl-6 col-md-6\">" +
                            "<img class=\"imageThumb\" style=\"width:100%;height:150px\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/>" +
                            "</div>").insertAfter("#imagecontainer");
                        $(".remove").click(function(){
                            $(this).parent(".pip").remove();
                        });

                        // Old code here
                        /*$("<img></img>", {
                            class: "imageThumb",
                            src: e.target.result,
                            title: file.name + " | Click to remove"
                        }).insertAfter("#files").click(function(){$(this).remove();});*/

                        });
                        fileReader.readAsDataURL(f);
                    }
                    });
                } else {
                    alert("Your browser doesn't support to File API")
                }

                if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "silver",
                        height:500,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ],
                        images_upload_handler: function (blobInfo, success, failure) {
                                var xhr, formData;
                                xhr = new XMLHttpRequest();
                                xhr.withCredentials = false;
                                xhr.open('POST', '/admin/blog/uploadfile');
                                var token = '{{ csrf_token() }}';
                                xhr.setRequestHeader("X-CSRF-Token", token);
                                xhr.onload = function() {
                                    var json;
                                    if (xhr.status != 200) {
                                        failure('HTTP Error: ' + xhr.status);
                                        return;
                                    }
                                    json = JSON.parse(xhr.responseText);

                                    if (!json || typeof json.location != 'string') {
                                        failure('Invalid JSON: ' + xhr.responseText);
                                        return;
                                    }
                                    success(json.location);
                                };
                                formData = new FormData();
                                formData.append('file', blobInfo.blob(), blobInfo.filename());
                                xhr.send(formData);
                            }
                        /* we override default upload handler to simulate successful upload*/
                        // images_upload_handler: function (blobInfo, success, failure) {
                        //     setTimeout(function () {
                        //     /* no matter what you upload, we will turn it into TinyMCE logo :)*/
                        //     success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
                        //     }, 2000);
                        // }
                    });
                }
                app.init();
                // appmanagement.handleManagementPage($('#filter').val());
                jQuery('#effective_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                jQuery('#effective_until').datepicker({
                    autoclose: true,
                    todayHighlight: true
                });
                $('.select2').select2();
                $('#resetfoto').on('click',function(){
                    $('#fotoimage').attr('src', '{{ asset('images/default.png') }}');
                    $('#valueresetfoto').val('1');
                    $('#foto').val('');
                });
            })
            $(function () {
                $("#foto").change(function () {
                    var size = this.files[0].size;
                    if(size > 15000000){
                        $(this).addClass('is-invalid');
                        $('#submitbutton').attr('disabled', true);
                    }else{
                        $(this).removeClass('is-invalid');
                        $('#submitbutton').attr('disabled', false);
                    }
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });
            });

            function imageIsLoaded(e) {
                $('#fotoimage').attr('src', e.target.result);
                $('#valueresetfoto').val('');
            };
        </script>
@endsection
