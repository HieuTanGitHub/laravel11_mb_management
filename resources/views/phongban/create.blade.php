@extends('layout')

@section('content')
    <h4 class="mb-3">Thêm Mới Phòng Ban</h4>

    <form action="{{ route('phongban.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mã Phòng Ban</label>
                <input type="text" name="MaPB" class="form-control" value="{{ old('MaPB') }}">
                @error('MaPB')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tên Phòng Ban</label>
                <input type="text" name="TenPB" class="form-control" value="{{ old('TenPB') }}">
                @error('TenPB')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('phongban.index') }}" class="btn btn-danger">Hủy</a>
        </div>
    </form>
@endsection
