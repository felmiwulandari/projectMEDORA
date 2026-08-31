@extends('layouts.app')

@section('title', 'Profile page -GuestBook' )

@section('content')
    <div class="d-sm-felx align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile Page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-body">
                <h5 class="card-title">user profile</h5>

                <form action="{{route ('admin.profile.save') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name"   
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ $user->name }}">

                    @error('name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email"   
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ $user->email }}">

                    @error('email')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password"   
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="text" id="password_confirmation"   
                        class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection