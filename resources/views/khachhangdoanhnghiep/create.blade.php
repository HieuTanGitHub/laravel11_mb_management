@extends('layout')

@section('content')
    <h4>THÊM MỚI KHÁCH HÀNG DOANH NGHIỆP</h4>

    <form method="POST" action="{{ route('khachhangdoanhnghiep.store') }}" enctype="multipart/form-data">
        @csrf
        <fieldset class="border p-3 mb-3">
            <legend class="float-none w-auto px-2">Thông tin khách hàng doanh nghiệp</legend>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Mã khách hàng</label>
                    <input type="text" name="MaKH" class="form-control" value="{{ old('MaKH') }}">
                    @error('MaKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tên doanh nghiệp</label>
                    <input type="text" name="TenDN" class="form-control" value="{{ old('TenDN') }}">
                    @error('TenDN')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ngày thành lập</label>
                    <input type="date" name="NgayThanhLap" class="form-control" value="{{ old('NgayThanhLap') }}">
                    @error('NgayThanhLap')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mã số thuế</label>
                    <input type="text" name="MaSoThue" class="form-control" value="{{ old('MaSoThue') }}">
                    @error('MaSoThue')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tên đại diện pháp lý</label>
                    <input type="text" name="TenDaiDienPL" class="form-control" value="{{ old('TenDaiDienPL') }}">
                    @error('TenDaiDienPL')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Chức vụ</label>
                    <input type="text" name="ChucVu" class="form-control" value="{{ old('ChucVu') }}">
                    @error('ChucVu')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tên kế toán</label>
                    <input type="text" name="TenKeToan" class="form-control" value="{{ old('TenKeToan') }}">
                    @error('TenKeToan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">CCCD kế toán</label>
                    <input type="text" name="CCCDKT" class="form-control" value="{{ old('CCCDKT') }}">
                    @error('CCCDKT')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email kế toán</label>
                    <input type="email" name="EmailKT" class="form-control" value="{{ old('EmailKT') }}">
                    @error('EmailKT')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Vốn điều lệ</label>
                    <input type="number" name="VonDieuLe" class="form-control" value="{{ old('VonDieuLe') }}">
                    @error('VonDieuLe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Địa chỉ doanh nghiệp</label>
                    <input type="text" name="DiaChiDN" class="form-control" value="{{ old('DiaChiDN') }}">
                    @error('DiaChiDN')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Hồ sơ doanh nghiệp</label>
                    <input type="file" name="HoSoDN" class="form-control">
                    @error('HoSoDN')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>


    </form>
@endsection
