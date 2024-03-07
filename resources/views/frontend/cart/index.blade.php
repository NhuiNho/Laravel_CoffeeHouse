@extends('frontend.layouts.app')
@section('title', 'Giỏ hàng')
@section('content')
    @php
        $quantity = 0;
        $total = 0;
        $discount = 0;
    @endphp
    <div class="padding-bottom-3x mb-1">
        <div class="table-responsive shopping-cart">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Bạn có muốn xóa không?')">Clear Cart</button>
                            </form>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $key => $value)
                        @foreach ($products as $product)
                            @if ($value['product_id'] == $product->id)
                                @php
                                    $totalProduct = $product->price;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="product-item">
                                                    <a class="product-thumb"
                                                        href="{{ route('product_details.show', $product->id) }}"><img
                                                            src="{{ asset('storage/backend/assets/img/' . $product->image) }}"
                                                            alt="{{ $product->name }}"></a>
                                                    <div class="product-info">
                                                        <h4 class="product-title">
                                                            <a
                                                                href="{{ route('product_details.show', $product->id) }}">{{ $product->name }}</a>
                                                        </h4>
                                                        @if ($value['size_id'] != 100)
                                                            @foreach ($product->sizes as $size)
                                                                @if ($size->id == $value['size_id'])
                                                                    @php
                                                                        $totalProduct += $size->price;
                                                                    @endphp
                                                                    <span><em>Size: </em>{{ $size->name }}</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if ($value['topping_id'] != 100)
                                                            @foreach ($product->toppings as $topping)
                                                                @if ($topping->id == $value['topping_id'])
                                                                    @php
                                                                        $totalProduct += $topping->price;
                                                                    @endphp
                                                                    <span> <em>Topping: </em>{{ $topping->name }}</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-end pt-5">
                                                <a class="btn btn-primary" id="update{{ $product->id }}" onclick=""
                                                    style="display: none">Update</a>
                                                <a class="btn btn-primary" id="edit{{ $product->id }}" name="edit"
                                                    onclick="">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="count-input">
                                            <input type="number" id="quantity{{ $product->id }}" min="1"
                                                name="quantity" class="form-control text-center"
                                                value="{{ $value['quantity'] }}" readonly>
                                        </div>
                                    </td>
                                    <td class="text-center text-lg text-medium">
                                        {{ number_format($totalProduct, 0, ',', '.') }}</td>
                                    <td class="text-center text-lg text-medium">
                                        {{ number_format($product->sale_price, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <form
                                            action="@if (session()->has('user_id')) {{ route('cart.destroy', $value['id']) }} @else {{ route('cart.destroy', $key) }} @endif"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger" type="submit"
                                                onclick="return confirm('Bạn có muốn xóa không?')"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $quantity += $value['quantity'];
                                    $total += $totalProduct * $value['quantity'];
                                    $discount += $product->sale_price * $value['quantity'];
                                @endphp
                            @endif
                        @endforeach
                    @endforeach


                    <tr class="text-end fs-4" style="height: 135.07px">

                        <td class="">
                            Tổng:
                        </td>
                        <td class="text-center">
                            <div class="count-input">
                                <input type="text" name="quantity" class="form-control text-center"
                                    value="{{ $quantity }}" readonly>
                            </div>
                        </td>
                        <td class="text-center">
                            {{ number_format($total, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            {{ number_format($discount, 0, ',', '.') }}
                        </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="shopping-cart-footer border-0">
            <div class="column"><a class="btn btn-outline-secondary" href="{{ route('product.index') }}"><i
                        class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
            <div class="column fs-4">
                <p class="text-end">Thành tiền: {{ number_format($total - $discount, 0, ',', '.') }}</p>
            </div>
            <div class="column">
                <a class="btn btn-success" href="{{ route('order.create') }}" id="checkout">Checkout</a>
            </div>
        </div>
    </div>
    <script>
        var quantity = 0;

        function Edit(id) {
            document.getElementById('quantity' + id).removeAttribute('readonly');
            document.getElementsByName('edit').forEach(item => {
                item.style.display = 'none';
            })
            document.getElementById('update' + id).style.display = '';
            quantity = document.getElementById('quantity' + id).value;
        }

        function Update(id, index) {
            document.getElementsByName('edit').forEach(item => {
                item.style.display = '';
            })
            document.getElementById('update' + id).style.display = 'none';
            document.getElementById('quantity' + id).setAttribute('readonly', 'true');
            var quantityNew = document.getElementById('quantity' + id).value;
            if (quantityNew != quantity) {
                document.getElementById('update' + id).setAttribute('href', '?action=cart&act=updateCart&id=' + index +
                    '&quantity=' + quantityNew);
            }
        }
    </script>

@endsection
