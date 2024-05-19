<!-- resources/views/child.blade.php -->
@extends('layout.admin')

@section('title' )
    <title>Trang chủ</title>
@endsection

@section('css' )
    <link rel="stylesheet" href="{{asset('admins/product/index/list.css')}}">

@endsection
@section('js' )
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@11.js')}}"></script>
    <script type="text/javascript" src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header',['name'=>'category','key'=>'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-lg-right m-2"> Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{route('categories.edit', ['id' =>$category->id])}}"
                                           class="btn btn-default">Edit</a>
                                        <a href=""
                                           data-url="{{route('categories.delete', ['id'=>$category->id])}}"
                                           class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

