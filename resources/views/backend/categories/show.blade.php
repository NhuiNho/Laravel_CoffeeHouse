@extends('backend.layouts.app')
@section('title', 'Hiển thị')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Show Category</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.category.index') }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $category->name }}
                    </div>
                    <div class="form-group">
                        <strong>Loại menu:</strong>
                        {{ $category->menu->name }}
                    </div>
                    <div class="form-group">
                        <strong>Hình ảnh:</strong>
                        <img src="{{ asset('storage\backend/assets/img/' . $category->image . '') }}" alt=""
                            style="height: 300px">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
