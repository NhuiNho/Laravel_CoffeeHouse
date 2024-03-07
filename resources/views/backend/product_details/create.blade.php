@extends('backend.layouts.app')
@section('title', 'Thêm mới')
@section('content')
    <div class="be-content">
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-0">Thêm mới chi tiết sản phẩm</h2>
                </div>
                <div class="col-lg-6">
                    <a class="btn btn-primary float-end" href="{{ route('admin.product.show', $id) }}">Back</a>
                </div>
                <div class="col-lg-12">
                    <form action="{{ route('admin.product_detail.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $id }}">
                        <div class="form-group">
                            Bạn muốn có bao nhiêu size cho sản phẩm này ? <input type="number" id="quantitySize"
                                name="quantitySize" max="3" min="0" value="0">
                            <div class="row">
                                <span id="size0">Sản phẩm này không cần size</span>
                                <div class="col-lg-4" id="size1" style="display: none">
                                    <h6>Size Nhỏ: </h6>
                                    <select name="size_1" class="form-select" onchange="changeSize1()" id="size_1">
                                        @foreach ($sizes->where('name', '=', 'Nhỏ')->all() as $size)
                                            <option value="{{ $size->id }}" data_price="{{ $size->price }}">
                                                {{ $size->name }} - {{ $size->price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-4" id="size2" style="display: none">
                                    <h6>Size Vừa: </h6>
                                    <select name="size_2" class="form-select" onchange="changeSize2()" id="size_2">
                                        @foreach ($sizes->where('name', '=', 'Vừa')->all() as $size)
                                            <option value="{{ $size->id }}" data_price="{{ $size->price }}">
                                                {{ $size->name }} - {{ $size->price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-4" id="size3" style="display: none">
                                    <h6>Size Lớn: </h6>
                                    <select name="size_3" class="form-select" onchange="changeSize3()" id="size_3">
                                        @foreach ($sizes->where('name', '=', 'Lớn')->all() as $size)
                                            <option value="{{ $size->id }}" data_price="{{ $size->price }}">
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
                                            value="{{ $topping->id }}">
                                        {{ $topping->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var quantitySize = document.getElementById('quantitySize');
        quantitySize.addEventListener('change', function() {
            console.log('Quantity Size changed: ' + quantitySize.value);
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
        })

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
        noToppingCheckbox.checked = true;
        toppingsCheckboxes.forEach(function(option) {
            option.addEventListener('change', function() {
                if (noToppingCheckbox.checked) {
                    if (option.checked && option != noToppingCheckbox) {
                        noToppingCheckbox.checked = false;
                    } else if (option == noToppingCheckbox) {
                        noToppingCheckbox.checked = true;
                        toppingsCheckboxes.forEach(function(option1) {
                            if (option1 != option) {
                                option1.checked = false;
                            }
                        })
                    }
                }
            })
        })


        // var checkboxList = [];
        // Add an event listener to the "Không có topping" checkbox
        // noToppingCheckbox.addEventListener('change', function() {
        //     // If "Không có topping" is checked, uncheck all other toppings
        //     if (noToppingCheckbox.checked) {
        //         toppingsCheckboxes.forEach(function(checkbox) {
        //             if (checkbox != noToppingCheckbox && checkbox.checked) {
        //                 checkbox.checked = false;
        //                 checkboxList.push(checkbox);
        //             }
        //         });
        //     } else {
        //         checkboxList.forEach(function(checkbox) {
        //             checkbox.checked = true;
        //         })
        //         checkboxList = [];
        //     }
        // });
    </script>
@endsection
