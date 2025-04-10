@extends('layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Chỉnh Sửa Tài Khoản</h2>

        <form action="{{ route('taikhoan.update', $taiKhoan->SoTK) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Số tài khoản -->
                <div class="col-md-6">
                    <label class="form-label">Số Tài Khoản</label>
                    <input type="text" name="SoTK" class="form-control" value="{{ $taiKhoan->SoTK }}" readonly>
                </div>

                <!-- Số dư tài khoản -->
                <div class="col-md-6">
                    <label class="form-label">Số Dư</label>
                    <input type="number" name="SoDuTK" class="form-control" value="{{ $taiKhoan->SoDuTK }}" required>
                </div>

                <!-- Trạng thái -->
                <div class="col-md-6">
                    <label class="form-label">Trạng Thái</label>
                    <select name="TrangThai" class="form-control">
                        <option value="1" {{ $taiKhoan->TrangThai ? 'selected' : '' }}>Còn hiệu lực</option>
                        <option value="0" {{ !$taiKhoan->TrangThai ? 'selected' : '' }}>Đã đóng</option>
                    </select>
                </div>

                <!-- Loại Thẻ -->
                <div class="col-md-6">
                    <label class="form-label">Loại Thẻ</label>
                    <select name="MaLoaiThe" class="form-control">
                        @foreach ($loaiThes as $loai)
                            <option value="{{ $loai->MaLoaiThe }}"
                                {{ $taiKhoan->MaLoaiThe == $loai->MaLoaiThe ? 'selected' : '' }}>
                                {{ $loai->TenLoaiThe }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">

                    <label for="NgayMo" class="form-label">Ngày Mở</label>
                    <input type="date" class="form-control" id="NgayMo" name="NgayMo"
                        value="{{ old('NgayMo', \Carbon\Carbon::parse($taiKhoan->NgayMo)->format('Y-m-d')) }}" required>

                </div>


                <!-- Ngày đóng -->
                <div class="col-md-6">
                    <label class="form-label">Ngày đóng</label>
                    <input type="date" name="NgayDong" class="form-control"
                        value="{{ old('NgayMo', \Carbon\Carbon::parse($taiKhoan->NgayDong)->format('Y-m-d')) }}">
                    @error('NgayDong')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Nhân viên -->
                <div class="col-md-6">
                    <label class="form-label">Nhân Viên</label>
                    <select name="MaNV" class="form-control">
                        @foreach ($nhanViens as $nv)
                            <option value="{{ $nv->MaNV }}" {{ $taiKhoan->MaNV == $nv->MaNV ? 'selected' : '' }}>
                                {{ $nv->HoTen }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Khách hàng -->
                <div class="col-md-6">
                    <label class="form-label">Khách Hàng</label>
                    <select name="MaKH" class="form-control">
                        @foreach ($khachHangs as $kh)
                            <option value="{{ $kh->MaKH }}" {{ $taiKhoan->MaKH == $kh->MaKH ? 'selected' : '' }}>
                                {{ $kh->TenKH }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit -->
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                </div>
            </div>
        </form>
    </div>
@endsection
