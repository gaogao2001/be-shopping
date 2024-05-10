
<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title' )
    <title>Trang chủ</title>
@endsection


@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'menus','key'=>'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6" >
                        <form action="{{route('menus.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label ">Tên menus</label>
                                <input  type="text"
                                        name="name"
                                        class="form-control"
                                        placeholder="Nhập tên menus"
                                >
                            </div>
                            <div class="form-group">
                                <label >Chọn menus cha</label>
                                <select class="form-control" name="parent_id" >
                                    <option value="0">Chọn danh mục cha  </option>
                                    {!! $optionSelect !!}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

