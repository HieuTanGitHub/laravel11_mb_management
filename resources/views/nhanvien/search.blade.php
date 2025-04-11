@extends('layout')

@section('content')
    <form class="search-form" action="{{ route('nhanvien.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="Nhập Tên nhân viên để tìm kiếm...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <h4>Tìm kiếm nhân viên : {{ $keyword }}</h4>
    <!-- Display success message if available -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('nhanvien.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>
    <!-- Table to display employee data -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã nhân viên</th>
                <th>Họ và tên</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Chức vụ</th>
                <th>Phòng ban</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nhanviens as $key => $nhanvien)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $nhanvien->MaNV }}</td>
                    <td>{{ $nhanvien->HoTen }}</td>
                    <td class="text-center">{{ $nhanvien->SDT }}</td>
                    <td class="text-center">{{ $nhanvien->Email }}</td>
                    <td class="text-center">{{ $nhanvien->chucvu->TenCV }}</td>
                    <td class="text-center">{{ $nhanvien->phongban->TenPB }}</td>
                    <td class="text-center">
                        <a href="{{ route('nhanvien.edit', $nhanvien->MaNV) }}" class="btn btn-edit btn-custom">Sửa</a>
                        {{-- <form action="{{ route('nhanvien.destroy', $nhanvien->MaNV) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-custom"
                                onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
