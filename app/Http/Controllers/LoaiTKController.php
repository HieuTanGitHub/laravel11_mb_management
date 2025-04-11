<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblloaitaikhoan;

class LoaiTKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all records from tblloaitk table
        $loaitk = tblloaitaikhoan::all();

        // Pass data to the view
        return view('loaitk.index', compact('loaitk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loaitk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'MaLoaiTK' => 'required|string|max:50|unique:tblloaitaikhoan,MaLoaiTK',
            'TenLoaiTK' => 'required|string|max:255',
        ]);

        // Create a new record
        tblloaitaikhoan::create([
            'MaLoaiTK' => $request->MaLoaiTK,
            'TenLoaiTK' => $request->TenLoaiTK,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('loaitk.index')->with('success', 'Loại tài khoản đã được thêm thành công.');
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
        $loaitk = tblloaitaikhoan::where('MaLoaiTK', $id)->first();
        return view('loaitk.edit', compact('loaitk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'TenLoaiTK' => 'required|string|max:255',
        ]);

        $loaitk = tblloaitaikhoan::where('MaLoaiTK', $id)->first();
        $loaitk->TenLoaiTK = $request->TenLoaiTK;
        $loaitk->MaLoaiTK = $request->MaLoaiTK;
        $loaitk->save();

        return redirect()->route('loaitk.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
