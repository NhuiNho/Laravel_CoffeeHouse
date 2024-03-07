@extends('backend.layouts.app')
@section('title', 'Chỉnh sửa')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">
                        Chỉnh sửa chi tiết sản phẩm
                    </h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product.show', $product->id) }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.product_detail.update', $product->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            Bạn muốn có bao nhiêu size cho sản phẩm này ? <input type="number" id="quantitySize"
                                name="quantitySize" max="3" min="0" value="{{ $product->sizes->count() }}">
                            <div class="row">
                                <span id="size0">Sản phẩm này không cần size</span>
                                <div class="col-lg-4" id="size1" style="display: none">
                                    <h6>Size Nhỏ: </h6>
                                    <select name="size_1" class="form-select" onchange="changeSize1()" id="size_1">
                                        @foreach ($sizes->where('name', '=', 'Nhỏ')->all() as $size)
                                            <option value="{{ $size->id }}" data_price="{{ $size->price }}"
                                                @if ($product->sizes->count() > 0) @foreach ($product->sizes as $size_real)                                                       
                                                    @if ($size_real->id == $size->id)
                                                        {{ 'selected' }} @endif
                                                @endforeach
                                        @endif>
                                        {{ $size->name }} - {{ $size->price }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-4" id="size2" style="display: none">
                                    <h6>Size Vừa: </h6>
                                    <select name="size_2" class="form-select" onchange="changeSize2()" id="size_2">
                                        @foreach ($sizes->where('name', '=', 'Vừa')->all() as $size)
                                            <option value="{{ $size->id }}" data_price="{{ $size->price }}"
                                                @if ($product->sizes->count() > 0) @foreach ($product->sizes as $size_real)                                                       
                                                @if ($size_real->id == $size->id)
                                                    {{ 'selected' }} @endif
                                                @endforeach
                                        @endif>
                                        {{ $size->name }} - {{ $size->price }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-4" id="size3" style="display: none">
                                    <h6>Size Lớn: </h6>
                                    <select name="size_3" class="form-select" onchange="changeSize3()" id="size_3">
                                        @foreach ($sizes->where('name', '=', 'Lớn')->all() as $size)
                                            <option value="{{ $size->id }}" data_price="{{ $size->price }}"
                                                @if ($product->sizes->count() > 0) @foreach ($product->sizes as $size_real)                                                       
                                                @if ($size_real->id == $size->id)
                                                    {{ 'selected' }} @endif
                                                @endforeach
                                        @endif>
                                        {{ $size->name }} - {{ $size->price }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name">Topping sản phẩm</label>
                            <div class="row">
                                @foreach ($toppings as $topping)
                                    <div class="col-lg-2 pt-2">
                                        <input type="checkbox" name="toppings[]" id="topping_{{ $topping->id }}"
                                            value="{{ $topping->id }}"
                                            @foreach ($product->toppings as $topping_real)
                                                @if ($topping_real->id == $topping->id)
                                                    {{ 'checked' }}
                                                @endif @endforeach>
                                        {{ $topping->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var quantitySize = document.getElementById('quantitySize');
        size(quantitySize);
        quantitySize.addEventListener('change', function() {
            size(quantitySize);
        })

        function size(quantitySize) {
            switch (quantitySize.value) {
                case '0':
                    document.getElementById('size3').style.display = 'none';
                    document.getElementById('size2').style.display = 'none';
                    document.getElementById('size1').style.display = 'none';
                    document.getElementById('size0').style.display = '';
                    changeSize1();
                    break;
                case '1':
                    document.getElementById('size0').style.display = 'none';
                    document.getElementById('size1').style.display = '';
                    document.getElementById('size3').style.display = 'none';
                    document.getElementById('size2').style.display = 'none';
                    break;
                case '2':
                    document.getElementById('size0').style.display = 'none';
                    document.getElementById('size1').style.display = '';
                    document.getElementById('size2').style.display = '';
                    document.getElementById('size3').style.display = 'none';
                    break;
                case '3':
                    document.getElementById('size0').style.display = 'none';
                    document.getElementById('size1').style.display = '';
                    document.getElementById('size3').style.display = '';
                    document.getElementById('size2').style.display = '';
                    changeSize2();
                    break;
            }
        }

        function changeSize1() {
            // Lấy đối tượng select
            var selectElement = document.getElementById('size_1');

            // Lấy giá trị của thuộc tính data_price từ option được chọn
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var dataPrice = parseInt(selectedOption.getAttribute('data_price'));

            // Lấy danh sách các option
            var optionList = document.getElementById('size_2').options;

            // In danh sách ra console
            for (var i = 0; i < optionList.length; i++) {
                if (dataPrice >= parseInt(optionList[i].getAttribute('data_price'))) {
                    optionList[i].style.display = 'none';
                } else {
                    optionList[i].style.display = '';
                }
            }

        }

        function changeSize2() {
            // Lấy đối tượng select
            var selectElement = document.getElementById('size_2');

            // Lấy giá trị của thuộc tính data_price từ option được chọn
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var dataPrice = parseInt(selectedOption.getAttribute('data_price'));

            var optionList = document.getElementById('size_3').options;

            // In danh sách ra console
            for (var i = 0; i < optionList.length; i++) {
                if (dataPrice >= parseInt(optionList[i].getAttribute('data_price'))) {
                    optionList[i].style.display = 'none';
                } else {
                    optionList[i].style.display = '';
                }
            }

            if (dataPrice >= parseInt(optionList[document.getElementById('size_3').selectedIndex].getAttribute(
                    'data_price'))) {
                document.getElementById('size_3').selectedIndex = optionList.length - 1;
            }


        }

        function changeSize3() {}

        // Get all toppings checkboxes
        var toppingsCheckboxes = document.querySelectorAll('input[name="toppings[]"]');

        // Get the "Không có topping" checkbox
        var noToppingCheckbox = document.getElementById('topping_100');
        var toppings = [];
        toppingsCheckboxes.forEach(function(option) {
            option.addEventListener('change', function() {
                if (noToppingCheckbox.checked) {
                    if (option.checked && option != noToppingCheckbox) {
                        noToppingCheckbox.checked = false;
                    } else if (option == noToppingCheckbox) {
                        noToppingCheckbox.checked = true;
                        toppingsCheckboxes.forEach(function(option1) {
                            if (option1 != option) {
                                if (option1.checked) {
                                    toppings.push(option1);
                                    option1.checked = false;
                                }
                            }
                        })
                    }
                } else {
                    toppings.forEach(function(option) {
                        option.checked = true;
                    })
                    toppings = [];
                }
            })
        })
    </script>
@endsection
