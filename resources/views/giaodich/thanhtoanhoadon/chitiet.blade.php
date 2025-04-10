<table class="table table-bordered">
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
</table>
