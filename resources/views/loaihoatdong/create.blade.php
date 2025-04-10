@extends('layout')

@section('content')
    <h4>THÊM MỚI LOẠI HOẠT ĐỘNG</h4>

    <form action="{{ route('loaihoatdong.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Mã Loại Hoạt Động</label>
            <input type="text" name="MaLoaiHD" class="form-control" value="{{ old('MaLoaiHD') }}">
            @error('MaLoaiHD')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tên Loại Hoạt Động</label>
            <input type="text" name="TenLoaiHD" class="form-control" value="{{ old('TenLoaiHD') }}">
            @error('TenLoaiHD')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mô Tả</label>
            <textarea name="MoTa" class="form-control">{{ old('MoTa') }}</textarea>
            @error('MoTa')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Thêm Mới</button>
        <a href="{{ route('loaihoatdong.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
