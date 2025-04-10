@extends('layout')

@section('content')
    <form method="POST" action="{{ route('khachhang.update', $khachhang->MaKH) }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mã khách hàng</label>
                <input type="text" name="MaKH" class="form-control" value="{{ old('MaKH', $khachhang->MaKH) }}">
                @error('MaKH')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tên khách hàng</label>
                <input type="text" name="TenKH" class="form-control" value="{{ old('TenKH', $khachhang->TenKH) }}">
                @error('TenKH')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">CCCD</label>
                <input type="text" name="CCCD" class="form-control" value="{{ old('CCCD', $khachhang->CCCD) }}">
                @error('CCCD')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" value="{{ old('Email', $khachhang->Email) }}">
                @error('Email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Ngày sinh</label>
                <input type="date" name="NgaySinh" class="form-control"
                    value="{{ old('NgaySinh', \Carbon\Carbon::parse($khachhang->NgaySinh)->format('Y-m-d')) }}">
                @error('NgaySinh')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="DiaChi" class="form-control" value="{{ old('DiaChi', $khachhang->DiaChi) }}">
                @error('DiaChi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Mã Loại Khách Hàng</label>
                <select name="MaLoaiKH" class="form-control">
                    <option value="ML1" {{ $khachhang->MaLoaiKH == 'ML1' ? 'selected' : '' }}>Mã Loại 1</option>
                    <option value="ML2" {{ $khachhang->MaLoaiKH == 'ML2' ? 'selected' : '' }}>Mã Loại 2</option>
                </select>
                @error('MaLoaiKH')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="SDT" class="form-control" value="{{ old('SDT', $khachhang->SDT) }}">
                @error('SDT')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Số tài khoản</label>
                <input type="text" name="SoTK" class="form-control" value="{{ old('SoTK', $khachhang->SoTK) }}">
                @error('SoTK')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="text-end mt-3">
            <button type="submit" class="btn btn-save btn-custom">Cập nhật</button>
        </div>
    </form>
@endsection
