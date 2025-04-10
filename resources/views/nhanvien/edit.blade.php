@extends('layout')

@section('content')
    <h4>Cập nhật thông tin nhân viên</h4>

    <form method="POST" action="{{ route('nhanvien.update', $nhanvien->MaNV) }}">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mã nhân viên</label>
                <input type="text" name="MaNV" class="form-control" value="{{ old('MaNV', $nhanvien->MaNV) }}" readonly>
            </div>

            <div class="col-md-4">
                <label class="form-label">Họ và tên</label>
                <input type="text" name="HoTen" class="form-control" value="{{ old('HoTen', $nhanvien->HoTen) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="SDT" class="form-control" value="{{ old('SDT', $nhanvien->SDT) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" name="TenDangNhap" class="form-control"
                    value="{{ old('TenDangNhap', $nhanvien->TenDangNhap) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" value="{{ old('Email', $nhanvien->Email) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Phân quyền</label>
                <input type="text" name="PhanQuyen" class="form-control"
                    value="{{ old('PhanQuyen', $nhanvien->PhanQuyen) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Mã phòng ban</label>
                <select name="MaPB" class="form-control">
                    @foreach ($phongbans as $phongban)
                        <option value="{{ $phongban->MaPB }}" {{ $nhanvien->MaPB == $phongban->MaPB ? 'selected' : '' }}>
                            {{ $phongban->TenPB }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Mã chức vụ</label>
                <select name="MaCV" class="form-control">
                    @foreach ($chucvus as $chucvu)
                        <option value="{{ $chucvu->MaCV }}" {{ $nhanvien->MaCV == $chucvu->MaCV ? 'selected' : '' }}>
                            {{ $chucvu->TenCV }}
                        </option>
                    @endforeach
                </select>
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="text-end mt-3">
            <button class="btn btn-success" type="submit">Cập nhật</button>
            <a href="{{ route('nhanvien.index') }}" class="btn btn-secondary">Hủy</a>
        </div>
    </form>
@endsection
