@extends('layout')

@section('content')
    <h4>Cập Nhật Loại Tài Khoản</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('loaitk.update', $loaitk->MaLoaiTK) }}">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Mã Loại Tài Khoản</label>
                <input type="text" name="MaLoaiTK" class="form-control" value="{{ $loaitk->MaLoaiTK }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Tên Loại Tài Khoản</label>
                <input type="text" name="TenLoaiTK" class="form-control"
                    value="{{ old('TenLoaiTK', $loaitk->TenLoaiTK) }}" required>
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">Cập Nhật</button>
            <a href="{{ route('loaitk.index') }}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
@endsection
