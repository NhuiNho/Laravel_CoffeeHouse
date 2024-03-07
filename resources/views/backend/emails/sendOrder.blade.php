<h1>Xin chào {{ $order->name_receiver }}</h1>

<p>
<h3>The Coffee House</h3>
<span>Mã đơn hàng: #{{ $order['id'] }}</span> <br>
<span>Tên người nhận: {{ $order['name_receiver'] }}</span><br>
<span>Địa chỉ người nhận: {{ $order['address_receiver'] }}</span><br>
<span>Số điện thoại người nhận: {{ $order['phone_receiver'] }}</span><br>
<span>Tổng tiền: {{ number_format($order['total_price'], 0, ',', '.') }}</span><br>
<span>Phương thức thanh toán: {{ $order->payment_method->name_method }}</span><br>
@if ($order->voucher_id != null)
    <span>Mã voucher: {{ $order->voucher->code }}</span>
@endif
</p>
