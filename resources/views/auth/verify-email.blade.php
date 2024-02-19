<x-guest-layout>
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

                                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                                {{ __('If you did not receive the email') }},
                                                <form class="d-inline" method="GET"
                                                    action="{{ route('verification-notice') }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
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
</x-guest-layout>
