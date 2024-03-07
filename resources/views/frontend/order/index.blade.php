@extends('frontend.layouts.app')
@section('title', 'Đơn hàng')
@section('content')
    <h3 class="text-primary text-center">Lịch sử mua hàng</h3>
    <table class="table table-success table-hover table-bordered table-sm table-responsive-sm">
        <thead>
            <tr class="text-center">
                <th scope="col" class="text-start">Mã đơn hàng</th>
                <th scope="col">Thời gian</th>
                <th scope="col">Tổng Tiền</th>
                <th scope="col">Phương thức thanh toán</th>
                <th scope="col">Voucher</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Xem chi tiết</th>
                <th scope="col">Thao tác</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>{{ $order->payment_method->name_method }}</td>
                    <td>
                        @if ($order->voucher_id != null)
                            {{ $order->voucher->code }}
                        @endif
                    </td>
                    <td>{{ $order->order_status->name }}</td>
                    <td class="text-center"><a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">Chi
                            tiết</a></td>
                    <td class="text-center">
                        @if ($order->order_status_id == 1)
                            <form method="POST" action="{{ route('order.cancel', $order->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-danger" type="submit"
                                    onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này chứ ?')">Hủy đơn</button>
                            </form>
                        @endif
                        @if ($order->order_status_id == 3 || $order->order_status_id == 4)
                            <a href="{{ route('order.rebook', $order->id) }}"
                                onclick="return confirm('Bạn có chắc muốn đặt lại đơn hàng này ?')"
                                class="btn btn-success">Đặt lại
                                đơn hàng</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
