@extends('backend.layouts.app')
@section('title', 'Thêm mới')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Thêm mới menu</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.menu.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.menu.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
