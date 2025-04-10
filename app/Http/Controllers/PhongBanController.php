<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblphongban;

class PhongBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phongbans = tblphongban::all(); // Lấy tất cả phòng ban từ cơ sở dữ liệu

        return view('phongban.index', compact('phongbans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('phongban.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'MaPB' => 'required|unique:tblphongban,MaPB|max:10',
            'TenPB' => 'required|max:255',
        ]);

        // Tạo mới phòng ban
        tblphongban::create([
            'MaPB' => $request->MaPB,
            'TenPB' => $request->TenPB,
        ]);

        // Quay lại trang danh sách phòng ban với thông báo thành công
        return redirect()->route('phongban.index')->with('success', 'Thêm mới phòng ban thành công!');
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
        $phongban = tblphongban::where('MAPB', $id)->first(); // Lấy thông tin phòng ban theo mã

        return view('phongban.edit', compact('phongban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'TenPB' => 'required|string|max:255',
        ]);

        // Tìm phòng ban theo mã
        $phongban = tblphongban::where('MAPB', $id)->first();

        // Cập nhật thông tin phòng ban
        $phongban->update([
            'TenPB' => $request->TenPB,
        ]);

        return redirect()->route('phongban.index')->with('success', 'Phòng ban đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phongban = tblphongban::find($MaPB);

        if ($phongban) {
            $phongban->delete();
            return redirect()->route('phongban.index')->with('success', 'Phòng Ban đã được xóa thành công.');
        }

        return redirect()->route('phongban.index')->with('error', 'Phòng Ban không tồn tại.');
    }
}
