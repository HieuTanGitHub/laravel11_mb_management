@extends('layout')

@section('content')
    <h4>Thêm Mới Thẻ</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('the.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Số Thẻ</label>
            <input type="text" name="SoThe" class="form-control" value="{{ old('SoThe') }}" required>
            @error('SoThe')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Mở</label>
            <input type="date" name="NgayMo" class="form-control" value="{{ old('NgayMo') }}" required>
            @error('NgayMo')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Hết Hạn</label>
            <input type="date" name="NgayHetHan" class="form-control" value="{{ old('NgayHetHan') }}" required>
            @error('NgayHetHan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày Đóng (nếu có)</label>
            <input type="date" name="NgayDong" class="form-control" value="{{ old('NgayDong') }}">
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

        <div class="mb-3">
            <label class="form-label">Khách Hàng (nếu có)</label>
            <select name="MaKH" class="form-control">
                <option value="">-- Chọn Khách Hàng --</option>
                @foreach ($khachhangs as $kh)
                    <option value="{{ $kh->MaKH }}">{{ $kh->TenKH }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Số Tài Khoản</label>
            <input type="text" name="SoTK" class="form-control" value="{{ old('SoTK') }}">
        </div>

        <button type="submit" class="btn btn-primary">Thêm Thẻ</button>
        <a href="{{ route('the.index') }}" class="btn btn-secondary">Quay Lại</a>
    </form>
@endsection
