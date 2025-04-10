<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblloaihoatdong;

class LoaiHoatDongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loaihoatdongs = tblloaihoatdong::all();
        return view('loaihoatdong.index', compact('loaihoatdongs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loaihoatdong.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'MaLoaiHD' => 'required|unique:tblloaihoatdong,MaLoaiHD|max:10',
            'TenLoaiHD' => 'required|string|max:255',
            'MoTa' => 'nullable|string'
        ]);

        tblloaihoatdong::create([
            'MaLoaiHD' => $request->MaLoaiHD,
            'TenLoaiHD' => $request->TenLoaiHD,
            'MoTa' => $request->MoTa
        ]);

        return redirect()->route('loaihoatdong.index')->with('success', 'Thêm mới loại hoạt động thành công.');
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
        $loaihoatdong = tblloaihoatdong::where('MaLoaiHD', $id)->first();
        return view('loaihoatdong.edit', compact('loaihoatdong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TenLoaiHD' => 'required|string|max:255',
            'MoTa' => 'nullable|string',
        ]);

        $loaihoatdong = tblloaihoatdong::where('MaLoaiHD', $id)->first();
        $loaihoatdong->update([
            'TenLoaiHD' => $request->TenLoaiHD,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('loaihoatdong.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loaihoatdong = tblloaihoatdong::where('MaLoaiHD', $id)->first();

        if (!$loaihoatdong) {
            return redirect()->route('loaihoatdong.index')->with('error', 'Loại hoạt động không tồn tại.');
        }

        $loaihoatdong->delete();

        return redirect()->route('loaihoatdong.index')->with('success', 'Xóa loại hoạt động thành công.');
    }
}
