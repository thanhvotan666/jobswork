@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('job list'))
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
                </a>
                <a href="?status=pending"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'pending') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('pending job') }}</div>
                </a>
                <a href="?status=processed"
                    class="p-3 text-center rounded-3 @if (request('status', 'all') === 'processed') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('processed job') }}</div>
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
            <div class="py-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('name') }}</th>
                            <th scope="col">{{ __('created at') }}</th>
                            <th scope="col">{{ __('expired date') }}</th>
                            <th scope="col">{{ __('create by') }}</th>
                            <th scope="col">{{ __('updated at') }}</th>
                            <th scope="col">{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="result">
                        @foreach ($jobs as $job)
                            <tr>
                                <th scope="row">
                                    <div>
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
                                    </div>
                                </th>

                                <td>
                                    {{ $job->created_at }}
                                </td>
                                <td>
                                    {{ $job->expired }}
                                </td>

                                <td class="text-center">
                                    {{ $job->employer->name }}
                                </td>

                                <td class="text-center">
                                    {{ $job->updated_at }}
                                </td>
                                <td class="text-end">
                                    <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                        aria-expanded="false"></i>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.jobs.show', $job->id) }}">
                                                {{ __('show') }}
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action=""></form>
                                            <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                @if ($job->admin_id)
                                                <button type="submit" class="dropdown-item text-warning">{{ __('not approved') }}</button>
                                                @else
                                                <button type="submit" class="dropdown-item text-success">{{ __('approved') }}</button>
                                                @endif
                                                
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action=""></form>
                                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">{{ __('delete') }}</button>
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
                            'status' => request('status'),
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
