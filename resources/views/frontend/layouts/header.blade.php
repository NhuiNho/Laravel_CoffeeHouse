@section('header')
    <header style="background-color: #fb8d17" class="align-items-center d-flex fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-sm navbar-dark align-items-center d-flex pt-3 pb-3">
                <a class="navbar-brand" href="{{ route('home') }}"><img
                        src="{{ asset('storage\backend\assets\img\logo.174bdfd.svg') }}" alt=""
                        style="width: 170px; height: 14px"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation"></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('product.index') }}" aria-current="page">Đặt hàng
                                <span class="visually-hidden">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('search.order') }}">Tra cứu đơn hàng</a>
                        </li>
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#">Action 1</a>
                                <a class="dropdown-item" href="#">Action 2</a>
                        </li> --}}
                    </ul>
                    <form class="d-flex my-2 my-lg-0">
                        <div class="dropdown">
                            <a @if (!session()->has('user_id')) {{ 'href=' . route('user.login') . '' }} @endif
                                id="dropdownAccount"
                                @if (session()->has('user_id')) {{ 'data-bs-toggle=dropdown aria-haspopup=true aria-expanded=false' }} @endif
                                class="text-decoration-none">
                                <span>
                                    <img src="{{ asset('storage/backend/assets/img/' . (session()->has('user_id') ? session('avatar') : 'avatar.png')) }}"
                                        alt="" style="width: 40px; height: 40px" class="rounded-circle">
                                </span>
                            </a>

                            <span class="text-white"></span>
                            @if (session()->has('user_id'))
                                <div class="dropdown-menu" aria-labelledby="dropdownAccount">
                                    <a class="dropdown-item" href="{{ route('user.index') }}"><img
                                            src="{{ asset('storage\backend\assets\img\icon_taikhoan.svg') }}"
                                            alt="">&nbsp; Thông tin tài
                                        khoản</a>
                                    <!-- <a class="dropdown-item" href=""><img src="Content/image/icon_diachi.svg" alt="">&nbsp; Sổ địa chỉ</a> -->
                                    <a class="dropdown-item" href="{{ route('order.index', ['status' => 'all']) }}"><img
                                            src="{{ asset('storage\backend\assets\img\icon_tracuudonhang.svg') }}"
                                            alt="">&nbsp; Lịch sử mua
                                        hàng</a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"><img
                                            src="{{ asset('storage\backend\assets\img\icon_dangxuat.svg') }}"
                                            alt="">&nbsp; Thoát</a>
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('cart.index') }}" style="text-decoration: none;">
                            <div class="icon-cart align-items-center justify-content-center d-flex">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('storage\backend\assets\img\cart.svg') }}" alt="">
                                    @if (session()->has('cart'))
                                        <span>{{ count(session('cart')) }}</span>
                                    @elseif (session()->has('user_id'))
                                        @php
                                            $countCart = App\Models\Cart::where('user_id', session()->get('user_id'))->count();
                                        @endphp
                                        @if ($countCart != 0)
                                            <span>{{ $countCart }}</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </a>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    {{-- @dd(session('cart')) --}}
    <!-- Heading -->
@show
