@extends('layouts.admin.index')

@section('title', request()->getHost() . __('dashboard'))

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <div class="container text-center">
                    <a href="https://gohire.vn/">
                        <img src="{{asset('storage/image/bg/gohire_banner.png')}}" alt="gohire" class="img-fluid">
                    </a>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid">
                <div class="container">
                    <form>
                        <label for="candidate-list">{{__('employer')}}</label>
                        <select name="date-start" id="candidate-list" class="form-select w-100" onchange="this.form.submit();">
                            @php
                                use Carbon\Carbon;
        
                                $mondayWeek = Carbon::now()->startOfWeek();
                                $created_at = Carbon::parse(App\Models\DailyVisit::first()->visit_date)->startOfWeek();
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
            
        </section>
        <section>
            <div class="container-fluid mb-5">
                <div class="container">
                    <div class="bg-white my-4 rounded shadow text-centers">
                        <div class="w-100" style="margin: auto;">
                            <canvas id="visitsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid">
                <div class="container">
                    <div class="bg-white my-4 rounded shadow text-centers">
                        <div class="w-100" style="margin: auto;">
                            <canvas id="candidatesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid mb-5">
                <div class="container">
                    <div class="bg-white my-4 rounded shadow text-centers">
                        <div class="w-100" style="margin: auto;">
                            <canvas id="jobsChart"></canvas>
                        </div>
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
            datasets: [
                {
                    label: '{{ __("new employers") }}',
                    data: chartData.allEmployers,
                    backgroundColor: 'rgba(128, 0, 128, 0.2)', // Tím nhạt
                    borderColor: 'rgba(128, 0, 128, 1)',       // Tím đậm
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: '{{ __("new candidates") }}',
                    data: chartData.allCandidates,
                    backgroundColor: 'rgba(0, 255, 255, 0.2)', // Xanh ngọc nhạt
                    borderColor: 'rgba(0, 255, 255, 1)',       // Xanh ngọc đậm
                    borderWidth: 2,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return ` ${context.dataset.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                            return null;
                        }
                    }
                }
            }
        }
    });

        const ctxVisit = document.getElementById('visitsChart').getContext('2d');
        const visitsChart = new Chart(ctxVisit, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: '{{ __("visits") }}',
                        data: chartData.allVisits,
                        backgroundColor: 'rgba(255, 0, 0, 0.2)', // Đỏ nhạt
                        borderColor: 'rgba(255, 0, 0, 1)',       // Đỏ đậm
                        borderWidth: 2,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.dataset.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                                return null;
                            }
                        }
                    }
                }
            }
        });
    
        const ctxJobs = document.getElementById('jobsChart').getContext('2d');
        const jobsChart = new Chart(ctxJobs, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: '{{ __("new jobs") }}',
                        data: chartData.allJobs,
                        backgroundColor: 'rgba(0, 128, 0, 0.2)', // Xanh lá nhạt
                        borderColor: 'rgba(0, 128, 0, 1)',       // Xanh lá đậm
                        borderWidth: 2,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.dataset.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                if (Number.isInteger(value)) {
                                    return value;
                                }
                                return null;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection

