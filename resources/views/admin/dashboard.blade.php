@extends('layouts.main')

@section('content')

<h1 class="mb-4">Admin Dashboard</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card p-3">
            <h5>Total Users</h5>
            <p>{{ \App\Models\User::count() }}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <h5>Total Products</h5>
            <p>0</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3">
            <h5>Total Orders</h5>
            <p>0</p>
        </div>
    </div>
</div>

@endsection
