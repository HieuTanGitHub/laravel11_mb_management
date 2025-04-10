<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Hệ thống quản lý khách hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .login-container {
            border: 1px solid #f4f4f4;

            max-width: 1200px;
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .login-image {
            background: #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-form {
            padding: 40px;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
            font-size: 24px;
            color: #0056b3;
        }

        .brand-logo img {
            height: 110px;
        }

        .btn-primary {
            width: 100%;
            font-size: 18px;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="row login-container">

            <!-- Cột bên trái chứa hình ảnh -->
            <div class="col-md-6 login-image">
                <img src="{{ asset('fe/images/login_img.png') }}" alt="Hình ảnh minh họa" class="img-fluid">
            </div>

            <!-- Cột bên phải chứa form đăng nhập -->
            <div class="col-md-6 login-form">
                <div class="brand-logo">
                    <img src="{{ asset('fe/images/Logo MB.png') }}" alt="MB Logo">

                </div>
                <h5 class="mt-3">Chào mừng bạn đến với <br><b>HỆ THỐNG QUẢN LÝ KHÁCH HÀNG</b></h5>
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
                <form action="{{ route('login-nhanvien') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" name="TenDangNhap" value="{{ old('TenDangNhap') }}" class="form-control"
                            id="username" placeholder="Tên đăng nhập" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" name="MatKhau" class="form-control" id="password" placeholder="Mật khẩu"
                            required>
                    </div>
                    {{-- <button type="submit" onclick="validateLogin()" class="btn btn-primary">Đăng nhập</button> --}}
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </form>
            </div>
            <!-- Modal cảnh báo -->
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="errorModalLabel">Lỗi đăng nhập</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ asset('fe/images/Icon cảnh báo.png') }}" width="50" alt="Cảnh báo">
                            <p class="mt-3">Bạn đã nhập sai tên đăng nhập hoặc mật khẩu. <br>Vui lòng nhập lại!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateLogin() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            // Kiểm tra thông tin đăng nhập (ở đây chỉ là ví dụ)
            if (username !== "admin" || password !== "123456") {
                var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            } else {
                alert("Đăng nhập thành công!");
                // Chuyển hướng hoặc thực hiện hành động tiếp theo ở đây
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
