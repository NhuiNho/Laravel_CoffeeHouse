<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.layouts.login');
    }

    public function showLogin()
    {
        return view('frontend.layouts.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Kiểm tra email hoặc phone
        $admin = Admin::attemptLogin($credentials['email'], $credentials['password']);

        if ($admin) {
            if ($admin->admin_status_id != 3) {
                // Đăng nhập Admin
                Auth::guard('admin')->login($admin);

                // Lưu thông tin vào session
                $request->session()->put('admin_id', $admin->id);
                $request->session()->put('admin_name', $admin->name);
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('admin.login')->with('warning', 'Tài khoản của bạn đã bị khóa');
            }
        } else {
            // Đăng nhập thất bại
            return redirect()->route('admin.login')->with('error', 'Thông tin đăng nhập không chính xác.');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email_or_phone' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email_or_phone', 'password');

        // Kiểm tra email hoặc phone
        $user = User::attemptLogin($credentials['email_or_phone'], $credentials['password']);
        if ($user) {
            if ($user->status == 0) {
                // Lưu thông tin vào session
                $request->session()->put('user_id', $user->id);
                $request->session()->put('fullname', $user->fullname);
                $request->session()->put('avatar', $user->avatar);
                if (session()->has('cart')) {
                    foreach (session()->get('cart') as $key => $value) {
                        Cart::create([
                            'product_id' => $value['product_id'],
                            'size_id' => $value['size_id'],
                            'topping_id' => $value['topping_id'],
                            'user_id' => $user->id,
                            'quantity' => $value['quantity']
                        ]);
                    }
                    if (Cart::where('user_id', '=', $user->id)->count() == count(session('cart'))) {
                        Session::forget('cart');
                    }
                }
                $cart = Cart::where('user_id', '=', $user->id)->count();
                $request->session()->put('countCart', $cart);
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('user.login')->with('warning', 'Tài khoản của bạn đã bị khóa, vui lòng liên hệ hotline!');
            }
        } else {
            // Đăng nhập thất bại
            return redirect()->route('user.login')->with('error', 'Thông tin đăng nhập không chính xác.');
        }
    }

    public function logoutUser()
    {
        // Xóa session admin_id
        Session::forget('user_id');
        Session::forget('fullname');
        Session::forget('avatar');
        return redirect()->route('home')->with('success', 'Đăng xuất thành công');
    }

    public function logout()
    {
        // Xóa session admin_id
        Session::forget('admin_id');

        // Đăng xuất khỏi guard 'admin'
        Auth::guard('admin')->logout();

        // Chuyển hướng đến trang đăng nhập của admin
        return redirect()->route('admin.login');
    }
}
