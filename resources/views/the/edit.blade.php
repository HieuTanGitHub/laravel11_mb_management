@extends('layout')

@section('content')
    <h4>Chỉnh sửa Thẻ</h4>

    <form action="{{ route('the.update', $the->SoThe) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="SoThe" class="form-label">Số Thẻ</label>
            <input type="text" class="form-control" readonly id="SoThe" name="SoThe"
                value="{{ old('SoThe', $the->SoThe) }}" required>
        </div>

        <div class="mb-3">
            <label for="NgayMo" class="form-label">Ngày Mở</label>
            <input type="date" class="form-control" id="NgayMo" name="NgayMo"
                value="{{ old('NgayMo', \Carbon\Carbon::parse($the->NgayMo)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="NgayHetHan" class="form-label">Ngày Hết Hạn</label>
            <input type="date" class="form-control" id="NgayMo" name="NgayHetHan"
                value="{{ old('NgayMo', \Carbon\Carbon::parse($the->NgayHetHan)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="NgayDong" class="form-label">Ngày Đóng</label>
            <input type="date" class="form-control" id="NgayMo" name="NgayDong"
                value="{{ old('NgayMo', \Carbon\Carbon::parse($the->NgayDong)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="MaLoaiThe" class="form-label">Loại Thẻ</label>
            <select class="form-control" id="MaLoaiThe" name="MaLoaiThe">
                @foreach ($loaitheList as $loaithe)
                    <option value="{{ $loaithe->MaLoaiThe }}"
                        {{ $loaithe->MaLoaiThe == $the->MaLoaiThe ? 'selected' : '' }}>
                        {{ $loaithe->TenLoaiThe }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label class="form-label">Nhân Viên (nếu có)</label>
            <select name="MaNV" class="form-control">
                <option value="">-- Chọn Nhân Viên --</option>
                @foreach ($nhanviens as $nv)
                    <option {{ $nv->MaNV == $nv->MaNV ? 'selected' : '' }} value="{{ $nv->MaNV }}">
                        {{ $nv->HoTen }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Khách Hàng (nếu có)</label>
            <select name="MaKH" class="form-control">
                <option value="">-- Chọn Khách Hàng --</option>
                @foreach ($khachhangs as $kh)
                    <option {{ $kh->MaKH == $kh->MaKH ? 'selected' : '' }}
                        value="{{ $nv->MaNV }}  value="{{ $kh->MaKH }}">{{ $kh->TenKH }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="SoTK" class="form-label">Số Tài Khoản</label>
            <input type="text" class="form-control" readonly id="SoTK" name="SoTK"
                value="{{ old('SoTK', $the->SoTK) }}" required>
        </div>

        <div class="mb-3">
            <label for="NgayTao" class="form-label">Ngày Tạo</label>
            <input type="date" class="form-control" id="NgayMo" name="NgayTao"
                value="{{ old('NgayMo', \Carbon\Carbon::parse($the->NgayTao)->format('Y-m-d')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
