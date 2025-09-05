@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('candidate statistics'))

@section('breadcrumb-item',)
<li class="breadcrumb-item">
    {{ __('candidate statistics') }}
</li>
@endsection

@section('content')
    <main>
        <section>
            <div class="container">
                <!-- Filters Section -->
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between bg-white p-4 rounded shadow mb-4">
                    <div class="d-flex align-items-center mb-3 mb-md-0">
                        <a class="btn btn-secondary me-3" style="width: 200px" href="{{ route('employer.candidate_statistics')."?all=true"}}">
                            {{ __('see all') }}
                        </a>
                        <form>
                            <select name="date-start" class="form-select w-100" onchange="this.form.submit();">
                                @php
                                    use Carbon\Carbon;

                                    $mondayWeek = Carbon::now()->startOfWeek();
                                    $created_at = Carbon::parse(auth()->guard('employer')->user()->created_at)->startOfWeek();
                                    $weeks = [];
                                    
                                    
                                    for ($i = $mondayWeek->copy(); $i->greaterThanOrEqualTo($created_at); $i->subWeek()) { 
                                        $weeks[] = $i->copy();
                                    }
                                @endphp

                                @foreach ($weeks as $week)
                                    <option value="{{ $week }}" @selected($week->format('Y-m-d H:i:s') == request('date-start'))>
                                        {{ $week->format('d-m-Y') . " - " . $week->copy()->endOfWeek()->format('d-m-Y') }}
                                    </option>
                                @endforeach
                            </select>   
                        </form>
                    </div>
                </div>
        
                <!-- Statistics Filters Section -->
                {{-- <div class="bg-white p-4 rounded shadow mb-4">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-3 mb-md-0">
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Ứng viên theo tỉnh thành</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Ứng viên theo độ tuổi</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Ứng viên theo bằng cấp</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Ứng viên theo vòng</label>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Ứng viên theo vòng và thời gian</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Tỉ lệ chuyển đổi ứng viên</label>
                            </div>
                            <div class="form-check form-switch me-3">
                                <input class="form-check-input toggle-checkbox" type="checkbox">
                                <label class="form-check-label">Ứng viên theo công việc</label>
                            </div>
                        </div>
                    </div>
                </div> --}}
        
                <!-- Statistics Section -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="bg-white p-4 rounded shadow text-center">
                            <h5 class="text-secondary mb-2">{{ __('total candidates') }}</h5>
                            <p class="display-4">{{ $list['all']}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white p-4 rounded shadow text-center">
                            <h5 class="text-secondary mb-2">{{ __('rejected candidates') }}</h5>
                            <p class="display-4">{{ $list['faileds']}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white p-4 rounded shadow text-center">
                            <h5 class="text-secondary mb-2">{{ __('hired candidates') }}</h5>
                            <p class="display-4">{{ $list['successes']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="bg-white my-4 rounded shadow text-centers">
                    <div class="w-100" style="margin: auto;">
                        <canvas id="candidatesChart"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);
        const ctx = document.getElementById('candidatesChart').getContext('2d');
        const candidatesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: '{{__('candidate')}}',
                    data: chartData.allApplieds,
                    backgroundColor: 'rgba(0, 0, 255, 0.2)', // Màu xanh dương nhạt
                    borderColor: 'rgba(0, 0, 255, 1)', // Màu xanh dương đậm
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw} candidates`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>
    
@endsection
