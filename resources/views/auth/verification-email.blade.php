<!-- verify-email.blade.php -->

@extends('layouts.guest')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <x-guest.sidenav-guest />
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                                            <div class="card-body">
                                                @if (session('resent'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                                    </div>
                                                @endif

                                                <p>{{ __('Your email address is not verified yet. Please check your email and click the verification link to verify your account.') }}
                                                </p>

                                                <!-- Add login button -->
                                                <form method="GET" action="{{ route('sign-in') }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('sign-in') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
