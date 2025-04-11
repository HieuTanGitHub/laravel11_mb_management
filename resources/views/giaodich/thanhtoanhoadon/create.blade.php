@extends('layout')

@section('content')
    <div class="container mt-4">
        <h4 class="text-center mb-4 fw-bold">THÊM MỚI GIAO DỊCH THANH TOÁN HÓA ĐƠN</h4>
        <div class="mb-3">
            <a href="{{ route('giaodich.thanhtoanhoadon') }}" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <form id="formthanhtoanhoadon" action="{{ route('giaodich.thanhtoanhoadon.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Mã giao dịch</label>
                    <input type="text" name="MaGDThanhToan" readonly class="form-control" value="{{ rand(000, 9999) }}">
                </div>
                <div class="col-md-3">
                    <label>Ngày tạo</label>
                    <input type="text" name="NgayTao" readonly class="form-control"
                        value="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh') }}">
                </div>
                <div class="col-md-3">
                    <label>Người tạo</label>
                    <input type="text" name="NguoiTao" class="form-control" readonly
                        value="{{ Session::get('TenDangNhap') }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Điểm giao dịch</label>
                    <input type="text" name="DiemGD" class="form-control" readonly value="Tại Quầy">
                </div>
            </div>

            <h5>Thông tin giao dịch</h5>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Loại hóa đơn</label>
                    <select name="LoaiHD" id="LoaiHD" class="form-control">
                        <option value="">-- Chọn loại hóa đơn --</option>
                        <option value="dien">Hóa đơn điện</option>
                        <option value="nuoc">Hóa đơn nước</option>
                        <option value="internet">Hóa đơn Internet</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Nhà cung cấp</label>
                    <select name="NCC" id="NCC" class="form-control">
                        <option value="">-- Chọn nhà cung cấp --</option>
                    </select>
                </div>


                <div class="col-md-3">
                    <label>Ngân hàng</label>
                    <input type="text" name="NganHang" readonly value="TP Bank" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Số tài khoản *</label>
                    <select name="SoTK" class="form-control chonsotaikhoan">
                        <option>---Chọn tài khoản---</option>
                        @foreach ($khachhang as $key => $kh)
                            <option value="{{ $kh->khach?->SoTK }}">{{ $kh->khach?->SoTK }} - {{ $kh->khach?->TenKH }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Tên chủ tài khoản</label>
                    <input type="text" name="TenChuTK" id="TenKH" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Số hóa đơn</label>
                    <input type="text" name="SoHD" readonly value="{{ 'SHD' . rand(000, 9999) }}"
                        class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Số tiền thanh toán</label>
                    <input type="number" name="SoTienThanhToan" id="SoTien" readonly value="125000"
                        class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Địa chỉ KH</label>
                    <input type="text" name="DiaChiKH" id="DiaChi" readonly class="form-control">
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="SDT" id="SDT" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Mã khách hàng</label>
                    <input type="text" name="MaKH" id="MaKH" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Phí giao dịch</label>
                    <input type="number" name="PhiGiaoDich" id="phigiaodich" min="1" name="PhiGD"
                        class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Tổng tiền</label>
                    <input type="number" id="tongtien" name="TongTien" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Nội dung</label>
                <textarea name="NoiDung" class="form-control"></textarea>
            </div>

            <div class="text-end">
                <a href="{{ route('giaodich.thanhtoanhoadon') }}" class="btn btn-danger">
                    Hủy
                </a>
                <button type="submit" class="btn btn-primary">Tạo mới</button>
            </div>
        </form>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận thông tin thanh toán hóa đơn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <!-- Nội dung đổ vào đây -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmSubmit">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        #modalContent ul {
            list-style: none;
            padding: 0;
        }

        #modalContent li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            font-size: 15px;
        }

        #modalContent li strong {
            color: #333;
            min-width: 150px;
        }
    </style>
@endsection
