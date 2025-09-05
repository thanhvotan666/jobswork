<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="height: 60px;">
        <div class="container-fluid bg-white">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('storage/image/' . config('app.logo')) }}" alt="logo">
            </a>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 400px;">
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="font-size: large;">
                            <img src="{{ asset('storage/image/icon/job.svg') }}" alt="job">
                            {{ __('job') }}
                        </div>
                        <div class="dropdown-menu" style="width: max-content;">
                            <div class="p-3">
                                <a href="" class="btn btn-secondary w-100">
                                    <i class="bi bi-search"></i>
                                    {{ __('search job') }}
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 text-nowrap">
                                    <div class="p-3">
                                        <div class="fw-bold">{{ __('job by profession') }}</div>
                                        <ul class="p-0" style="list-style-type: none;">
                                            @foreach (\App\Models\Profession::take(10)->get() as $p)
                                                <li>
                                                    <a class="text-steelblue-hover"
                                                        href="{{ route('jobs', ['profession' => $p->id]) }}">
                                                        {{ __($p->name) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                                <div class="col-lg-4 text-nowrap">
                                    <div class="p-3">
                                        <div class="fw-bold">{{ __('job by location') }}</div>
                                        <ul class="p-0" style="list-style-type: none;">
                                            @foreach (\App\Models\LocationSelect::take(10)->get() as $p)
                                                <li>
                                                    <a class="text-steelblue-hover"
                                                        href="{{ route('jobs', ['location' => $p->location]) }}">
                                                        {{ __($p->location) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-nowrap">
                                    <div class="p-3">
                                        <div class="fw-bold">{{ __('job by demand') }}</div>
                                        <ul class="p-0" style="list-style-type: none;">
                                            <li>
                                                <a class="text-steelblue-hover" href="">
                                                    {{ __('featured jobs') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-steelblue-hover" href="">
                                                    {{ __('jobs no degree required') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="text-steelblue-hover" href="">
                                                    {{ __('seasonal jobs') }}
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="font-size: large;">
                            <img src="{{ asset('storage/image/icon/employer.svg') }}" alt="employer">
                            {{ __('company') }}
                        </div>
                        {{--  <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tiêu Biểu</a></li>
                            <li><a class="dropdown-item" href="#">Nổi Bật</a></li>
                            <li><a class="dropdown-item" href="#">Ngân Hàng</a></li>
                            <li><a class="dropdown-item" href="#">Bảo Hiểm</a></li>
                            <li><a class="dropdown-item" href="#">Công Nghệ</a></li>
                            <li><a class="dropdown-item" href="#">Xây Dựng</a></li>
                            <li><a class="dropdown-item" href="#">Sản Xuất</a></li>
                            <li><a class="dropdown-item" href="#">Nhà Hàng</a></li>
                            <li><a class="dropdown-item" href="#">Khách Sạn</a></li>
                            <li><a class="dropdown-item" href="#">Y Tế</a></li>
                            <li><a class="dropdown-item" href="#">Bất Động Sản</a></li>
                            <li><a class="dropdown-item" href="#">Giáo Dục</a></li>
                        </ul> --}}
                    </li>
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="font-size: large;">
                            <img src="{{ asset('storage/image/icon/cv.svg') }}" alt="cv">
                            CV / {{ __('profile') }}
                        </div>
                        {{-- <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Đánh giá CV</a></li>
                            <li><a class="dropdown-item" href="#">Tạo CV bằng AI</a></li>
                            <li><a class="dropdown-item" href="#">Tải lên CV</a></li>
                            <li><a class="dropdown-item" href="#">Mẫu CV</a></li>
                        </ul> --}}
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="font-size: large;">
                            <img src="{{ asset('storage/image/icon/career.svg') }}" alt="career">
                            Phát triển sự nghiệp
                        </div>
                         <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">
                                    Kiến thức</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Hỏi đáp Luật Lao
                                    Động</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Hỏi đáp Bảo Hiểm Xã
                                    Hội</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Tra cứu lương</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Đổi lương Gross - Net</a>
                            </li>
                            <li><a class="dropdown-item" href="#">
                                    La Bàn Hướng Nghiệp</a>
                            </li>
                            <li><a class="dropdown-item" href="#">
                                    Trắc nghiệm EQ</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Trắc nghiệm tính
                                    cách MBTI</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Trắc nghiệm
                                    tính cách Enneagram</a></li>
                            <li><a class="dropdown-item" href="#">
                                    Trắc nghiệm tính cách
                                    DISC</a></li>
                        </ul> --}}
                    {{-- <div class="modal fade" id="addCertificateModal" tabindex="-1"
                            aria-labelledby="addCertificateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">Thêm chứng chỉ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="file" name="certificate" class="form-control">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Thoát</button>
                                        <button type="submit" class="btn btn-primary">Lưu thay
                                            đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle text-dark" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="font-size: large;">
                            <i class="bi bi-translate"></i>

                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'vi' ? 'active' : '' }}"
                                    href="{{ route('language', 'vi') }}">
                                    {{ __('vietnamese') }} (Vietnamese)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                    href="{{ route('language', 'en') }}">
                                    {{ __('english') }} (English)
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand d-flex gap-3 text-end" role="group" aria-label="Basic example">
                @guest('user')
                    <div class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                        {{ __('register') }}</div>
                    <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                        {{ __('login') }}
                    </div>
                    <div class="vr d-none d-xl-block"></div>
                    <a href="{{ route('employer.index') }}" class="d-none d-xl-block btn btn-dark">
                        {{ __('post a job & find resumes') }}
                    </a>
                @endguest
                @auth('user')
                    @php
                        $auth = auth()->guard('user')->user();
                    @endphp
                    <div class="dropdown me-lg-5">
                        <div href="" class="d-flex gap-2 align-items-center" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div><img class="rounded-3" src="{{ asset($auth->image) }}" alt="{{ $auth->name }}"
                                    width="50" height="50"></div>
                            <div style="font-size: smaller;">
                                <div>{{ $auth->name }}</div>
                                @if ($auth->job_search_status)
                                    <div class="text-success">{{ __('looking for a job') }}</div>
                                @else
                                    <div class="text-danger">{{ __('looking for a job is off') }}</div>
                                @endif
                            </div>
                            <div class="dropdown-toggle"></div>
                        </div>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('candidate.user.index') }}">
                                    <i class="bi bi-person text-primary fw-bold fs-4"></i>
                                    {{ __('manage profile') }}</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('candidate.user.edit', $auth->id) }}">
                                    <i class="bi bi-pencil-square text-primary fw-bold fs-4"></i>
                                    {{ __('update profile') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('candidate.applieds.index') }}">
                                    <i class="bi bi-file-earmark-check text-primary fw-bold fs-4"></i>
                                    {{ __('applied jobs') }}</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('candidate.saveds.index') }}">
                                    <i class="bi bi-bookmark text-primary fw-bold fs-4"></i>
                                    {{ __('saved jobs') }}
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                @if ($auth->job_search_status)
                                    <div class="dropdown-item" href="#">
                                        <div class="text-success">
                                            <i class="bi bi-toggle-on fw-bold fs-4"></i>
                                            {{ __('looking for a job') }}
                                        </div>
                                    </div>
                                @else
                                    <div class="dropdown-item" href="#">
                                        <div class="text-danger">
                                            <i class="bi bi-toggle-off fw-bold fs-4"></i>
                                            {{ __('looking for a job is off') }}
                                        </div>
                                    </div>
                                @endif
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <i class="bi bi-key text-primary fw-bold fs-4"></i>
                                    {{ __('change password') }}
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('candidate.logout_user') }}">
                                    <i class="bi bi-box-arrow-left text-primary fw-bold fs-4"></i>
                                    {{ __('logout') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                @endauth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>
</header>
<modal>
    @guest('user')
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('candidate.check_login') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            {{ __('login') }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email">
                            <label>
                                {{ __('email') }}
                            </label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password">
                            <label>
                                {{ __('password') }}
                            </label>
                        </div>
                        <br>
                        <div class="text-primary" data-bs-toggle="modal" data-bs-target="#forgotpasswordModal">
                            {{ __('forgot password') }}?</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('close') }}
                        </button>
                        <button type="submit" class="btn btn-success">
                            {{ __('login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('candidate.check_register') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            {{ __('register') }}
                        </h1>
                        <button type="button" id="closeRegisterModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="name" class="form-control" name="name" required>
                            <label>
                                {{ __('name') }}
                            </label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="email" class="form-control" name="email" required>
                            <label>
                                {{ __('email') }}
                            </label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" required>
                            <label>
                                {{ __('password') }}
                            </label>
                        </div>
                        <br>
                        <div class="d-flex gap-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" name="code" id="code" required>
                                <label>
                                    {{ __('veri code') }}
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary" id="get_code"
                                onclick="getCode(this.form.email.value, this)">
                                {{ __('get code') }}
                            </button>
                        </div>
                        <script>
                            async function getCode(email, button) {
                                if (!email) {
                                    alert("Please enter your email.");
                                    return;
                                }
                                button.disabled = true;
                                button.innerHTML =
                                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                                const url = `{{ route('rv_user.store') }}`;
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
                                    button.innerHTML = '{{ __('get code') }}';
                                }
                            }
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('close') }}
                        </button>
                        <button type="button" class="btn btn-success" onclick="checkRegistration(this.form,this)">
                            {{ __('register') }}
                        </button>
                    </div>
                    <script>
                        async function checkRegistration(form, button) {
                            if (form.name.value == "") {
                                alert("Please enter your name.");
                                form.name.focus();
                                return false;
                            }
                            if (form.email.value == "") {
                                alert("Please enter your email.");
                                form.email.focus();
                                return false;
                            }
                            if (form.password.value == "") {
                                alert("Please enter your password.");
                                form.password.focus();
                                return false;
                            }
                            if (form.code.value == "") {
                                alert("Please enter your code.");
                                form.code.focus();
                                return false;
                            }

                            const email = form.email.value;
                            const code = form.code.value;
                            const password = form.password.value;
                            const name = form.name.value;

                            button.disabled = true;
                            button.innerHTML =
                                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                            const url = `{{ route('candidate.check_register') }}`;
                            const data = {
                                name: name,
                                email: email,
                                password: password,
                                code: code
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
                                console.log(result.message);
                                
                                if (result.success) {
                                    form.name.value = "";
                                    form.email.value = "";
                                    form.password.value = "";
                                    form.code.value = "";
                                    document.getElementById("closeRegisterModal").click();
                                }
                            } catch (error) {
                                console.error("Error:", error);
                                alert("Error: " + error);
                            } finally {
                                button.disabled = false;
                                button.innerHTML = '{{ __('register') }}';
                            }
                        }
                    </script>
                </form>

            </div>
        </div>
        <div class="modal fade" id="forgotpasswordModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="forgotpasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('rv_user.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">{{ __('forgot password') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button type="button" class="btn btn-primary" onclick="sendCode(this.form.email.value,this)">
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
                        const url = `{{ route('fp_user.store') }}`;

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
    @auth('user')
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('candidate.user.update', $auth->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">
                            {{ __('change password') }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="password" class="form-control" name="current_password" required>
                            <label>
                                {{ __('current password') }}
                            </label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="new_password" required>
                            <label>
                                {{ __('new password') }}
                            </label>
                        </div>
                        <br>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="confirm_password" required>
                            <label>
                                {{ __('confirm password') }}
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ __('save change') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endauth
</modal>
