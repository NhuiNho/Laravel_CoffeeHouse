<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('admin_id')) {
            $perPage = 5;
            $admins = Admin::paginate($perPage);
            $ad = Admin::findOrFail(session()->get('admin_id'));
            return view('backend.admins.index', compact('admins', 'ad'));
        } else {
            return redirect()->route('admin.login')->with('error', 'Vui lòng đăng nhập trước!');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Admin::findOrFail(session()->get('admin_id'));
        if ($admin->admin_status_id == 1) {
            $admin_statuses = AdminStatus::all();
            return view('backend.admins.create', compact('admin_statuses'));
        } else {
            return redirect('/admin');
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
            'name' => 'required|max:200',
            'email' => 'required|email|max:50',
            'password' => 'required|max:255',
            'admin_status_id' => 'required|numeric',
        ]);
        $admin = Admin::checkAdmin($validatedData['email']);
        if (!$admin) {
            $passnew = Hash::make($validatedData['password']);
            $validatedData['password'] = $passnew;
            $admin = Admin::create($validatedData);
            return redirect('/admin')->with('success', 'Tạo thành công!');
        } else {
            return redirect('/admin/create')->with('error', 'Email đã tồn tại!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('backend.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail(session()->get('admin_id'));
        if ($admin->admin_status_id == 1) {
            $admin_statuses = AdminStatus::all();
            $admin = Admin::findOrFail($id);
            return view('backend.admins.edit', compact('admin', 'admin_statuses'));
        } else {
            return redirect('/admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|email|max:50',
            'password' => 'required||max:255',
            'admin_status_id' => 'required|numeric',
        ]);
        $passnew = Hash::make($validatedData['password']);
        $validatedData['password'] = $passnew;
        Admin::whereId($id)->update($validatedData);
        return redirect('/admin')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail(session()->get('admin_id'));
        if ($admin->admin_status_id == 1) {
            Admin::findOrFail($id)->delete();
        }
        return redirect('/admin')->with('success', 'Xóa thành công');
    }
}
