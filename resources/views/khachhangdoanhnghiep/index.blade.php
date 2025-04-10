@extends('layout')

@section('content')
    <h4 class="mb-3">Danh sách khách hàng doanh nghiệp</h4>
    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('khachhangdoanhnghiep.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã KH</th>
                <th>Tên Doanh Nghiệp</th>
                <th>MST</th>
                <th>Đại Diện</th>
                <th>Chức Vụ</th>
                <th>Email Kế Toán</th>
                <th>Hồ Sơ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khachhangs as $key => $kh)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $kh->MaKH }}</td>
                    <td>{{ $kh->TenDN }}</td>
                    <td>{{ $kh->MaSoThue }}</td>
                    <td>{{ $kh->TenDaiDienPL }}</td>
                    <td>{{ $kh->ChucVu }}</td>
                    <td>{{ $kh->EmailKT }}</td>
                    <td class="text-center">
                        @if ($kh->HoSoDN)
                            <a href="{{ asset('storage/' . $kh->HoSoDN) }}" target="_blank" download class="btn btn-primary">
                                Tải Xuống
                            </a>
                        @else
                            <span class="text-muted">Chưa có</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('khachhangdoanhnghiep.edit', $kh->MaKH) }}"
                            class="btn btn-warning btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('khachhangdoanhnghiep.destroy', $kh->MaKH) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
