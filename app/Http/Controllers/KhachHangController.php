<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblkhachhang;


class KhachHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách khách hàng từ database
        $khachhangs = tblkhachhang::all();

        // Trả về view và truyền danh sách khách hàng
        return view('khachhang.index', compact('khachhangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $khachhangs = tblkhachhang::all();
        return view('khachhang.create', compact('khachhangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'MaKH' => 'required|unique:tblkhachhang,MaKH|max:50',
            'TenKH' => 'required|string|max:255',
            'CCCD' => 'required|digits:12|unique:tblkhachhang,CCCD',
            'Email' => 'required|email|unique:tblkhachhang,Email',
            'NgaySinh' => 'required|date',
            'DiaChi' => 'required|string|max:255',
            'SoTK' => 'required|string|max:255',
            'MaLoaiKH' => 'required|string|max:255',
            'SDT' => 'required|digits_between:10,11|unique:tblkhachhang,SDT',
        ]);
        $khachHang = new tblkhachhang();

        $khachHang->MaKH = $request->MaKH;
        $khachHang->TenKH = $request->TenKH;
        $khachHang->CCCD = $request->CCCD;
        $khachHang->Email = $request->Email;
        $khachHang->NgaySinh = $request->NgaySinh;
        $khachHang->DiaChi = $request->DiaChi;
        $khachHang->SDT = $request->SDT;
        $khachHang->MaLoaiKH = $request->MaLoaiKH;
        $khachHang->SoTK = $request->SoTK;

        $khachHang->save();


        // Redirect with success message
        return redirect()->back()->with('success', 'Khách hàng đã được thêm thành công!');
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
        $khachhang = tblkhachhang::where('MaKH', $id)->first();
        return view('khachhang.edit', compact('khachhang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'MaKH' => 'required|string|max:10',
            'TenKH' => 'required|string|max:255',
            'CCCD' => 'required|string|max:20|unique:tblkhachhang,CCCD,' . $id . ',MaKH',
            'Email' => 'required|email|max:255|unique:tblkhachhang,Email,' . $id . ',MaKH',
            'NgaySinh' => 'nullable|date',
            'DiaChi' => 'nullable|string|max:255',
            'MaLoaiKH' => 'required|string|max:10',
            'SDT' => 'required|string|max:15|unique:tblkhachhang,SDT,' . $id . ',MaKH',
            'SoTK' => 'nullable|string|max:20|unique:tblkhachhang,SoTK,' . $id . ',MaKH',
        ]);

        // Tìm khách hàng cần cập nhật
        $khachhang = tblkhachhang::where('MaKH', $id)->firstOrFail();

        // Cập nhật dữ liệu
        $khachhang->update([
            'MaKH' => $request->MaKH,
            'TenKH' => $request->TenKH,
            'CCCD' => $request->CCCD,
            'Email' => $request->Email,
            'NgaySinh' => $request->NgaySinh,
            'DiaChi' => $request->DiaChi,
            'MaLoaiKH' => $request->MaLoaiKH,
            'SDT' => $request->SDT,
            'SoTK' => $request->SoTK,
        ]);

        // Trả về thông báo thành công
        return redirect()->route('khachhang/create')->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
