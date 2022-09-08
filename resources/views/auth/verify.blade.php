@extends('layouts.user-auth')

@section('content')

    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <!-- Register Form -->
                    <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                        <div class="card mt-12">
                            <div class="card-header text-start pt-4 ms-1">
                                <h3 class="font-weight-bolder text-dark text-gradient">
                                    Check Your Inbox
                                    <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16   ">
                                        <title>letter</title>
                                        <g fill="#212121">
                                            <path d="M14,1H2A2,2,0,0,0,0,3v.4L8,7.9l8-4.4V3A2,2,0,0,0,14,1Z"></path>
                                            <path d="M7.5,9.9,0,5.7V13a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V5.7L8.5,9.9A1.243,1.243,0,0,1,7.5,9.9Z" fill="#212121"></path>
                                        </g>
                                    </svg>
                                </h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('verification.resend') }}" role="form text-left">
                                    @csrf
                                    <div class="mb-3">
                                        @if (session('resent'))
                                            <p>A Verification Link has been Sent On To Your Email</p>
                                        @endif
                                        <p>Before proceeding, please check your email for a verification link.</p>
                                        <p>If you didn't Receive any Email!</p>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" @if(session('resent')) hidden @endif class="btn bg-gradient-dark w-100 my-4 mb-2">Request Another</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <p class="text-secondary text-center pt-5">
                            Copyright © <script>
                                document.write(new Date().getFullYear())
                            </script> Dash UI - Laravel Starter
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                            <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n9" style="background-image:url('{{ asset('assets/img/curved-images/curved45.jpg') }}')"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Verify Your Email Address') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('resent'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ __('A fresh verification link has been sent to your email address.') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('Before proceeding, please check your email for a verification link.') }}--}}
{{--                    {{ __('If you did not receive the email') }},--}}
{{--                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">--}}
{{--                        @csrf--}}
{{--                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
