@extends('frontend.layouts.app')
@section('title', 'Đơn hàng')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h2 class="h5 mb-0 fs-2"><a href="#" class="text-muted"></a> Order #{{ $order->id }}</h2>
                </div>
                <!-- Main content -->
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Details -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3 d-flex  fs-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="text-start">{{ $order->created_at }}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="text-end">{{ $order->payment_method->name_method }}</span>
                                        </div>
                                        <div class="col-lg-12">
                                            <span
                                                class="badge rounded-pill bg-info fs-4">{{ $order->order_status->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-borderless">
                                    <tbody>
                                        @foreach ($order->order_details as $order_detail)
                                            <tr>
                                                <td colspan="2">
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ asset('storage/backend/assets/img/' . $order_detail->product->image) }}"
                                                                alt="{{ $order_detail->product->name }}" width="85"
                                                                class="img-fluid">
                                                        </div>
                                                        <div class="flex-lg-grow-1 ms-3">
                                                            <div class="product-info">
                                                                <h6 class="product-title fs-4">
                                                                    {{ $order_detail->product->name }}
                                                                </h6>
                                                                <span><em>Size: {{ $order_detail->size->name }}</em>
                                                                </span><br>
                                                                <span> <em>Topping: {{ $order_detail->topping->name }}</em>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="fs-4">{{ $order_detail->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="fs-4">

                                        <tr>
                                            <td colspan="2">Subtotal</td>
                                            <td class="text-end">$ @if ($order->voucher_id != null)
                                                    {{ number_format($order->total_price / (1 - $order->voucher->discount / 100), 0, ',', '.') }}
                                                @else
                                                    {{ number_format($order->total_price, 0, ',', '.') }}
                                                @endif

                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Shipping</td>
                                            <td class="text-end">$ 0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Discount </td>
                                            <td class="text-danger text-end">$ @if ($order->voucher_id != null)
                                                    {{ number_format(($order->voucher->discount / 100) * $order->total_price, 0, ',', '.') }}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="2">TOTAL</td>
                                            <td class="text-end">$ {{ number_format($order->total_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Payment -->
                        <div class="card mb-4 fs-5">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="h6">Payment Method</h3>
                                        <p>{{ $order->payment_method->name_method }}
                                            <br>
                                            Total: $ {{ number_format($order->total_price, 0, ',', '.') }} <span
                                                class="badge bg-success rounded-pill"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 class="h6">Billing address</h3>
                                        <address>
                                            <strong>{{ $order->name_receiver }}</strong><br>
                                            {{ $order->address_receiver }}<br>
                                            {{ $order->phone_receiver }}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 fs-5">
                        <div class="card mb-4">
                            <!-- Shipping information -->
                            <div class="card-body">
                                <h3 class="h6">Shipping Information</h3>
                                <strong>FedEx</strong>
                                <span><a href="#" class="text-decoration-underline" target="_blank">FF1234567890</a>
                                    <i class="bi bi-box-arrow-up-right"></i> </span>
                                <hr>
                                <h3 class="h6">Billing address</h3>
                                <address>
                                    <strong>{{ $order->name_receiver }}</strong><br>
                                    {{ $order->address_receiver }}<br>
                                    {{ $order->phone_receiver }}
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
