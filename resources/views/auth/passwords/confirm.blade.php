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
                                <h3 class="font-weight-bolder text-danger text-gradient">Confirm Password</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('password.confirm') }}" role="form text-left">
                                    @csrf
                                    <div class="mb-3">
                                        <p>Before proceeding, please confirm your password</p>
                                    </div>

                                    <label class="text-danger text-gradient">Password</label>
                                    <div class="mb-3">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-danger w-100 my-4 mb-2">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-danger text-gradient" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </p>
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
