@extends('layout')

@section('content')
    <div class="container">
        <h2 class="mb-4">Danh Sách Tài Khoản</h2>
        <div class="mb-3 text-end">
            <a href="{{ route('taikhoan.create') }}" class="btn btn-add btn-custom">
                <i class="fa fa-plus"></i> Thêm Mới
            </a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Số TK</th>
                    <th>Số Dư</th>
                    <th>Ngày Mở</th>
                    <th>Ngày Đóng</th>
                    <th>Trạng Thái</th>
                    <th>Loại Thẻ</th>
                    <th>Nhân Viên</th>
                    <th>Khách Hàng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taiKhoans as $tk)
                    <tr>
                        <td>{{ $tk->SoTK }}</td>
                        <td>{{ number_format($tk->SoDuTK, 0, ',', '.') }} VND</td>
                        <td>{{ \Carbon\Carbon::parse($tk->NgayMo)->format('d/m/Y') }}</td>
                        <td>{{ $tk->NgayDong ? \Carbon\Carbon::parse($tk->NgayDong)->format('d/m/Y') : '---' }}</td>
                        <td>
                            <span class="badge {{ $tk->TrangThai ? 'bg-success' : 'bg-danger' }}">
                                {{ $tk->TrangThai ? 'Còn hiệu lực' : 'Đã đóng' }}
                            </span>
                        </td>
                        <td>{{ $tk->loaiThe->TenLoaiThe ?? 'N/A' }}</td>
                        <td>{{ $tk->nhanVien->HoTen ?? 'N/A' }}</td>
                        <td>{{ $tk->khachHang->TenKH ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('taikhoan.edit', $tk->SoTK) }}"
                                class="btn btn-warning btn-sm btn-edit-style">Sửa</a>
                            {{-- <form action="{{ route('taikhoan.destroy', $tk->SoTK) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    Xóa
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
