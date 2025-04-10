@extends('layout')

@section('content')
    <h4>Danh Sách Loại Hoạt Động</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3 text-end">
        <a href="{{ route('loaihoatdong.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Mã Loại Hoạt Động</th>
                <th>Tên Loại Hoạt Động</th>
                <th>Mô Tả</th>
                <th class="text-center">Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($loaihoatdongs as $index => $loaihoatdong)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $loaihoatdong->MaLoaiHD }}</td>
                    <td>{{ $loaihoatdong->TenLoaiHD }}</td>
                    <td>{{ $loaihoatdong->MoTa }}</td>
                    <td class="text-center">
                        <a href="{{ route('loaihoatdong.edit', $loaihoatdong->MaLoaiHD) }}"
                            class="btn btn-warning btn-sm btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('loaihoatdong.destroy', $loaihoatdong->MaLoaiHD) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
