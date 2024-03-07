<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('user_id')) {
            $user = User::findOrFail(session()->get('user_id'));
            return view('frontend.user.index', compact('user'));
        } else {
            return redirect('/')->with('warning', 'Bạn phải đăng nhập mới xem được chức năng này');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $otpFromUser = $request->input('otp');
        $otpFromSession = Session::get('code');

        if ($otpFromUser == $otpFromSession) {
            // Mã OTP đúng, tiến hành tạo tài khoản
            $validatedData = Session::get('validatedData');
            User::create($validatedData);

            // Xóa mã OTP khỏi Session sau khi đã sử dụng
            Session::forget('code');
            Session::forget('validatedData');
            Session::forget('route');
            return redirect('/user/login')->with('success', 'Tạo tài khoản thành công! Vui lòng đăng nhập.');
        } else {
            return redirect('/verify/otp/form')->with('error', 'Mã xác thực không đúng. Vui lòng thử lại.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:200',
            'phone' => 'required|min:10|max:10',
            'address' => 'required|max:200',
            'email' => 'required|email|max:255',
        ]);
        $user = User::checkUser($validatedData['email'], $validatedData['phone']);
        if ($user->count() > 1) {
            return redirect('/user/index')->with('error', 'Email hoặc Số điện thoại bạn vừa nhập đã có người sử dụng');
        }
        User::whereId($id)->update($validatedData);
        return redirect('/user/index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function uploadImage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'avatar' => 'required',
        ]);
        $currentTime = time();
        $randomString = random_int(1000, 9999);

        // Kết hợp thời gian và chuỗi ngẫu nhiên để tạo tên file
        $tenfile = $currentTime . $randomString;

        // Lấy đuôi định dạng của tập tin
        $extension = $request->file('avatar')->getClientOriginalExtension();

        // Kết hợp đuôi định dạng vào tên file
        $tenfileWithExtension = $tenfile . '.' . $extension;

        // Lưu file vào thư mục
        $imagePath = $request->file('avatar')->storeAs('public/backend/assets/img/', $tenfileWithExtension);
        $validatedData['avatar'] = $tenfileWithExtension;

        // Lấy thông tin sản phẩm cũ
        $user = User::find($id);
        $oldImagePath = storage_path('app/public/backend/assets/img/') . $user->avatar;

        if (file_exists($oldImagePath) && $imagePath !== false && $user->avatar != 'avatar.png') {
            unlink($oldImagePath);
        }
        $update = User::whereId($id)->update($validatedData);
        if ($update > 0) {
            Session::put('avatar', $validatedData['avatar']);
            return redirect('/user/index')->with('success', 'Cập nhật thành công');
        } else {
            return redirect('/user/index')->with('success', 'Cập nhật thất bại');
        }
    }

    public function showFormResetpw()
    {
        return view('frontend.verify.resetpw');
    }

    public function checkResetpw(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::checkUser($validatedData['email'], null)->first();
        if ($user) {
            $this->sendOtp($validatedData['email'], $user->fullname);

            // Lưu validatedData và chuyển hướng đến view nhập mã xác thực
            Session::put('validatedData', $validatedData);
            Session::put('route', 'verify.otp.resetpw');
            return redirect('/verify/otp/form')->with('success', 'Mã xác thực đã được gửi vào email bạn cung cấp, vui lòng kiểm tra trong đó');
        } else {
            return redirect('/verify/resetpw')->with('error', 'Email không tồn tại, vui lòng nhập lại');
        }
    }

    public function resetpw(Request $request)
    {
        $otpFromUser = $request->input('otp');
        $otpFromSession = Session::get('code');

        if ($otpFromUser == $otpFromSession) {
            // Mã OTP đúng, tiến hành tạo tài khoản
            $validatedData = Session::get('validatedData');
            $pass = random_int(10000000, 99999999);
            $password = Hash::make($pass);
            $update = User::where('email', $validatedData['email'])->update(['password' => $password]);
            if ($update > 0) {
                $user = User::where('email', $validatedData['email'])->first();
                if ($user) {
                    $this->sendPassword($user->email, $user->fullname, $pass);
                    // Xóa mã OTP khỏi Session sau khi đã sử dụng
                    Session::forget('code');
                    Session::forget('validatedData');
                    Session::forget('route');
                    return redirect('/user/login')->with('success', 'Mật khẩu mới đã được gửi vào email bạn cung cấp, vui lòng kiểm tra trong hòm thư!');
                }
            } else {
                return redirect('/verify/resetpw')->with('error', 'Có lỗi khi cập nhật mật khẩu, vui lòng thử lại sau!');
            }
        } else {
            return redirect('/verify/otp/form')->with('error', 'Mã xác thực không đúng. Vui lòng thử lại.');
        }
    }

    // public function testEmail()
    // {
    //     $name = 'test send email';
    //     Mail::send('backend.emails.test', compact('name'), function ($email) {
    //         $email->to('ahavyvy@gmail.com')->subject('Your Subject Here');
    //     });
    // }

    public function sendOtp($emailAddress, $name)
    {
        $code = random_int(100000, 999999);
        try {
            Mail::send('backend.emails.sendOtp', compact('emailAddress', 'name', 'code'), function ($email) use ($emailAddress, $name, $code) {
                $email->to($emailAddress, $name)->subject('Mã xác thực: ' . $code);
                Session::put('code', $code);
            });
        } catch (\Exception $e) {
            // Xử lý lỗi gửi email ở đây, ví dụ: log lỗi hoặc thông báo người dùng
            return redirect('/user/login')->with('error', 'Có lỗi xảy ra khi gửi mã xác thực.');
        }
    }

    public function sendPassword($emailAddress, $name, $password)
    {
        try {
            Mail::send('backend.emails.sendPassword', compact('emailAddress', 'name', 'password'), function ($email) use ($emailAddress, $name, $password) {
                $email->to($emailAddress, $name)->subject('Mật khẩu mới của bạn: ' . $password);
            });
        } catch (\Exception $e) {
            // Xử lý lỗi gửi email ở đây, ví dụ: log lỗi hoặc thông báo người dùng
            return redirect('/verify/resetpw')->with('error', 'Có lỗi xảy ra khi gửi mật khẩu.');
        }
    }

    public function showVerifyOtpForm()
    {
        return view('frontend.verify.otp');
    }

    public function verifyAccount(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:200',
            'phone' => 'required|min:10|max:11',
            'address' => 'required|max:200',
            'password' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
        $user = User::checkUser($validatedData['email'], $validatedData['phone']);
        if ($user->count() == 0) {
            $this->sendOtp($validatedData['email'], $validatedData['fullname']);

            // Lưu validatedData và chuyển hướng đến view nhập mã xác thực
            Session::put('validatedData', $validatedData);
            Session::put('route', 'verify.otp.account');
            return redirect('/verify/otp/form')->with('success', 'Mã xác thực đã được gửi vào email bạn đăng ký, vui lòng kiểm tra trong hòm thư!');
        } else {
            return redirect('/user/login')->with('error', 'Email hoặc Số điện thoại đã có người sử dụng');
        }
    }

    public function showFormChangepw()
    {
        return view('frontend.user.changepw');
    }

    public function changepw(Request $request)
    {
        $validatedData = $request->validate([
            'passOld' => 'required',
            'passNew' => 'required',
            'rePassNew' => 'required',
        ]);
        if ($validatedData['passNew'] != $validatedData['rePassNew']) {
            return redirect()->route('user.showFormChangepw')->with('error', 'Mật khẩu mới phải giống nhau');
        } else {
            $update = User::whereId(session()->get('user_id'))->update(['password' => Hash::make($validatedData['passNew'])]);
            if ($update > 0) {
                return redirect()->route('user.index')->with('success', 'Mật khẩu đã được đổi thành công');
            } else {
                return redirect()->route('user.index')->with('error', 'Có lỗi khi đổi mật khẩu');
            }
        }
    }
}
