@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Service - Edit: ' . $service->name)
@section('content')
    <main>
        <div class="container-fluid">
            <div class="container">
                <h1>{{ __('edit') }} - {{ __('id') }}: {{ $service->id }}</h1>
                <div class="d-flex flex-column gap-4 bg-white rounded-3 p-4">
                    <div class="d-flex gap-4 ">
                        <div>Name: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#nameModal" style="text-decoration: underline">
                            {{ $service->name }}</div>
                        <div class="modal fade" id="nameModal" tabindex="-1" aria-labelledby="nameModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.services.update', ['service' => $service->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change name') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="name" required>
                                            <label>{{ __('new name') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <div>{{ __('show contact candidate') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#showContactCandidateModal"
                            style="text-decoration: underline">
                            {{ $service->show_contact_candidate ? 'Yes' : 'No' }}</div>
                        <div class="modal fade" id="showContactCandidateModal" tabindex="-1"
                            aria-labelledby="showContactCandidateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.services.update', ['service' => $service->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('edit') }}
                                            {{ __('show contact candidate') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <select class="form-select" name="show_contact_candidate" required>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            <label>{{ __('new show contact candidate') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4">
                        <div>{{ __('hot job') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#hotJobModal"
                            style="text-decoration: underline">
                            {{ $service->hot_job ? 'Yes' : 'No' }}</div>
                        <div class="modal fade" id="hotJobModal" tabindex="-1"
                            aria-labelledby="hotJobModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.services.update', ['service' => $service->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('edit') }}
                                            {{ __('hot job') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <select class="form-select" name="hot_job" required>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            <label>{{ __('hot job') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
