<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblkhachhangcanhan;
use App\Models\tblkhachhang;
use App\Models\tblruttien;
use App\Models\tblguitien;
use App\Models\tblthe;
use App\Models\tbltaikhoan;
use App\Models\tblquanhuyen;
use App\Models\tbltinhthanhpho;
use App\Models\tblphuongxa;
use App\Models\tblthanhtoanhoadon;
use Session;

class GiaoDichController extends Controller
{
    public function ruttien()
    {
        $ruttien = tblruttien::orderBy('NgayTao', 'DESC')->get();
        return view('giaodich.ruttien.index', compact('ruttien'));
    }
    public function guitien()
    {
        $guitien = tblguitien::orderBy('NgayTao', 'DESC')->get();
        return view('giaodich.guitien.index', compact('guitien'));
    }
    public function thanhtoanhoadon()
    {
        $thanhtoanhoadon = tblthanhtoanhoadon::orderBy('NgayTao', 'DESC')->get();
        return view('giaodich.thanhtoanhoadon.index', compact('thanhtoanhoadon'));
    }
    public function themthanhtoanhoadon()
    {
        $khachhang = tblkhachhangcanhan::with('khach')->get();
        return view('giaodich.thanhtoanhoadon.create', compact('khachhang'));
    }
    public function showChiTiet(Request $request)
    {
        $ruttien = tblruttien::where('MaGDRutTien', $request->MaGDRutTien)->first();

        if (!$ruttien) {
            return 'Không tìm thấy giao dịch';
        }

        $taikhoan = tbltaikhoan::where('SoTK', $ruttien->SoTK)->first();
        $khachhang = tblkhachhang::where('SoTK', $taikhoan->SoTK)->first();
        $the = tblthe::where('SoTK', $taikhoan->SoTK)->first();

        return view('giaodich.ruttien.chitiet', compact('ruttien', 'taikhoan', 'khachhang', 'the'))->render();
    }
    public function showChiTietGui(Request $request)
    {
        $guitien = tblguitien::where('MaGDGuiTien', $request->MaGDGuiTien)->first();

        if (!$guitien) {
            return 'Không tìm thấy giao dịch';
        }

        $taikhoan = tbltaikhoan::where('SoTK', $guitien->SoTK)->first();
        $khachhang = tblkhachhang::where('SoTK', $taikhoan->SoTK)->first();
        $the = tblthe::where('SoTK', $taikhoan->SoTK)->first();

        return view('giaodich.guitien.chitiet', compact('guitien', 'taikhoan', 'khachhang', 'the'))->render();
    }
    public function showChiTietThanhToan(Request $request)
    {
        $thanhtoan = tblthanhtoanhoadon::where('MaGDThanhToan', $request->MaGDThanhToan)->first();

        if (!$thanhtoan) {
            return 'Không tìm thấy giao dịch';
        }

        $taikhoan = tbltaikhoan::where('SoTK', $thanhtoan->SoTK)->first();
        $khachhang = tblkhachhang::where('SoTK', $taikhoan->SoTK)->first();
        $the = tblthe::where('SoTK', $taikhoan->SoTK)->first();

        return view('giaodich.thanhtoanhoadon.chitiet', compact('thanhtoan', 'taikhoan', 'khachhang', 'the'))->render();
    }


    public function themruttien()
    {
        $khachhang = tblkhachhangcanhan::with('khach')->get();
        return view('giaodich.ruttien.create', compact('khachhang'));
    }
    public function themguitien()
    {
        $khachhang = tblkhachhangcanhan::with('khach')->get();
        return view('giaodich.guitien.create', compact('khachhang'));
    }
    public function getThongTinKhach($id)
    {
        $khach = tblkhachhang::where('SoTK', $id)->first();
        $taikhoan = tbltaikhoan::where('SoTK', $id)->first();
        $the = tblthe::where('SoTK', $id)->first();
        $khachhangcanhan = tblkhachhangcanhan::with('khach')->where('MaKH', $khach->MaKH)->first();

        $thanhpho = null;
        $quanhuyen = null;
        $xaphuong = null;

        if (!empty($khachhangcanhan) && !empty($khachhangcanhan->khach?->DiaChi)) {
            $parts = explode(" ", $khachhangcanhan->khach?->DiaChi);

            if (count($parts) >= 3) {
                [$matp, $maqh, $xaid] = $parts;

                $thanhpho  = tbltinhthanhpho::where('matp', $matp)->first();
                $quanhuyen = tblquanhuyen::where('maqh', $maqh)->first();
                $xaphuong  = tblphuongxa::where('xaid', $xaid)->first();
            }
        }

        if ($khach) {
            return response()->json([
                'TenKH' => $khach->TenKH,
                'CCCD'  => $khach->CCCD,
                'SoThe' => $the->SoThe,
                'SoDuTK' => $taikhoan->SoDuTK,
                'SDT' => $khach->SDT,
                'MaKH' => $khach->MaKH,
                'DiaChi' => $thanhpho->name_city . ' - ' . $quanhuyen->name_quanhuyen . ' - ' . $xaphuong->name_xaphuong
            ]);
        }

        return response()->json([], 404);
    }
    public function storeruttien(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'MaGDRutTien' => 'required|unique:tblruttien',
                'SoTienRut' => 'required|numeric|min:1000000',
                'SoTK' => 'required|exists:tbltaikhoan,SoTK',
                'NoiDung' => 'required',
                'PhiGiaoDich' => 'required|numeric',
                'ViTri' => 'required',
                'NgayTao' => 'required|date'
            ]);

            $taikhoan = tbltaikhoan::where('SoTK', $request->SoTK)->first();

            if (!$taikhoan) {
                return back()->with('error', 'Không tìm thấy tài khoản');
            }

            if ($taikhoan->SoDuTK < $request->SoTienRut) {
                return back()->with('error', 'Số dư không đủ để rút tiền');
            }

            $SoDuSauRut = $taikhoan->SoDuTK - ($request->SoTienRut + $request->PhiGiaoDich);

            tblruttien::create([
                'MaGDRutTien' => $request->MaGDRutTien,
                'SoTienRut' => $request->SoTienRut,
                'PhiGiaoDich' => $request->PhiGiaoDich,
                'SoDuSauRut' => $SoDuSauRut,
                'NoiDung' => $request->NoiDung,
                'ViTri' => $request->ViTri,
                'NgayTao' => $request->NgayTao,
                'MaNV' => Session::get('MaNV'),
                'SoTK' => $request->SoTK,
            ]);

            $taikhoan->update([
                'SoDuTK' => $SoDuSauRut
            ]);

            return redirect()->route('giaodich.ruttien')->with('success', 'Rút tiền thành công');
        } catch (\Exception $e) {

            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function storeguitien(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'MaGDGuiTien' => 'required|unique:tblguitien',
                'SoTienGui' => 'required|numeric|min:1000000',
                'SoTK' => 'required|exists:tbltaikhoan,SoTK',
                'NoiDung' => 'required',
                'PhiGiaoDich' => 'required|numeric',
                'ViTri' => 'required',
                'NgayTao' => 'required|date'
            ]);

            $taikhoan = tbltaikhoan::where('SoTK', $request->SoTK)->first();

            if (!$taikhoan) {
                return back()->with('error', 'Không tìm thấy tài khoản');
            }

            // if ($taikhoan->SoDuTK < $request->SoTienGui) {
            //     return back()->with('error', 'Số dư không đủ để rút tiền');
            // }

            $SoDuSauGui = ($taikhoan->SoDuTK + $request->SoTienGui) - $request->PhiGiaoDich;

            tblguitien::create([
                'MaGDGuiTien' => $request->MaGDGuiTien,
                'SoTienGui' => $request->SoTienGui,
                'PhiGiaoDich' => $request->PhiGiaoDich,
                'SoDuSauGui' => $SoDuSauGui,
                'NoiDung' => $request->NoiDung,
                'ViTri' => $request->ViTri,
                'NgayTao' => $request->NgayTao,
                'MaNV' => Session::get('MaNV'),
                'SoTK' => $request->SoTK,
            ]);

            $taikhoan->update([
                'SoDuTK' => $SoDuSauGui
            ]);

            return redirect()->route('giaodich.guitien')->with('success', 'Rút tiền thành công');
        } catch (\Exception $e) {

            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function storethanhtoanhoadon(Request $request)
    {
        $request->validate([
            'MaGDThanhToan' => 'required',
            'NgayTao' => 'required|date',
            'PhiGiaoDich' => 'required|numeric|min:0',
            'TongTien' => 'required|numeric|min:0',
            'SoHD' => 'required',
            'NganHang' => 'required',
            'NCC' => 'required',
            'LoaiHD' => 'required',
            'NoiDung' => 'required',
            'DiemGD' => 'required',
            'SoTienThanhToan' => 'required',
            'SoTK' => 'required|exists:tbltaikhoan,SoTK',
        ]);

        $taikhoan = tbltaikhoan::where('SoTK', $request->SoTK)->first();

        if (!$taikhoan) {
            return back()->with('error', 'Không tìm thấy tài khoản');
        }

        if ($taikhoan->SoDuTK < $request->TongTien) {
            return back()->with('error', 'Số dư không đủ để thanh toán');
        }

        $SoDuSauThanhToan = $taikhoan->SoDuTK - $request->TongTien;

        tblthanhtoanhoadon::create([
            'MaGDThanhToan' => $request->MaGDThanhToan,
            'NgayTao' => $request->NgayTao,
            'PhiGiaoDich' => $request->PhiGiaoDich,
            'TongTien' => $request->TongTien,
            'SoHD' => $request->SoHD,
            'NganHang' => $request->NganHang,
            'SoTienThanhToan' => $request->SoTienThanhToan,
            'NCC' => $request->NCC,
            'LoaiHD' => $request->LoaiHD,
            'SoDuSauThanhToan' => $SoDuSauThanhToan,
            'NoiDung' => $request->NoiDung,
            'DiemGD' => $request->DiemGD,
            'MaNV' => Session::get('MaNV'),
            'SoTK' => $request->SoTK,
        ]);

        $taikhoan->update([
            'SoDuTK' => $SoDuSauThanhToan
        ]);

        return redirect()->route('giaodich.thanhtoanhoadon')->with('success', 'Thanh toán hóa đơn thành công');
    }
}
