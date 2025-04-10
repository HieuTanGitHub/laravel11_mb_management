@extends('layout')

@section('content')
    <h4>Thêm Mới Loại Thẻ</h4>

    <!-- Hiển thị lỗi validation -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loaithe.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Mã Loại Thẻ</label>
            <input type="text" name="MaLoaiThe" class="form-control" value="{{ old('MaLoaiThe') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên Loại Thẻ</label>
            <input type="text" name="TenLoaiThe" class="form-control" value="{{ old('TenLoaiThe') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('loaithe.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
