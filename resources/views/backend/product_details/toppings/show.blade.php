@extends('backend.layouts.app')
@section('title', 'Hiển thị')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Show Topping</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product_detail.topping.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Tên:</strong>
                        {{ $topping->name }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Chi tiết tên:</strong>
                        {{ $topping->description_name }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Giá tiền:</strong>
                        {{ $topping->price }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
