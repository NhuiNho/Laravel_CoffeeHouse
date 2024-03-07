<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status)
    {
        if (session()->has('user_id')) {
            if ($status == 'all') {
                $orders = Order::where('user_id', session()->get('user_id'))
                    ->orderBy('id', 'desc')
                    ->get();

                return view('frontend.order.index', compact('orders'));
            } else {
                return redirect('/');
            }
        } else if (session()->has('admin_id')) {
            if ($status == 'all') {
                $orders = Order::orderBy('order_status_id', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->get();
            } else {
                $orders = Order::where('order_status_id', $status)
                    ->orderBy('order_status_id', 'asc')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }

            return view('backend.orders.index', compact('orders'))->with('status', $status);
        } else if (session()->has('email_checkOrder')) {
            if ($status == 'all') {
                $orders = Order::where('email_receiver', session()->get('email_checkOrder'))->get();
                return view('frontend.order.index', compact('orders'));
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payment_methods = PaymentMethod::all();
        if (!session()->has('user_id')) {
            if (session()->has('cart')) {
                $cart = session()->get('cart');
                // Lấy danh sách product_id từ giỏ hàng
                $productIds = array_column($cart, 'product_id');

                // Thực hiện truy vấn để lấy thông tin chi tiết từ database
                $products = Product::whereIn('id', $productIds)->get();
            } else {
                return redirect()->route('product.index')->with('warning', 'Giỏ hàng chưa có sản phẩm nào, vui lòng thêm chúng tại đây!');
            }
            return view('frontend.order.create', compact('cart', 'products', 'payment_methods'));
        } else {
            $user = User::find(session('user_id'));
            $cart = Cart::where('user_id', $user->id)->get();
            // Lấy danh sách product_id từ giỏ hàng
            $productIds = array_column($cart->toArray(), 'product_id');

            // Thực hiện truy vấn để lấy thông tin chi tiết từ database
            $products = Product::whereIn('id', $productIds)->get();
            return view('frontend.order.create', compact('cart', 'products', 'payment_methods', 'user'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_receiver' => 'required|max:50',
            'address_receiver' => 'required|max:200',
            'email_receiver' => 'required|email',
            'phone_receiver' => 'required|max:10|min:10',
            'payment_method_id' => 'required|numeric',
            'total_price' => 'required|numeric|max:99999999',
            'voucher_id' => '',
        ]);
        if ($validatedData['voucher_id'] == '') {
            $validatedData['voucher_id'] = null;
        }
        if (!session()->has('user_id')) {
            $UserController = new UserController();
            $UserController->sendOtp($validatedData['email_receiver'], $validatedData['name_receiver']);

            // Lưu validatedData và chuyển hướng đến view nhập mã xác thực
            Session::put('validatedData', $validatedData);
            Session::put('route', 'verify.otp.order');
            return redirect('/verify/otp/form')->with('success', 'Mã xác thực đã được gửi vào email bạn đăng ký, vui lòng kiểm tra trong hòm thư!');
        } else {
            $validatedData['user_id'] = session()->get('user_id');
            $order = Order::create($validatedData);
            if ($order) {
                $this->sendOrder($order);
                $cart = Cart::where('user_id', $validatedData['user_id'])->get();
                foreach ($cart as $key => $value) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $value->product_id,
                        'size_id' => $value->size_id,
                        'topping_id' => $value->topping_id,
                        'quantity' => $value->quantity,
                    ]);
                }
                $cart->each->delete();
                return redirect()->route('product.index')->with('success', 'Đơn hàng được đặt thành công');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (session()->has('user_id')) {
            $user_id = session()->get('user_id');
            $order = Order::findOrFail($id);
            if ($order->user_id == $user_id) {
                return view('frontend.order.show', compact('order'));
            } else {
                return redirect()->route('home')->with('warning', 'Đây không phải đơn hàng của bạn, bạn không thể xem!');
            }
        } else if (session()->has('admin_id')) {
            $order = Order::findOrFail($id);
            return view('backend.orders.show', compact('order'));
        } else if (session()->has('email_checkOrder')) {
            $email = session()->get('email_checkOrder');
            $order = Order::where('email_receiver', $email)
                ->where('id', $id)
                ->first();
            if ($order) {
                return view('frontend.order.show', compact('order'));
            } else {
                return redirect()->route('home')->with('warning', 'Đây không phải đơn hàng của bạn, bạn không thể xem!');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'order_status_id' => 'required|numeric',
        ]);
        Order::whereId($id)->update($validatedData);
        return redirect()->route('admin.order.show', $id)->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function addCoupon(Request $request)
    {
        $validatedData = $request->validate([
            'coupon' => 'required',
        ]);

        $voucher = Voucher::where('code', $validatedData['coupon'])->first();

        if ($voucher) {
            // Mã giảm giá hợp lệ
            return redirect()->route('order.create')->with('success', 'Mã giảm giá đã được áp dụng thành công')->with('voucher', $voucher);
        } else {
            // Mã giảm giá không hợp lệ
            return redirect()->route('order.create')->with('error', 'Mã giảm giá không đúng')->with('coupon', $validatedData['coupon']);
        }
    }

    public function cancel($id)
    {
        if (session()->has('user_id')) {
            $order = Order::findOrFail($id);
            if ($order && $order->user_id == session()->get('user_id')) {
                $order->update(['order_status_id' => 4]);
                return redirect()->route('order.index')->with('success', 'Hủy đơn thành công');
            } else {
                return redirect()->route('order.index')->with('error', 'Đây không phải đơn hàng của bạn');
            }
        } else if (session()->has('admin_id')) {
            Order::whereId($id)->update(['order_status_id' => 4]);
            return redirect()->route('admin.order.show', $id)->with('success', 'Hủy đơn thành công');
        }
    }

    public function rebook($id)
    {
        if (session()->has('user_id')) {
            $cart = Cart::where('user_id', session()->get('user_id'))->get();
            if ($cart->count() != 0) {
                $cart->each->delete();
            }
            $order = Order::findOrFail($id);
            foreach ($order->order_details as $order_detail) {
                Cart::create([
                    'user_id' => session()->get('user_id'),
                    'product_id' => $order_detail->product_id,
                    'size_id' => $order_detail->size_id,
                    'topping_id' => $order_detail->topping_id,
                    'quantity' => $order_detail->quantity,
                ]);
            }
            return redirect()->route('cart.index');
        }
    }

    public function sendOrder($order)
    {
        try {
            Mail::send('backend.emails.sendOrder', compact('order'), function ($email) use ($order) {
                $email->to($order->email_receiver, $order->name_receiver)->subject('Chúc mừng bạn đặt hàng thành công');
            });
        } catch (\Exception $e) {
            // Xử lý lỗi gửi email ở đây, ví dụ: log lỗi hoặc thông báo người dùng
            return redirect('/verify/resetpw')->with('error', 'Có lỗi xảy ra khi gửi mật khẩu.');
        }
    }

    public function storeOrder(Request $request)
    {
        $otpFromUser = $request->input('otp');
        $otpFromSession = Session::get('code');

        if ($otpFromUser == $otpFromSession) {
            // Mã OTP đúng, tiến hành tạo tài khoản
            $validatedData = Session::get('validatedData');
            $order = Order::create($validatedData);
            if ($order) {
                Session::put('email_checkOrder', $validatedData['email_receiver']);
                // Xóa mã OTP khỏi Session sau khi đã sử dụng
                Session::forget('code');
                Session::forget('validatedData');
                Session::forget('route');

                $this->sendOrder($order);
                $cart = session()->get('cart');
                foreach ($cart as $key => $value) {
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $value['product_id'],
                        'size_id' => $value['size_id'],
                        'topping_id' => $value['topping_id'],
                        'quantity' => $value['quantity'],
                    ]);
                }

                Session::forget('cart');
                return redirect()->route('order.index', ['status' => 'all'])->with('success', 'Đơn hàng được đặt thành công');
            }
        } else {
            return redirect('/verify/otp/form')->with('error', 'Mã xác thực không đúng. Vui lòng thử lại.');
        }
    }

    public function searchOrder()
    {
        return view('frontend.verify.checkEmail');
    }

    public function orderCheck(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
        $order = Order::where('email_receiver', $validatedData['email']);
        if ($order->count() > 0) {
            $order = $order->first();
            $UserController = new UserController();
            $UserController->sendOtp($validatedData['email'], $order->name_receiver);

            // Lưu validatedData và chuyển hướng đến view nhập mã xác thực
            Session::put('validatedData', $validatedData);
            Session::put('route', 'verify.otp.getOrder');
            return redirect('/verify/otp/form')->with('success', 'Mã xác thực đã được gửi vào email bạn cung cấp, vui lòng kiểm tra trong đó');
        } else {
            return redirect('/verify/resetpw')->with('error', 'Email không tồn tại, vui lòng nhập lại');
        }
    }

    public function getOrder(Request $request)
    {
        $otpFromUser = $request->input('otp');
        $otpFromSession = Session::get('code');

        if ($otpFromUser == $otpFromSession) {
            // Mã OTP đúng, tiến hành tạo tài khoản
            $validatedData = Session::get('validatedData');

            $orders = Order::where('email_receiver', $validatedData['email'])->get();
            if ($orders) {
                Session::put('email_checkOrder', $validatedData['email']);
                // Xóa mã OTP khỏi Session sau khi đã sử dụng
                Session::forget('code');
                Session::forget('validatedData');
                Session::forget('route');
                return redirect()->route('order.index', ['status' => 'all']);
            }
        } else {
            return redirect('/verify/otp/form')->with('error', 'Mã xác thực không đúng. Vui lòng thử lại.');
        }
    }
}
