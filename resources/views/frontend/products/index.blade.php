@extends('frontend.layouts.app')
@section('title', 'Sản Phẩm')
@section('content')
    <div class="row">
        <div class="text-center pt-5 pb-5">
            <span class="mau_vang pe-3"><i class="fa fa-trophy fs-3"></i></span>
            <h2 class="d-inline-block">Sản phẩm từ Nhà</h2>
        </div>
        <!-- Nav tabs -->
        <ul class="nav tch-category-card-list tch-category-card-list--spacing d-flex justify-content-md-center flex-xl-wrap flex-lg-wrap"
            id="myTab" role="tablist">
            @foreach ($categories as $index => $category)
                <li class="nav-item text-muted" role="presentation">
                    <a class="nav-link nav-link-category {{ $index == 0 ? 'active' : '' }}" id="a{{ $category->id }}-tab"
                        data-bs-toggle="tab" data-bs-target="#a{{ $category->id }}" role="tab"
                        aria-controls="a{{ $category->id }}" aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                        <div class="tch-category-card d-flex flex-column">
                            <div
                                class="d-flex justify-content-center align-items-center tch-category-card__image tch-category-card--circle">
                                <img class="rounded-circle"
                                    src="{{ asset('storage\backend\assets\img/' . $category->image) }}"
                                    alt="{{ $category->name }}">
                            </div>
                            <div class="tch-category-card__content">
                                <h5 class="tch-category-card__title text-center mb-0">
                                    {{ $category->name }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        <!-- Tab panes -->
        <div class="tab-content pt-5">
            @foreach ($categories as $index => $category)
                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="a{{ $category->id }}" role="tabpanel"
                    aria-labelledby="a{{ $category->id }}-tab">
                    <div class="row">
                        @foreach ($category->products as $product)
                            <div class="col-xl-2 mb-5">
                                <div class="card mb-3 shadow border-0 rounded-4">
                                    <a href="{{ route('product_details.show', $product->id) }}"
                                        title="{{ $product->name }}">
                                        <img src="{{ asset('storage\backend\assets\img/' . $product->image) }}"
                                            class="card-img-top p-2 rounded-4" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ route('product_details.show', $product->id) }}"
                                            title="{{ $product->name }}" class="text-decoration-none text-black">
                                            <h6 class="card-subtitle mb-2 hover_vang" style="height: 48px;">
                                                {{ $product->name }}
                                            </h6>
                                        </a>
                                        <span class="card-text text-muted">
                                            {{ number_format($product->price - $product->sale_price, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
