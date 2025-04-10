@extends('layout')

@section('content')
    <h4>DANH SÁCH LOẠI KHÁCH HÀNG</h4>

    <!-- Hiển thị thông báo nếu có -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('loaikhachhang.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>

    <!-- Bảng danh sách loại khách hàng -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Loại KH</th>
                <th>Tên Loại KH</th>
                <th>Mô Tả</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loaikhachhangs as $key => $loaiKH)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $loaiKH->MaLoaiKH }}</td>
                    <td>{{ $loaiKH->TenLoaiKH }}</td>
                    <td>{{ $loaiKH->MoTa }}</td>
                    <td class="text-center">
                        <a href="{{ route('loaikhachhang.edit', $loaiKH->MaLoaiKH) }}"
                            class="btn btn-edit btn-custom btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('loaikhachhang.destroy', $loaiKH->MaLoaiKH) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-custom"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
