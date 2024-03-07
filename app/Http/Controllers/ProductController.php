<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Models\Topping;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('admin_id')) {
            $perPage = 10;

            // Lấy danh sách menu đã phân trang
            $products = Product::paginate($perPage);

            return view('backend.products.index', compact('products'));
        } else {
            $products = Product::all();
            $categories = Category::all();

            return view('frontend.products.index', compact('products', 'categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create', compact('categories'));
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
            'name' => 'required|max:50',
            'price' => 'required|numeric|min:1|max:99999999',
            'category_id' => 'required|numeric|min:1',
            'image' => 'nullable|image',
            'description' => 'required',
            'sale_price' => 'required|numeric|min:0|max:99999999',
        ]);

        // Xử lý lưu trữ hình ảnh
        if ($request->hasFile('image')) {
            $currentTime = time();
            $randomString = random_int(1000, 9999);

            // Kết hợp thời gian và chuỗi ngẫu nhiên để tạo tên file
            $tenfile = $currentTime . $randomString;

            // Lấy đuôi định dạng của tập tin
            $extension = $request->file('image')->getClientOriginalExtension();

            // Kết hợp đuôi định dạng vào tên file
            $tenfileWithExtension = $tenfile . '.' . $extension;

            // Lưu file vào thư mục
            $imagePath = $request->file('image')->storeAs('public/backend/assets/img/', $tenfileWithExtension);
            $validatedData['image'] = $tenfileWithExtension;

            $product = Product::create($validatedData);
            return redirect("/admin/product_details/create/{$product->id}")->with('success', 'Thêm thành công, hãy tiến hành thêm chi tiết sản phẩm cho hoàn thiện nhé!');
        } else {
            return redirect('/admin/products')->with('error', 'Có lỗi khi tải hình ảnh lên');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('backend.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'price' => 'required|numeric|min:1|max:99999999',
            'category_id' => 'required|numeric|min:1',
            'image' => 'nullable|image',
            'description' => 'required',
            'sale_price' => 'required|numeric|min:0|max:99999999',
        ]);

        if ($request->hasFile('image')) {
            $currentTime = time();
            $randomString = random_int(1000, 9999);

            // Kết hợp thời gian và chuỗi ngẫu nhiên để tạo tên file
            $tenfile = $currentTime . $randomString;

            // Lấy đuôi định dạng của tập tin
            $extension = $request->file('image')->getClientOriginalExtension();

            // Kết hợp đuôi định dạng vào tên file
            $tenfileWithExtension = $tenfile . '.' . $extension;

            // Lưu file vào thư mục
            $imagePath = $request->file('image')->storeAs('public/backend/assets/img/', $tenfileWithExtension);
            $validatedData['image'] = $tenfileWithExtension;

            // Lấy thông tin sản phẩm cũ
            $product = Product::find($id);
            $oldImagePath = storage_path('app/public/backend/assets/img/') . $product->image;

            if (file_exists($oldImagePath) && $imagePath !== false) {
                unlink($oldImagePath);
            }
        } else {
            // Nếu không có ảnh mới, loại bỏ trường 'image' khỏi dữ liệu kiểm tra
            unset($validatedData['image']);
        }

        Product::whereId($id)->update($validatedData);

        return redirect('/admin/products')->with('success', 'Cập nhật thành công');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $oldImagePath = storage_path('app/public/backend/assets/img/') . $product->image;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $product->delete();
        return redirect('/admin/products')->with('success', 'Xóa thành công');
    }
}
