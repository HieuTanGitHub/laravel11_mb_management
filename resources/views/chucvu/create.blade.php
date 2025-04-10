@extends('layout')

@section('content')
    <h4 class="mb-3">Thêm Mới Chức Vụ</h4>

    <form method="POST" action="{{ route('chucvu.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Mã Chức Vụ</label>
            <input type="text" name="MaCV" class="form-control" value="{{ old('MaCV') }}">
            @error('MaCV')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Tên Chức Vụ</label>
            <input type="text" name="TenCV" class="form-control" value="{{ old('TenCV') }}">
            @error('TenCV')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mã Phòng Ban</label>
            <select name="MaPB" class="form-control">
                @foreach ($phongbans as $phongban)
                    <option value="{{ $phongban->MaPB }}" {{ old('MaPB') == $phongban->MaPB ? 'selected' : '' }}>
                        {{ $phongban->TenPB }}
                    </option>
                @endforeach
            </select>
            @error('MaPB')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm Mới</button>
        <a href="{{ route('chucvu.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
@endsection
