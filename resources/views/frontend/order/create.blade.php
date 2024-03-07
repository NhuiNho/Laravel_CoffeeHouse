@extends('frontend.layouts.app')
@section('title', 'Đơn hàng')
@section('content')
    @php
        $total = 0;
        $discount = 0;
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <!-- Details -->
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            @foreach ($cart as $key => $value)
                                @foreach ($products as $product)
                                    @if ($product->id == $value['product_id'])
                                        @php
                                            $totalProduct = $product->price - $product->sale_price;
                                            $discount += $product->sale_price * $value['quantity'];
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ asset('storage/backend/assets/img/' . $product->image) }}"
                                                            alt="" width="35" class="img-fluid">
                                                    </div>
                                                    <div class="flex-lg-grow-1 ms-3">
                                                        <div class="product-info">
                                                            <h6 class="product-title">
                                                                {{ $product->name }}
                                                            </h6>
                                                            @if ($value['size_id'] != 100)
                                                                @foreach ($product->sizes as $size)
                                                                    @if ($size->id == $value['size_id'])
                                                                        @php
                                                                            $totalProduct += $size->price;
                                                                        @endphp
                                                                        <span>
                                                                            <em>Size: </em>{{ $size->name }}
                                                                        </span><br>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if ($value['topping_id'] != 100)
                                                                @foreach ($product->toppings as $topping)
                                                                    @if ($topping->id == $value['topping_id'])
                                                                        @php
                                                                            $totalProduct += $topping->price;
                                                                        @endphp
                                                                        <span>
                                                                            <em>Topping: </em> {{ $topping->name }}
                                                                        </span>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $value['quantity'] }}</td>
                                            <td class="text-end">$ {{ number_format($totalProduct, 0, ',', '.') }}</td>
                                        </tr>
                                        @php
                                            $total += $totalProduct * $value['quantity'];
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="2">Subtotal</td>
                                <td class="text-end">$ {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Shipping</td>
                                <td class="text-end">$ 0.00</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Discount @if (session('voucher'))
                                        (Code: {{ session('voucher')->code }})
                                    @endif
                                </td>
                                <td class="text-danger text-end">
                                    @if (session('voucher'))
                                        $ {{ number_format(($total * session('voucher')->discount) / 100, 0, ',', '.') }}
                                        @php
                                            $total *= 1 - session('voucher')->discount / 100;
                                        @endphp
                                    @endif
                                </td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="2">TOTAL</td>
                                <td class="text-end">$ {{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- Payment -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="coupon-form" method="post" action="{{ route('order.create.addCoupon') }}">
                                @csrf
                                <input class="form-control-cart form-control-sm-cart" type="text" name="coupon"
                                    placeholder="Coupon code"
                                    value="@if (session('voucher')) {{ session('voucher')->code }} @endif">
                                <button class="btn btn-outline-primary btn-sm" type="submit" name="addCoupon">Apply
                                    Coupon</button>
                            </form>
                        </div>
                        <form action="{{ route('order.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div>
                                        <input type="hidden" name="total_price" value="{{ $total }}">
                                        <input type="hidden" name="voucher_id"
                                            value="@if (session('voucher')) {{ session('voucher')->id }} @endif">
                                        <h5 class="font-size-14 mb-3">Payment method :</h5>
                                        <div class="row">
                                            @foreach ($payment_methods as $index => $payment_method)
                                                <div class="col-lg-3 col-sm-6">
                                                    <div data-bs-toggle="collapse">
                                                        <label class="card-radio-label">
                                                            <input type="radio" name="payment_method_id"
                                                                value="{{ $payment_method->id }}"
                                                                id="pay_methodoption{{ $payment_method->id }}"
                                                                class="card-radio-input"
                                                                @if ($index == 0) {{ 'checked' }} @endif>
                                                            <span class="card-radio py-3 text-center text-truncate">
                                                                <i class="{{ $payment_method->icon }} d-block h2 mb-3"></i>
                                                                {{ $payment_method->name_method }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="fullname">Fullname</label>
                                        <input class="form-control" name="name_receiver" id="name_receiver" type="text"
                                            placeholder="Enter your fullname"
                                            value="@if (session('user_id')) {{ $user->fullname }} @endif">
                                    </div>
                                    <!-- Form Group (address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="address">Address</label>
                                        <input class="form-control" name="address_receiver" id="address_receiver"
                                            type="text" placeholder="Enter your address"
                                            value="@if (session('user_id')) {{ $user->address }} @endif">
                                    </div>
                                    <!-- Form Group (address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" name="email_receiver" id="email_receiver" type="text"
                                            placeholder="Enter your Email"
                                            value="@if (session('user_id')) {{ $user->email }} @endif">
                                    </div>
                                    <!-- Form Group (phone)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="phone">Phone</label>
                                        <input class="form-control" name="phone_receiver" id="phone_receiver" type="text"
                                            placeholder="Enter your phone number"
                                            value="@if (session('user_id')) {{ $user->phone }} @endif">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary form-control mt-3" name="submit"
                                    onclick="dathang()">Đặt hàng</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
