<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Nette\Utils\Random;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 5;

        // Lấy danh sách menu đã phân trang
        $categories = Category::paginate($perPage);

        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all();
        return view('backend.categories.create', compact('menus'));
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
            'name' => 'required|max:200',
            'menu_id' => 'required|numeric|min:1',
            'image' => 'required|image', // Thêm rule image để đảm bảo đây là tập tin hình ảnh
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

            $category = Category::create($validatedData);
            return redirect('/admin/categories')->with('success', 'Thêm thành công');
        } else {
            return redirect('/admin/categories')->with('error', 'Có lỗi khi tải hình ảnh lên');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $menus = Menu::all();
        return view('backend.categories.edit', compact('category', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:200',
            'menu_id' => 'required|numeric|min:1',
            'image' => 'nullable|image',
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
            $category = Category::find($id);
            $oldImagePath = storage_path('app/public/backend/assets/img/') . $category->image;

            if (file_exists($oldImagePath) && $imagePath !== false) {
                unlink($oldImagePath);
            }
        } else {
            // Nếu không có ảnh mới, loại bỏ trường 'image' khỏi dữ liệu kiểm tra
            unset($validatedData['image']);
        }
        Category::whereId($id)->update($validatedData);
        return redirect('/admin/categories')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $oldImagePath = storage_path('app/public/backend/assets/img/') . $category->image;
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
        $category->delete();
        return redirect('/admin/categories')->with('success', 'Xóa thành công');
    }
}
