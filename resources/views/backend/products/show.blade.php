@extends('backend.layouts.app')
@section('title', 'Hiển thị')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Show Product</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Tên:</strong>
                        {{ $product->name }}
                    </div>
                    <div class="form-group">
                        <strong>Giá:</strong>
                        {{ $product->price }}
                    </div>
                    <div class="form-group">
                        <strong>Loại category:</strong>
                        {{ $product->category->name }}
                    </div>
                    <div class="form-group">
                        <strong>Hình ảnh:</strong>
                        <img src="{{ asset('storage\backend/assets/img/' . $product->image . '') }}" alt=""
                            style="height: 300px">
                    </div>
                    <div class="form-group">
                        <strong>Nội dung:</strong>
                        {{ $product->description }}
                    </div>
                    <div class="form-group">
                        <strong>Giảm giá:</strong>
                        {{ $product->sale_price }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <Strong>Size sản phẩm:</Strong> <br>
                        @foreach ($product->sizes as $size)
                            Loại size: {{ $size->name }} - Giá tiền: {{ $size->price }} <br>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <Strong>Topping sản phẩm:</Strong> <br>
                        @foreach ($product->toppings as $topping)
                            Loại size: {{ $topping->name }} - Giá tiền: {{ $topping->price }} <br>
                        @endforeach
                    </div>
                    @if ($product->sizes->count() == 0 && $product->toppings->count() == 0)
                        <a class="btn btn-primary" href="{{ route('admin.product_detail.create', $product->id) }}">Thêm chi
                            tiết sản phẩm</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('admin.product_detail.edit', $product->id) }}">Chỉnh sửa
                            chi tiết sản phẩm</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
