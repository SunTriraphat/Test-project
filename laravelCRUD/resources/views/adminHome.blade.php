@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div>
                <a href="{{ route('jobs.index') }}" class="btn btn-success">Jobs </a>
                <a href="{{ route('addresses.index') }}" class="btn btn-success">Address </a>
                <a href="{{ route('userProfile.index') }}" class="btn btn-success">User </a>
            </div>
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    you are admin.
                </div>
                
            </div> --}}
        </div>
    </div>
</div>
@endsection
