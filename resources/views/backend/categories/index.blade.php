@extends('backend.layouts.app')
@section('title', 'Danh mục Sản phẩm')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Categories</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.category.create') }}">Create new category</a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:25%;">Tên category</th>
                                        <th style="width:25%;">Loại menu</th>
                                        <th style="width:25%;">Hình ảnh</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($categories as $category)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->menu->name }}</td>
                                            <td><img src="{{ asset('storage\backend/assets/img/' . $category->image . '') }}"
                                                    alt="" class="" style="height: 120px"></td>
                                            <td class="actions">
                                                <form action="{{ route('admin.category.destroy', $category->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.category.show', $category->id) }}">Show</a>

                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.category.edit', $category->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
