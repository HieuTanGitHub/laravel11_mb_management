<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="{{ asset('fe/css/style.css') }}">

    <style>
        .sidebar.collapsed {
            width: 2px;
        }
    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo">
            <img src="{{ asset('fe/images/Logo MB.png') }}" width="100" alt="MB Logo">
        </div>
        <nav class="nav flex-column">
            <a class="nav-link" data-bs-toggle="collapse" href="#menuQLgiaodich">
                <span>
                    <i class="fa-solid fa-money-check-dollar icon_sidebar"></i> Quản lý giao dịch
                </span>
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            @php
                $active_giaodich = in_array(Request::segment(1), [
                    'ruttien',
                    'themruttien',
                    'them-thanhtoanhoadon',
                    'themguitien',
                    'guitien',
                    'chuyenkhoan',
                    'thanhtoanhoadon',
                    'giaodich-search',
                ])
                    ? 'show'
                    : '';
            @endphp
            <div class="collapse menuQL {{ $active_giaodich }}" id="menuQLgiaodich">
                <nav class="nav flex-column ms-3">

                    <a class="nav-link {{ Request::segment(1) == 'ruttien' || Request::segment(1) == 'themruttien' ? 'active' : '' }}"
                        href="{{ route('giaodich.ruttien') }}">
                        <i class="fa-solid fa-money-bill-wave"></i> Rút tiền
                    </a>

                    <a class="nav-link {{ Request::segment(1) == 'guitien' || Request::segment(1) == 'themguitien' ? 'active' : '' }}"
                        href="{{ route('giaodich.guitien') }}">
                        <i class="fa-solid fa-piggy-bank"></i> Gửi tiền
                    </a>

                    <a class="nav-link {{ Request::segment(1) == 'chuyenkhoan' ? 'active' : '' }}" href="#">
                        <i class="fa-solid fa-right-left"></i> Chuyển khoản
                    </a>

                    <a class="nav-link {{ Request::segment(1) == 'thanhtoanhoadon' || Request::segment(1) == 'them-thanhtoanhoadon' ? 'active' : '' }}"
                        href="{{ route('giaodich.thanhtoanhoadon') }}">

                        <i class="fa-solid fa-file-invoice-dollar"></i> Thanh toán hóa đơn

                    </a>

                </nav>
            </div>
            <!-- Dropdown Toggle -->
            <a class="nav-link" data-bs-toggle="collapse" href="#menuQLchung">
                <span>
                    <i class="fa-solid fa-clipboard-list icon_sidebar"></i> Quản lý chung
                </span>
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            @php
                $active = in_array(Request::segment(1), [
                    // 'nhanvien',
                    'loaihoatdong',
                    'the',
                    'taikhoan',
                    'loaitk',
                    'loaithe',
                    'chucvu',
                    'phongban',
                    'loaikhachhang',
                    'khachhang',
                ])
                    ? 'show'
                    : '';
            @endphp

            <div class="collapse menuQL {{ $active }}" id="menuQLchung">

                <a class="nav-link {{ Request::segment(1) == 'loaihoatdong' ? 'active' : '' }}"
                    href="{{ route('loaihoatdong.index') }}"><i class="fa-solid fa-list"></i> Loại
                    hoạt động</a>
                <a class="nav-link {{ Request::segment(1) == 'the' ? 'active' : '' }}"
                    href="{{ route('the.index') }}"><i class="fa-solid fa-id-card"></i> Thẻ</a>
                <a class="nav-link {{ Request::segment(1) == 'taikhoan' ? 'active' : '' }}"
                    href="{{ route('taikhoan.index') }}"><i class="fa-solid fa-wallet"></i> Tài
                    khoản</a>
                <a class="nav-link {{ Request::segment(1) == 'loaitk' ? 'active' : '' }}"
                    href="{{ route('loaitk.index') }}"><i class="fa-solid fa-credit-card"></i> Loại
                    tài khoản</a>
                <a class="nav-link {{ Request::segment(1) == 'loaithe' ? 'active' : '' }}"
                    href="{{ route('loaithe.index') }}"><i class="fa-solid fa-address-card"></i>
                    Loại thẻ</a>
                <a class="nav-link {{ Request::segment(1) == 'chucvu' ? 'active' : '' }}"
                    href="{{ route('chucvu.index') }}"><i class="fa-solid fa-briefcase"></i> Chức
                    vụ</a>
                <a class="nav-link {{ Request::segment(1) == 'phongban' ? 'active' : '' }}"
                    href="{{ route('phongban.index') }}"><i class="fa-solid fa-building"></i> Phòng
                    Ban</a>
                <a class="nav-link {{ Request::segment(1) == 'loaikhachhang' ? 'active' : '' }}"
                    href="{{ route('loaikhachhang.index') }}"><i class="fa-solid fa-users"></i>
                    Loại khách hàng</a>
                <a class="nav-link {{ Request::segment(1) == 'khachhang' ? 'active' : '' }}"
                    href="{{ route('khachhang.index') }}"><i class="fa-solid fa-user"></i> Cá
                    nhân</a>

            </div>
            <!-- Dropdown Toggle -->
            <a class="nav-link" data-bs-toggle="collapse" href="#menuKhachHang">
                <span>
                    <i class="fa-solid fa-users icon_sidebar"></i> Quản lý khách hàng
                </span>
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            @php
                $active_khachhang = in_array(Request::segment(1), [
                    'khachhangcanhan',
                    'khachhangdoanhnghiep',
                    'khachhang-search',
                ])
                    ? 'show'
                    : '';
            @endphp

            <!-- Dropdown Items -->
            <div class="collapse menuQL {{ $active_khachhang }}" id="menuKhachHang">
                <nav class="nav flex-column ms-3">

                    <a class="nav-link {{ Request::segment(1) == 'khachhangcanhan' || Request::segment(1) == 'khachhang-search' ? 'active' : '' }}"
                        href="{{ route('khachhangcanhan.index') }}">
                        Khách hàng cá nhân
                    </a>

                    <a class="nav-link {{ Request::segment(1) == 'khachhangdoanhnghiep' ? 'active' : '' }}"
                        href="{{ route('khachhangdoanhnghiep.index') }}"><i class="fa-solid fa-industry"></i> SME</a>
                    <a class="nav-link {{ Request::segment(1) == 'khachhangdoanhnghiep' ? 'active' : '' }}"
                        href="#"><i class="fa-solid fa-industry"></i> CIB</a>
                    {{-- <a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> SME</a>
                    <a class="nav-link" href="#"><i class="fa-regular fa-circle"></i> CIR</a> --}}
                </nav>
            </div>


            <a class="nav-link" data-bs-toggle="collapse" href="#menuBaocao"><span>
                    <i class="fa-solid fa-users icon_sidebar"></i>
                </span> Báo cáo
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            @php
                $active_baocao = in_array(Request::segment(1), ['baocaotongquan']) ? 'show' : '';
            @endphp
            <!-- Dropdown Items -->
            <div class="collapse menuQL {{ $active_baocao }}" id="menuBaocao">
                <nav class="nav flex-column ms-3">
                    <a class="nav-link {{ Request::segment(1) == 'baocaotongquan' ? 'active' : '' }}"
                        href="{{ route('baocaotongquan') }}">
                        <i class="fa-solid fa-chart-pie"></i> Báo cáo tổng quan
                    </a>
                </nav>
            </div>
            <a class="nav-link {{ Request::segment(1) == 'nhanvien' || Request::segment(1) == 'nhanvien-search' ? 'active' : '' }}"
                href="{{ route('nhanvien.index') }}"><i class="fa-solid fa-user-tie"></i> Quản lý nhân
                viên</a>
            <a class="nav-link" href="#"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử hoạt động</a>
            <a class="nav-link" href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
            </a>

        </nav>

    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Navbar -->
        <div class="topbar">
            <button class="btn btn-outline-primary btn-sm" onclick="toggleSidebar()">☰</button>
            <div class="user-info">
                <img src="{{ asset('fe/images/Avatar.png') }}" alt="User">
                @if (session()->has('TenDangNhap'))
                    <span>{{ session('TenDangNhap') }}</span>
                @else
                    <span>Khách</span>
                @endif
            </div>
        </div>
        <!-- Nội dung chính -->
        <div class="container text-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Lỗi nhập liệu:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-month-picker@4.0.0/dist/MonthPicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-edit-chitiet').click(function(e) {
                e.preventDefault();
                var maKH = $(this).data('id');
                // alert(maKH);
                $.ajax({
                    url: '/khachhangcanhan/show/' + maKH,
                    type: 'GET',
                    success: function(res) {
                        var kh = res.khachhang;
                        var khcn = res.khachhangcanhan;
                        var tp = res.thanhpho ? res.thanhpho.name_city : '';
                        var qh = res.quanhuyen ? res.quanhuyen.name_quanhuyen : '';
                        var xp = res.xaphuong ? res.xaphuong.name_xaphuong : '';
                        var diachi = `${xp} - ${qh} - ${tp}`;
                        var html = `
                    <tr><th>Mã KH</th><td>${kh.MaKH}</td></tr>
                    <tr><th>Tên KH</th><td>${kh.TenKH}</td></tr>
                     <tr><th>Địa chỉ</th><td>${diachi}</td></tr>
                    <tr><th>Ngày Sinh</th><td>${kh.NgaySinh}</td></tr>
                    <tr><th>Mã Loại KH</th><td>${kh.MaLoaiKH}</td></tr>
                    <tr><th>Số tài khoản</th><td>${kh.SoTK}</td></tr>
                    <tr><th>Mã loại tài khoản</th><td>${kh.MaLoaiTK}</td></tr>
                    <tr><th>Thẻ Cứng</th><td>${kh.TheCung}</td></tr>
                    <tr><th>Số thẻ</th><td>${kh.SoThe}</td></tr>
                    <tr><th>Loại thẻ</th><td>${kh.LoaiThe}</td></tr>
                    <tr><th>CCCD</th><td>${kh.CCCD}</td></tr>
                    <tr><th>Email</th><td>${kh.Email}</td></tr>
                    <tr><th>SDT</th><td>${kh.SDT}</td></tr>
                    <tr><th>Nghề Nghiệp</th><td>${khcn.NgheNghiep}</td></tr>
                    <tr><th>Doanh Thu</th><td>${khcn.DoanhThu.toLocaleString()} VND</td></tr>
                `;

                        $('#showDetailKhachHang').html(html);
                        $('#modalChiTiet').modal('show');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';


            if (action == 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: '/select-diachi',

                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                }
            });
        });
    </script>
    <script>
        $('.chonsotaikhoan').on('change', function() {
            let maKH = $(this).val();

            if (maKH) {
                $.ajax({
                    url: '/get-thong-tin-khach/' + maKH,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        $('#TenKH').val(res.TenKH);
                        $('#CCCD').val(res.CCCD);
                        $('#SoThe').val(res.SoThe);

                        $('#SoDuTK').val(res.SoDuTK);
                        $('#SDT').val(res.SDT);
                        $('#MaKH').val(res.MaKH);
                        $('#DiaChi').val(res.DiaChi);
                    },
                    error: function() {
                        $('#TenKH').val('');
                        $('#CCCD').val('');
                        $('#SoThe').val('');

                        $('#SoDuTK').val('');
                        $('#SDT').val('');
                        $('#MaKH').val('');
                        $('#DiaChi').val('');
                        alert('Không tìm thấy thông tin khách hàng');
                    }
                });
            } else {
                $('#TenKH').val('');
                $('#CCCD').val('');
                $('#SoThe').val('');

                $('#SoDuTK').val('');
                $('#SDT').val('');
                $('#MaKH').val('');
                $('#DiaChi').val('');
            }
        });
    </script>
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 3000); // 3 giây
    </script>
    <script>
        $(document).on('click', '.btn-edit-chitiet-giaodich', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('giaodich.ruttien.chitiet') }}',
                type: 'GET',
                data: {
                    MaGDRutTien: id
                },
                success: function(res) {
                    $('#info').html(res);
                    $('#modal-chitiet').modal('show');
                },
                error: function() {
                    alert('Không thể load dữ liệu');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-edit-chitiet-giaodich-gui', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('giaodich.guitien.chitiet') }}',
                type: 'GET',
                data: {
                    MaGDGuiTien: id
                },
                success: function(res) {
                    $('#info').html(res);
                    $('#modal-chitiet').modal('show');
                },
                error: function() {
                    alert('Không thể load dữ liệu');
                }
            });
        });
    </script>
    <script>
        const dataNCC = {
            dien: [
                'EVN - Tổng Công Ty Điện Lực VN',
                'EVNHCMC - Điện Lực TP HCM',
                'EVNNPC - Điện Lực Miền Bắc',
                'EVNCPC - Điện Lực Miền Trung'
            ],
            nuoc: [
                'Cấp Nước Sài Gòn (SAWACO)',
                'Cấp Nước Hà Nội (HAWASUCO)',
                'Cấp Nước Đà Nẵng (DAWACO)'
            ],
            internet: [
                'FPT Telecom',
                'VNPT',
                'Viettel'
            ]
        }

        $('#LoaiHD').on('change', function() {
            var loaiHD = $(this).val();
            var ncc = dataNCC[loaiHD] || [];

            var html = '<option value="">-- Chọn nhà cung cấp --</option>';
            ncc.forEach(item => {
                html += `<option value="${item}">${item}</option>`;
            });

            $('#NCC').html(html);
        });
    </script>
    <script>
        $('#phigiaodich').on('keyup change', function() {
            var phiGD = parseInt($(this).val()) || 0;
            var soTien = parseInt($('#SoTien').val()) || 0;

            var tongTien = phiGD + soTien;

            $('#tongtien').val(tongTien);
        });
    </script>
    <script>
        $(document).on('click', '.btn-edit-chitiet-giaodich-thanhtoan', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('giaodich.thanhtoan.chitiet') }}',
                type: 'GET',
                data: {
                    MaGDThanhToan: id
                },
                success: function(res) {
                    $('#info').html(res);
                    $('#modal-chitiet').modal('show');
                },
                error: function() {
                    alert('Không thể load dữ liệu');
                }
            });
        });
    </script>
    <script>
        // Khi chọn MaKH => chọn SoTK tương ứng
        $('#maKH').on('change', function() {
            var maKH = $(this).val();
            $('#soTK option').each(function() {
                if ($(this).data('makh') == maKH) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
            $('#SoThe option').each(function() {
                if ($(this).data('makh') == maKH) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
        });

        // Khi chọn SoTK => chọn MaKH tương ứng
        $('#soTK').on('change', function() {
            var maKH = $(this).find(':selected').data('makh');
            $('#maKH option').each(function() {
                if ($(this).val() == maKH) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.chonsotaikhoan').select2({
                placeholder: "---Chọn tài khoản---",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    <script>
        function printBienLai() {
            var printContents = document.getElementById('bienLaiContent').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = `
        <html>
        <head>
            <title>In Biên Lai</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                h5 { text-align: center; margin-bottom: 20px; }
                ul { list-style: none; padding: 0; }
                li { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px dashed #ccc; }
                span { font-weight: bold; }
            </style>
        </head>
        <body>${printContents}</body>
        </html>
    `;

            window.print();
            window.location.reload(); // In xong load lại
        }
        $(document).ready(function() {

            $('#formruttien').on('submit', function(e) {
                e.preventDefault(); // chặn submit

                var data = {
                    'Mã giao dịch': $('input[name="MaGDRutTien"]').val(),
                    'Ngày tạo': $('input[name="NgayTao"]').val(),
                    'Người tạo': $('input[name="MaNV"]').val(),
                    'Điểm GD': $('input[name="ViTri"]').val(),
                    'Số tài khoản': $('select[name="SoTK"] option:selected').text(),
                    'Số tiền rút': $('input[name="SoTienRut"]').val(),
                    'Phí GD': $('input[name="PhiGiaoDich"]').val(),
                    'Nội dung': $('textarea[name="NoiDung"]').val()
                };

                var html = '<ul class="ul_ruttien">';
                $.each(data, function(k, v) {
                    html += '<li><strong>' + k + ': </strong>' + v + '</li>';
                });
                html += '</ul>';

                $('#modalContent').html(html);
                $('#confirmModal').modal('show'); // show modal

                $('#btnConfirmSubmit').off('click').on('click', function() {
                    let $form = $('#formruttien');

                    // Submit thật
                    $form.off('submit').on('submit', function(e) {
                        e.preventDefault();

                        $.ajax({
                            url: $form.attr('action'),
                            method: $form.attr('method'),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: $form.serialize(),
                            success: function(res) {
                                if (res.success) {
                                    $('#confirmModal').modal('hide');

                                    // Lấy dữ liệu mới nhất bằng ID vừa lưu
                                    $.ajax({
                                        url: '/ruttien/receipt/' + res
                                            .id, // route API lấy chi tiết
                                        method: 'GET',
                                        success: function(receipt) {
                                            var html = `
            <h5 class="text-center mb-3">BIÊN LAI RÚT TIỀN</h5><br/>
            <ul style="list-style:none; padding:0;">`;

                                            $.each(receipt,
                                                function(k, v) {
                                                    html += `
                <li style="display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px dashed #ccc;">
                    <span><strong>${k}:</strong></span>
                    <span>${v}</span>
                </li>`;
                                                });

                                            html += `</ul>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-primary" onclick="printBienLai()">In Biên Lai</button>
            </div>`;

                                            $('#bienLaiContent')
                                                .html(html);
                                            $('#modalBienLai')
                                                .modal('show');
                                        }
                                    });
                                }
                            },
                            error: function() {
                                alert('Lưu thất bại!');
                            }
                        });
                    });

                    $form.submit(); // submit
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#formguitien').on('submit', function(e) {
                e.preventDefault();

                var data = {
                    'Mã giao dịch': $('input[name="MaGDGuiTien"]').val(),
                    'Ngày tạo': $('input[name="NgayTao"]').val(),
                    'Người tạo': $('input[name="MaNV"]').val(),
                    'Điểm GD': $('input[name="ViTri"]').val(),
                    'Tên người gửi': $('input[name="TenNG"]').val(),
                    'Số điện thoại người gửi': $('input[name="SDTNG"]').val(),
                    'Ngân Hàng': $('input[name="NganHang"]').val(),
                    'Số tài khoản nhận': $('select[name="SoTK"] option:selected').text(),
                    'Số tiền gửi': $('input[name="SoTienGui"]').val(),
                    'Phí GD': $('input[name="PhiGiaoDich"]').val(),
                    'Tổng Tiền': $('input[name="TongTien"]').val(),
                    'Nội dung': $('textarea[name="NoiDung"]').val()
                };

                var html = '<ul>';
                $.each(data, function(k, v) {
                    html += '<li><strong>' + k + ': </strong>' + v + '</li>';
                });
                html += '</ul>';

                $('#modalContent').html(html);
                $('#confirmModal').modal('show');

                // Bắt sự kiện xác nhận
                $('#btnConfirmSubmit').off('click').on('click', function() {
                    let $form = $('#formguitien');

                    // Submit thật
                    $form.off('submit').on('submit', function(e) {
                        e.preventDefault();

                        $.ajax({
                            url: $form.attr('action'),
                            method: $form.attr('method'),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: $form.serialize(),
                            success: function(res) {
                                if (res.success) {
                                    $('#confirmModal').modal('hide');

                                    // Lấy dữ liệu mới nhất bằng ID vừa lưu
                                    $.ajax({
                                        url: '/guitien/receipt/' + res
                                            .id, // route API lấy chi tiết
                                        method: 'GET',
                                        success: function(receipt) {
                                            var html = `
            <h5 class="text-center mb-3">BIÊN LAI GỬI TIỀN</h5><br/>
            <ul style="list-style:none; padding:0;">`;

                                            $.each(receipt,
                                                function(k, v) {
                                                    html += `
                <li style="display:flex; justify-content:space-between; padding:6px 0; border-bottom:1px dashed #ccc;">
                    <span><strong>${k}:</strong></span>
                    <span>${v}</span>
                </li>`;
                                                });

                                            html += `</ul>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-primary" onclick="printBienLai()">In Biên Lai</button>
            </div>`;

                                            $('#bienLaiContent')
                                                .html(html);
                                            $('#modalBienLai')
                                                .modal('show');
                                        }
                                    });
                                }
                            },
                            error: function() {
                                alert('Lưu thất bại!');
                            }
                        });
                    });

                    $form.submit(); // submit
                });
            });
        });

        function showReceipt(data) {
            var html = '<h5 style="text-align:center;">BIÊN LAI GỬI TIỀN</h5><ul>';

            html += '<li><strong>Mã giao dịch: </strong>' + data.MaGDGuiTien + '</li>';
            html += '<li><strong>Ngày tạo: </strong>' + data.NgayTao + '</li>';
            html += '<li><strong>Người tạo: </strong>' + data.MaNV + '</li>';
            html += '<li><strong>Điểm GD: </strong>' + data.ViTri + '</li>';
            html += '<li><strong>Tên người gửi: </strong>' + data.TenNG + '</li>';
            html += '<li><strong>SDT người gửi: </strong>' + data.SDTNG + '</li>';
            html += '<li><strong>Ngân hàng: </strong>' + data.NganHang + '</li>';
            html += '<li><strong>Số tài khoản nhận: </strong>' + data.SoTK + '</li>';
            html += '<li><strong>Số tiền gửi: </strong>' + data.SoTienGui + ' VNĐ</li>';
            html += '<li><strong>Phí giao dịch: </strong>' + data.PhiGiaoDich + ' VNĐ</li>';
            html += '<li><strong>Tổng tiền: </strong>' + data.TongTien + ' VNĐ</li>';
            html += '<li><strong>Nội dung: </strong>' + data.NoiDung + '</li>';

            html += '</ul>';

            html += '<div class="text-center mt-3">';
            html += '<button class="btn btn-primary" onclick="printBienLai()">In Biên Lai</button>';
            html += '</div>';

            $('#modalContent').html(html);
            $('#confirmModal').modal('show');
        }

        function printBienLai() {
            var printContents = document.getElementById('modalContent').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#formthanhtoanhoadon').on('submit', function(e) {
                e.preventDefault(); // chặn submit

                var data = {
                    'Mã giao dịch': $('input[name="MaGDThanhToan"]').val(),
                    'Ngày tạo': $('input[name="NgayTao"]').val(),
                    'Ngân hàng': $('input[name="NganHang"]').val(),
                    'Loại Hóa Đơn': $('select[name="LoaiHD"] option:selected').text(),
                    'Nhà cung cấp': $('select[name="NCC"] option:selected').text(),
                    'Số Hóa Đơn': $('input[name="SoHD"]').val(),
                    'Người tạo': $('input[name="NguoiTao"]').val(),
                    'Điểm GD': $('input[name="DiemGD"]').val(),
                    'Số tài khoản': $('select[name="SoTK"] option:selected').text(),
                    'Số tiền gửi': $('input[name="SoTienGui"]').val(),
                    'Phí GD': $('input[name="PhiGiaoDich"]').val(),
                    'Nội dung': $('textarea[name="NoiDung"]').val()
                };

                var html = '<ul>';
                $.each(data, function(k, v) {
                    html += '<li><strong>' + k + ': </strong>' + v + '</li>';
                });
                html += '</ul>';

                $('#modalContent').html(html);
                $('#confirmModal').modal('show'); // show modal

                $('#btnConfirmSubmit').off('click').on('click', function() {
                    e.currentTarget.submit(); // submit form thật
                })
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function tinhTongTien() {
                let soTienGui = parseFloat($('#SoTienGui').val()) || 0;
                let phiGiaoDich = parseFloat($('#PhiGiaoDich').val()) || 0;
                let tongTien = soTienGui - phiGiaoDich;

                $('#TongTien').val(tongTien); // format đẹp
            }

            $('#SoTienGui, #PhiGiaoDich').on('keyup change', function() {
                tinhTongTien();
            });

            // Gọi 1 lần khi load trang
            tinhTongTien();
        });
    </script>
    <script>
        $(function() {
            $('#NgayMo').datepicker({
                dateFormat: 'mm-yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,

                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });
            $('#NgayDong').datepicker({
                dateFormat: 'mm-yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,

                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });
            $('#NgayHetHan').datepicker({
                dateFormat: 'mm-yy',
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,

                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            });

            // Fix chỉ hiện tháng năm khi show
            $("#NgayMo").focus(function() {
                $(".ui-datepicker-calendar").hide();
            });
            $("#NgayDong").focus(function() {
                $(".ui-datepicker-calendar").hide();
            });
            $("#NgayHetHan").focus(function() {
                $(".ui-datepicker-calendar").hide();
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-edit-chitiet-search', function() {
            let id = $(this).data('id');

            $.ajax({
                url: '{{ route('giaodich.search.chitiet') }}',
                type: 'GET',
                data: {
                    MaGD: id
                },
                success: function(res) {
                    $('#info').html(res);
                    $('#modal-chitiet').modal('show');
                },
                error: function() {
                    alert('Không thể load dữ liệu');
                }
            });
        });
    </script>
    @yield('scripts');
</body>

</html>
