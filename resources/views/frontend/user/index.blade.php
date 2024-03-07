@extends('frontend.layouts.app')
@section('title', 'Tài Khoản')
@section('content')
    <div class="d-flex justify-content-center pt-3">
        <h3 class="text-center"><img src="Content/image/icon_taikhoan_cuaban.svg" alt=""> Tài khoản của bạn</h3>
    </div>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="{{ route('user.index') }}" target="__blank">Profile</a>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <img class="img-account-profile rounded-circle mb-2 img-fluid"
                            src="{{ asset('storage/backend/assets/img/' . $user->avatar) }}" alt="" width="180px">
                        <!-- Profile picture help block-->
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <!-- Profile picture upload button-->
                        <form action="{{ route('user.uploadImage', session()->get('user_id')) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="avatar" class="mb-4" />
                            <button class="btn btn-primary" type="submit" name="submit">Upload new image</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ route('user.update', session()->get('user_id')) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="fullname">Fullname</label>
                                <input class="form-control" name="fullname" id="fullname" type="text"
                                    placeholder="Enter your fullname" value="{{ $user->fullname }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="address">Address</label>
                                <input class="form-control" name="address" id="address" type="text"
                                    placeholder="Enter your address" value="{{ $user->address }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="email">Email address</label>
                                <input class="form-control" name="email" id="email"
                                    placeholder="Enter your email address" value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="phone">Phone</label>
                                <input class="form-control" name="phone" id="phone" type="text"
                                    placeholder="Enter your phone number" value="{{ $user->phone }}">
                            </div>
                            <a href="{{ route('user.showFormChangepw') }}" class="btn btn-info">Change Password</a>
                            <button class="btn btn-primary float-end" type="submit" name="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
