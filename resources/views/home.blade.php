@extends('layouts.master')

@section("warnahome", "active")

@section('content')
<div class="container">
    <div class="row">
    <div class="col-lg-4 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $success }}</h3>
                <p>ORDER COMPLETED</p>
            </div>
            <div class="icon">
                <i class="fa fa-check"></i>
            </div>
            <a href="{{ url('order', []) }}" class="small-box-footer">More info
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


    <div class="col-lg-4 col-6">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pending }}</h3>
                <p>ORDER PENDING</p>
            </div>
            <div class="icon">
                <i class="fa fa-clock"></i>
            </div>
            <a href="{{ url('order', []) }}" class="small-box-footer">More info
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-6">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $fail }}</h3>
                <p>ORDER FAIL</p>
            </div>
            <div class="icon">
                <i class="fa fa-times"></i>
            </div>
            <a href="{{ url('order', []) }}" class="small-box-footer">More info
                <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>
</div>
@endsection
