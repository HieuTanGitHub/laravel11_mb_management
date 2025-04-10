<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblloaithe;

class LoaiTheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loaithe = tblloaithe::all();
        return view('loaithe.index', compact('loaithe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loaithe.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation dữ liệu nhập vào
        $request->validate([
            'MaLoaiThe' => 'required|unique:tblloaithe,MaLoaiThe|max:10',
            'TenLoaiThe' => 'required|max:255',
        ]);

        // Tạo mới bản ghi
        tblloaithe::create([
            'MaLoaiThe' => $request->MaLoaiThe,
            'TenLoaiThe' => $request->TenLoaiThe,
        ]);

        // Quay về trang danh sách với thông báo thành công
        return redirect()->route('loaithe.index')->with('success', 'Loại thẻ đã được tạo thành công!');
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
        $loaithe = tblloaithe::where('MaLoaiThe', $id)->first();
        return view('loaithe.edit', compact('loaithe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TenLoaiThe' => 'required|string|max:255'
        ]);

        $loaithe = tblloaithe::where('MaLoaiThe', $id)->first();
        $loaithe->update([
            'TenLoaiThe' => $request->TenLoaiThe
        ]);

        return redirect()->route('loaithe.index')->with('success', 'Cập nhật loại thẻ thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $loaithe = tblloaithe::where('MaLoaiThe', $id)->first();
            $loaithe->delete();

            return redirect()->route('loaithe.index')->with('success', 'Xóa loại thẻ thành công.');
        } catch (\Exception $e) {
            return redirect()->route('loaithe.index')->with('error', 'Xóa loại thẻ thất bại.');
        }
    }
}
