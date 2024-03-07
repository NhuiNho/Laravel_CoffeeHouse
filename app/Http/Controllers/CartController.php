<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session()->has('user_id')) {
            if (session()->has('cart')) {
                $cart = session()->get('cart');
                // Lấy danh sách product_id từ giỏ hàng
                $productIds = array_column($cart, 'product_id');
            } else {
                return redirect()->route('product.index')->with('warning', 'Giỏ hàng chưa có sản phẩm nào, vui lòng thêm chúng tại đây!');
            }
        } else {
            $cart = Cart::where('user_id', session()->get('user_id'))->get();
            if ($cart->count() != 0) {
                // Lấy danh sách product_id từ giỏ hàng
                $productIds = array_column($cart->toArray(), 'product_id');
            } else {
                return redirect()->route('product.index')->with('warning', 'Giỏ hàng chưa có sản phẩm nào, vui lòng thêm chúng tại đây!');
            }
        }
        // Thực hiện truy vấn để lấy thông tin chi tiết từ database
        $products = Product::whereIn('id', $productIds)->get();
        return view('frontend.cart.index', compact('cart', 'products'));
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
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|numeric|min:1',
            'size_id' => 'required|numeric|min:1',
            'topping_id' => 'required|numeric|min:1'
        ]);

        $validatedData['product_id'] = $id;

        if (!session()->has('user_id')) {
            // Lấy giỏ hàng từ session, nếu không có, tạo mới
            $cart = $request->session()->get('cart', []);
            $flag = false;
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            if (count($cart) != 0) {
                foreach ($cart as $key => $value) {
                    if ($validatedData['product_id'] == $value['product_id']) {
                        if ($validatedData['size_id'] == $value['size_id'] && $validatedData['topping_id'] == $value['topping_id']) {
                            $cart[$key]['quantity'] += $validatedData['quantity'];
                            $flag = true;
                        }
                    }
                }
                if (!$flag) {
                    $cart[] = $validatedData;
                }
            } else {
                $cart[] = $validatedData;
            }

            // Lưu giỏ hàng vào session
            $request->session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Sản phẩm được thêm vào giỏ hàng thành công');
        } else {
            $validatedData['user_id'] = session()->get('user_id');
            $carts = Cart::where('user_id', $validatedData['user_id'])->get();
            $flag = false;
            foreach ($carts as $key => $value) {
                if ($validatedData['product_id'] == $value['product_id']) {
                    if ($validatedData['size_id'] == $value['size_id'] && $validatedData['topping_id'] == $value['topping_id']) {
                        Cart::where('id', $key + 1)->update(['quantity' => $value['quantity'] + $validatedData['quantity']]);
                        $flag = true;
                        return redirect()->route('cart.index')->with('success', 'Sản phẩm được thêm vào giỏ hàng thành công');
                    }
                }
            }
            $createCart = Cart::create($validatedData);
            if ($createCart) {
                return redirect()->route('cart.index')->with('success', 'Sản phẩm được thêm vào giỏ hàng thành công');
            } else {
                return redirect()->route('cart.index')->with('success', 'Sản phẩm thêm vào giỏ hàng thất bại');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (session()->has('user_id')) {
            Cart::find($id)->delete();
        } else {
            $cart = Session::get('cart', []);

            foreach ($cart as $key => $item) {
                if ($key == $id) {
                    unset($cart[$key]);
                }
            }
            if (count($cart) == 0) {
                Session::forget('cart');
            } else {
                Session::put('cart', $cart);
            }
        }
        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clearCart()
    {
        if (session()->has('user_id')) {
            Cart::where('user_id', session()->get('user_id'))->delete();
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.index')->with('success', 'Đã xóa toàn bộ sản phẩm khỏi giỏ hàng.');
    }
}
