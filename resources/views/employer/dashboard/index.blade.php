@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('account employer'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('account employer') }}
    </li>
@endsection
{{-- @dd($chartData) --}}
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
                        <label for="candidate-list">{{__('candidate list')}}</label>
                        <select name="date-start" id="candidate-list" class="form-select w-100" onchange="this.form.submit();">
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);
        console.log(chartData.allApplieds);
        console.log(chartData.allViews);
        console.log(chartData.labels);
        const ctx = document.getElementById('candidatesChart').getContext('2d');
        const candidatesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: '{{ __("applied") }}',
                    data: chartData.allApplieds,
                    backgroundColor: 'rgba(0, 0, 255, 0.2)', // Xanh dương nhạt
                    borderColor: 'rgba(0, 0, 255, 1)',       // Xanh dương đậm
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: '{{ __("views") }}',
                    data: chartData.allViews,
                    backgroundColor: 'rgba(0, 255, 0, 0.2)', // Xanh lá nhạt
                    borderColor: 'rgba(0, 255, 0, 1)',       // Xanh lá đậm
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
