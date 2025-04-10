<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblchucvu;
use App\Models\tblphongban;

class ChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chucvus = tblchucvu::with('phongban')->get();  // Use get() instead of all()
        return view('chucvu.index', compact('chucvus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phongbans = tblphongban::all(); // Lấy danh sách phòng ban
        return view('chucvu.create', compact('phongbans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenCV' => 'required|string|max:255',
            'MaPB' => 'required|exists:tblphongban,MaPB', // Kiểm tra MaPB có tồn tại trong bảng phòng ban
        ]);

        tblchucvu::create([
            'MaCV' => $request->MaCV,
            'TenCV' => $request->TenCV,
            'MaPB' => $request->MaPB,
        ]);

        return redirect()->route('chucvu.index')->with('success', 'Chức vụ đã được thêm thành công.');
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
        // Find the ChucVu record by its ID
        $chucvu = tblchucvu::where('MaCV', $id)->first();

        // Get all the PhongBan records for the dropdown
        $phongbans = tblphongban::all();

        // Return the edit view with the ChucVu and PhongBan data
        return view('chucvu.edit', compact('chucvu', 'phongbans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the input data
        $request->validate([
            'TenCV' => 'required|string|max:255',
            'MaPB' => 'required|exists:tblphongban,MaPB',
        ]);

        // Find the ChucVu record by its ID
        $chucvu = tblchucvu::where('MaCV', $id)->first();

        // Update the ChucVu record with the new data
        $chucvu->update([
            'TenCV' => $request->TenCV,
            'MaPB' => $request->MaPB,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('chucvu.index')->with('success', 'Chức vụ cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the ChucVu record by its ID
        $chucvu = tblchucvu::where('MaCV', $id)->first();
        // Delete the record
        $chucvu->delete();
        // Redirect to the index page with a success message
        return redirect()->route('chucvu.index')->with('success', 'Chức vụ đã bị xóa thành công!');
    }
}
