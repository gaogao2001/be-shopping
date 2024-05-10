<!-- resources/views/child.blade.php -->
@extends('layout.admin')

@section('title' )
    <title>Trang chủ</title>
@endsection
@section('css' )
   <link rel="stylesheet" href="{{asset('admins/roles/add/add.css')}}">

@endsection


@section('js' )
<script src="{{asset('/admins/roles/add/add.js')}}"></script>
@endsection


@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Roles','key'=>'Add'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('role.store')}}" method="post" enctype="multipart/form-data" style="width: 100%">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Nhập tên vai trò"
                                       value="{{old('name')}}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Mô tả Vai trò</label>
                                <textarea name="display_name" class="form-control " rows="4">{{old('display_name')}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="checkall">
                                        Checkall
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input type="checkbox" value="" class="checkbox-wrapper">
                                            </label>
                                            Module {{$permissionsParentItem->name}}
                                        </div>
                                        <div class="row">
                                          @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentitem )
                                                <div class="card-body col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input type="checkbox" name="permission_id[]"
                                                                   class="checkbox-childrent"
                                                                   value="{{$permissionsChildrentitem->id}}">
                                                        </label>
                                                        {{$permissionsChildrentitem->name}}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

