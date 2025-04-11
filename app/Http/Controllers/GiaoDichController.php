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
use DB;

class GiaoDichController extends Controller
{
    public function search_chitiet(Request $request)
    {
        $MaGD = $request->MaGD;

        // Kiểm tra trong bảng Rút Tiền
        $rutTien = DB::table('tblruttien')
            ->join('tblkhachhang', 'tblruttien.SoTK', '=', 'tblkhachhang.SoTK')
            ->join('tblthe', 'tblruttien.SoTK', '=', 'tblthe.SoTK')
            ->where('tblruttien.MaGDRutTien', $MaGD)
            ->select('tblruttien.*', 'tblkhachhang.*', 'tblthe.SoThe')
            ->first();

        if ($rutTien) {
            $LoaiGD = 'Rút Tiền';
            return view('giaodich.ruttien.search_chitiet', compact('rutTien', 'LoaiGD'));
        }

        // Kiểm tra trong bảng Gửi Tiền
        $guiTien = DB::table('tblguitien')
            ->join('tblkhachhang', 'tblguitien.SoTK', '=', 'tblkhachhang.SoTK')
            ->join('tblthe', 'tblguitien.SoTK', '=', 'tblthe.SoTK')
            ->where('tblguitien.MaGDGuiTien', $MaGD)
            ->select('tblguitien.*', 'tblkhachhang.*', 'tblthe.SoThe')
            ->first();

        if ($guiTien) {
            $LoaiGD = 'Gửi Tiền';
            return view('giaodich.ruttien.search_chitiet', compact('guiTien', 'LoaiGD'));
        }

        // Kiểm tra trong bảng Thanh Toán
        $thanhToan = DB::table('thanh_toan')
            ->join('khach_hang', 'thanh_toan.SoTK', '=', 'khach_hang.SoTK')
            ->join('the', 'thanh_toan.SoTK', '=', 'the.SoTK')
            ->where('thanh_toan.MaGDThanhToan', $MaGD)
            ->select('thanh_toan.*', 'khach_hang.*', 'the.SoThe')
            ->first();

        if ($thanhToan) {
            $LoaiGD = 'Thanh Toán';
            return view('giaodich.chitiet', compact('thanhToan', 'LoaiGD', 'khachhang', 'the'));
        }

        return response()->json(['error' => 'Không tìm thấy giao dịch'], 404);
    }



    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $ruttien = tblruttien::where('NgayTao', 'like', "%$keyword%")
            ->select('MaGDRutTien as MaGD', 'NgayTao')
            ->get()
            ->map(function ($item) {
                $item->LoaiGD = 'Rút Tiền';
                return $item;
            });

        $guitien = tblguitien::where('NgayTao', 'like', "%$keyword%")
            ->select('MaGDGuiTien as MaGD', 'NgayTao')
            ->get()
            ->map(function ($item) {
                $item->LoaiGD = 'Gửi Tiền';
                return $item;
            });

        $thanhtoan = tblthanhtoanhoadon::where('NgayTao', 'like', "%$keyword%")
            ->select('MaGDThanhToan as MaGD', 'NgayTao')
            ->get()
            ->map(function ($item) {
                $item->LoaiGD = 'Thanh Toán Hóa Đơn';
                return $item;
            });

        $giaodich = $ruttien->merge($guitien)->merge($thanhtoan)->sortByDesc('NgayTao');




        return view('giaodich.ruttien.search', compact('giaodich', 'keyword'));
    }

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
        $lastMaGD = DB::table('tblruttien')
            ->orderBy('MaGDRutTien', 'desc')
            ->value('MaGDRutTien');

        if ($lastMaGD) {
            $number = (int)substr($lastMaGD, 2); // Cắt bỏ "RT"
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        $newMaGD = 'RT' . str_pad($newNumber, 10, '0', STR_PAD_LEFT);

        $khachhang = tblkhachhangcanhan::with('khach')->get();
        return view('giaodich.ruttien.create', compact('khachhang', 'newMaGD'));
    }
    public function themguitien()
    {
        $lastMaGD = DB::table('tblguitien')
            ->orderBy('MaGDGuiTien', 'desc')
            ->value('MaGDGuiTien');

        if ($lastMaGD) {
            $number = (int)substr($lastMaGD, 2); // Cắt bỏ "RT"
            $newNumber = $number + 1;
        } else {
            $newNumber = 1;
        }

        $newMaGD = 'GT' . str_pad($newNumber, 10, '0', STR_PAD_LEFT);
        $khachhang = tblkhachhangcanhan::with('khach')->get();

        return view('giaodich.guitien.create', compact('khachhang', 'newMaGD'));
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

            $ruttien = tblruttien::create([
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

            //return redirect()->route('giaodich.ruttien')->with('success', 'Rút tiền thành công');
            return response()->json([
                'success' => true,
                'id' => $ruttien->MaGDRutTien  // return id để ajax call tiếp
            ]);
        } catch (\Exception $e) {

            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function showReceipt($id)
    {
        $ruttien = tblruttien::where('MaGDRutTien', $id)->first();
        $khachhang = tblkhachhang::where('SoTK', $ruttien->SoTK)->first();

        return [
            'Mã GD' => $ruttien->MaGDRutTien,
            'Tên Người Rút' => $khachhang->TenKH,
            'SDT' => $khachhang->SDT,
            'CCCD' => $khachhang->CCCD,
            'DiaChi' => $khachhang->DiaChi,
            'Số TK' => $ruttien->SoTK,
            'Số Tiền Rút' => number_format($ruttien->SoTienRut) . ' VNĐ',
            'Ngày Tạo' => $ruttien->NgayTao,
            'Người Tạo' => $ruttien->MaNV,
            // field khác
        ];
    }
    public function showReceiptGuiTien($id)
    {
        $guitien = tblguitien::where('MaGDGuiTien', $id)->first();
        $khachhang = tblkhachhang::where('SoTK', $guitien->SoTK)->first();

        return [

            'Số Tài khoản người nhận' => $guitien->SoTK,
            'Số tiền gửi' => $guitien->SoTienGui,
            'Lệ phí' => $guitien->PhiGiaoDich,
            'Tổng tiền' => $guitien->TongTien,
            'Ngày Tạo' => $guitien->NgayTao,
            // field khác
        ];
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

                'TenNG' => 'required',
                'SDTNG' => 'required',
                'TongTien' => 'required',
                'NganHang' => 'required',

                'NgayTao' => 'required|date'
            ]);

            $taikhoan = tbltaikhoan::where('SoTK', $request->SoTK)->first();

            if (!$taikhoan) {
                return back()->with('error', 'Không tìm thấy tài khoản');
            }

            // if ($taikhoan->SoDuTK < $request->SoTienGui) {
            //     return back()->with('error', 'Số dư không đủ để rút tiền');
            // }

            $SoDuSauGui = ($taikhoan->SoDuTK + $request->TongTien);

            $guitien = tblguitien::create([
                'MaGDGuiTien' => $request->MaGDGuiTien,
                'SoTienGui' => $request->SoTienGui,
                'PhiGiaoDich' => $request->PhiGiaoDich,
                'SoDuSauGui' => $SoDuSauGui,
                'NoiDung' => $request->NoiDung,
                'ViTri' => $request->ViTri,
                'NgayTao' => $request->NgayTao,
                'MaNV' => Session::get('MaNV'),
                'SoTK' => $request->SoTK,

                'TenNG' => $request->TenNG,
                'SDTNG' => $request->SDTNG,
                'TongTien' => str_replace('.', '', $request->TongTien),
                'NganHang' => $request->NganHang
            ]);

            $taikhoan->update([
                'SoDuTK' => $SoDuSauGui
            ]);

            //return redirect()->route('giaodich.guitien')->with('success', 'Rút tiền thành công');
            return response()->json([
                'success' => true,
                'id' => $guitien->MaGDGuiTien  // return id để ajax call tiếp
            ]);
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
