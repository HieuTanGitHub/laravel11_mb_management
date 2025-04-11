@extends('layout')

@section('content')
    <h2 class="title">QUẢN LÝ THÔNG TIN KHÁCH HÀNG CÁ NHÂN</h2>
    <form class="search-form" action="{{ route('khachhangcanhan.search') }}" method="GET">

        <input type="text" name="keyword" placeholder="Nhập số điện thoại hoặc CCCD để tìm kiếm...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <h4>TÌM KIẾM KHÁCH HÀNG CÁ NHÂN : {{ $keyword }}</h4>

    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('khachhangcanhan.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Khách Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Số Điện Thoại</th>

                <th>CCCD</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khachhangs as $key => $khachhang)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $khachhang->MaKH }}</td>
                    <td>{{ $khachhang->khach?->TenKH }}</td>
                    <td>{{ $khachhang->khach?->SDT }}</td>
                    <td>
                        {{ $khachhang->khach?->CCCD ?? 'Chưa có thông tin' }}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-warning btn-edit-chitiet" data-id="{{ $khachhang->MaKH }}">
                            Chi tiết
                        </a>
                        <a href="{{ route('khachhangcanhan.edit', $khachhang->MaKH) }}"
                            class="btn btn-warning 
btn-edit-style">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="modalChiTiet" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi Tiết Khách Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="showDetailKhachHang"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
