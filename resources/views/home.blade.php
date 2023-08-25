@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Home') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (Auth::user() && !Auth::user()->verified)
                            <div class="alert alert-warning" role="alert">
                                Your account is not verified yet. Please check your email for the verification link.
                            </div>
                            <form method="POST" action="{{ route('verify.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    Resend Verification Link
                                </button>
                            </form>
                        @endif

                        @if (Auth::user())
                            <p>Welcome, {{ Auth::user()->name }}!</p>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    Logout
                                </button>
                            </form>
                        @else
                            <p>You need to <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to access this page.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
