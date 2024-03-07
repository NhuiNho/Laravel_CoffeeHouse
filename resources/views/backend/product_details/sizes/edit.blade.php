@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">
                        Chỉnh sửa size sản phẩm
                    </h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product_detail.size.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.product_detail.size.update', $size->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên size: </label>
                            <input type="text" class="form-control" name="name" value="{{ $size->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá tiền: </label>
                            <input type="text" class="form-control" name="price" value="{{ $size->price }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
