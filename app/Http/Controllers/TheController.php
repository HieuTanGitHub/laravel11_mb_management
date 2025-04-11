<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblthe;
use App\Models\tblloaithe;
use App\Models\tblnhanvien;
use App\Models\tblkhachhang;

class TheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy danh sách thẻ cùng loại thẻ, nhân viên, khách hàng
        $theList = tblthe::with(['loaiThe', 'nhanvien', 'khachhang'])->get();
        return view('the.index', compact('theList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loaiThe = tblloaithe::all();
        $nhanviens = tblnhanvien::all();
        $khachhangs = tblkhachhang::all();
        return view('the.create', compact('loaiThe', 'nhanviens', 'khachhangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'SoThe' => 'required|string|unique:tblthe,SoThe',
            'NgayMo' => 'required|date',
            'NgayHetHan' => 'required|date|after:NgayMo',
            'MaLoaiThe' => 'required',
            'MaNV' => 'nullable',
            'MaKH' => 'nullable',
            'SoTK' => 'nullable|string',
        ]);

        tblthe::create([
            'SoThe' => $request->SoThe,
            'NgayMo' => $request->NgayMo,
            'NgayHetHan' => $request->NgayHetHan,
            'NgayDong' => $request->NgayDong,
            'MaLoaiThe' => $request->MaLoaiThe,
            'MaNV' => $request->MaNV,
            'MaKH' => $request->MaKH,
            'SoTK' => $request->SoTK,
            'NgayTao' => now(),
        ]);

        return redirect()->route('the.create')->with('success', 'Thêm thẻ thành công!');
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
        $loaitheList = tblloaithe::all();
        $nhanviens = tblnhanvien::all();
        $khachhangs = tblkhachhang::all();
        // Tìm thẻ theo ID
        $the = tblthe::where('SoThe', $id)->first();

        if (!$the) {
            return redirect()->route('the.index')->with('error', 'Thẻ không tồn tại');
        }

        // Trả về view edit với dữ liệu thẻ
        return view('the.edit', compact('the', 'loaitheList', 'nhanviens', 'khachhangs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm thẻ theo ID
        $the = tblthe::where('SoThe', $id)->first();

        if (!$the) {
            return redirect()->route('the.index')->with('error', 'Thẻ không tồn tại');
        }

        // Validate dữ liệu đầu vào
        $request->validate([
            'SoThe' => 'required|string|max:255',
            'NgayMo' => 'required',
            'NgayHetHan' => 'required',
            'NgayDong' => 'nullable',
            'MaLoaiThe' => 'required|string|max:255',
            'MaNV' => 'required|string|max:255',
            'MaKH' => 'required|string|max:255',
            'SoTK' => 'required|string|max:255',
            'NgayTao' => 'required|date',
        ]);

        // Cập nhật thông tin thẻ
        $the->update([
            'SoThe' => $request->SoThe,
            'NgayMo' => $request->NgayMo,
            'NgayHetHan' => $request->NgayHetHan,
            'NgayDong' => $request->NgayDong,
            'MaLoaiThe' => $request->MaLoaiThe,
            'MaNV' => $request->MaNV,
            'MaKH' => $request->MaKH,
            'SoTK' => $request->SoTK,
            'NgayTao' => $request->NgayTao,
        ]);

        // Chuyển hướng với thông báo thành công
        return redirect()->route('the.index')->with('success', 'Cập nhật thẻ thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tìm thẻ theo ID
        $the = tblthe::where('SoThe', $id)->first();

        if (!$the) {
            return redirect()->route('the.index')->with('error', 'Thẻ không tồn tại');
        }

        // Xóa thẻ
        $the->delete();

        // Chuyển hướng trở lại trang danh sách với thông báo thành công
        return redirect()->route('the.index')->with('success', 'Thẻ đã được xóa thành công');
    }
}
