<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product_details = ProductDetail::where('product_id', $id)->get();
        if ($product_details->count() == 0) {
            $sizes = Size::all();
            $toppings = Topping::all();
            return view('backend.product_details.create', compact('sizes', 'toppings', 'id'));
        } else {
            return redirect("/admin/product_details/{$id}/edit")->with('success', 'Sản phẩm này đã có size, vui lòng chỉnh sửa ở đây!');
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
            'product_id' => 'required|integer',
            'quantitySize' => 'required|integer',
            'toppings' => ['required', 'array', 'min:1'],
        ]);
        $toppings = $validatedData['toppings'];
        unset($validatedData['toppings']);
        if ($validatedData['quantitySize'] == 0) {
            $validatedData['size_id'] = 100;
            unset($validatedData['quantitySize']);
            foreach ($toppings as $key => $value) {
                $validatedData['topping_id'] = $value;
                $product_detail = ProductDetail::create($validatedData);
            }
            return redirect('/admin/products')->with('success', 'Tạo thành công!');
        } else {
            $sizes = $validatedData['quantitySize'];
            unset($validatedData['quantitySize']);
            for ($i = 0; $i < $sizes; $i++) {
                $validatedData['size_id'] = $request->input('size_' . ($i + 1));
                foreach ($toppings as $key => $value) {
                    $validatedData['topping_id'] = $value;
                    $product_detail = ProductDetail::create($validatedData);
                }
            }
            return redirect('/admin/products')->with('success', 'Tạo thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!session()->has('admin_id')) {
            $product = Product::findOrFail($id);
            if ($product) {
                $related_products = Product::where('category_id', $product->category_id)->get();
                return view('frontend.products.details.show', compact('product', 'related_products'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_details = ProductDetail::where('product_id', $id)->get();
        if ($product_details->count() != 0) {
            $product = Product::findOrFail($id);
            $sizes = Size::all();
            $toppings = Topping::all();
            return view('backend.product_details.edit', compact('sizes', 'toppings', 'product'));
        } else {
            return redirect("/admin/product_details/{$id}/create")->with('error', 'Sản phẩm chưa có chi tiết, vui lòng thêm!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductDetail $productDetail)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantitySize' => 'required|integer',
            'toppings' => ['required', 'array', 'min:1'],
        ]);
        $toppings = $validatedData['toppings'];
        unset($validatedData['toppings']);
        ProductDetail::where('product_id', $request->input('product_id'))->delete();
        if ($validatedData['quantitySize'] == 0) {
            $validatedData['size_id'] = 100;
            unset($validatedData['quantitySize']);
            foreach ($toppings as $key => $value) {
                $validatedData['topping_id'] = $value;
                $product_detail = ProductDetail::create($validatedData);
            }
            return redirect('/admin/products')->with('success', 'Chỉnh sửa thành công!');
        } else {
            $sizes = $validatedData['quantitySize'];
            unset($validatedData['quantitySize']);
            for ($i = 0; $i < $sizes; $i++) {
                $validatedData['size_id'] = $request->input('size_' . ($i + 1));
                foreach ($toppings as $key => $value) {
                    $validatedData['topping_id'] = $value;
                    $product_detail = ProductDetail::create($validatedData);
                }
            }
            return redirect('/admin/products')->with('success', 'Chỉnh sửa thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductDetail  $productDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductDetail $productDetail)
    {
        //
    }
}
