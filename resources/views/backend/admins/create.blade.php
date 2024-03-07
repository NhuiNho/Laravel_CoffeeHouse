@extends('backend.layouts.app')
@section('title', 'Thêm mới')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Thêm mới admin</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <strong>Email Address:</strong>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <strong>Password:</strong>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <strong>Loại admin:</strong>
                            <select name="admin_status_id" id="admin_status_id" class="form-select">
                                @foreach ($admin_statuses as $admin_status)
                                    <option value="{{ $admin_status->id }}">{{ $admin_status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
