<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblnhanvien;
use Hash;
use Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string',
            'MatKhau' => 'required|string',
        ]);

        $nhanVien = tblnhanvien::where('TenDangNhap', $request->TenDangNhap)->first();

        if (!$nhanVien || !Hash::check($request->MatKhau, $nhanVien->MatKhau)) {
            return back()->withErrors(['login' => 'Tên đăng nhập hoặc mật khẩu không chính xác']);
        }

        // Lưu session
        Session::put('TenDangNhap', $nhanVien->TenDangNhap);
        Session::put('MaNV', $nhanVien->MaNV);

        return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công!');
    }
    public function logout()
    {
        Session::flush(); // Xóa toàn bộ session
        return redirect()->route('homepage');
    }
}
