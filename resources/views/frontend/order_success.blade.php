
@extends('frontend.master')
@section('content')

<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
      @if (session('order_done'))
        <div class="col-md-8">
            <div class="card">
                <div class="text-left logo p-2 px-5"> <img src="" width="50"> </div>
                <div class="alert alert_success">
                    {{ (session('order_done')) }}
                    <a href="{{ route('customer.dashboard')}}">View Order</a>
                </div>
            </div>
        </div>
      @endif
    </div>
</div>


@endsection
