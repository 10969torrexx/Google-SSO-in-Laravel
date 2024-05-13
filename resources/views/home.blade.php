@extends('layouts.app')
@section('title', 'Home | Human Resources Mangement System')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="form-group">
                            <p>Name: {{ Auth::user()->name }}</p>
                            <p>Email: {{ Auth::user()->email }}</p>
                            <p>Department: {{ !empty($user[0]->department_name) ? $user[0]->department_name : 'Not yet assigned' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
