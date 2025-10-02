@extends('layouts.employer.index')

@section('title', request()->getHost() . ': '. __('list of orders'))

@section('breadcrumb-item')
    <li class="breadcrumb-item">
        {{__('list of orders')}}
    </li>
@endsection

@section('content')
<main>
    <section>
        <div class="container-fluid">
            <div class="container">
                <div class="h1 p-4">{{__('list of orders')}}</div>
                <form action="{{route('employer.vnpay')}}" method="get">
                    {{-- @csrf --}}
                    <div class="row">
                        <div class="col-xl-8">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="table">
                                            <th scope="col"></th>
                                            <th scope="col">
                                                {{__('service package')}}
                                            </th>
                                            <th scope="col">
                                                {{__('list price')}}
                                            </th>
                                            <th scope="col">
                                                {{__('promotional price')}}
                                            </th>
                                            <th scope="col" class="text-center">
                                                {{__('quantity')}}
                                            </th>
                                            <th scope="col">
                                                {{__('total')}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="small">
<th scope="row" class="text-center">
    <i class="bi bi-boxes" style="font-size: 20px;"
       data-bs-toggle="tooltip"
       data-bs-placement="top"
       data-bs-html="true"
       title="<pre style='white-space:pre-wrap;'>{{ $product->service->description ?? '...' }}</pre>"></i>
</th>
                                                <td style="max-width:300px;">
                                                    {{ $product->name}}
                                                </td>
                                                <td class="@if($product->price_discount) text-decoration-line-through text-secondary @else text-primary fw-bold @endif">
                                                    {{ $product->getNumber($product->price) }} ₫
                                                </td>
                                                <td class="text-primary fw-bold">
                                                    @if($product->price_discount)
                                                        {{ $product->getNumber($product->price_discount) }} ₫
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <button class="btn btn-outline-secondary" onclick="decrementQuantity(this)" type="button">
                                                        -
                                                        </button>
                                                        <input name="quantity_{{ $product->id }}" id="quantity_{{ $product->id }}" class="form-control quantity-input text-center" readonly="" type="text"
                                                        value="0" min="0" style="width: 20px"/>
                                                        <button class="btn btn-outline-secondary" onclick="incrementQuantity(this)" type="button">
                                                        +
                                                        </button>
                                                    </div>
                                                </td>
            
                                                <td class="text-danger total" style="width: 100px">
                                                    <b id='total_{{ $product->id }}'>
                                                        0
                                                    </b> ₫
                                                </td>
                                            </tr>                  
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="col-xl-4">
                            <div class="border rounded-4 p-4 bg-white">
                                <h2 class="h5 mb-4">
                                    {{__('total')}}
                                </h2>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>
                                        {{__('provisional')}}:
                                    </span>
                                    <span>
                                        <b id="provisional">0</b>đ
                                        
                                    </span>
                                    </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <span>
                                        {{__('into cash')}}:
                                    </span>
                                    <span class="text-danger">
                                        <b name='into_cash' id="into_cash" value="0">0</b>đ
                                    </span>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger btn-block">
                                        {{__('continue')}}
                                        <i class="bi bi-arrow-right">
                                        </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });

    function onClickRadioSelect(e) {
        e.checked = true;
        document.getElementById('cart_id').value = e.value;
        document.getElementById('form-select-cart').submit();
    }
    function incrementQuantity(button) {
            var input = button.previousElementSibling;
            var value = parseInt(input.value);
            input.value = value + 1;
            loadTotal();
    }

    function decrementQuantity(button) {
        var input = button.nextElementSibling;
        var value = parseInt(input.value);
        if (value > 0) {
            input.value = value - 1;
            loadTotal();
        }
    }
    

    function loadTotal(){
        const intoCash = document.getElementById('into_cash');
        const provisional = document.getElementById('provisional');
        const products = @json($products->map(fn($product) => ['id' => $product->id, 'price' => $product->price,'price_discount' => $product->price_discount]));
        var all = 0;
        products.forEach(e => {
            const total = document.getElementById(`total_${e.id}`);
            const quantity = document.getElementById(`quantity_${e.id}`).value;
            const price = e.price_discount ? e.price_discount : e.price;
            total.innerText = (quantity * price).toLocaleString('vi-VN');
            all += quantity * price;
        });
        intoCash.innerText = all.toLocaleString('vi-VN');
        provisional.innerText = all.toLocaleString('vi-VN');
    }
</script>
@endsection