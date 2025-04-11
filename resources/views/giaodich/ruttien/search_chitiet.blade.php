@if ($LoaiGD = 'Rút Tiền')
    <table class="table table-bordered">
        <tr>
            <th>Mã Giao Dịch</th>
            <td>{{ $rutTien->MaGDRutTien }}</td>
        </tr>
        <tr>
            <th>Số Tài Khoản</th>
            <td>{{ $rutTien->SoTK }}</td>
        </tr>
        <tr>
            <th>Chủ Tài Khoản</th>
            <td>{{ $rutTien->TenKH }}</td>
        </tr>
        <tr>
            <th>CCCD</th>
            <td>{{ $rutTien->CCCD }}</td>
        </tr>
        <tr>
            <th>Số Thẻ</th>
            <td>{{ $rutTien->SoThe }}</td>
        </tr>
        <tr>
            <th>Số Tiền Rút</th>
            <td>{{ number_format($rutTien->SoTienRut) }} VNĐ</td>
        </tr>
        <tr>
            <th>Phí Giao Dịch</th>
            <td>{{ number_format($rutTien->PhiGiaoDich) }} VNĐ</td>
        </tr>
        <tr>
            <th>Nội Dung</th>
            <td>{{ $rutTien->NoiDung }}</td>
        </tr>
        <tr>
            <th>Ngày Tạo</th>
            <td>{{ $rutTien->NgayTao }}</td>
        </tr>
    </table>
@elseif($LoaiGD = 'Gửi Tiền')
    <table class="table table-bordered">
        <tr>
            <th>Mã Giao Dịch</th>
            <td>{{ $guiTien->MaGDGuiTien }}</td>
        </tr>
        <tr>
            <th>Số Tài Khoản nhận</th>
            <td>{{ $guiTien->SoTK }}</td>
        </tr>
        <tr>
            <th>Tên người gửi</th>
            <td>{{ $guiTien->TenNG }}</td>
        </tr>
        <tr>
            <th>SDT gửi</th>
            <td>{{ $guiTien->SDTNG }}</td>
        </tr>
        <tr>
            <th>Ngân Hàng</th>
            <td>{{ $guiTien->NganHang }}</td>
        </tr>
        <tr>
            <th>Chủ Tài Khoản</th>
            <td>{{ $guiTien->TenKH }}</td>
        </tr>
        <tr>
            <th>CCCD</th>
            <td>{{ $guiTien->CCCD }}</td>
        </tr>
        <tr>
            <th>Số Thẻ</th>
            <td>{{ $guiTien->SoThe }}</td>
        </tr>
        <tr>
            <th>Số Tiền Gửi</th>
            <td>{{ number_format($guiTien->SoTienGui) }} VNĐ</td>
        </tr>
        <tr>
            <th>Phí Giao Dịch</th>
            <td>{{ number_format($guiTien->PhiGiaoDich) }} VNĐ</td>
        </tr>
        <tr>
            <th>Nội Dung</th>
            <td>{{ $guiTien->NoiDung }}</td>
        </tr>
        <tr>
            <th>Ngày Tạo</th>
            <td>{{ $guiTien->NgayTao }}</td>
        </tr>
    </table>
@else
    {{-- <table class="table table-bordered">
        <tr>
            <th>Mã Giao Dịch</th>
            <td>{{ $thanhtoan->MaGDThanhToan }}</td>
        </tr>
        <tr>
            <th>Số Tài Khoản</th>
            <td>{{ $thanhtoan->SoTK }}</td>
        </tr>
        <tr>
            <th>Chủ Tài Khoản</th>
            <td>{{ $khachhang->TenKH }}</td>
        </tr>
        <tr>
            <th>CCCD</th>
            <td>{{ $khachhang->CCCD }}</td>
        </tr>
        <tr>
            <th>Số Thẻ</th>
            <td>{{ $the->SoThe }}</td>
        </tr>
        <tr>
            <th>Số Tiền Rút</th>
            <td>{{ number_format($thanhtoan->SoTienThanhToan) }} VNĐ</td>
        </tr>
        <tr>
            <th>Phí Giao Dịch</th>
            <td>{{ number_format($thanhtoan->PhiGiaoDich) }} VNĐ</td>
        </tr>
        <tr>
            <th>Nội Dung</th>
            <td>{{ $thanhtoan->NoiDung }}</td>
        </tr>
        <tr>
            <th>Ngày Tạo</th>
            <td>{{ $thanhtoan->NgayTao }}</td>
        </tr>
    </table> --}}
@endif
