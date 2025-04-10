@extends('layout')

@section('content')
    <h4>THÊM MỚI LOẠI KHÁCH HÀNG</h4>

    <!-- Form nhập thông tin loại khách hàng -->
    <fieldset class="border p-3 mb-3">
        <legend class="float-none w-auto px-2">Thông tin loại khách hàng</legend>
        <form method="POST" action="{{ route('loaikhachhang.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Mã Loại Khách Hàng</label>
                    <input type="text" name="MaLoaiKH" class="form-control" value="{{ old('MaLoaiKH') }}">
                    @error('MaLoaiKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tên Loại Khách Hàng</label>
                    <input type="text" name="TenLoaiKH" class="form-control" value="{{ old('TenLoaiKH') }}">
                    @error('TenLoaiKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label class="form-label">Mô Tả</label>
                    <textarea name="MoTa" class="form-control">{{ old('MoTa') }}</textarea>
                    @error('MoTa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
    </fieldset>

    <!-- Nút hành động -->
    <div class="text-end">
        <button class="btn btn-save btn-custom">Lưu</button>
        </form>
        <a href="{{ route('loaikhachhang.index') }}" class="btn btn-cancel btn-custom">Hủy</a>
    </div>
@endsection
