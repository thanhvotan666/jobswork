@extends('layouts.employer.index')

@section('title', request()->getHost() . ': '. __('purchased orders'))

@section('breadcrumb-item')
    <li class="breadcrumb-item">
        {{__('purchased orders')}}
    </li>
@endsection

@section('content')
<main>
    <section>
        <div class="container-fluid">
            <div class="container">
                <div class="d-flex p-4 justify-content-between">
                    <h1>{{__('purchased orders')}}</h1>
                    <a class="btn btn-success" href="{{ route('employer.orders.create') }}" style="height: fit-content">
                        <i class="bi bi-file-plus-fill"></i>
                        {{ __('add new')}}
                    </a>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr class="table">
                            <th scope="col">
                                {{ __('order code')}}
                            </th>
                            <th scope="col">
                                {{__('service')}}
                            </th>
                            <th scope="col">
                                {{__('price')}}
                            </th>
                            <th scope="col">
                                {{__('quantity')}}
                            </th>
                            <th scope="col">
                                {{__('created date')}}
                            </th>
                            <th scope="col">
                                {{__('start date')}}
                            </th>
                            <th scope="col">
                                {{__('expired date')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logServices as $logService)
                            <tr class="small">
                                <th scope="row" class="text-center">
                                    {{ $logService->order_id}}
                                </th>
                                <td style="max-width:300px;">
                                    @if ($logService->service_id)
                                        {{ $logService->service->name}}
                                    @else
                                        Work Point
                                    @endif
                                </td>
                                <td class="text-secondary">
                                    @if ($logService->service_id)
                                        {{ $logService->service->price}} ₫
                                    @endif
                                </td>
                                <td class="text-primary">
                                    {{  $logService?->quantity }}
                                </td>
                                <td>
                                    {{ $logService->created_at }}
                                </td>

                                <td class="text-success">
                                    @if ($logService->service_id)
                                    {{ $logService?->start }}
                                    @endif
                                </td>
                                <td class="text-danger">
                                    @if ($logService->service_id)
                                    {{ $logService?->expired }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<script>
    function onClickRadioSelect(e) {
        e.checked = true;
        document.getElementById('cart_id').value = e.value;
        document.getElementById('form-select-cart').submit();
    }
    function incrementQuantity(button) {
            var input = button.parentElement.previousElementSibling;
            var value = parseInt(input.value);
            input.value = value + 1;
            loadTotal();
    }

    function decrementQuantity(button) {
        var input = button.parentElement.nextElementSibling;
        var value = parseInt(input.value);
        if (value > 0) {
            input.value = value - 1;
            loadTotal();
        }
        
    }
    

    function loadTotal(){
        const intoCash = document.getElementById('into_cash');
        const provisional = document.getElementById('provisional');
        const ids = ['1'];
        var all = 0;
        ids.forEach(e => {
            const total = document.getElementById(`total_${e}`);
            const quantity = document.getElementById(`quantity_${e}`).value;
            const price = parseFloat(document.querySelector(`#price_${e}`).innerText);
            total.innerText = (quantity * price).toLocaleString('vi-VN');
            all += quantity * price;
        });
        intoCash.innerText = all.toLocaleString('vi-VN');
        provisional.innerText = all.toLocaleString('vi-VN');
    }
</script>

@endsection