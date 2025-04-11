<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblkhachhang;
use App\Models\tblruttien;
use App\Models\tblguitien;
use App\Models\tblthanhtoanhoadon;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function baocaotongquan()
    {
        $khachHangTuan = DB::table('tblkhachhangcanhan')
            ->select(
                DB::raw('WEEKDAY(NgayTao) as thu'),
                DB::raw('COUNT(*) as soLuong')
            )
            ->whereBetween('NgayTao', [
                Carbon::now('Asia/Ho_Chi_minh')->startOfWeek(),
                Carbon::now('Asia/Ho_Chi_minh')->endOfWeek()
            ])
            ->groupBy(DB::raw('WEEKDAY(NgayTao)'))
            ->get();

        $dataKhachHangTuan = array_fill(0, 7, 0); // default 7 ngày = 0        
        foreach ($khachHangTuan as $item) {
            $dataKhachHangTuan[$item->thu] = $item->soLuong;
        }

        return view('baocao.index', compact('dataKhachHangTuan'));
    }
    public function loadGiaoDichTrongNgay()
    {
        $today = Carbon::today('Asia/Ho_Chi_minh');

        $rutTien = DB::table('tblruttien')->whereDate('NgayTao', $today)->count();
        $guiTien = DB::table('tblguitien')->whereDate('NgayTao', $today)->count();

        $thanhToan = DB::table('tblthanhtoanhoadon')->whereDate('NgayTao', $today)->count();

        return response()->json([
            'rutTien' => $rutTien,
            'guiTien' => $guiTien,
            'chuyenKhoan' => 0,
            'thanhToan' => $thanhToan,
        ]);
    }
    public function loadKhachHangTheoNhom()
    {
        $caNhan = DB::table('tblkhachhangcanhan')->count();

        return response()->json([
            'caNhan' => $caNhan,
        ]);
    }

    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
