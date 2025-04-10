@extends('layout')

@section('content')
    <h4>Danh Sách Loại Tài Khoản</h4>

    <!-- Display success message if any -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('loaitk.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>
    <!-- Table displaying the records -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Loại Tài Khoản</th>
                <th>Tên Loại Tài Khoản</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loaitk as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $item->MaLoaiTK }}</td>
                    <td>{{ $item->TenLoaiTK }}</td>
                    <td class="text-center">
                        <a href="{{ route('loaitk.edit', $item->MaLoaiTK) }}"
                            class="btn btn-warning btn-sm btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('loaitk.destroy', $item->MaLoaiTK) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
