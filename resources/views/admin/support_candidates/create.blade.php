@extends('layouts.admin.index')

@section('title', request()->getHost() . ': ' . __('recruitment support'))
@section('breadcrumb-item')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.support_candidates.index') }}">
            {{ __('recruitment support') }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('create new') }}
    </li>
@endsection

@section('content')
    <main>
        <form>
        <section>
            <div class="container">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between bg-white p-4 rounded shadow mb-4">
                    <h1 class="h3 mb-0">{{ __('create new') }}</h1>
                </div>

                <div class="bg-white p-4 rounded shadow mb-4">
                        <div class="form-group mb-3">
                            <label for="search">{{ __('search') }} {{__('employers')}}</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="EX: công ty ABC" onclick="" value="{{old('search',request('search'))}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="employer_id">{{ __('employer') }} <sup class="text-danger">*</sup></label>
                            <select name="employer_id" id="employer_id" class="form-control select2" onchange="this.form.submit()">
                                <option value="" @selected(old('employer_id',request('employer_id')) == "")>{{ __('select') }} {{ __('employers')}}</option>
                                @foreach ($employers as $employer)
                                    <option value="{{ $employer->id }}" @selected(old('employer_id',request('employer_id')) == $employer->id)>{{ $employer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="job_id">{{ __('job') }} <sup class="text-danger">*</sup></label>
                            <select name="job_id" class="form-control select2" onchange="changeJob(this)">
                                <option value="" @selected(old('job_id',request('job_id') == ""))>{{ __('select') }} {{__('job')}}</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->id }}" @selected(old('job_id',request('job_id')) == $job->id)>{{ $job->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="bg-white p-4 rounded shadow mb-4">
                    <div class="form-group mb-3">
                        <label for="search_candidate">{{ __('search') }} {{__('candidate name')}}</label>
                        <input type="text" id="search_candidate" name="search_candidate" class="form-control" placeholder="EX: Hải Đăng" value="{{old('search_candidate',request('search_candidate'))}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="candidate_id">{{ __('candidate') }} <sup class="text-danger">*</sup></label>
                        <select name="candidate_id" class="form-control select2" onchange="changeCandidate(this)" required>
                            <option value="" @selected(old('employer_id',request('employer_id')) == "")>{{ __('select') }} {{ __('candidate')}}</option>
                            @foreach ($candidates as $candidate)
                                <option value="{{ $candidate->id }}" @selected(old('candidate_id',request('candidate_id')) == $candidate->id)>{{ $candidate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <form action="{{route('admin.support_candidates.store')}}" method="POST">
        @csrf
        <section>
            <div class="container">
                <div class="bg-white p-4 rounded shadow mb-4 text-center">
                    <input type="hidden" name="job_id" id="job_id" value="{{old('job_id',request('job_id'))}}" required>
                    <input type="hidden" name="candidate_id" id="candidate_id" value="{{old('candidate_id',request('candidate_id'))}}" required>
                    <div class="form-group mb-3 text-start">
                        <label for="description">{{ __('description') }}</label>
                        <textarea name="description" id="description" class="form-control" rows="4" placeholder="EX: {{ __('support candidates') }}">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary px-5">
                            {{ __('create') }}
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </form>
    </main>
    <script>
        document.getElementById('search').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
        document.getElementById('search_candidate').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('form').submit();
            }
        });
        function changeJob(e){
            const value = e.value;
            document.getElementById('job_id').value = value;
        }
        function changeCandidate(e){
            const value = e.value;
            document.getElementById('candidate_id').value = value;
        }
    </script>
@endsection