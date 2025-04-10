@extends('layout')

@section('content')
    <h4 class="mb-3">Danh Sách Phòng Ban</h4>


    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('phongban.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>

    <!-- Bảng Danh Sách Phòng Ban -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Phòng Ban</th>
                <th>Tên Phòng Ban</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($phongbans as $index => $phongban)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $phongban->MaPB }}</td>
                    <td>{{ $phongban->TenPB }}</td>
                    <td class="text-center">
                        <a href="{{ route('phongban.edit', $phongban->MaPB) }}"
                            class="btn btn-warning btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('phongban.destroy', $phongban->MaPB) }}" method="POST"
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
