@extends('layouts.employer.index')

@section('title', request()->getHost() . ': '. __('job list'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        JobPoint
    </li>
@endsection

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <div class="container">
                    <h4>{{__('service exchange')}}</h4>
                    <div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
