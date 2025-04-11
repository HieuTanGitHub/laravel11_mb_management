@extends('layout')

@section('content')
    <h4>Danh Sách Thẻ</h4>
    <div class="mb-3 text-end">
        <a href="{{ route('the.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Số Thẻ</th>
                <th>Ngày Mở</th>
                <th>Ngày Hết Hạn</th>
                <th>Loại Thẻ</th>
                <th>Nhân Viên</th>
                <th>Khách Hàng</th>
                <th>Số Tài Khoản</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($theList as $the)
                <tr>
                    <td>{{ $the->SoThe }}</td>
                    <td>{{ date('m/Y', strtotime($the->NgayMo)) }}</td>
                    <td>{{ date('m/Y', strtotime($the->NgayHetHan)) }}</td>
                    <td>{{ $the->loaiThe->TenLoaiThe ?? 'N/A' }}</td>
                    <td>{{ $the->nhanvien->HoTen ?? 'N/A' }}</td>
                    <td>{{ $the->khachhang->TenKH ?? 'N/A' }}</td>
                    <td>{{ $the->SoTK }}</td>
                    <td>
                        @if (\Carbon\Carbon::parse($the->NgayHetHan)->format('Y-m-d') >= now()->format('Y-m-d'))
                            <span class="badge bg-success">Còn hạn</span>
                        @else
                            <span class="badge bg-danger">Hết hạn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('the.edit', $the->SoThe) }}" class="btn btn-warning btn-sm btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('the.destroy', $the->SoThe) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
