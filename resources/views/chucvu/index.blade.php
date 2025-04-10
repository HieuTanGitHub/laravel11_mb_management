@extends('layout')

@section('content')
    <h4 class="mb-3">Danh Sách Chức Vụ</h4>

    <div class="mb-3 text-end">
        <a href="{{ route('chucvu.create') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Chức Vụ</th>
                <th>Tên Chức Vụ</th>
                <th>Phòng Ban</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($chucvus as $index => $chucvu)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $chucvu->MaCV }}</td>
                    <td>{{ $chucvu->TenCV }}</td>
                    <td>{{ $chucvu->phongban->TenPB }}</td>
                    <td class="text-center">
                        <a href="{{ route('chucvu.edit', $chucvu->MaCV) }}" class="btn btn-warning btn-edit-style">Sửa</a>
                        {{-- <form action="{{ route('chucvu.destroy', $chucvu->MaCV) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
