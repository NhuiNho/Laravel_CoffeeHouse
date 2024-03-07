@extends('backend.layouts.app')
@section('title', 'Thêm mới')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Thêm mới category</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.category.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <strong>Loại menu:</strong>
                            <select name="menu_id" id="" class="form-select">
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" selected>{{ $menu->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <strong>Hình ảnh:</strong>
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
