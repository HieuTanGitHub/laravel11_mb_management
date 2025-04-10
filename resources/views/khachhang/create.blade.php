@extends('layout')

@section('content')
    <h4>THÊM MỚI THÔNG TIN KHÁCH HÀNG CÁ NHÂN</h4>

    <!-- Ngày tạo và Người tạo -->
    <div class="row mb-3">
        {{-- <div class="col-md-6">
            <label class="form-label">Ngày tạo:</label>
            <input type="text" class="form-control" value="09:05:05 01/03/2025">
        </div>
        <div class="col-md-6">
            <label class="form-label">Người tạo:</label>
            <input type="text" class="form-control" value="Nguyễn Văn A">
        </div> --}}
    </div>

    <!-- Form nhập thông tin khách hàng -->
    <fieldset class="border p-3 mb-3">
        <legend class="float-none w-auto px-2">Thông tin khách hàng</legend>
        <form method="POST" action="{{ route('khachhang/store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Mã khách hàng</label>
                    <input type="text" name="MaKH" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tên khách hàng</label>
                    <input type="text" name="TenKH" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">CCCD</label>
                    <input type="text" name="CCCD" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" name="NgaySinh" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="DiaChi" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Mã Loại Khách Hàng</label>
                    <select name="MaLoaiKH" class="form-control">
                        <option name="ML1">
                            Mã Loại 1
                        </option>
                        <option name="ML2">
                            Mã Loại 2
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="SDT" class="form-control" value="">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Số tài khoản</label>
                    <input type="text" name="SoTK" class="form-control" value="">
                </div>
            </div>
    </fieldset>

    <!-- Nút hành động -->
    <div class="text-end">
        <button class="btn btn-save btn-custom">Lưu</button>
        </form>
        <button class="btn btn-cancel btn-custom">Hủy</button>
        <button class="btn btn-empty btn-custom" onclick="showErrorAlert()">Empty</button>

    </div>
@endsection
