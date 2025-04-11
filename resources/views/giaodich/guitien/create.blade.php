@extends('layout')

@section('content')
    <div class="container mt-4">
        <h4 class="text-center mb-4 fw-bold">THÊM MỚI GIAO DỊCH GỬI TIỀN</h4>
        <div class="mb-3">
            <a href="{{ route('giaodich.ruttien') }}" class="btn btn-primary">
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
        <form id="formguitien" action="{{ route('giaodich.guitien.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <label>Mã giao dịch</label>
                    <input type="text" class="form-control" name="MaGDGuiTien" readonly value="{{ $newMaGD }}">
                </div>

                <div class="col-md-3">
                    <label>Ngày tạo</label>
                    <input type="text" class="form-control" name="NgayTao" readonly
                        value="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh') }}">
                </div>

                <div class="col-md-3">
                    <label>Người tạo</label>
                    <input type="text" class="form-control" name="MaNV" readonly
                        value="{{ Session::get('TenDangNhap') }}">
                </div>

                <div class="col-md-3">
                    <label>Điểm giao dịch</label>
                    <input type="text" class="form-control" name="ViTri" readonly value="Tại Quầy">
                </div>
            </div>

            <h6 class="mt-4 fw-bold">Thông tin giao dịch</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Tên người gửi *</label>
                    <input type="text" name="TenNG" class="form-control" id="TenNG">
                </div>
                <div class="col-md-6">
                    <label>Số điện thoại người gửi *</label>
                    <input type="text" name="SDTNG" class="form-control" id="SDTNG">
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-3">
                    <label>Số tài khoản người nhận *</label>
                    <select name="SoTK" class="form-control chonsotaikhoan">
                        <option>---Chọn tài khoản---</option>
                        @foreach ($khachhang as $key => $kh)
                            <option value="{{ $kh->khach?->SoTK }}">{{ $kh->khach?->SoTK }} - {{ $kh->khach?->TenKH }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Tên chủ tài khoản</label>
                    <input type="text" class="form-control" id="TenKH" disabled>
                </div>
                <div class="col-md-3">
                    <label>Ngân hàng *</label>
                    <input type="text" class="form-control" name="NganHang" value="TP Bank" readonly>
                </div>

                {{-- <div class="col-md-2">
                    <label>CCCD</label>
                    <input type="text" class="form-control" id="CCCD" disabled>
                </div>

                <div class="col-md-2">
                    <label>Số thẻ</label>
                    <input type="text" class="form-control" id="SoThe" disabled>
                </div>

                <div class="col-md-2">
                    <label>Số dư tài khoản</label>
                    <input type="text" class="form-control" id="SoDuTK" disabled>
                </div> --}}

                <div class="col-md-3">
                    <label>Số tiền gửi</label>
                    <input type="number" min="1000000" id="SoTienGui" value="1000000" name="SoTienGui" placeholder=">1tr"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Phí giao dịch</label>
                    <input type="text" min="0" name="PhiGiaoDich" id="PhiGiaoDich" value="10000" placeholder="0"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Tổng tiền</label>
                    <input type="text" min="0" name="TongTien" id="TongTien" placeholder="0"
                        class="form-control">
                </div>

                <div class="col-md-6">
                    <label>Nội dung</label>
                    <textarea class="form-control" name="NoiDung" rows="3">Giao Dịch Gửi Tiền Tại Quầy.</textarea>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ route('giaodich.guitien') }}" class="btn btn-danger">
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
                    <h5 class="modal-title">Xác nhận thông tin gửi tiền</h5>
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
    <!-- Modal Biên Lai -->
    <div class="modal fade" id="modalBienLai" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body" id="bienLaiContent">
                    <div class="receipt-container"></div>
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

        #bienLaiContent ul {
            list-style: none;
            padding: 0;
        }

        #bienLaiContent li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            font-size: 15px;
        }

        #bienLaiContent li strong {
            color: #333;
            min-width: 150px;
        }

        div#bienLaiContent h5 {
            text-align: center;
            font-weight: bold;
            color: blue;
        }

        div#bienLaiContent ul {
            margin: 0;
            padding: 0;
            text-align: left;
        }
    </style>
@endsection
