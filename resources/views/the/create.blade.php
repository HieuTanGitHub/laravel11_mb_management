@extends('layout')

@section('content')
    <h4>Thêm Mới Thẻ</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('the.store') }}" method="POST">
        @csrf


        @php
            $ngayTao = \Carbon\Carbon::now()->format('Y-m-d');
            $ngayMo = \Carbon\Carbon::now()->format('Y-m-d');
            $ngayDong = \Carbon\Carbon::now()->addYears(5)->format('Y-m-d');
            $ngayHetHan = \Carbon\Carbon::now()->addYears(5)->format('Y-m-d');
        @endphp
        <div class="mb-3">
            <label class="form-label">Ngày Mở</label>
            <input type="date" name="NgayMo" class="form-control" value="{{ old('NgayMo', $ngayMo) }}" required>
            @error('NgayMo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Hết Hạn</label>
            <input type="date" name="NgayHetHan" class="form-control" value="{{ old('NgayDong', $ngayHetHan) }}"
                required>
            @error('NgayHetHan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Đóng (nếu có)</label>
            <input type="date" name="NgayDong" class="form-control" value="{{ old('NgayDong', $ngayDong) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Loại Thẻ</label>
            <select name="MaLoaiThe" class="form-control" required>
                <option value="">-- Chọn Loại Thẻ --</option>
                @foreach ($loaiThe as $loai)
                    <option value="{{ $loai->MaLoaiThe }}">{{ $loai->TenLoaiThe }}</option>
                @endforeach
            </select>
            @error('MaLoaiThe')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nhân Viên (nếu có)</label>
            <select name="MaNV" class="form-control">
                <option value="">-- Chọn Nhân Viên --</option>
                @foreach ($nhanviens as $nv)
                    <option value="{{ $nv->MaNV }}">{{ $nv->HoTen }}</option>
                @endforeach
            </select>
        </div>

        <!-- Mã khách hàng -->

        <label class="form-label">Khách hàng</label>
        <select name="MaKH" id="maKH" class="form-control" required>
            <option value="">Chọn mã khách hàng</option>
            @foreach ($khachhangs as $kh)
                <option value="{{ $kh->MaKH }}" {{ old('MaKH') == $kh->MaKH ? 'selected' : '' }}>
                    {{ $kh->MaKH }} - {{ $kh->TenKH }}
                </option>
            @endforeach
        </select>
        @error('MaKH')
            <span class="text-danger">{{ $message }}</span>
        @enderror


        <!-- Số tài khoản -->

        <label class="form-label">Số tài khoản</label>
        <select name="SoTK" id="soTK" class="form-control">
            <option value="">---Chọn tài khoản---</option>
            @foreach ($khachhangs as $kh)
                <option value="{{ $kh->SoTK }}" data-makh="{{ $kh->MaKH }}">
                    {{ $kh->SoTK }}
                </option>
            @endforeach
        </select>
        <div class="mb-3">
            <label class="form-label">Số Thẻ</label>
            <select name="SoThe" id="SoThe" class="form-control">
                @foreach ($khachhangs as $kh)
                    <option value="{{ $kh->SoThe }}" data-makh="{{ $kh->MaKH }}">
                        {{ $kh->SoThe }}
                    </option>
                @endforeach
            </select>

            @error('SoThe')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm Thẻ</button>
        <a href="{{ route('the.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
@endsection
