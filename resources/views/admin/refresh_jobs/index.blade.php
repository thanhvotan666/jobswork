@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('job list'))
@section('content')
    <main>
        <section>
            <h1>
                {{ __('job list') }}
            </h1>
            <div class="w-100 px-5">
                <form action="" method="get">
                    @if (request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <select name="employer_id" id="employer_id" class="form-select" onchange="this.form.submit()">
                        <option value="">{{__('choose employer')}}</option>
                        @php
                            $employers = App\Models\Employer::all();
                        @endphp
                        @foreach ($employers as $employer)
                            <option value="{{ $employer->id }}" {{ request('employer_id') == $employer->id ? 'selected' : '' }}>
                                {{ $employer->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <hr>
            <div class="d-flex flex-wrap gap-3 px-4 fw-bold justify-content-around ">
                <a href="?"
                    class="p-3 text-center rounded-3 @if (request('sort', "") === '') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('created date') }}</div>
                </a>
                <a href="?sort=updated_at"
                    class="p-3 text-center rounded-3 @if (request('sort') === 'updated_at') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('updated date') }}</div>
                </a>
                <a href="?sort=expired_at"
                    class="p-3 text-center rounded-3 @if (request('sort') === 'expired_at') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('expired date') }}</div>
                </a>
                <a href="?sort=refreshed"
                    class="p-3 text-center rounded-3 @if (request('sort') === 'refreshed') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('refreshed') }}</div>
                </a>
                <a href="?sort=not_refreshed"
                    class="p-3 text-center rounded-3 @if (request('sort') === 'not_refreshed') bg-success
                @else
                    bg-white @endif">
                    <div>{{ __('not refreshed yet') }}</div>
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
                            <th scope="col">{{ __('updated at') }}</th>
                            <th scope="col">{{ __('expired date') }}</th>
                            <th scope="col">{{ __('refresh date') }}</th>
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
                                                {{ $job->name }} {{ $job->is_hot ? '🔥' : '' }}
                                            </strong>
                                            <strong>
                                                # {{ $job->id }}
                                            </strong>
                                        </div>
                                        <div>{{ __('update') }}: {{ $job->updated_at }}</div>
                                        <div>
                                            {{ __('location') }}: {{ $job->location }}
                                        </div>
                                        <small class="text-info">{{ $job->employer->name }}</small>
                                    </div>
                                </th>

                                <td>
                                    {{ $job->created_at }}
                                </td>
                                
                                <td class="text-center">
                                    {{ $job->updated_at }}
                                </td>
                                
                                <td>
                                    {{ $job->expired }}
                                </td>

                                <td class="text-center">
                                    {{ $job->sort_date }}
                                </td>

                                <td class="text-end">
                                    <form action="{{ route('admin.refresh_job.update', $job->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">{{ __('refresh') }}</button>
                                    </form>
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
