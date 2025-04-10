@extends('layout')

@section('content')
    <h4>Chỉnh sửa Loại Hoạt Động</h4>

    <form action="{{ route('loaihoatdong.update', $loaihoatdong->MaLoaiHD) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mã Loại Hoạt Động</label>
            <input type="text" name="MaLoaiHD" class="form-control" value="{{ $loaihoatdong->MaLoaiHD }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên Loại Hoạt Động</label>
            <input type="text" name="TenLoaiHD" class="form-control"
                value="{{ old('TenLoaiHD', $loaihoatdong->TenLoaiHD) }}">
            @error('TenLoaiHD')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mô Tả</label>
            <textarea name="MoTa" class="form-control">{{ old('MoTa', $loaihoatdong->MoTa) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('loaihoatdong.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
