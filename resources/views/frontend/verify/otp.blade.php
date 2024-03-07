@extends('frontend.layouts.app')
@section('title', 'Xác thực')
@section('content')
    <form method="POST" action="{{ route(session()->get('route')) }}">
        @csrf
        <label for="otp">Nhập mã xác thực:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Xác nhận</button>
    </form>
@endsection
