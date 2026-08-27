@extends('layouts.app')

@section('title', 'Create New - Admin page')

@section('content')
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New - Admin page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('admin.admin.store') }}" method="POST">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title">Create New Admin</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

                             @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{$message}}
                                </span>   
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"  class="form-control @error('email') is-invalid @enderror">

                             @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{$message}}
                                </span>   
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                             @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{$message}}
                                </span>   
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span>
                            Save
                        </button>

                        <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">
                            <span class="fa fa-times-circle"></span> Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection