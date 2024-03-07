@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">
                        Chỉnh sửa admin
                    </h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.update', $admin->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên: </label>
                            <input type="text" class="form-control" name="name" value="{{ $admin->name }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Email: </label>
                            <input type="text" class="form-control" name="email" value="{{ $admin->email }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Password: </label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>
                        <div class="form-group">
                            <label for="name">Loại admin:</label>
                            <select name="admin_status_id" id="admin_status_id" class="form-select">
                                @foreach ($admin_statuses as $admin_status)
                                    <option value="{{ $admin_status->id }}"
                                        @if ($admin_status->id == $admin->admin_status_id) {{ 'selected' }} @endif>
                                        {{ $admin_status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
