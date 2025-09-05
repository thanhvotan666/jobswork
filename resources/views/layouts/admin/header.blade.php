<header>
    <nav class="navbar navbar-expand-lg bg-primary" style="height: 60px;">
        <div class="container-fluid bg-primary">
            <a class="navbar-brand" href="{{ route('admin.index') }}">
                <img src="{{ asset('storage/image/' . config('app.logo')) }}" alt="logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-5 my-2 my-lg-0 align-items-center
                navbar-nav-scroll justify-content-end w-100"
                    style="--bs-scroll-height: 400px;">
                    <li class="nav-item ">
                        <div class="dropdown me-lg-5 nav-link text-white">
                            <div href="" class="d-flex gap-2 align-items-center" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <div>
                                    <img class="rounded-3" src="{{ asset(auth()->guard('admin')->user()->image) }}"
                                        alt="{{ auth()->guard('admin')->user()->name }}" width="40" height="40">
                                </div>
                                <strong>{{ auth()->guard('admin')->user()->name }}</strong>
                                <div class="dropdown-toggle"></div>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeNameModal">
                                        <i class="bi bi-person-vcard-fill text-primary fw-bold fs-4"></i>
                                        {{ __('change name') }}
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changeImageModal">
                                        <i class="bi bi-person-video text-primary fw-bold fs-4"></i>
                                        {{ __('change profile picture') }}
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                        <i class="bi bi-key text-primary fw-bold fs-4"></i>
                                        {{ __('change password') }}
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                        <i class="bi bi-box-arrow-left text-primary fw-bold fs-4"></i>
                                        {{ __('logout') }}
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-item dropdown me-lg-5 text-black">
                                        <div class="d-flex gap-2 align-items-center" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-translate text-primary fw-bold fs-4"></i>
                                            {{ __('language') }}
                                            <div class="dropdown-toggle"></div>
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
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
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
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST"
                action="{{ route('admin.admins.update', ['admin' => auth()->guard('admin')->id()]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('change name') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="new_name" required>
                        <label>{{ __('new name') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('save changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="changeImageModal" tabindex="-1" aria-labelledby="changeImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.admins.update', ['admin' => auth()->guard('admin')->id()]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('change profile picture') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <input type="file" name="new_image" class="form-control" accept="image/*" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('save changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST"
                action="{{ route('admin.admins.update', ['admin' => auth()->guard('admin')->id()]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('change password') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="current_password" required>
                        <label>{{ __('current password') }}</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="new_password" required>
                        <label>{{ __('new password') }}</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="confirm_password" required>
                        <label>{{ __('confirm new password') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('save changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</modal>
