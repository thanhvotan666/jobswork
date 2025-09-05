<header>
    <nav class="navbar navbar-expand-xl border-bottom bg-white" style="height: 60px;background-color: white">
        <div class="container-fluid bg-white">
            <div class="navbar-brand d-flex gap-4 align-items-center">
                <a  href="{{ route('employer.dashboard.index') }}"><img src="{{ asset('storage/image/' . config('app.logo')) }}" alt="logo"></a>
                <small style="font-size: 0.75rem;font-weight: 500">
                    <i class="bi bi-globe-americas text-primary"></i>
                    {{__('CSKH')}}: {{ auth()->guard('employer')->user()->support?->customerCare->name }}
                </small>
                <small style="font-size: 0.75rem">
                    <i class="bi bi-telephone text-primary"></i>
                    {{ auth()->guard('employer')->user()->support?->customerCare->phone }}
                </small>
                <small style="font-size: 0.75rem">
                    <i class="bi bi-envelope text-primary"></i>
                    {{ auth()->guard('employer')->user()->support?->customerCare->email }}
                </small>
            </div>

            <div class="collapse navbar-collapse bg-white" id="navbarScroll">
                <ul class="navbar-nav me-5 my-2 my-lg-0 align-items-center
                navbar-nav-scroll justify-content-end w-100"
                    style="--bs-scroll-height: 400px;">
                    <li class="nav-item d-flex">
                        <div class="mx-3 d-flex align-items-center">
                            <a href="{{route('employer.orders.create')}}">
                                <i class="bi bi-cart-fill text-primary fs-5"></i>
                                {{__('buy service')}}
                            </a>
                        </div>
                        <div class="mx-3 d-flex align-items-center">
                            <div class="text-primary">
                                <i class="bi bi-gem text-primary fs-5"></i>
                                <text id="work-point">
                                    {{ number_format(auth()->guard('employer')->user()->point,0,',','.')  }}
                                </text>
                                
                            </div>
                        </div>
                        <div class="dropdown me-lg-2 nav-link">
                            <div class="d-flex gap-2 align-items-center" role="button"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <div>
                                    <img class="rounded-3" src="{{ asset(auth()->guard('employer')->user()->image) }}"
                                        alt="{{ auth()->guard('employer')->user()->name }}" width="40"
                                        height="40">
                                </div>
                                <strong class="text-truncate" style="max-width: 250px;font-size: smaller">{{ auth()->guard('employer')->user()->name }}</strong>
                                <div class="dropdown-toggle"></div>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('employer.dashboard.edit', auth()->guard('employer')->user()->id) }}">
                                        <i class="bi bi-card-heading text-primary fw-bold fs-4"></i>
                                        {{ __('profile') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item disabled" href="#">
                                        <i class="bi bi-bell-fill text-primary fw-bold fs-4"></i>
                                        {{ __('notification') }}
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#changePasswordModal">
                                        <i class="bi bi-key text-primary fw-bold fs-4"></i>
                                        {{ __('change password') }}
                                    </div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('employer.jobs.create') }}">
                                        <i class="bi bi-file-earmark-plus text-primary fw-bold fs-4"></i>
                                        {{ __('post new job') }}
                                    </a>
                                </li>
                                
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('employer.logout') }}">
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
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST"
                action="{{ route('employer.dashboard.update', auth()->guard('employer')->id()) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('change password') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="password" class="form-control" name="current_password">
                        <label>{{ __('current password') }}</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="new_password">
                        <label>{{ __('new password') }}</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="confirm_password">
                        <label>{{ __('confirm password') }}</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('exit') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</modal>
