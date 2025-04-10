
@extends('layout')

@section('content')
    <h4>Chỉnh sửa chức vụ</h4>

    <!-- Form to edit the ChucVu -->
    <form method="POST" action="{{ route('chucvu.update', $chucvu->MaCV) }}">
        @csrf

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Mã chức vụ</label>
                <input type="text" name="MaCV" class="form-control" value="{{ $chucvu->MaCV }}" readonly>
            </div>

            <div class="col-md-4">
                <label class="form-label">Tên chức vụ</label>
                <input type="text" name="TenCV" class="form-control" value="{{ old('TenCV', $chucvu->TenCV) }}" required>
                @error('TenCV')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-4">
                <label class="form-label">Phòng ban</label>
                <select name="MaPB" class="form-control">
                    @foreach ($phongbans as $phongban)
                        <option value="{{ $phongban->MaPB }}" {{ $phongban->MaPB == $chucvu->MaPB ? 'selected' : '' }}>
                            {{ $phongban->TenPB }}
                        </option>
                    @endforeach
                </select>
                @error('MaPB')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-save btn-custom">Cập nhật</button>
            <a href="{{ route('chucvu.index') }}" class="btn btn-cancel btn-custom">Hủy</a>
        </div>
    </form>
@endsection
