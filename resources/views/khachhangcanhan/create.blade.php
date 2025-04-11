@extends('layout')

@section('content')
    <h4>THÊM MỚI KHÁCH HÀNG CÁ NHÂN</h4>
    <style>
        .col-md-6.check-form {
            display: inline-table;
        }
    </style>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Ngày tạo</label>
            <input type="text" readonly name="NgayTao" class="form-control"
                value="{{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh') }}">

        </div>
        <div class="col-md-6">
            <label class="form-label">Người tạo</label>
            <input type="text" readonly name="NguoiTao" class="form-control" value="{{ Session::get('TenDangNhap') }}">

        </div>
    </div>
    <!-- Form nhập thông tin khách hàng -->
    <form method="POST" action="{{ route('khachhangcanhan.store') }}" enctype="multipart/form-data">
        @csrf

        <fieldset class="border p-3 mb-3">
            <legend class="float-none w-auto px-2">Nhập thông tin khách hàng</legend>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Mã Khách Hàng</label>
                    <input type="text" name="MaKH" readonly class="form-control" value="{{ $maKH }}">
                    @error('MaKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nghề Nghiệp</label>
                    <input type="text" name="NgheNghiep" class="form-control" value="{{ old('NgheNghiep') }}">
                    @error('NgheNghiep')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Doanh Thu</label>
                    <input type="number" name="DoanhThu" min="1" class="form-control" value="{{ old('DoanhThu') }}">
                    @error('DoanhThu')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hồ Sơ Cá Nhân (File PDF, DOCX)</label>
                    <input type="file" name="HoSoCaNhan" class="form-control">
                    @error('HoSoCaNhan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tên Khách Hàng</label>
                    <input type="text" name="TenKH" class="form-control" value="{{ old('TenKH') }}">
                    @error('TenKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">CCCD</label>
                    <input type="text" name="CCCD" class="form-control" value="{{ old('CCCD') }}">
                    @error('CCCD')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" name="Email" class="form-control" value="{{ old('Email') }}">
                    @error('Email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control" value="{{ old('NgaySinh') }}">
                    @error('NgaySinh')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" name="SDT" class="form-control" value="{{ old('SDT') }}">
                    @error('SDT')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tỉnh thành phố</label>
                    <select name="Thanhpho" id="city" class="form-control choose city">
                        <option value="">--Chọn tỉnh thành phố--</option>
                        @foreach ($city as $key => $ci)
                            <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Quận huyện</label>
                    <select name="Quanhuyen" id="province" class="form-control choose province city">
                        <option value="">--Chọn quận huyện--</option>

                    </select>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Xã phường</label>
                    <select name="Xaphuong" id="wards" class="form-control wards">
                        <option value="">--Chọn Xã phường--</option>

                    </select>

                </div>
                <div class="col-md-6">
                    <label class="form-label">Số Tài Khoản</label>
                    <input type="text" name="SoTK" class="form-control">
                    @error('SoTK')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 check-form">
                    <label class="form-label">Thẻ cứng</label>
                    <div class="form-check">
                        <input class="form-check-input" value="có" type="radio" name="TheCung"
                            id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Có
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="Không" type="radio" name="TheCung"
                            id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Không
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Loại Tài Khoản</label>
                    <select name="MaLoaiTK" class="form-control">
                        @foreach ($loaitaikhoan as $key => $loaitk)
                            <option value="{{ $loaitk->MaLoaiTK }}">{{ $loaitk->TenLoaiTK }}</option>
                        @endforeach
                    </select>
                    @error('MaLoaiTK')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- <div class="col-md-6">
                    <label class="form-label">Loại Khách Hàng</label>
                    <select name="MaLoaiKH" class="form-control">
                        @foreach ($loaikhachhang as $key => $loaikh)
                            <option value="{{ $loaikh->MaLoaiKH }}">{{ $loaikh->TenLoaiKH }}</option>
                        @endforeach
                    </select>
                    @error('LoaiKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div> --}}
                <div class="col-md-6">
                    <label class="form-label">Loại Thẻ</label>
                    <select name="LoaiThe" class="form-control">
                        @foreach ($loaithe as $key => $loaithe)
                            <option value="{{ $loaithe->MaLoaiThe }}">{{ $loaithe->TenLoaiThe }}</option>
                        @endforeach
                    </select>
                    @error('LoaiKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Số Thẻ</label>
                    <input type="text" name="SoThe" readonly
                        value="{{ old('SoThe', rand(1000_0000_0000_0000, 9999_9999_9999_9999)) }}" class="form-control">
                    @error('SoThe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng Thái</label>
                    <select name="TrangThai" class="form-control">
                        <option>Kích hoạt</option>
                        <option>Khóa</option>
                    </select>
                    @error('TrangThai')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </fieldset>
        <!-- Nút hành động -->
        <div class="text-end">
            <button type="submit" class="btn btn-save btn-custom">Lưu</button>
            <a href="{{ route('khachhangcanhan.index') }}" class="btn btn-cancel btn-custom">Hủy</a>
        </div>
    </form>
@endsection
