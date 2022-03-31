@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <router-view user="{{ auth()->user() }}" is_admin="{{auth()->user()->hasRole('admin')}}"></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
