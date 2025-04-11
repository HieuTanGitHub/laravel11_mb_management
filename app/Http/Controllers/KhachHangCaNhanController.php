<?php

namespace App\Http\Controllers;

use App\Models\tblkhachhangcanhan;
use Illuminate\Http\Request;
use App\Models\tblloaitaikhoan;
use App\Models\tblloaikhachhang;
use App\Models\tblkhachhang;
use App\Models\tblquanhuyen;
use App\Models\tblphuongxa;
use App\Models\tbltinhthanhpho;
use App\Models\tblloaithe;
use Session;
use DB;

class KhachHangCaNhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function select_diachi(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = tblquanhuyen::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {

                $select_wards = tblphuongxa::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function index()
    {
        $khachhangs = tblkhachhangcanhan::with('khach')->get();
        return view('khachhangcanhan.index', compact('khachhangs'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $khachhangs = tblkhachhangcanhan::with(['khach' => function ($query) use ($keyword) {
            $query->where('SDT', 'like', "%$keyword%")
                ->orWhere('CCCD', 'like', "%$keyword%");
        }])
            ->whereHas('khach', function ($query) use ($keyword) {
                $query->where('SDT', 'like', "%$keyword%")
                    ->orWhere('CCCD', 'like', "%$keyword%");
            })
            ->get();

        return view('khachhangcanhan.search', compact('khachhangs', 'keyword'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $last = DB::table('tblkhachhangcanhan')->orderBy('MaKH', 'desc')->first();

        if ($last) {
            // Lấy số cuối cùng + 1
            $lastNumber = (int)substr($last->MaKH, 4); // bỏ KHCN
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $maKH = str_pad($newNumber, 8, '0', STR_PAD_LEFT);

        $loaithe = tblloaithe::all();
        $city = tbltinhthanhpho::all();
        $loaikhachhang = tblloaikhachhang::all();
        $loaitaikhoan = tblloaitaikhoan::all();
        return view('khachhangcanhan.create', compact('maKH', 'loaitaikhoan', 'loaikhachhang', 'city', 'loaithe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'MaKH' => 'required|string|max:50|unique:tblkhachhang,MaKH',
            'NgheNghiep' => 'required|string|max:255',
            'DoanhThu' => 'required|numeric|min:0',
            'HoSoCaNhan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'TenKH' => 'required|string|max:255',
            'CCCD' => 'required|digits:12|unique:tblkhachhang,CCCD',
            'Email' => 'required|email|unique:tblkhachhang,Email',
            'NgaySinh' => 'required|date',
            'SoTK' => 'required|string|max:255',
            // 'MaLoaiKH' => 'required|string|max:255',
            'MaLoaiTK' => 'required',
            'Thanhpho' => 'required',
            'Quanhuyen' => 'required',
            'Xaphuong' => 'required',
            'TheCung' => 'required',
            'SoThe' => 'required|string|max:255',
            'LoaiThe' => 'required|string|max:255',
            'SDT' => 'required|digits_between:10,11|unique:tblkhachhang,SDT',
        ]);
        // Xử lý file tải lên
        $hoSoPath = null;
        if ($request->hasFile('HoSoCaNhan')) {
            $hoSoPath = $request->file('HoSoCaNhan')->store('uploads/hoso', 'public');
        }
        // Tạo bản ghi mới
        tblkhachhangcanhan::create([
            'MaKH' => $request->MaKH,
            'NgheNghiep' => $request->NgheNghiep,
            'DoanhThu' => $request->DoanhThu,
            'HoSoCaNhan' => $hoSoPath,
            'MaNV' => Session::get('MaNV'),
        ]);
        //Tạo bản ghi cho khách hàng
        $khachHang = new tblkhachhang();
        $khachHang->MaKH = $request->MaKH;
        $khachHang->TenKH = $request->TenKH;
        $khachHang->CCCD = $request->CCCD;
        $khachHang->Email = $request->Email;
        $khachHang->NgaySinh = $request->NgaySinh;
        $khachHang->DiaChi = $request->Thanhpho . ' ' . $request->Quanhuyen . ' ' . $request->Xaphuong;
        $khachHang->SDT = $request->SDT;
        // $khachHang->MaLoaiKH = $request->MaLoaiKH;
        $khachHang->MaLoaiTK = $request->MaLoaiTK;
        $khachHang->SoTK = $request->SoTK;
        $khachHang->TheCung = $request->TheCung;
        $khachHang->LoaiThe = $request->LoaiThe;
        $khachHang->SoThe = $request->SoThe;

        $khachHang->save();
        return redirect()->route('khachhangcanhan.index')->with('success', 'Thêm khách hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $khachhang = tblkhachhang::where('MaKH', $id)->first();
        $khachhangcanhan = tblkhachhangcanhan::with('khach')->where('MaKH', $id)->first();

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

        return response()->json([
            'khachhang' => $khachhang,
            'khachhangcanhan' => $khachhangcanhan,
            'thanhpho' => $thanhpho,
            'quanhuyen' => $quanhuyen,
            'xaphuong' => $xaphuong,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $loaithe = tblloaithe::all();
        $city = tbltinhthanhpho::all();
        $loaikhachhang = tblloaikhachhang::all();
        $loaitaikhoan = tblloaitaikhoan::all();
        $khachhang = tblkhachhangcanhan::with('khach')->where('MaKH', $id)->first();

        $thanhpho = null;
        $quanhuyen = null;
        $xaphuong = null;

        if (!empty($khachhang) && !empty($khachhang->khach?->DiaChi)) {
            $parts = explode(" ", $khachhang->khach?->DiaChi);

            if (count($parts) >= 3) {
                [$matp, $maqh, $xaid] = $parts;

                $thanhpho  = tbltinhthanhpho::where('matp', $matp)->first();
                $quanhuyen = tblquanhuyen::where('maqh', $maqh)->first();
                $xaphuong  = tblphuongxa::where('xaid', $xaid)->first();
            }
        }

        return view('khachhangcanhan.edit', compact('loaithe', 'city', 'khachhang', 'loaikhachhang', 'loaitaikhoan', 'thanhpho', 'quanhuyen', 'xaphuong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm khách hàng cần cập nhật
        $khachHang = tblkhachhang::findOrFail($id);
        $khachHangCaNhan = tblkhachhangcanhan::where('MaKH', $khachHang->MaKH)->first();

        // Validate dữ liệu đầu vào
        $request->validate([
            'MaKH' => 'required|string|max:50|unique:tblkhachhang,MaKH,' . $khachHang->MaKH . ',MaKH',
            'NgheNghiep' => 'required|string|max:255',
            'DoanhThu' => 'required|numeric|min:0',
            'HoSoCaNhan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'TenKH' => 'required|string|max:255',
            'CCCD' => 'required|digits:12|unique:tblkhachhang,CCCD,' . $khachHang->MaKH . ',MaKH',
            'Email' => 'required|email|unique:tblkhachhang,Email,' . $khachHang->MaKH . ',MaKH',
            'NgaySinh' => 'required|date',
            'SoTK' => 'required|string|max:255',
            // 'MaLoaiKH' => 'required|string|max:255',
            'SoThe' => 'required|string|max:255',
            'LoaiThe' => 'required|string|max:255',
            'MaLoaiTK' => 'required',
            'TheCung' => 'required',
            'Thanhpho' => 'required',
            'Quanhuyen' => 'required',
            'Xaphuong' => 'required',
            'SDT' => 'required|digits_between:10,11|unique:tblkhachhang,SDT,' . $khachHang->MaKH . ',MaKH',
        ]);

        // Xử lý file upload
        if ($request->hasFile('HoSoCaNhan')) {
            $hoSoPath = $request->file('HoSoCaNhan')->store('uploads/hoso', 'public');
        } else {
            $hoSoPath = $khachHangCaNhan->HoSoCaNhan; // Giữ lại file cũ
        }

        // Cập nhật tblkhachhangcanhan
        $khachHangCaNhan->update([
            'MaKH' => $request->MaKH,
            'NgheNghiep' => $request->NgheNghiep,
            'DoanhThu' => $request->DoanhThu,
            'HoSoCaNhan' => $hoSoPath,
            'MaNV' => Session::get('MaNV'),
        ]);

        // Cập nhật tblkhachhang
        $khachHang->update([
            'MaKH' => $request->MaKH,
            'TenKH' => $request->TenKH,
            'CCCD' => $request->CCCD,
            'Email' => $request->Email,
            'NgaySinh' => $request->NgaySinh,
            'DiaChi' =>    $khachHang->DiaChi = $request->Thanhpho . ' ' . $request->Quanhuyen . ' ' . $request->Xaphuong,
            'SDT' => $request->SDT,
            // 'MaLoaiKH' => $request->MaLoaiKH,
            'MaLoaiTK' => $request->MaLoaiTK,
            'SoTK' => $request->SoTK,
            'TheCung' => $request->TheCung,
            'SoThe' => $request->SoThe,
            'LoaiThe' => $request->LoaiThe,
        ]);

        return redirect()->route('khachhangcanhan.index')->with('success', 'Cập nhật khách hàng thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khachhangcanhan = tblkhachhangcanhan::findOrFail($id);
        $khachhang = tblkhachhang::where('MaKH', $id)->first();

        // Xóa file hồ sơ nếu có
        if ($khachhangcanhan->HoSoCaNhan) {
            \Storage::disk('public')->delete($khachhangcanhan->HoSoCaNhan);
        }

        $khachhangcanhan->delete();
        $khachhang->delete();
        return redirect()->route('khachhangcanhan.index')->with('success', 'Xóa khách hàng thành công!');
    }
}
