@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">
                        Chỉnh sửa product
                    </h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên sản phẩm: </label>
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá sản phẩm: </label>
                            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Loại category: </label>
                            <select name="category_id" id="" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($category->id == $product->category_id) {{ 'selected' }} @endif>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Hình ảnh sản phẩm: </label>
                            <img src="{{ asset('storage\backend/assets/img/' . $product->image . '') }}" alt=""
                                class="card-img-top" style="width: 200px">
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="name">Nội dung sản phẩm: </label>
                            <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Giảm giá: </label>
                            <input type="text" class="form-control" name="sale_price" value="{{ $product->sale_price }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
