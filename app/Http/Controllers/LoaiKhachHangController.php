<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblloaikhachhang;
use App\Models\tblloaitaikhoan;

class LoaiKhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loaikhachhangs = tblloaikhachhang::all();
        return view('loaikhachhang.index', compact('loaikhachhangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loaikhachhang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'MaLoaiKH' => 'required|string|unique:tblloaikhachhang,MaLoaiKH|max:10',
            'TenLoaiKH' => 'required|string|max:255',
            'MoTa' => 'nullable|string',
        ]);

        // Tạo mới loại khách hàng
        tblloaikhachhang::create([
            'MaLoaiKH' => $request->MaLoaiKH,
            'TenLoaiKH' => $request->TenLoaiKH,
            'MoTa' => $request->MoTa,
        ]);

        // Quay lại danh sách với thông báo
        return redirect()->route('loaikhachhang.index')->with('success', 'Thêm mới loại khách hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $loaikhachhang = tblloaikhachhang::findOrFail($id);
        return view('loaikhachhang.edit', compact('loaikhachhang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TenLoaiKH' => 'required|string|max:255',
            'MoTa' => 'nullable|string',
        ]);

        $loaikhachhang = tblloaikhachhang::findOrFail($id);
        $loaikhachhang->update([
            'TenLoaiKH' => $request->TenLoaiKH,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('loaikhachhang.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loaiKH = tblloaikhachhang::findOrFail($id);
        $loaiKH->delete();
        return redirect()->route('loaikhachhang.index')->with('success', 'Xóa loại khách hàng thành công!');
    }
}
