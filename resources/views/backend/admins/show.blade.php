@extends('backend.layouts.app')
@section('title', 'Hiển thị')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Show Adminstration</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Name: {{ $admin->name }}</strong>

                    </div>
                    <div class="form-group">
                        <strong>Email: {{ $admin->email }}</strong>

                    </div>
                    <div class="form-group">
                        <strong>Loại admin: {{ $admin->admin_status->name }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
