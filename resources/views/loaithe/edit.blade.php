@extends('layout')

@section('content')
    <h4>CHỈNH SỬA LOẠI THẺ</h4>

    <form action="{{ route('loaithe.update', $loaithe->MaLoaiThe) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mã Loại Thẻ</label>
            <input type="text" name="MaLoaiThe" class="form-control" value="{{ $loaithe->MaLoaiThe }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên Loại Thẻ</label>
            <input type="text" name="TenLoaiThe" class="form-control"
                value="{{ old('TenLoaiThe', $loaithe->TenLoaiThe) }}">
            @error('TenLoaiThe')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Cập Nhật</button>
        <a href="{{ route('loaithe.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
