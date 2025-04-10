@extends('layout')

@section('content')
    <h4>Danh Sách Loại Thẻ</h4>
    <div class="mb-3 text-end">
        <a href="{{ route('loaithe.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>
    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Loại Thẻ</th>
                <th>Tên Loại Thẻ</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loaithe as $key => $lt)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $lt->MaLoaiThe }}</td>
                    <td>{{ $lt->TenLoaiThe }}</td>
                    <td class="text-center">
                        <a href="{{ route('loaithe.edit', $lt->MaLoaiThe) }}" class="btn btn-warning btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('loaithe.destroy', $lt->MaLoaiThe) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
