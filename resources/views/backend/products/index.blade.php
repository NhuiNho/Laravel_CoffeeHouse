@extends('backend.layouts.app')
@section('title', 'Sản phẩm')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Products</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product.create') }}">Create new product</a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:10%;">Tên sản phẩm</th>
                                        <th style="width:5%;">Đơn giá</th>
                                        <th style="width:10%;">Loại category</th>
                                        <th style="width:10%;">Hình ảnh</th>
                                        <th style="width:40%;">Nội dung sản phẩm</th>
                                        <th style="width:5%">Giảm giá</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($products as $product)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td><img src="{{ asset('storage\backend/assets/img/' . $product->image . '') }}"
                                                    alt="" class="" style="width: 100%"></td>
                                            <td>{{ Str::limit($product->description, 100) }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td class="actions">
                                                <form action="{{ route('admin.product.destroy', $product->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.product.show', $product->id) }}">Show</a>

                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.product.edit', $product->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
