@extends('frontend.layouts.app')
@section('title', 'Đăng nhập')
@section('content')
    <registration>
        <h2 class="registration-h2">Sign in/up Form</h2>
        <div class="registration-container" id="container">
            <div class="registration-form-container registration-sign-up-container">
                <form action="{{ route('verify.account') }}" class="registration-form" method="post">
                    @csrf
                    <h1 class="registration-h1">Create Account</h1>
                    <div class="registration-social-container">
                        <a href="#" class="registration-social registration-a"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="registration-social registration-a"><i
                                class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="registration-social registration-a"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <!-- <span class="registration-span">or use your email for registration</span> -->
                    <input type="text" placeholder="FullName" name="fullname" class="registration-input" />
                    <input type="text" placeholder="PhoneNumber" name="phone" class="registration-input" />
                    <input type="text" placeholder="Address" name="address" class="registration-input" />
                    <!-- <input type="text" placeholder="UserName" name="username" class="registration-input" required maxlength="50" /> -->
                    <input type="password" placeholder="Password" name="password" class="registration-input" />
                    <input type="email" placeholder="Email" class="registration-input" name="email" />
                    <button class="registration-button" type="submit" name="submit">Sign Up</button>
                </form>
            </div>
            <div class="registration-form-container registration-sign-in-container">
                <form action="{{ route('user.login.action') }}" class="registration-form" method="post">
                    @csrf
                    <h1 class="registration-h1">Sign in</h1>
                    <div class="registration-social-container">
                        <a href="#" class="registration-social registration-a"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="registration-social registration-a"><i
                                class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="registration-social registration-a"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span class="registration-span">or use your account</span>
                    <input type="text" placeholder="Email or Phonenumber" class="registration-input"
                        name="email_or_phone" />
                    <input type="password" placeholder="Password" class="registration-input" name="password"
                        value="" />
                    <a href="{{ route('verify.showFormResetpw') }}">Quên mật khẩu?</a>
                    <button class="registration-button" type="submit" name="submit">Sign In</button>
                </form>
            </div>
            <div class="registration-overlay-container">
                <div class="registration-overlay">
                    <div class="registration-overlay-panel registration-overlay-left">
                        <h1 class="registration-h1">Welcome Back!</h1>
                        <p class="registration-p">To keep connected with us please login with your personal info</p>
                        <button class="ghost registration-button" id="signIn">Sign In</button>
                    </div>
                    <div class="registration-overlay-panel registration-overlay-right">
                        <h1 class="registration-h1">Hello, Friend!</h1>
                        <p class="registration-p">Enter your personal details and start journey with us</p>
                        <button class="ghost registration-button" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </registration>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('registration-right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('registration-right-panel-active');
        });
    </script>
@endsection
