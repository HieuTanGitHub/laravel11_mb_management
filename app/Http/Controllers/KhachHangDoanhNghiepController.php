<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblkhachhangdoanhnghiep;

class KhachHangDoanhNghiepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khachhangs = tblkhachhangdoanhnghiep::all();
        return view('khachhangdoanhnghiep.index', compact('khachhangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('khachhangdoanhnghiep.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'MaKH' => 'required|string|max:10|unique:tblkhachhangdoanhnghiep,MaKH',
            'TenDN' => 'required|string|max:255',
            'NgayThanhLap' => 'required|date',
            'MaSoThue' => 'required|string|max:50|unique:tblkhachhangdoanhnghiep,MaSoThue',
            'TenDaiDienPL' => 'required|string|max:255',
            'ChucVu' => 'required|string|max:100',
            'TenKeToan' => 'required|string|max:255',
            'CCCDKT' => 'required|string|max:50',
            'EmailKT' => 'required|email|max:255',
            'VonDieuLe' => 'required|numeric|min:0',
            'DiaChiDN' => 'required|string|max:255',
            'HoSoDN' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        $data = $request->except('HoSoDN');

        if ($request->hasFile('HoSoDN')) {
            $file = $request->file('HoSoDN');
            $filePath = $file->store('hoso_doanhnghiep', 'public'); // Lưu file vào storage/app/public/hoso_doanhnghiep
            $data['HoSoDN'] = $filePath;
        }

        $data['NgayTao'] = now();
        $data['NguoiTao'] = auth()->user()->name ?? 'Admin'; // Lấy tên người tạo từ Auth hoặc mặc định là Admin

        tblkhachhangdoanhnghiep::create($data);

        return redirect()->route('khachhangdoanhnghiep.index')->with('success', 'Khách hàng doanh nghiệp đã được thêm thành công!');
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
        $khachhang = tblkhachhangdoanhnghiep::findOrFail($id);
        return view('khachhangdoanhnghiep.edit', compact('khachhang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TenDN' => 'required|max:255',
            'MaSoThue' => 'required|unique:tblkhachhangdoanhnghiep,MaSoThue,' . $id,
            'TenDaiDienPL' => 'required|max:255',
            'ChucVu' => 'required|max:255',
            'EmailKT' => 'required|email',
        ]);

        $khachhang = tblkhachhangdoanhnghiep::findOrFail($id);

        $khachhang->update([
            'TenDN' => $request->TenDN,
            'MaSoThue' => $request->MaSoThue,
            'TenDaiDienPL' => $request->TenDaiDienPL,
            'ChucVu' => $request->ChucVu,
            'EmailKT' => $request->EmailKT,
        ]);

        if ($request->hasFile('HoSoDN')) {
            // Xóa file cũ nếu có
            if ($khachhang->HoSoDN && Storage::exists('public/' . $khachhang->HoSoDN)) {
                Storage::delete('public/' . $khachhang->HoSoDN);
            }

            // Lưu file mới
            $filePath = $request->file('HoSoDN')->store('hoso_doanhnghiep', 'public');
            $khachhang->update(['HoSoDN' => $filePath]);
        }

        return redirect()->route('khachhangdoanhnghiep.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
