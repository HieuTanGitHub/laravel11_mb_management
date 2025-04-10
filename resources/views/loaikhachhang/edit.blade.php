@extends('layout')

@section('content')
    <h4>CẬP NHẬT LOẠI KHÁCH HÀNG</h4>

    <!-- Hiển thị thông báo lỗi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form cập nhật -->
    <form method="POST" action="{{ route('loaikhachhang.update', $loaikhachhang->MaLoaiKH) }}">
        @csrf
        @method('PUT')

        <fieldset class="border p-3 mb-3">
            <legend class="float-none w-auto px-2">Chỉnh sửa thông tin</legend>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Mã Loại KH</label>
                    <input type="text" name="MaLoaiKH" class="form-control"
                        value="{{ old('MaLoaiKH', $loaikhachhang->MaLoaiKH) }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tên Loại KH</label>
                    <input type="text" name="TenLoaiKH" class="form-control"
                        value="{{ old('TenLoaiKH', $loaikhachhang->TenLoaiKH) }}">
                    @error('TenLoaiKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Mô Tả</label>
                    <textarea name="MoTa" class="form-control">{{ old('MoTa', $loaikhachhang->MoTa) }}</textarea>
                    @error('MoTa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <!-- Nút hành động -->
        <div class="text-end">
            <button type="submit" class="btn btn-save btn-custom">Cập nhật</button>
            <a href="{{ route('loaikhachhang.index') }}" class="btn btn-cancel btn-custom">Hủy</a>
        </div>
    </form>
@endsection
