<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title' )
    <title>Add product</title>
@endsection
@section('css' )
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>

    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>

@endsection



@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'product','key'=>'Edit'])
        <form action="{{route('product.update',['id' => $product->id ])}}" method="post" enctype="multipart/form-data">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">

                            @csrf
                            <div class="form-group">
                                <label ">Tên sản phẩm</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Nhập tên sản phẩm"
                                       value="{{$product->name}}"
                                >
                            </div>
                            <div class="form-group">
                                <label ">Gía sản phẩm</label>
                                <input type="text"
                                       name="price"
                                       class="form-control"
                                       placeholder="Nhập giá sản phẩm"
                                       value="{{$product->price}}"
                                >
                            </div>
                            <div class="form-group">
                                <label ">Ảnh đại diện</label>
                                <input type="file"
                                       name="feature_image_path"
                                       class="form-control-file"
                                >
                                <div CLASS="col-md-4 feature_image_container">
                                    <div class="row">
                                        <img class="feature_image" src="{{$product->feature_image_path}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label ">Ảnh chi tiết</label>
                                <input type="file"
                                       multiple
                                       name="image_path[]"
                                       class="form-control"
                                >
                                <div CLASS="col-md-12 container_image-detail">
                                    <div class="row">
                                        @foreach($product->productImages as $productImageItem)
                                        <div class="col-md-3">
                                            <img class="image_detail_product" src="{{$productImageItem->image_path}}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục </option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nhập tag cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                         <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>






                    </div>
                    <div class="col-md-12" >
                        <div class="form-group">
                            <label>Nhập nội dung</label>

                            <textarea name="contents" class="form-control tinymce_editor_init" rows="3" > {{$product->content}} </textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('js' )
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/nhq4f5mw6tk4p8n8uqixddn48mbkv98kyfgqftd44mb46qqp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('add.blade.php')}}"></script>

@endsection


