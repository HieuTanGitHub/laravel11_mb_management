@extends('layout')

@section('content')
    <h2 class="title">QUẢN LÝ THÔNG TIN CHUNG GIAO DỊCH</h2>
    <form class="search-form" action="{{ route('giaodich.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="Nhập thời gian giao dịch để tìm kiếm...">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>


    <!-- Hiển thị thông báo thành công -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- Nút thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('giaodich.themruttien') }}" class="btn btn-add btn-custom">
            <i class="fa fa-plus"></i> Thêm Mới
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã Giao Dịch</th>
                <th>Thời gian giao dịch</th>
                <th>Loại giao dịch</th>
                <th>Chức Năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruttien as $key => $rut)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $rut->MaGDRutTien }}</td>
                    <td class="text-center">{{ $rut->NgayTao }}</td>
                    <td class="text-center">{{ $rut->LoaiGiaoDich }}</td>


                    <td class="text-center">
                        <a class="btn btn-warning btn-edit-chitiet-giaodich btn-edit-chitiet"
                            data-id="{{ $rut->MaGDRutTien }}">
                            Chi tiết
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="modal-chitiet" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết giao dịch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="info">
                    <!-- Dữ liệu ajax sẽ load vào đây -->
                </div>
            </div>
        </div>
    </div>
@endsection
