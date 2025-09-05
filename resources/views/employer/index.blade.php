<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ request()->getHost() . ': ' . 'Employer' }}
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="{{ asset('storage/css/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('storage/css/body.css') }}">
</head>

<body>
    @include('layouts.include.alert')
    <header>
        <nav class="navbar navbar-expand-lg bg-primary" style="height: 60px;">
            <div class="container-fluid bg-primary">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('storage/image/' . config('app.logo')) }}" alt="logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-5 my-2 my-lg-0 align-items-center
                    navbar-nav-scroll justify-content-end w-100"
                        style="--bs-scroll-height: 400px;">
                        <li class="nav-item ">
                            <div class="nav-link text-white" role="button" style="font-size: large;">
                                Giới thiệu
                            </div>
                        </li>
                        <li class="nav-item ">
                            <div class="nav-link text-white" role="button" style="font-size: large;">
                                Nhà tuyển dụng
                            </div>
                        </li>
                        <li class="nav-item ">
                            <div class="nav-link text-white" role="button" style="font-size: large;">
                                Tìm ứng viên
                            </div>
                        </li>
                        @guest('employer')
                            <li class="nav-item ">
                                <a  href="{{route('employer.login')}}"
                                 class="nav-link text-white" style="font-size: large;">
                                    Đăng nhập
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('employer.register') }}" class="nav-link text-white bg-success rounded-4"
                                    style="font-size: large; max-width: max-content ;">
                                    Đăng ký
                                </a>
                            </li>
                        @endguest
                        @auth('employer')
                            <li class="nav-item ">
                                <div class="me-lg-5 nav-link">
                                    <a href="{{ route('employer.dashboard.index') }}"
                                        class="d-flex gap-2 align-items-center" role="button">
                                        <div>
                                            <img class="rounded-3"
                                                src="{{ asset(auth()->guard('employer')->user()->image) }}"
                                                alt="{{ auth()->guard('employer')->user()->name }}" width="40"
                                                height="40">
                                        </div>
                                        <strong class="text-danger">
                                            {{ auth()->guard('employer')->user()->name }}
                                        </strong>
                                    </a>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>
    <modal>
        @guest('employer')
            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route('employer.check_login') }}">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Đăng nhập</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <input type="email" class="form-control" name="email">
                                <label>Email</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="password">
                                <label>Mật khẩu</label>
                            </div>
                            <br>
                            <div class="text-primary" data-bs-toggle="modal" data-bs-target="#forgotpasswordModal">
                                {{ __('forgot password') }}?</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                            <button type="submit" class="btn btn-success">
                                Đăng nhập
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="forgotpasswordModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="forgotpasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route('rv_employer.store') }}">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">{{ __('forgot password') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" required>
                                <label>{{ __('email address') }}</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('close') }}
                            </button>
                            <button type="button" class="btn btn-primary"
                                onclick="sendCode(this.form.email.value,this)">
                                {{ __('submit') }}
                            </button>
                        </div>
                    </form>
                    <script>
                        async function sendCode(email, button) {
                            if (!email) {
                                alert("Please enter your email.");
                                return;
                            }
                            button.disabled = true;
                            button.innerHTML =
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                            const url = `{{ route('fp_employer.store') }}`;

                            const data = {
                                email: email
                            };
                            try {
                                const response = await fetch(url, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    },
                                    body: JSON.stringify(data)
                                });
                                const result = await response.json();
                                alert(result.message);
                            } catch (error) {
                                console.error("Error:", error);
                                alert("Error: " + error);
                            } finally {

                                button.disabled = false;
                                button.innerHTML = '{{ __('submit') }}';
                            }
                        }
                    </script>
                </div>
            </div>
        @endguest
        @auth('employer')
            <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Đổi mật khẩu</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-floating">
                                <input type="password" class="form-control" name="current_password" required>
                                <label>Mật khẩu hiện tại</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="new_password" required>
                                <label>Mật khẩu mới</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="password" class="form-control" name="confirm_password" required>
                                <label>Nhập lại mật khẩu mới</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                            <button type="submit" class="btn btn-primary">
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
    </modal>

    <main>
        <section>
            <div class="container-fluid d-flex justify-content-center p-5"
                style="background-image: url('{{ asset('storage/image/bg/parallax-2.jpg') }}');
                background-repeat: no-repeat; background-size: cover; background-color: 	rgb(0, 191, 255,0.4); background-blend-mode: overlay;">
                <div class="container row">
                    <div class="col-xs-12 col-md-5 header-text">
                        <h2 class="text-white">Tìm nhân sự <span class="text-warning">chất lượng</span> theo cách hoàn
                            toàn mới!</h2>
                        <p class="text-white"><strong>{{ config('app.name') }}</strong> giúp bạn tìm ứng viên phù hợp
                            thật nhanh và hiệu quả. Hệ thống
                            <strong>{{ config('app.name') }}</strong> tìm kiếm thông minh và chủ động gợi ý các ứng
                            viên thích hợp,
                            đồng
                            thời tự động hoá quy trình quản lý ứng viên.
                        </p>
                        <a href="#about-us" class="btn btn-white bg-white">Tìm hiểu thêm</a>
                    </div>
                    <div class="d-none d-md-block col-md-6 text-md-end">
                        <div class="screen-box">
                            <div class="item">
                                <img src="{{ asset('storage/image/bg/screen-3.jpg') }}" class="lazy"
                                    alt="" height="300">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5" style="background-color: #cce0ff">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="page-title">
                            <h2 class="pb-0 mb-0"> Tại sao chọn <span>chúng tôi</span></h2>
                            <p>Các doanh nghiệp lựa chọn {{ config('app.name') }} để tuyển dụng nhân sự</p>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 h-100">
                            <div class="card-body">
                                <h3 class="card-title">1.600.000+</h3>
                                <p class="card-text">Lượng ứng viên truy cập sử dụng hàng tháng</p>
                                <img src="{{ asset('storage/image/bg/tai-sao4.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 h-100">
                            <div class="card-body">
                                <h3 class="card-title">AI thông minh</h3>
                                <p class="card-text">Giúp tìm kiếm ứng viên phù hợp nhanh chóng</p>
                                <img src="{{ asset('storage/image/bg/tai-sao1.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 h-100">
                            <div class="card-body">
                                <h3 class="card-title">Tuyển dụng đa kênh</h3>
                                <p class="card-text">Kết nối thêm với nguồn ứng viên từ: Facebook, Indeed, Jobstreet…
                                </p>
                                <img src="{{ asset('storage/image/bg/tai-sao2.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card border-0 h-100">
                            <div class="card-body">
                                <h3 class="card-title">Support 24/7</h3>
                                <p class="card-text">Đội ngũ CSKH tận tình luôn sẵn sàng hỗ trợ Khách hàng</p>
                                <img src="{{ asset('storage/image/bg/tai-sao3.png') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.user.footer')
    @include('layouts.include.zalo')
</body>

</html>
