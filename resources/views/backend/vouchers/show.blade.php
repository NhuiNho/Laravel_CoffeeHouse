@extends('backend.layouts.app')
@section('title', 'Hiển thị')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Show Voucher</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.voucher.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Mã voucher:</strong>
                        {{ $voucher->code }}
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Giảm giá %:</strong>
                        {{ $voucher->discount }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
