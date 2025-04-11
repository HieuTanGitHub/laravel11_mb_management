<table class="table table-bordered">
    <tr>
        <th>Mã Giao Dịch</th>
        <td>{{ $guitien->MaGDGuiTien }}</td>
    </tr>
    <tr>
        <th>Số Tài Khoản nhận</th>
        <td>{{ $guitien->SoTK }}</td>
    </tr>
    <tr>
        <th>Tên người gửi</th>
        <td>{{ $guitien->TenNG }}</td>
    </tr>
    <tr>
        <th>SDT gửi</th>
        <td>{{ $guitien->SDTNG }}</td>
    </tr>
    <tr>
        <th>Ngân Hàng</th>
        <td>{{ $guitien->NganHang }}</td>
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
        <th>Số Tiền Gửi</th>
        <td>{{ number_format($guitien->SoTienGui) }} VNĐ</td>
    </tr>
    <tr>
        <th>Phí Giao Dịch</th>
        <td>{{ number_format($guitien->PhiGiaoDich) }} VNĐ</td>
    </tr>
    <tr>
        <th>Nội Dung</th>
        <td>{{ $guitien->NoiDung }}</td>
    </tr>
    <tr>
        <th>Ngày Tạo</th>
        <td>{{ $guitien->NgayTao }}</td>
    </tr>
</table>
