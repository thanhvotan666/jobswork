<sidebar class="overflow-y-scroll position-sticky top-0 start-0" style="padding-top: 60px">
    <style>
        sidebar {
            background-color: white;
            min-width: 260px;
            max-width: 260px;
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
            <a href="{{route('employer.dashboard.index')}}" class="nav-link">
                <span class="text-dark text-uppercase" style="font-size: medium">
                    {{ __('account employer') }}
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
                <span class="text-secondary small">{{ __('job management') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.jobs.index') }}" class="nav-link">
                <i class="bi bi-file-earmark-check-fill"></i>
                <span>
                    {{ __('job list') }}({{ auth()->guard('employer')->user()->jobs()->count() }})</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.jobs.create') }}" class="nav-link">
                <i class="bi bi-file-earmark-plus"></i>
                <span>{{ __('create new job') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('candidate management') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.candidates.index') }}" class="nav-link">
                <i class="bi bi-people-fill"></i>
                <span>{{ __('applied candidates') }}
                    ({{ auth()->guard('employer')->user()->jobs()->withCount('applieds')->get()->sum('applieds_count') }})
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.candidates.index', ['status' => 'suitable']) }}" class="nav-link">
                <i class="bi bi-file-earmark-person"></i>
                <span>{{ __('suitable candidate') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('employer.contacted_candidate')}}" class="nav-link">
                <i class="bi bi-people"></i>
                <span>{{ __('contacted candidate') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.support_candidates.index') }}" class="nav-link">
                <i class="bi bi-person-rolodex"></i>
                <span>
                    {{ __('support candidates') }}
                    ({{ auth()->guard('employer')->user()->jobs()->withCount('supports')->get()->sum('supports_count') }})</span>
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('employer.search')}}" class="nav-link">
                <i class="bi bi-search"></i>
                <span>{{ __('search candidate') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <div class="nav-link">
                <span class="text-secondary small">{{ __('utilities') }}</span>
            </div>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.candidate_statistics') }}" class="nav-link">
                <i class="bi bi-file-earmark-person-fill"></i>
                <span>{{ __('candidate statistics') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.orders.create') }}" class="nav-link">
                <i class="bi bi-cart"></i>
                <span>{{ __('list of orders') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.orders.index') }}" class="nav-link">
                <i class="bi bi-list-ul"></i>
                <span>{{ __('purchased orders') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.download') }}" class="nav-link">
                <i class="bi bi-file-earmark-arrow-down"></i>
                <span>{{ __('download list of candidates') }}</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('employer.dashboard.edit',1) }}" class="nav-link">
                <i class="bi bi-person-fill-exclamation"></i>
                <span>{{ __('user account') }}</span>
            </a>
        </li> --}}
        
        <li class="nav-item">
            <a href="{{ route('employer.dashboard.edit',1) }}" class="nav-link">
                <i class="bi bi-card-text"></i>
                <span>{{ __('edit company profile') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.orders.create') }}" class="nav-link">
                <i class="bi bi-gem"></i>
                <span>WorkPoint</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('employer.payment_info') }}" class="nav-link">
                <i class="bi bi-credit-card"></i>
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
