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
                                    <a href="#">Website Content</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Blog
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
    <form action="{{ route('blog.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <input type="hidden" name="id" value="{{ $blog->id }}">
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
    
        <div class="col-xl-12">
            <div class="card m-b-20">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title">Content</h4>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <label>Thumbnail</label>
                                        <img id="fotoimage" src="{{ asset('images/'.$blog->thumbnail) }}" style="width:100%;margin-bottom:20px">
                                        <input type="file" class="form-control" name="foto" id="foto" accept=".jpg, .png, .jpeg">
                                        <span class="help-block">
                                            <strong>Max file size: 15MB</strong>
                                        </span>
                                        <span class="invalid-feedback" role="alert">
                                            <strong>File size is too large. Please change with another image.</strong>
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-12">
                            <button id="resetfoto" type="button" class="btn btn-block btn-secondary" >Reset Image</button>
                            <input type="hidden" name="resetfoto" id="valueresetfoto" value="">
                            </div>
                            <div class="col-md-12">
                                <hr>
                            <h4 class="header-title">SEO</h4>
                            </div>
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <label>Meta Title</label>
                                <input class="form-control" name="seo_title" value="{{ $seo['title'] }}">
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea class="form-control" name="seo_description" rows="10">{{ $seo['description'] }}</textarea>
                                </div>
                            </div>
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input class="form-control" name="seo_keyword" value="{{ $seo['keyword'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class='col-md-12'>
                                <div class="form-group">
                                    <label>Title</label>
                                <input class="form-control" type="text" name="title" value="{{ $blog->title }}" required>
                                </div>
                            </div>
                            <div class='col-md-6'>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control"  name="category" required>
                                        @foreach($category as $key)
                                        <option value="{{ $key->id }}" {{ $key->id == $blog->category_id ? 'selected' : '' }}>{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <textarea id="elm1" name="area" rows="20">{!! $blog->content !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                if($("#elm1").length > 0){
                    tinymce.init({
                        selector: "textarea#elm1",
                        theme: "silver",
                        height:1000,
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