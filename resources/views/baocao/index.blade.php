@extends('layout') <!-- hoặc layout bạn đang dùng -->

@section('content')
    <div class="container">
        <h2 class="text-center font-weight-bold my-4">TỔNG QUAN</h2>

        <div class="row">
            <!-- Khách hàng theo tuần -->
            <div class="col-md-6 mb-4">
                <select class="form-select mb-2">
                    <option>Số lượng khách hàng mới theo tuần</option>
                </select>
                <canvas id="chartKhachHangTuan"></canvas>
            </div>

            <!-- Khách hàng theo nhóm -->
            <div class="col-md-6 mb-4">
                <select class="form-select mb-2">
                    <option>Số lượng khách hàng theo nhóm</option>
                </select>
                <canvas id="chartKhachHangNhom"></canvas>
            </div>

            <!-- Giao dịch trong ngày -->
            <div class="col-md-6 mb-4">
                <select class="form-select mb-2">
                    <option>Số giao dịch trong một ngày</option>
                </select>
                <canvas id="chartGiaoDichNgay"></canvas>
            </div>

            <!-- Top khách hàng -->
            <div class="col-md-6 mb-4">
                <select class="form-select mb-2">
                    <option>Top 5 Khách hàng cá nhân có số dư nợ cao nhất</option>
                </select>
                <canvas id="chartTopKhachHang"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataKhachHangTuan = @json($dataKhachHangTuan);
    </script>
    <script>
        // 1. Khách hàng mới theo tuần
        const ctx1 = document.getElementById('chartKhachHangTuan').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
                datasets: [{
                    label: 'Số lượng',
                    data: dataKhachHangTuan,
                    borderColor: '#36A2EB',
                    fill: false
                }]
            }
        });

        // 2. Khách hàng theo nhóm
        const ctx2 = document.getElementById('chartKhachHangNhom').getContext('2d');
        $.get('/load-khach-hang-nhom', function(res) {
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Khách hàng cá nhân', 'Khách hàng doanh nghiệp', 'Khách hàng VIP'],
                    datasets: [{
                        data: [res.caNhan, 0, 0],
                        backgroundColor: ['#36A2EB', '#4BC0C0', '#FFCE56']
                    }]
                }
            });
        });

        // 3. Giao dịch trong ngày
        const ctx3 = document.getElementById('chartGiaoDichNgay').getContext('2d');
        $.get('/load-giao-dich-ngay', function(res) {
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: ['Rút tiền', 'Gửi tiền', 'Chuyển khoản', 'Thanh toán'],
                    datasets: [{
                        label: 'Số lượng',
                        data: [res.rutTien, res.guiTien, res.chuyenKhoan, res.thanhToan],
                        backgroundColor: '#4BC0C0'
                    }]
                }
            });
        });

        // 4. Top 5 khách hàng dư nợ cao nhất
        const ctx4 = document.getElementById('chartTopKhachHang').getContext('2d');
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['12034859', '20934885', '31894833', '40123555', '50934939'],
                datasets: [{
                    label: 'Dư nợ (triệu)',
                    data: [40000000, 39000000, 37000000, 36000000, 35000000],
                    backgroundColor: '#FF6384'
                }]
            },
            options: {
                indexAxis: 'y'
            }
        });
    </script>
@endsection
