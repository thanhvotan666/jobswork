@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('product list'))
@section('content')
    <main>
        <section>
            <div class="container-fluid d-flex flex-column gap-4 ">
                <div class="p-5 d-flex flex-column gap-4">
                    <div class="d-flex justify-content-between">
                        <div class="h2 fw-bold ">
                            {{ __('product list') }}
                        </div>
                        <a href="{{ route('admin.product.create') }}" class="h2 fw-bold btn btn-success px-3">
                            {{ __('add') }}
                        </a>
                    </div>
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
                                <th scope="col" class="text-center">
                                    {{__('action')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="small">
                                    <th scope="row" class="text-center">
                                        @if ($product->image)
                                            <img src="{{ asset($product->image) }}" alt="Product Image"
                                                class="rounded-circle" style="width: 30px; height: 30px;">
                                        @else
                                            <i class="bi bi-boxes" style="font-size: 20px;"></i>
                                        @endif
                                    </th>
                                    <td style="max-width:300px;">
                                        {{ $product->name}}
                                    </td>
                                    <td class="text-secondary @if($product->price_discount) text-decoration-line-through @endif">
                                        {{ $product->getNumber($product->price) }} ₫
                                    </td>
                                    <td class="text-primary">
                                        @if ($product->price_discount)
                                            <b>{{ $product->getNumber($product->price_discount) }}</b> ₫
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ $product->getNumber($product->quantity) }}
                                    </td>

                                    <td class="text-end">
                                        <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                            aria-expanded="false"></i>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.product.edit', $product->id) }}">
                                                    {{ __('edit') }}
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('admin.product.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ __('are you sure you want to delete this product?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item text-danger">{{ __('remove') }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>                  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
@endsection