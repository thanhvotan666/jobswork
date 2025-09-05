<sidebar class="overflow-y-scroll position-sticky top-0 start-0" style="padding-top: 60px">
    <style>
        sidebar {
            background-color: white;
            min-width: 250px;
            max-width: 250px;
            transition: all 0.3s;
            border-right: 1px solid;
            height: 100vh;
        }

        sidebar.collapsed {
            min-width: 80px;
            max-width: 80px;
        }

        sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        sidebar.collapsed .nav-link {
            justify-content: center;
        }

        sidebar.collapsed .nav-link span {
            display: none;
        }

        sidebar.collapsed .sidebar-header {
            text-align: center;
        }
    </style>
    <div class="sidebar-header p-3 d-flex justify-content-between">
        <div>
            <a href="{{ route('admin.index') }}" class="nav-link">
                <span class="text-dark fs-5 text-uppercase">
                    {{ __('dashboard') }}
                </span>
            </a>
        </div>
        <button id="toggle-btn" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-list fs-4"></i>
        </button>
    </div>
    <ul class="nav flex-column p-2">
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">
                    {{ __('manage') }} {{ __('job list') }}
                </span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.jobs.index') }}" class="nav-link">
                <i class="bi bi-person-gear"></i>
                <span>{{ __('job list') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.refresh_job.index') }}" class="nav-link">
                <i class="bi bi-arrow-clockwise"></i>
                <span>{{ __('refresh job') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.support_candidates.index') }}" class="nav-link">
                <i class="bi bi-person-rolodex"></i>
                <span>
                    {{ __('recruitment support') }}
                </span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('manage') }} {{ __('admins') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.admins.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-person-gear"></i>
                <span>{{ __('account') }} {{ __('admin') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.admins.create') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-person-plus"></i>
                <span>{{ __('add admin') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.customer_care.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-person-raised-hand"></i>
                <span>{{ __('customer care') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('manage') }} {{ __('services') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.services.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->service)">
                <i class="bi bi-bag"></i>
                <span>{{ __('service') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.services.create') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->service)">
                <i class="bi bi-bag-plus"></i>
                <span>{{ __('add service') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('manage') }} {{ __('candidates') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.candidates.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->candidate)">
                <i class="bi bi-people"></i>
                <span>{{ __('account') }} {{ __('candidate') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('manage') }} {{ __('employer') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.employers.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->employer)">
                <i class="bi bi-people-fill"></i>
                <span>{{ __('employer') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.employers.create') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->employer)">
                <i class="bi bi-person-plus-fill"></i>
                <span>{{ __('add employer') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.employer_pending.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->employer)">
                <i class="bi bi-people-fill"></i>
                <span>{{ __('NTD') }} {{ __('pending')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('manage') }} {{ __('products') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-cart"></i>
                <span>{{ __('product list') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.product.create') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-cart-plus"></i>
                <span>{{ __('add') }} {{__('product')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('manage') }} {{ __('categories') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.categories') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-tags"></i>
                <span>{{ __('categories') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.payment_info.index') }}" class="nav-link @disabled(!auth()->guard('admin')->user()->admin)">
                <i class="bi bi-qr-code"></i>
                <span>{{ __('payment information') }}</span>
            </a>
        </li>
    </ul>
    <script>
        document.getElementById("toggle-btn").addEventListener("click", function() {
            document.querySelector("sidebar").classList.toggle("collapsed");
        });
    </script>
</sidebar>
