@extends('layout')

@section('content')
    <h4 class="text-center fw-bold">QUẢN LÝ THÔNG TIN KHÁCH HÀNG CÁ NHÂN</h4>

    <!-- Thanh tìm kiếm -->
    <div class="d-flex justify-content-between my-3">
        <div class="input-group w-50">
            <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm...">
            <button class="btn btn-search"><i class="fa fa-search"></i></button>
        </div>
        <div>
            <a href="{{ route('khachhang/create') }}"> <button class="btn btn-add btn-custom"><i class="fa fa-plus"></i> Thêm
                    mới</button></a>

        </div>
    </div>

    <!-- Bảng danh sách khách hàng -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>CCCD</th>
                <th>Email</th>
                <th>Ngày sinh</th>
                <th>Địa chỉ</th>
                <th>Mã loại khách hàng</th>
                <th>Số tài khoản</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khachhangs as $index => $khachhang)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $khachhang->MaKH }}</td>
                    <td>{{ $khachhang->TenKH }}</td>
                    <td class="text-center">{{ $khachhang->SDT }}</td>
                    <td class="text-center">{{ $khachhang->CCCD }}</td>
                    <td class="text-center">{{ $khachhang->Email }}</td>
                    <td class="text-center">{{ $khachhang->NgaySinh }}</td>
                    <td class="text-center">{{ $khachhang->DiaChi }}</td>
                    <td class="text-center">{{ $khachhang->MaLoaiKH }}</td>
                    <td class="text-center">{{ $khachhang->SoTK }}</td>
                    <td class="text-center">
                        <a href="{{ route('khachhang.edit', $khachhang->MaKH) }}" class="btn btn-edit btn-custom">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
