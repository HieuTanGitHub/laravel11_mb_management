@extends('layout')

@section('content')
    <h4>Thêm Mới Loại Tài Khoản</h4>

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

    <!-- Form nhập thông tin loại tài khoản -->
    <form method="POST" action="{{ route('loaitk.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Mã Loại Tài Khoản</label>
                <input type="text" name="MaLoaiTK" class="form-control" value="{{ old('MaLoaiTK') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tên Loại Tài Khoản</label>
                <input type="text" name="TenLoaiTK" class="form-control" value="{{ old('TenLoaiTK') }}" required>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('loaitk.index') }}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
@endsection
