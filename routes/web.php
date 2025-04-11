<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\LoaiKhachHangController;
use App\Http\Controllers\KhachHangCaNhanController;
use App\Http\Controllers\KhachHangDoanhNghiepController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\LoaiTKController;
use App\Http\Controllers\LoaiTheController;
use App\Http\Controllers\LoaiHoatDongController;
use App\Http\Controllers\TheController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\GiaoDichController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [NhanVienController::class, 'login'])->name('homepage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/login-nhanvien', [AuthController::class, 'login'])->name('login-nhanvien');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //khachhang
    Route::get('/khachhang', [KhachHangController::class, 'index'])->name('khachhang.index');
    Route::get('/khachhang/create', [KhachHangController::class, 'create'])->name('khachhang/create');
    Route::get('/khachhang/edit/{id}', [KhachHangController::class, 'edit'])->name('khachhang.edit');
    Route::post('/khachhang/store', [KhachHangController::class, 'store'])->name('khachhang/store');
    Route::post('/khachhang/update/{id}', [KhachHangController::class, 'update'])->name('khachhang.update');
    //loaikhachhang
    Route::get('/loaikhachhang', [LoaiKhachHangController::class, 'index'])->name('loaikhachhang.index');
    Route::get('/loaikhachhang/create', [LoaiKhachHangController::class, 'create'])->name('loaikhachhang.create');
    Route::post('/loaikhachhang/store', [LoaiKhachHangController::class, 'store'])->name('loaikhachhang.store');
    Route::get('/loaikhachhang/edit/{id}', [LoaiKhachHangController::class, 'edit'])->name('loaikhachhang.edit');
    Route::put('/loaikhachhang/update/{id}', [LoaiKhachHangController::class, 'update'])->name('loaikhachhang.update');
    Route::delete('/loaikhachhang/{id}', [LoaiKhachHangController::class, 'destroy'])->name('loaikhachhang.destroy');
    //khachhangcanhan
    Route::get('/khachhangcanhan', [KhachHangCaNhanController::class, 'index'])->name('khachhangcanhan.index');
    Route::get('/khachhangcanhan/create', [KhachHangCaNhanController::class, 'create'])->name('khachhangcanhan.create');
    Route::post('/khachhangcanhan/store', [KhachHangCaNhanController::class, 'store'])->name('khachhangcanhan.store');
    Route::get('/khachhangcanhan/edit/{id}', [KhachHangCaNhanController::class, 'edit'])->name('khachhangcanhan.edit');
    Route::put('/khachhangcanhan/update/{id}', [KhachHangCaNhanController::class, 'update'])->name('khachhangcanhan.update');
    Route::delete('/khachhangcanhan/{id}', [KhachHangCaNhanController::class, 'destroy'])->name('khachhangcanhan.destroy');
    Route::get('/khachhangcanhan/show/{id}', [KhachHangCaNhanController::class, 'show']);
    Route::post('/select-diachi', [KhachHangCaNhanController::class, 'select_diachi']);
    Route::get('/khachhang-search', [KhachHangCaNhanController::class, 'search'])->name('khachhangcanhan.search');

    //khachhangdoanhnghiep
    Route::get('/khachhangdoanhnghiep', [KhachHangDoanhNghiepController::class, 'index'])->name('khachhangdoanhnghiep.index');
    Route::get('/khachhangdoanhnghiep/create', [KhachHangDoanhNghiepController::class, 'create'])->name('khachhangdoanhnghiep.create');
    Route::post('/khachhangdoanhnghiep/store', [KhachHangDoanhNghiepController::class, 'store'])->name('khachhangdoanhnghiep.store');
    Route::get('/khachhangdoanhnghiep/edit/{id}', [KhachHangDoanhNghiepController::class, 'edit'])->name('khachhangdoanhnghiep.edit');
    Route::put('/khachhangdoanhnghiep/update/{id}', [KhachHangDoanhNghiepController::class, 'update'])->name('khachhangdoanhnghiep.update');
    Route::delete('/khachhangdoanhnghiep/{id}', [KhachHangDoanhNghiepController::class, 'destroy'])->name('khachhangdoanhnghiep.destroy');
    //nhanvien
    Route::get('/nhanvien', [NhanVienController::class, 'index'])->name('nhanvien.index');
    Route::get('/nhanvien/create', [NhanVienController::class, 'create'])->name('nhanvien.create');
    Route::get('/nhanvien/edit/{id}', [NhanVienController::class, 'edit'])->name('nhanvien.edit');
    Route::post('/nhanvien/store', [NhanVienController::class, 'store'])->name('nhanvien.store');
    Route::put('/nhanvien/update/{id}', [NhanVienController::class, 'update'])->name('nhanvien.update');
    Route::delete('/nhanvien/{id}', [NhanVienController::class, 'destroy'])->name('nhanvien.destroy');
    Route::get('/nhanvien-search', [NhanVienController::class, 'search'])->name('nhanvien.search');

    //phongban
    Route::get('/phongban', [PhongBanController::class, 'index'])->name('phongban.index');
    Route::get('/phongban/create', [PhongBanController::class, 'create'])->name('phongban.create');
    Route::get('/phongban/edit/{id}', [PhongBanController::class, 'edit'])->name('phongban.edit');
    Route::post('/phongban/store', [PhongBanController::class, 'store'])->name('phongban.store');
    Route::put('/phongban/update/{id}', [PhongBanController::class, 'update'])->name('phongban.update');
    Route::delete('/phongban/{id}', [PhongBanController::class, 'destroy'])->name('phongban.destroy');
    //chucvu
    Route::get('/chucvu', [ChucVuController::class, 'index'])->name('chucvu.index');
    Route::get('/chucvu/create', [ChucVuController::class, 'create'])->name('chucvu.create');
    Route::get('/chucvu/edit/{id}', [ChucVuController::class, 'edit'])->name('chucvu.edit');
    Route::post('/chucvu/store', [ChucVuController::class, 'store'])->name('chucvu.store');
    Route::post('/chucvu/update/{id}', [ChucVuController::class, 'update'])->name('chucvu.update');
    Route::delete('/chucvu/{id}', [ChucVuController::class, 'destroy'])->name('chucvu.destroy');

    //loaitk
    Route::get('/loaitk', [LoaiTKController::class, 'index'])->name('loaitk.index');
    Route::get('/loaitk/create', [LoaiTKController::class, 'create'])->name('loaitk.create');
    Route::get('/loaitk/edit/{id}', [LoaiTKController::class, 'edit'])->name('loaitk.edit');
    Route::post('/loaitk/store', [LoaiTKController::class, 'store'])->name('loaitk.store');
    Route::put('/loaitk/update/{id}', [LoaiTKController::class, 'update'])->name('loaitk.update');
    Route::delete('/loaitk/{id}', [LoaiTKController::class, 'destroy'])->name('loaitk.destroy');

    //loaithe
    Route::get('/loaithe', [LoaiTheController::class, 'index'])->name('loaithe.index');
    Route::get('/loaithe/create', [LoaiTheController::class, 'create'])->name('loaithe.create');
    Route::get('/loaithe/edit/{id}', [LoaiTheController::class, 'edit'])->name('loaithe.edit');
    Route::post('/loaithe/store', [LoaiTheController::class, 'store'])->name('loaithe.store');
    Route::put('/loaithe/update/{id}', [LoaiTheController::class, 'update'])->name('loaithe.update');
    Route::delete('/loaithe/{id}', [LoaiTheController::class, 'destroy'])->name('loaithe.destroy');

    //loaithe
    Route::get('/loaihoatdong', [LoaiHoatDongController::class, 'index'])->name('loaihoatdong.index');
    Route::get('/loaihoatdong/create', [LoaiHoatDongController::class, 'create'])->name('loaihoatdong.create');
    Route::get('/loaihoatdong/edit/{id}', [LoaiHoatDongController::class, 'edit'])->name('loaihoatdong.edit');
    Route::post('/loaihoatdong/store', [LoaiHoatDongController::class, 'store'])->name('loaihoatdong.store');
    Route::put('/loaihoatdong/update/{id}', [LoaiHoatDongController::class, 'update'])->name('loaihoatdong.update');
    Route::delete('/loaihoatdong/{id}', [LoaiHoatDongController::class, 'destroy'])->name('loaihoatdong.destroy');

    //the
    Route::get('/the', [TheController::class, 'index'])->name('the.index');
    Route::get('/the/create', [TheController::class, 'create'])->name('the.create');
    Route::get('/the/edit/{id}', [TheController::class, 'edit'])->name('the.edit');
    Route::post('/the/store', [TheController::class, 'store'])->name('the.store');
    Route::put('/the/update/{id}', [TheController::class, 'update'])->name('the.update');
    Route::delete('/the/{id}', [TheController::class, 'destroy'])->name('the.destroy');

    //taikhoan
    Route::get('/taikhoan', [TaiKhoanController::class, 'index'])->name('taikhoan.index');
    Route::get('/taikhoan/create', [TaiKhoanController::class, 'create'])->name('taikhoan.create');
    Route::get('/taikhoan/edit/{id}', [TaiKhoanController::class, 'edit'])->name('taikhoan.edit');
    Route::post('/taikhoan/store', [TaiKhoanController::class, 'store'])->name('taikhoan.store');
    Route::put('/taikhoan/update/{id}', [TaiKhoanController::class, 'update'])->name('taikhoan.update');
    Route::delete('/taikhoan/{id}', [TaiKhoanController::class, 'destroy'])->name('taikhoan.destroy');

    //giaodich
    Route::get('/ruttien', [GiaoDichController::class, 'ruttien'])->name('giaodich.ruttien');
    Route::get('/themruttien', [GiaoDichController::class, 'themruttien'])->name('giaodich.themruttien');
    Route::post('/storeruttien', [GiaoDichController::class, 'storeruttien'])->name('giaodich.ruttien.store');
    Route::get('/giaodich/ruttien/chitiet', [GiaoDichController::class, 'showChiTiet'])->name('giaodich.ruttien.chitiet');
    Route::get('/ruttien/receipt/{id}', [GiaoDichController::class, 'showReceipt']);
    Route::get('/giaodich-search', [GiaoDichController::class, 'search'])->name('giaodich.search');
    Route::get('/giaodich-search-chitiet', [GiaoDichController::class, 'search_chitiet'])->name('giaodich.search.chitiet');

    Route::get('/guitien/receipt/{id}', [GiaoDichController::class, 'showReceiptGuiTien']);

    Route::get('/guitien', [GiaoDichController::class, 'guitien'])->name('giaodich.guitien');
    Route::get('/themguitien', [GiaoDichController::class, 'themguitien'])->name('giaodich.themguitien');
    Route::post('/storeguitien', [GiaoDichController::class, 'storeguitien'])->name('giaodich.guitien.store');
    Route::get('/giaodich/guitien/chitiet', [GiaoDichController::class, 'showChiTietGui'])->name('giaodich.guitien.chitiet');

    Route::get('/chuyenkhoan', [GiaoDichController::class, 'chuyenkhoan'])->name('giaodich.chuyenkhoan');
    Route::get('/thanhtoanhoadon', [GiaoDichController::class, 'thanhtoanhoadon'])->name('giaodich.thanhtoanhoadon');
    Route::get('/them-thanhtoanhoadon', [GiaoDichController::class, 'themthanhtoanhoadon'])->name('giaodich.themthanhtoanhoadon');
    Route::get('/get-thong-tin-khach/{id}', [GiaoDichController::class, 'getThongTinKhach']);
    Route::post('/storethanhtoanhoadon', [GiaoDichController::class, 'storethanhtoanhoadon'])->name('giaodich.thanhtoanhoadon.store');
    Route::get('/giaodich/thanhtoan/chitiet', [GiaoDichController::class, 'showChiTietThanhToan'])->name('giaodich.thanhtoan.chitiet');
    //báo cáo
    Route::get('/baocaotongquan', [DashboardController::class, 'baocaotongquan'])->name('baocaotongquan');
    Route::get('/load-giao-dich-ngay', [DashboardController::class, 'loadGiaoDichTrongNgay']);
    Route::get('/load-khach-hang-nhom', [DashboardController::class, 'loadKhachHangTheoNhom']);
});
require __DIR__ . '/auth.php';
