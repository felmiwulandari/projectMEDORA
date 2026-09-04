@extends('layouts.auth')

@section('content')

<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-lg-5 col-md-9">
            <div class="card o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">FORM LOGIN</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf 

                                    <div class="form-group">
                                        <label for="email" class="font-weight-bold">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control form-control-user rounded shadow-sm @error('email') is-invalid @enderror"
                                            style="border-width: 2px;" value="{{ old('email') }}" placeholder="Enter Your Email Address...">

                                        @error('email')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="font-weight-bold">Password</label>
                                        <input type="password" name="password" id="password" 
                                            class="form-control form-control-user rounded shadow-sm @error('password') is-invalid @enderror" 
                                            style="border-width: 2px;" value="{{ old('password') }}" placeholder="Enter Your Password...">

                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block rounded shadow-sm" style="border-width: 2px;">
                                        LOGIN
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
@endsection
