<?php

namespace App\Http\Controllers;

use App\Models\Topping;
use Illuminate\Http\Request;

class ToppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 5;
        $toppings = Topping::paginate($perPage);
        return view('backend.product_details.toppings.index', compact('toppings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $toppings = Topping::all()->reject(function ($item) {
            return $item->id === 100;
        });
        return view('backend.product_details.toppings.create', compact('toppings'));
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
            'price' => 'required|numeric'
        ]);
        $topping = Topping::create($validatedData);
        return redirect('/admin/product_details/toppings')->with('success', 'Tạo thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topping = Topping::findOrFail($id);
        return view('backend.product_details.toppings.show', compact('topping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topping = Topping::findOrFail($id);
        return view('backend.product_details.toppings.edit', compact('topping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required||max:200',
            'price' => 'required|numeric|max:99999999'
        ]);
        Topping::whereId($id)->update($validatedData);
        return redirect('/admin/product_details/toppings')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Topping  $topping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topping = Topping::findOrFail($id);
        $topping->delete();
        return redirect('/admin/product_details/toppings')->with('success', 'Xóa thành công');
    }
}
