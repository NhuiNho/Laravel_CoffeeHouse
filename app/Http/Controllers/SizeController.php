<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 5;
        $sizes = Size::paginate($perPage);
        return view('backend.product_details.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::all()->reject(function ($item) {
            return $item->id === 100;
        })->unique('name');
        return view('backend.product_details.sizes.create', compact('sizes'));
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
            'name' => 'required|max:150',
            'price' => 'required|numeric|max:99999999'
        ]);
        $validatedData['description_name'] = $validatedData['name'] . ' ' . $validatedData['price'];
        $size = Size::create($validatedData);
        return redirect('/admin/product_details/sizes')->with('success', 'Tạo thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $size = Size::findOrFail($id);
        return view('backend.product_details.sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('backend.product_details.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required||max:200',
            'price' => 'required|numeric|max:99999999'
        ]);
        $validatedData['description_name'] = $validatedData['name'] . ' ' . $validatedData['price'];
        Size::whereId($id)->update($validatedData);
        return redirect('/admin/product_details/sizes')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Size  $size
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect('/admin/product_details/sizes')->with('success', 'Xóa thành công');
    }
}
