@extends('backend.layouts.app')
@section('title', 'Thêm mới')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Thêm mới voucher</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.voucher.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.voucher.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <strong>Mã voucher:</strong>
                            <input type="text" name="code" class="form-control" placeholder="Code">
                        </div>
                        <div class="form-group">
                            <strong>Giảm giá %:</strong>
                            <input type="text" name="discount" class="form-control" placeholder="Discount">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
