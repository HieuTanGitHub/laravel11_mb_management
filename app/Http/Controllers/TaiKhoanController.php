<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbltaikhoan;
use App\Models\tblloaithe;
use App\Models\tblnhanvien;
use App\Models\tblkhachhang;
use Carbon\Carbon;

class TaiKhoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taiKhoans = tbltaikhoan::with(['loaiThe', 'nhanVien', 'khachHang'])->get();
        return view('taikhoan.index', compact('taiKhoans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $loaithe = tblloaithe::all();
        $nhanvien = tblnhanvien::all();
        $khachhang = tblkhachhang::all();

        return view('taikhoan.create', compact('loaithe', 'nhanvien', 'khachhang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'SoTK'       => 'required|unique:tbltaikhoan,SoTK|string|max:20',
            'SoDuTK'     => 'required|numeric|min:0',
            'NgayMo'     => 'required|date',
            'NgayDong'   => 'nullable|date|after_or_equal:NgayMo',
            'TrangThai'  => 'required',
            'MaLoaiThe'  => 'required|exists:tblloaithe,MaLoaiThe',
            'MaNV'       => 'required|exists:tblnhanvien,MaNV',
            'MaKH'       => 'required|exists:tblkhachhang,MaKH',
            'NgayTao'    => 'required|date',
        ]);

        try {
            // Create a new account record
            tbltaikhoan::create([
                'SoTK'       => $request->SoTK,
                'SoDuTK'     => $request->SoDuTK,
                'NgayMo'     => Carbon::parse($request->NgayMo),
                'NgayDong'   => $request->NgayDong ? Carbon::parse($request->NgayDong) : null,
                'TrangThai'  => $request->TrangThai,
                'MaLoaiThe'  => $request->MaLoaiThe,
                'MaNV'       => $request->MaNV,
                'MaKH'       => $request->MaKH,
                'NgayTao'    => Carbon::parse($request->NgayTao),
            ]);

            return redirect()->route('taikhoan.index')->with('success', 'Tài khoản đã được tạo thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tạo tài khoản: ' . $e->getMessage());
        }
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
        $taiKhoan = tbltaikhoan::where('SoTK', $id)->first();
        $loaiThes = tblloaithe::all();
        $nhanViens = tblnhanvien::all();
        $khachHangs = tblkhachhang::all();

        return view('taikhoan.edit', compact('loaiThes', 'nhanViens', 'khachHangs', 'taiKhoan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'SoDuTK' => 'required|numeric|min:0',
            'SoTK' => 'required|numeric|min:0',
            'TrangThai' => 'required|boolean',
            'MaLoaiThe' => 'required|exists:tblloaithe,MaLoaiThe',
            'MaNV' => 'required|exists:tblnhanvien,MaNV',
            'MaKH' => 'required|exists:tblkhachhang,MaKH',
        ]);

        // Tìm tài khoản cần cập nhật
        $taiKhoan = tbltaikhoan::where('SoTK', $id)->first();

        // Cập nhật dữ liệu
        $taiKhoan->update([
            'SoTK' => $request->SoTK,
            'SoDuTK' => $request->SoDuTK,
            'TrangThai' => $request->TrangThai,
            'MaLoaiThe' => $request->MaLoaiThe,
            'MaNV' => $request->MaNV,
            'MaKH' => $request->MaKH,
        ]);

        // Chuyển hướng về danh sách với thông báo thành công
        return redirect()->route('taikhoan.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $taiKhoan = tbltaikhoan::where('SoTK', $SoTK)->first();
        $taiKhoan->delete();

        return redirect()->route('taikhoan.index')->with('success', 'Tài khoản đã được xóa thành công.');
    }
}
