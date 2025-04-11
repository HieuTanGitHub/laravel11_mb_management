<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblnhanvien;
use App\Models\tblphongban;
use App\Models\tblchucvu;
use DB;

class NhanVienController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function login()
    {
        return view('login');
    }
    public function index()
    {
        $nhanviens = tblnhanvien::with('phongban', 'chucvu')->get();
        return view('nhanvien.index', compact('nhanviens'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $nhanviens = tblnhanvien::with('phongban', 'chucvu')->where('HoTen', 'like', '%' . $keyword . '%')->get();

        return view('nhanvien.search', compact('nhanviens', 'keyword'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastNV = DB::table('tblnhanvien')
            ->orderBy('MaNV', 'desc')
            ->first();

        if ($lastNV) {
            $lastNumber = (int)substr($lastNV->MaNV, 2); // lấy 3 số cuối
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $maNV = 'NV' . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // đủ 3 số
        // Pass all PhongBan and ChucVu records to the view for dropdown selection
        $phongbans = tblphongban::all();
        $chucvus = tblchucvu::all();

        return view('nhanvien.create', compact('phongbans', 'chucvus', 'maNV'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'MaNV' => 'required|unique:tblnhanvien,MaNV',
            'HoTen' => 'required|string|max:255',
            'SDT' => 'required|string|max:15',
            'TenDangNhap' => 'required|string|max:255|unique:tblnhanvien,TenDangNhap',
            'MatKhau' => 'required|string|min:6',
            'Email' => 'required|email',
            'PhanQuyen' => 'required|string|max:255',
            'MaPB' => 'required|string|max:255',
            'MaCV' => 'required|string|max:255',
        ]);

        // Store the data into the database
        tblnhanvien::create([
            'MaNV' => $request->MaNV,
            'HoTen' => $request->HoTen,
            'SDT' => $request->SDT,
            'TenDangNhap' => $request->TenDangNhap,
            'MatKhau' => bcrypt($request->MatKhau),
            'Email' => $request->Email,
            'PhanQuyen' => $request->PhanQuyen,
            'MaPB' => $request->MaPB,
            'MaCV' => $request->MaCV,
        ]);

        // Redirect after storing
        return redirect()->route('nhanvien.index')->with('success', 'Nhân viên đã được thêm thành công!');
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
        // Fetch the employee by ID
        $nhanvien = tblnhanvien::findOrFail($id);

        // Get all departments and job titles for selection
        $phongbans = tblphongban::all();
        $chucvus = tblchucvu::all();

        // Return the edit view with the employee and the data for dropdowns
        return view('nhanvien.edit', compact('nhanvien', 'phongbans', 'chucvus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming data
        $request->validate([
            'HoTen' => 'required|string|max:255',
            'SDT' => 'required|string|max:15',
            'TenDangNhap' => 'required|string|max:255|unique:tblnhanvien,TenDangNhap,' . $id . ',MaNV',
            'Email' => 'required|email|max:255',
            'PhanQuyen' => 'required|string|max:50',
            'MaPB' => 'required|string',
            'MaCV' => 'required|string',
        ]);

        // Find the employee record by ID
        $nhanvien = tblnhanvien::where('MaNV', $id)->first();

        // Update the employee record with the new data
        $nhanvien->update([
            'HoTen' => $request->HoTen,
            'SDT' => $request->SDT,
            'TenDangNhap' => $request->TenDangNhap,
            'Email' => $request->Email,
            'PhanQuyen' => $request->PhanQuyen,
            'MaPB' => $request->MaPB,
            'MaCV' => $request->MaCV,
        ]);

        // Redirect to the employee list with a success message
        return redirect()->route('nhanvien.index')->with('success', 'Cập nhật nhân viên thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the employee by ID and delete
        $nhanvien = tblnhanvien::where('MaNV', $id)->first();
        $nhanvien->delete();

        // Redirect back to the list of employees with a success message
        return redirect()->route('nhanvien.index')->with('success', 'Xóa nhân viên thành công!');
    }
}
