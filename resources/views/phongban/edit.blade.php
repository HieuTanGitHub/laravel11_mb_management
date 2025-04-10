@extends('layout')

@section('content')
    <h4 class="mb-3">Chỉnh Sửa Phòng Ban</h4>

    <form method="POST" action="{{ route('phongban.update', $phongban->MaPB) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Mã Phòng Ban</label>
            <input type="text" name="MaPB" class="form-control" value="{{ $phongban->MaPB }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên Phòng Ban</label>
            <input type="text" name="TenPB" class="form-control" value="{{ old('TenPB', $phongban->TenPB) }}">
            @error('TenPB')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('phongban.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
