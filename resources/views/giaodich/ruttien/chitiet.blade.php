<table class="table table-bordered">
    <tr>
        <th>Mã Giao Dịch</th>
        <td>{{ $ruttien->MaGDRutTien }}</td>
    </tr>
    <tr>
        <th>Số Tài Khoản</th>
        <td>{{ $ruttien->SoTK }}</td>
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
        <td>{{ number_format($ruttien->SoTienRut) }} VNĐ</td>
    </tr>
    <tr>
        <th>Phí Giao Dịch</th>
        <td>{{ number_format($ruttien->PhiGiaoDich) }} VNĐ</td>
    </tr>
    <tr>
        <th>Nội Dung</th>
        <td>{{ $ruttien->NoiDung }}</td>
    </tr>
    <tr>
        <th>Ngày Tạo</th>
        <td>{{ $ruttien->NgayTao }}</td>
    </tr>
</table>
