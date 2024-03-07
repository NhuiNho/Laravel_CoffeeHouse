@extends('backend.layouts.app')
@section('title', 'Topping Sản Phẩm')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Topping sản phẩm</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product_detail.topping.create') }}">Create new
                        topping</a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <table class="table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">STT</th>
                                        <th style="width:30%;">Tên topping</th>
                                        <th style="width:30%;">Giá tiền</th>
                                        <th class="actions">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="no-border-x">
                                    @foreach ($toppings as $topping)
                                        <tr style="height: 100px">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $topping->name }}</td>
                                            <td>{{ $topping->price }}</td>
                                            <td class="actions">
                                                <form
                                                    action="{{ route('admin.product_detail.topping.destroy', $topping->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.product_detail.topping.show', $topping->id) }}">Show</a>

                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.product_detail.topping.edit', $topping->id) }}">Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $toppings->links('pagination::bootstrap-5') }}</td>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
