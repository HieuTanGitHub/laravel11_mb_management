@extends('layout')

@section('content')
    <h4>Thêm mới tài khoản</h4>

    <form method="POST" action="{{ route('taikhoan.store') }}">
        @csrf
        <div class="row g-3">
            <!-- Mã loại thẻ -->
            <div class="col-md-4">
                <label class="form-label">Mã loại thẻ</label>
                <select name="MaLoaiThe" class="form-control" required>
                    <option value="">Chọn mã loại thẻ</option>
                    @foreach ($loaithe as $loaiThe)
                        <option value="{{ $loaiThe->MaLoaiThe }}"
                            {{ old('MaLoaiThe') == $loaiThe->MaLoaiThe ? 'selected' : '' }}>
                            {{ $loaiThe->TenLoaiThe }}
                        </option>
                    @endforeach
                </select>
                @error('MaLoaiThe')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mã nhân viên -->
            <div class="col-md-4">
                <label class="form-label">Mã nhân viên</label>
                <select name="MaNV" class="form-control" required>
                    <option value="">Chọn mã nhân viên</option>
                    @foreach ($nhanvien as $nv)
                        <option value="{{ $nv->MaNV }}" {{ Session::get('MaNV') == $nv->MaNV ? 'selected' : '' }}>
                            {{ $nv->HoTen }}
                        </option>
                    @endforeach
                </select>
                @error('MaNV')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mã khách hàng -->
            <div class="col-md-4">
                <label class="form-label">Mã khách hàng</label>
                <select name="MaKH" id="maKH" class="form-control" required>
                    <option value="">Chọn mã khách hàng</option>
                    @foreach ($khachhang as $kh)
                        <option value="{{ $kh->MaKH }}" {{ old('MaKH') == $kh->MaKH ? 'selected' : '' }}>
                            {{ $kh->MaKH }} - {{ $kh->TenKH }}
                        </option>
                    @endforeach
                </select>
                @error('MaKH')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Số tài khoản -->
            <div class="col-md-4">
                <label class="form-label">Số tài khoản</label>
                <select name="SoTK" id="soTK" class="form-control">
                    <option value="">---Chọn tài khoản---</option>
                    @foreach ($khachhang as $kh)
                        <option value="{{ $kh->SoTK }}" data-makh="{{ $kh->MaKH }}">
                            {{ $kh->SoTK }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Số dư tài khoản -->
            <div class="col-md-4">
                <label class="form-label">Số dư tài khoản</label>
                <input type="number" name="SoDuTK" min="100000" value="70000000" class="form-control"
                    value="{{ old('SoDuTK') }}" required>
                @error('SoDuTK')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @php
                $ngayTao = \Carbon\Carbon::now()->format('Y-m-d');
                $ngayMo = \Carbon\Carbon::now()->format('Y-m-d');
                $ngayDong = \Carbon\Carbon::now()->addYears(5)->format('Y-m-d');
            @endphp

            <!-- Ngày mở -->
            <div class="col-md-4">
                <label class="form-label">Ngày mở</label>
                <input type="date" name="NgayMo" class="form-control" value="{{ old('NgayMo', $ngayMo) }}" required>
                @error('NgayMo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ngày đóng -->
            <div class="col-md-4">
                <label class="form-label">Ngày đóng</label>
                <input type="date" name="NgayDong" class="form-control" value="{{ old('NgayDong', $ngayDong) }}">
                @error('NgayDong')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="col-md-4">
                <label class="form-label">Trạng thái</label>
                <select name="TrangThai" class="form-control">
                    <option value="1" {{ old('TrangThai', $the->TrangThai ?? '') == 1 ? 'selected' : '' }}>Còn hiệu
                        lực</option>
                    <option value="0" {{ old('TrangThai', $the->TrangThai ?? '') == 0 ? 'selected' : '' }}>Đã đóng
                    </option>
                </select>
                @error('TrangThai')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <!-- Ngày tạo -->
            <div class="col-md-4">
                <label class="form-label">Ngày tạo</label>
                <input type="date" name="NgayTao" class="form-control" value="{{ $ngayTao }}" required>
                @error('NgayTao')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-save btn-custom">Lưu</button>
            <a href="{{ route('taikhoan.index') }}" class="btn btn-cancel btn-custom">Hủy</a>
        </div>
    </form>
@endsection
