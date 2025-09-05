@extends('layouts.admin.index')
@section('title', __('customer care') . ' - ' . __('edit'))
@section('content')
    <main>

        <section>
            <div class="container-fluid px-5 mt-5">
                <div class="container p-5 d-flex flex-column gap-4 bg-white border rounded-4">
                    <div class="d-flex gap-5 flex-wrap justity-content-between align-items-center">
                        <h2>{{__('support')}}</h2>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            {{ __('add') }}
                        </button>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <form action="{{ route('admin.customer_care.update', $customerCare->id) }}" 
                            method="POST" 
                            class="modal-content">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('support')}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="_support" value="0">
                                    <div class="form-floating m-3">
                                        <select class="form-select" id="employer_id" name="employer_id" aria-label="Floating label select example">
                                            <option selected disabled>{{__('choose employer')}}</option>
                                            @php
                                                $ids = $customerCare->supports()->pluck('employer_id')->toArray();
                                                $employers = \App\Models\Employer::whereNotIn('id', $ids)->get();
                                            @endphp
                                            @foreach($employers as $employer)
                                                <option value="{{ $employer->id }}">{{ $employer->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="employer_id">{{__('company name')}}</label>
                                      </div>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('close')}}</button>
                                        <button type="submit" class="btn btn-primary">{{__('add')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="py-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">{{ __('id') }}</th>
                                    <th scope="col">{{ __('name') }}</th>
                                    <th scope="col">{{ __('email') }}</th>
                                    <th scope="col">{{ __('phone') }}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="result">
                                @foreach ($supports as $support)
                                    <tr>
                                        <th scope="row">{{ $support->employer->id }}</th>
                                        <td class="">{{ $support->employer->name }}</td>
                                        <td class="">{{ $support->employer->email }}</td>
                                        <td class="">{{ $support->employer->phone }}</td>

                                        <td class="text-end">
                                            <form
                                                action="{{ route('admin.customer_care.destroy', $customerCare->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('{{ __('are you sure you want to delete?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="_support" value="{{ $support->id }}">
                                                <button type="submit" class="dropdown-item text-danger">{{ __('remove') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                            {{ $supports->appends([
                                    'name' => request('name'),
                                    'email' => request('email'),
                                    'phone' => request('phone'),
                                ])->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
