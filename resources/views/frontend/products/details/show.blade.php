@extends('frontend.layouts.app')
@section('title', $product->name)
@section('content')
    <p class="text-muted pt-5">
        <a href="{{ route('product.index') }}" class="text-decoration-none text-black fw-bold">Menu</a>&nbsp; /&nbsp;
        <a class="text-decoration-none text-black fw-bold">{{ $product->category->name }}</a>&nbsp; /&nbsp;
        <a class="text-decoration-none text-muted">{{ $product->name }}</a>
    </p>
    <div class="row pt-5 pb-5">
        <div class="col-lg-6 pb-5">
            <img src="{{ asset('storage/backend/assets/img/' . $product->image) }}" alt="{{ $product->name }}"
                class="img-fluid">
        </div>
        <div class="col-lg-6">
            <form action="{{ route('cart.add', $product->id) }}" method="post">
                @csrf
                <h3>{{ $product->name }}</h3>
                <h3 class="mau_vang">
                    <span id="price_now">{{ number_format($product->price - $product->sale_price, 0, ',', '.') }}</span> đ
                    <input type="hidden" name="price" id="price"
                        value="{{ $product->price - $product->sale_price }}">
                </h3>
                <h6 class="pt-3">Chọn số lượng</h6>
                <button type="button" class="btn btn-secondary" id="minus"><span><i
                            class="fa fa-minus"></i></span></button>
                <span id="quantity_now">1</span><input type="hidden" id="quantity" name="quantity" value="1">
                <button type="button" class="btn btn-warning" id="plus"><span><i
                            class="fa fa-plus"></i></span></button>

                @if ($product->sizes->count() != 1)
                    <h6 class="pt-3 pb-2">Chọn size (bắt buộc)</h6>
                    @foreach ($product->sizes as $index => $size)
                        @if ($index == 0)
                            @php
                                $value_size = $size->id;
                            @endphp
                        @endif
                        <button type="button" class="btn btn-outline-secondary me-3" id-size="{{ $size->id }}"
                            id="size" name="size"
                            value="{{ $size->price }}">{{ $size->name . ' + ' . number_format($size['price'], 0, ',', '.') }}đ</button>
                    @endforeach
                @else
                    @php
                        $value_size = 100;
                    @endphp
                @endif

                <input type="hidden" id="size_id" name="size_id" value="{{ $value_size }}">
                @if ($product->toppings->count() != 1)
                    <h6 class="pt-3 pb-1">Topping</h6>
                    @foreach ($product->toppings as $topping)
                        <button type="button" class="btn btn-outline-success me-3 mb-4" id="topping"
                            name="{{ $topping->id }}"
                            value="{{ $topping->price }}">{{ $topping->name . ' + ' . number_format($topping['price'], 0, ',', '.') }}đ</button>
                    @endforeach
                @endif
                <input type="hidden" id="topping_id" name="topping_id" value="100">
                <br>
                <button type="submit" class="btn btn-info form-control fw-bold p-2 mt-3" name="submit">Thêm vào giỏ
                    hàng</button>
            </form>
        </div>
        <hr>
        <h5 class="pt-3">Mô tả sản phẩm</h5>
        <p class="pb-3">{{ $product->description }}</p>
        <hr>
        <h5 class="pt-3">Sản phẩm liên quan</h5>
        @foreach ($related_products as $related_product)
            @if ($related_product->id != $product->id)
                <div class="col-lg-2">
                    <div class="card border-0">
                        <a href="{{ route('product_details.show', $related_product->id) }}"
                            title="{{ $related_product->name }}"><img
                                src="{{ asset('storage/backend/assets/img/' . $related_product->image) }}"
                                class="card-img-top rounded-4 border border-5" alt="{{ $related_product->name }}"></a>
                    </div>
                    <a href="{{ route('product_details.show', $related_product->id) }}"
                        title="{{ $related_product->name }}" class="text-decoration-none text-black">
                        <h6 class="card-subtitle mb-2 hover_vang">{{ $related_product->name }}</h6>
                    </a>
                    <span
                        class="card-text text-muted">{{ number_format($related_product->price - $related_product->sale_price, 0, ',', '.') }}đ</span>
                </div>
            @endif
        @endforeach
    </div>
    <script>
        var quantity = parseInt(document.getElementById('quantity').value);
        var plus = document.getElementById('plus');
        var minus = document.getElementById('minus');
        var price = parseInt(document.getElementById('price').value);
        var topping = document.getElementById('topping_id');
        // Lấy danh sách các button
        var button_size = document.querySelectorAll('button[name="size"]');
        var button_topping = document.querySelectorAll('button[id="topping"]');

        function disalbed_minus(quantity, minus) {
            if (quantity < 2) {
                minus.disabled = true;
                minus.classList.remove('btn-warning');
            } else {
                minus.disabled = false;
                minus.classList.add('btn-warning');
            }
            document.getElementById('quantity_now').textContent = quantity;
            document.getElementById('quantity').value = quantity;
        }
        disalbed_minus(quantity, minus);
        plus.addEventListener('click', function() {
            quantity += 1;
            disalbed_minus(quantity, minus);
            price *= (quantity / (quantity - 1));
            document.getElementById('price_now').textContent = price.toLocaleString('vi-VN');
        })
        minus.addEventListener('click', function() {
            quantity -= 1;
            disalbed_minus(quantity, minus);
            price /= ((quantity + 1) / quantity);
            document.getElementById('price_now').textContent = price.toLocaleString('vi-VN');
        })


        // Thêm sự kiện click cho từng button
        button_size.forEach(function(button) {
            button.addEventListener('click', function() {
                // Xóa class 'active' từ tất cả các button trước khi thêm vào button được click
                button_size.forEach(function(btn) {
                    if (btn.classList.contains('active')) {
                        btn.classList.remove('active');
                        price -= parseInt(btn.value);
                    }
                });
                // Thêm class 'active' cho button được click
                this.classList.add('active');
                document.getElementById('size_id').value = parseInt(this.getAttribute('id-size'));
                var price_size = this.value;
                // Định dạng giá trị và cập nhật nội dung của phần tử có id="price_now"
                price += parseInt(this.value);
                document.getElementById('price_now').textContent = price.toLocaleString('vi-VN');
            });
        });

        button_topping.forEach(function(button) {
            button.addEventListener('click', function() {
                var isActive = this.classList.contains('active');
                button_topping.forEach(function(btn) {
                    if (btn.classList.contains('active')) {
                        btn.classList.remove('active');
                        price -= parseInt(btn.value);
                    }
                });
                this.classList.add('active');
                document.getElementById('topping_id').value = parseInt(this.getAttribute('name'));
                var price_topping = this.value;
                // Định dạng giá trị và cập nhật nội dung của phần tử có id="price_now"
                price += parseInt(this.value);
                document.getElementById('price_now').textContent = price.toLocaleString('vi-VN');
                // Kiểm tra xem button đã có class 'active' hay chưa
                // if (isActive) {
                //      // Nếu đã có, loại bỏ class 'active' khi click lần nữa
                //      this.classList.remove('active');
                //      price -= parseInt(this.value);
                //      var mang = topping.value.split('');
                //      topping.value = '';
                //      console.log(topping.value);
                //      for (var i = 0; i < mang.length; i++) {
                //           if (mang[i] != this.getAttribute('name')) {
                //                topping.value += mang[i];
                //           }
                //      }
                // } else {
                //      // Thêm class 'active' cho button được click
                //      this.classList.add('active');
                //      price += parseInt(this.value);
                //      topping.value += this.getAttribute('name');
                // }
                // document.getElementById('price_now').textContent = price.toLocaleString('vi-VN');
            });
        });
    </script>
@endsection
