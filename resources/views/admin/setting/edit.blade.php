
<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title' )
    <title>Setting </title>
@endsection
@section('js' )
    <link rel="stylesheet" href="{{asset('')}}">
@endsection



@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'settings','key'=>'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6" >
                        <form action="{{route('settings.update' , ['id'=>$setting->id])}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label ">Config Key</label>
                                <input  type="text"
                                        name="config_key"
                                        class="form-control @error('config_key') is-invalid @enderror"
                                        placeholder="Nhập config key"
                                        value="{{$setting->config_key}}"
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
                                            value="{{$setting->config_value}}"
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
                                            value="{{$setting->config_value}}"
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

