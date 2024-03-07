@extends('backend.layouts.app')
@section('title', 'Danh Sách Đơn Hàng')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <caption>Order List</caption>
                <table class="table table-dark  table-hover table-bordered table-sm table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">Order Id</th>
                            <th scope="col">User Id</th>
                            <th scope="col">Name Receiver</th>
                            <th scope="col">Phone Receiver</th>
                            <th scope="col">Address Receiver</th>
                            <th scope="col">Time</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Payment Method</th>
                            <th scope="col">Voucher</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Details</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->name_receiver }}</td>
                                <td>{{ $order->phone_receiver }}</td>
                                <td>{{ $order->address_receiver }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->total_price }} đ</td>
                                <td>{{ $order->payment_method->name_method }}</td>
                                <td>
                                    @if ($order->voucher_id != null)
                                        {{ $order->voucher->code }}
                                    @endif
                                </td>
                                <td>{{ $order->order_status->name }}</td>
                                <td>
                                    <a href="{{ route('admin.order.show', $order->id) }}"><button type="button"
                                            class="btn btn-outline-primary">Xem chi
                                            tiết</button></a>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.order.update', $order->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="order_status_id"
                                            value="{{ $order->order_status_id + 1 }}">
                                        @if ($order->order_status_id == 1)
                                            <button type="submit" class="btn btn-outline-success">Bắt đầu giao
                                                hàng</button>
                                            <a href="{{ route('admin.order.cancel', $order->id) }}"
                                                class="btn btn-outline-danger">Hủy
                                                đơn</a>
                                        @elseif ($order->order_status_id == 2)
                                            <button type="submit" class="btn btn-outline-success">Giao hàng thành
                                                công</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
