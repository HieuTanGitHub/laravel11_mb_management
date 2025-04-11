@extends('layout')

@section('content')
    <h4>CẬP NHẬT KHÁCH HÀNG CÁ NHÂN</h4>

    <style>
        .col-md-6.check-form {
            display: inline-table;
        }
    </style>

    <form method="POST" action="{{ route('khachhangcanhan.update', $khachhang->MaKH) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Ngày tạo</label>
                <input type="text" readonly name="NgayTao" class="form-control" value="{{ $khachhang->NgayTao }}">
            </div>

            <div class="col-md-6">
                <label class="form-label">Người tạo</label>
                <input type="text" readonly name="NguoiTao" class="form-control" value="{{ $khachhang->NguoiTao }}">
            </div>
        </div>

        <fieldset class="border p-3 mb-3">
            <legend class="float-none w-auto px-2">Nhập thông tin khách hàng</legend>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Mã Khách Hàng</label>
                    <input type="text" readonly name="MaKH" class="form-control" value="{{ $khachhang->MaKH }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nghề Nghiệp</label>
                    <input type="text" name="NgheNghiep" class="form-control" value="{{ $khachhang->NgheNghiep }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Doanh Thu</label>
                    <input type="number" name="DoanhThu" class="form-control" value="{{ $khachhang->DoanhThu }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Hồ Sơ Cá Nhân (File PDF, DOCX)</label>
                    <input type="file" name="HoSoCaNhan" class="form-control">
                    @if ($khachhang->HoSoCaNhan)
                        <a href="{{ asset('upload/' . $khachhang->HoSoCaNhan) }}" target="_blank">Xem file cũ</a>
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tên Khách Hàng</label>
                    <input type="text" name="TenKH" class="form-control" value="{{ $khachhang->khach->TenKH }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">CCCD</label>
                    <input type="text" name="CCCD" class="form-control" value="{{ $khachhang->khach->CCCD }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="text" name="Email" class="form-control" value="{{ $khachhang->khach->Email }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="NgaySinh" class="form-control"
                        value="{{ old('NgaySinh', \Carbon\Carbon::parse($khachhang->khach->NgaySinh)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" name="SDT" class="form-control" value="{{ $khachhang->khach->SDT }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tỉnh thành phố</label>
                    <select name="Thanhpho" id="city" class="form-control choose city">
                        <option value="">--Chọn tỉnh thành phố--</option>
                        @foreach ($city as $ci)
                            <option value="{{ $ci->matp }}"
                                {{ isset($thanhpho) && $thanhpho->matp == $ci->matp ? 'selected' : '' }}>
                                {{ $ci->name_city }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Quận huyện</label>
                    <select name="Quanhuyen" id="province" class="form-control choose province">
                        <option value="">--Chọn quận huyện--</option>
                        @if (isset($quanhuyen))
                            <option value="{{ $quanhuyen->maqh }}" selected>{{ $quanhuyen->name_quanhuyen }}</option>
                        @endif
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Xã phường</label>
                    <select name="Xaphuong" id="wards" class="form-control wards">
                        <option value="">--Chọn xã phường--</option>
                        @if (isset($xaphuong))
                            <option value="{{ $xaphuong->xaid }}" selected>{{ $xaphuong->name_xaphuong }}</option>
                        @endif
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="DiaChi" class="form-control" value="{{ $khachhang->khach->DiaChi }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Số Tài Khoản</label>
                    <input type="text" name="SoTK" class="form-control" value="{{ $khachhang->khach->SoTK }}">
                </div>

                <div class="col-md-6 check-form">
                    <label class="form-label">Thẻ cứng</label>
                    <div class="form-check">
                        <input class="form-check-input" value="có" type="radio" name="TheCung"
                            {{ $khachhang->khach->TheCung == 'có' ? 'checked' : '' }}>
                        <label class="form-check-label">Có</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="Không" type="radio" name="TheCung"
                            {{ $khachhang->khach->TheCung == 'Không' ? 'checked' : '' }}>
                        <label class="form-check-label">Không</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Loại Tài Khoản</label>
                    <select name="MaLoaiTK" class="form-control">
                        @foreach ($loaitaikhoan as $loaitk)
                            <option value="{{ $loaitk->MaLoaiTK }}"
                                {{ $khachhang->khach->MaLoaiTK == $loaitk->MaLoaiTK ? 'selected' : '' }}>
                                {{ $loaitk->TenLoaiTK }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- <div class="col-md-6">
                    <label class="form-label">Loại Khách Hàng</label>
                    <select name="MaLoaiKH" class="form-control">
                        @foreach ($loaikhachhang as $loaikh)
                            <option value="{{ $loaikh->MaLoaiKH }}"
                                {{ $khachhang->khach->MaLoaiKH == $loaikh->MaLoaiKH ? 'selected' : '' }}>
                                {{ $loaikh->TenLoaiKH }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-md-6">
                    <label class="form-label">Loại Thẻ</label>
                    <select name="LoaiThe" class="form-control">
                        @foreach ($loaithe as $key => $loaithe)
                            <option {{ $khachhang->khach->LoaiThe == $loaithe->MaLoaiThe ? 'selected' : '' }}
                                value="{{ $loaithe->MaLoaiThe }}">{{ $loaithe->TenLoaiThe }}</option>
                        @endforeach
                    </select>
                    @error('LoaiKH')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Số Thẻ</label>
                    <input type="text" name="SoThe" readonly value="{{ $khachhang->khach->SoThe }}"
                        class="form-control">
                    @error('SoThe')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trạng Thái</label>
                    <select name="TrangThai" class="form-control">
                        <option {{ $khachhang->khach->TrangThai == 'Kích hoạt' ? 'selected' : '' }}>Kích hoạt</option>
                        <option {{ $khachhang->khach->TrangThai == 'Khóa' ? 'selected' : '' }}>Khóa</option>
                    </select>
                </div>

            </div>
        </fieldset>

        <div class="text-end">
            <button type="submit" class="btn btn-save btn-custom">Cập Nhật</button>
            <a href="{{ route('khachhangcanhan.index') }}" class="btn btn-cancel btn-custom">Hủy</a>
        </div>
    </form>
@endsection
