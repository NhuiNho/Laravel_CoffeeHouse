@extends('frontend.layouts.app')
@section('title', 'Quên Mật Khẩu')
@section('content')
    <form action="{{ route('verify.resetpw.check') }}" method="post">
        @csrf
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="email">Nhập địa chỉ email</label>
                <input class="form-control" name="email" id="email" type="text" placeholder="Nhập địa chỉ email">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
@endsection
