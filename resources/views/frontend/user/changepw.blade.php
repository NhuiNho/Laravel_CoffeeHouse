@extends('frontend.layouts.app')
@section('title', 'Đổi Mật Khẩu')
@section('content')
    <form action="{{ route('user.changepw') }}" method="post">
        @csrf
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="passOld">Nhập mật khẩu cũ</label>
                <input class="form-control" name="passOld" id="passOld" type="password" placeholder="Nhập mật khẩu cũ">
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="passNew">Nhập mật khẩu mới</label>
                <input class="form-control" name="passNew" id="passNew" type="password" placeholder="Nhập mật khẩu mới">
            </div>
        </div>
        <div class="row gx-3 mb-3">
            <div class="col-md-6">
                <label class="small mb-1" for="rePassNew">Nhập lại mật khẩu mới</label>
                <input class="form-control" name="rePassNew" id="rePassNew" type="password"
                    placeholder="Nhập lại mật khẩu mới">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
@endsection
