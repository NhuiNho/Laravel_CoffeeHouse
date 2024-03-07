@extends('backend.layouts.app')
@section('title', 'Size Sản Phẩm')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Size sản phẩm</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product_detail.size.create') }}">Create new
                        size</a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:20%;">Tên size</th>
                                        <th style="width:20%;">Chi tiết tên</th>
                                        <th style="width:20%;">Giá tiền</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($sizes as $size)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $size->name }}</td>
                                            <td>{{ $size->description_name }}</td>
                                            <td>{{ $size->price }}</td>
                                            <td class="actions">
                                                <form action="{{ route('admin.product_detail.size.destroy', $size->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.product_detail.size.show', $size) }}">Show</a>

                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.product_detail.size.edit', $size) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $sizes->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
