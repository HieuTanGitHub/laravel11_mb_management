@extends('layout')

@section('content')
    <h4>Thêm mới nhân viên</h4>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form to add new employee -->
    <form action="{{ route('nhanvien.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mã nhân viên</label>
                <input type="text" name="MaNV" class="form-control" value="{{ $maNV }}" readonly>
            </div>
            <div class="col-md-4">
                <label class="form-label">Họ và tên</label>
                <input type="text" name="HoTen" class="form-control" value="{{ old('HoTen') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="SDT" class="form-control" value="{{ old('SDT') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" name="TenDangNhap" class="form-control" value="{{ old('TenDangNhap') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="MatKhau" class="form-control" value="{{ old('MatKhau') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" name="Email" class="form-control" value="{{ old('Email') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Phân quyền</label>
                <input type="text" name="PhanQuyen" class="form-control" value="{{ old('PhanQuyen') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Mã phòng ban</label>
                <select name="MaPB" class="form-control">
                    @foreach ($phongbans as $phongban)
                        <option value="{{ $phongban->MaPB }}" {{ old('MaPB') == $phongban->MaPB ? 'selected' : '' }}>
                            {{ $phongban->TenPB }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Mã chức vụ</label>
                <select name="MaCV" class="form-control">
                    @foreach ($chucvus as $chucvu)
                        <option value="{{ $chucvu->MaCV }}" {{ old('MaCV') == $chucvu->MaCV ? 'selected' : '' }}>
                            {{ $chucvu->TenCV }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-end">
            <button class="btn btn-save btn-custom">Lưu</button>
        </div>
    </form>
@endsection
