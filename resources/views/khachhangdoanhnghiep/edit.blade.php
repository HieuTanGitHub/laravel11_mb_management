@extends('layout')

@section('content')
    <h4 class="mb-3">Chỉnh sửa thông tin khách hàng doanh nghiệp</h4>

    <form action="{{ route('khachhangdoanhnghiep.update', $khachhang->MaKH) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mã KH</label>
                <input type="text" name="MaKH" class="form-control" value="{{ old('MaKH', $khachhang->MaKH) }}" disabled>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tên Doanh Nghiệp</label>
                <input type="text" name="TenDN" class="form-control" value="{{ old('TenDN', $khachhang->TenDN) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Mã Số Thuế</label>
                <input type="text" name="MaSoThue" class="form-control"
                    value="{{ old('MaSoThue', $khachhang->MaSoThue) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tên Đại Diện PL</label>
                <input type="text" name="TenDaiDienPL" class="form-control"
                    value="{{ old('TenDaiDienPL', $khachhang->TenDaiDienPL) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Chức Vụ</label>
                <input type="text" name="ChucVu" class="form-control" value="{{ old('ChucVu', $khachhang->ChucVu) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Email Kế Toán</label>
                <input type="email" name="EmailKT" class="form-control" value="{{ old('EmailKT', $khachhang->EmailKT) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Hồ Sơ Doanh Nghiệp</label>
                <input type="file" name="HoSoDN" class="form-control">
                @if ($khachhang->HoSoDN)
                    <a href="{{ asset('storage/' . $khachhang->HoSoDN) }}" target="_blank" class="btn btn-info mt-2">Xem Hồ
                        Sơ</a>
                @endif
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('khachhangdoanhnghiep.index') }}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
@endsection
