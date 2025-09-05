@extends('layouts.employer.index')

@section('title', request()->getHost() . ': '. __('job list'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('job') }}
    </li>
@endsection

@section('content')
    <main>
        <section>
            <h1>
                {{ __('job list') }}
            </h1>
            <div class="d-flex flex-wrap gap-3 px-4 fw-bold justify-content-around ">
                <a href="?status=all"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'all') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('all job') }}</div>
                    <div>{{ $auth->jobs->count() }}</div>
                </a>
                <a href="?status=online"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'online') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('online job') }}</div>
                    <div>{{ $auth->jobs->where('expired', '>=', now()->toDateString())->where('is_stop', false)->where('admin_id',true)->count() }}</div>
                </a>
                <a href="?status=stop"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'stop') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('pause job') }}</div>
                    <div>{{ $auth->jobs->where('is_stop', true)->count() }}</div>
                </a>
                <a href="?status=expired"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'expired') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('expired job') }}</div>
                    <div>{{ $auth->jobs->where('expired', '<', now()->toDateString())->count() }}</div>
                </a>
                <a href="?status=pending"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'pending') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('pending job') }}</div>
                    <div>{{ $auth->jobs->count() - $auth->jobs->whereIn('admin_id', true)->count() }}</div>
                </a>
                
            </div>
            <hr>
        </section>
        <section>
            <div class="text-end p-4">
                {{ __('showing') }}
                {{ 1 * request('page', '1') }}
                -
                {{ request('per_page', '1') * (request('page', '1') - 1) + $jobs->count() }}
                {{ __('of') }} {{ $jobsCount }} {{ __('results') }}
            </div>
            <hr>
            
                <input type="hidden" name="status" value="{{ request('status','all') }}">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('name') }}</th>
                            <th scope="col">{{ __('created at') }}</th>
                            <th scope="col">{{ __('expired date') }}</th>
                            <th scope="col">{{ __('cadidate') }}</th>
                            <th scope="col">{{ __('views') }}</th>
                            <th scope="col">{{ __('action') }}</th>
                        </tr>
                        <tr>
                            <form class="py-3" method="GET" action="{{ route('employer.jobs.index') }}">
                                <th scope="col">
                                    <input type="text" class="form-control" name="name" placeholder="enter name" onkeypress="if(event.key === 'Enter') this.form.submit();" value="{{ request('name') }}">
                                </th>
                                <th scope="col">
                                    <input type="date" class="form-control" name="created_at" onchange="this.form.submit();" value="{{ request('created_at') }}">
                                </th>
                                <th scope="col">
                                    <input type="date" class="form-control" name="expired" onchange="this.form.submit();"  value="{{ request('expired') }}">
                                </th>
                                <th scope="col">
                                    <input type="number" class="form-control" name="applied" value="0" onkeypress="if(event.key === 'Enter') this.form.submit();" value="{{ request('applied',0) }}">
                                </th>
                                <th scope="col">
                                    <input type="number" class="form-control" name="view" value="0" onkeypress="if(event.key === 'Enter') this.form.submit();" value="{{ request('view',0) }}">
                                </th>
                                <th scope="col"></th>
                            </form>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="result">
                        @foreach ($jobs as $job)
                            <tr>
                                <th scope="row">
                                    <a href="{{route('employer.jobs.show',$job->id)}}" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" style="text-decoration: underline">
                                        <div>
                                            <strong>
                                                {{ $job->name }}
                                            </strong>
                                            <strong>
                                                # {{ $job->id }}
                                            </strong>
                                        </div>
                                        <div>{{ __('update') }}: {{ $job->updated_at }}</div>
                                        <div>
                                            {{ __('location') }}: {{ $job->location }}
                                        </div>
                                    </a>
                                </th>

                                <td>
                                    {{ $job->created_at }}
                                </td>
                                <td>
                                    {{ $job->expired }}
                                </td>

                                <td class="text-center">
                                    <div class="btn btn-lighter">
                                        {{ $job->applieds()->count() }}
                                    </div>
                                </td>

                                <td class="text-center">
                                    <div class="btn btn-lighter">
                                        {{ \App\Models\JobView::where('job_id', $job->id)->count() }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                        aria-expanded="false"></i>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('employer.jobs.create', ['id' => $job->id]) }}">
                                                {{ __('clone') }}
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('employer.jobs.edit', $job->id) }}">
                                                {{ __('edit') }}
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action=""></form>
                                            <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST">
                                                {{-- onsubmit="return confirm('{{ __('are you sure you want to stop this job?') }}')"> --}}
                                                @csrf
                                                @method('DELETE')

                                                @if ($job->is_stop)
                                                    <button type="submit" class="dropdown-item text-success">{{ __('resume') }}</button>
                                                @else
                                                    <button type="submit" class="dropdown-item text-danger">{{ __('pause') }}</button>
                                                @endif
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-3 d-flex align-items-center gap-4 justify-content-center">
                    <div>
                        <label for="per_page">{{ __('num of rows') }}:</label>
                        <select name="per_page" id="per_page" onchange="this.form.submit()" class="form-select">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>
                                10
                            </option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>
                                20
                            </option>
                            <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>
                                30
                            </option>
                        </select>
                    </div>
                </div>
                <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                    {{ $jobs->appends([
                            'per_page' => request('per_page'),
                            'name' => request('name'),
                            'create_at' => request('create_at'),
                            'expired' => request('expired'),
                            'view' => request('view'),
                            'applied' => request('applied'),
                        ])->links() }}
                </div>
                </div>
            
        </section>
    </main>
@endsection
