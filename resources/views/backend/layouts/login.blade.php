@extends('backend.layouts.app')
@section('title', 'Đăng nhập')
@section('content')
    <div class="be-wrapper be-login">
        <div class="">
            <div class="main-content container-fluid">
                <div class="splash-container">
                    <div class="card card-border-color card-border-color-primary">
                        <div class="card-header"><img class="logo-img"
                                src="{{ asset('storage\backend\assets\img\logo-xx.png') }}" alt="logo" width="102"
                                height="27"><span class="splash-description">Please enter
                                your user
                                information.</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.login.action') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" name="email" type="text" placeholder="Email Address"
                                        autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="form-group row login-tools">
                                    <div class="col-6 login-remember">
                                        {{-- <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="checkbox1">
                                            <label class="custom-control-label" for="checkbox1">Remember Me</label>
                                        </div> --}}
                                    </div>
                                    <div class="col-6 login-forgot-password"><a href="pages-forgot-password.html">Forgot
                                            Password?</a></div>
                                </div>
                                <div class="form-group login-submit"><button class="btn btn-primary btn-xl" type="submit"
                                        name="submit" data-dismiss="modal">Sign me in</button></div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="splash-footer"><span>Don't have an account? <a href="pages-sign-up.html">Sign Up</a></span> --}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
