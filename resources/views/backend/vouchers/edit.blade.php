@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">
                        Chỉnh sửa voucher
                    </h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.voucher.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.voucher.update', $voucher->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Mã voucher: </label>
                            <input type="text" class="form-control" name="code" value="{{ $voucher->code }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Giảm giá %: </label>
                            <input type="text" class="form-control" name="discount" value="{{ $voucher->discount }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
