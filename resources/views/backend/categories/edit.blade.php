@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">
                        Chỉnh sửa category
                    </h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.category.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên category: </label>
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Loại menu: </label>
                            <select name="menu_id" id="" class="form-select">
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}"
                                        @if ($menu->id == $category->menu_id) {{ 'selected' }} @endif>{{ $menu->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Hình ảnh category: </label>
                            <img src="{{ asset('storage\backend/assets/img/' . $category->image . '') }}" alt=""
                                class="card-img-top" style="width: 200px">
                            <input type="file" class="form-control" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
