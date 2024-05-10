
<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title' )
    <title>Setting </title>
@endsection
@section('css' )
    <link rel="stylesheet" href="{{asset('admins/setting/add/add.css')}}">
@endsection



@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'settings','key'=>'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6" >
                        <form action="{{route('settings.store') . '?type=' . request()->type}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label> Config Key </label>
                                <input  type="text"
                                        name="config_key"
                                        class="form-control @error('config_key') is-invalid @enderror"
                                        placeholder="Nhập config key"
                                >
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(request()->type === 'Text')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <input  type="text"
                                            name="config_value "
                                            class="form-control @error('config_value') is-invalid @enderror"
                                            placeholder="Nhập config value"
                                    >
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type === 'Textarea')
                                <div class="form-group">
                                    <label>Config Value</label>
                                    <textarea
                                            name="config_value"
                                            class="form-control @error('config_value') is-invalid @enderror"
                                            placeholder="Nhập config value"
                                            rows="5"
                                    >
                                    </textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger"> {{ $message }}
                                    </div> @enderror
                                </div>

                            @endif


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

