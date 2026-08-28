@extends('layouts.app')

@section('title', 'Update Admin')

@section('content')
    <div class="container py-4">
       <h1 class="page-title mb-3">Update Admin!</h1>

       <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.admin.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                   

                    <div class="form-group mb-2">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('name') ?? $user->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name">

                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                {{$message}}
                            </span>   
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="text" value="{{ old('email') ?? $user->email  }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email">

                        @error('email')
                            <span class="invalid-feedback d-block" role="alert">
                                {{$message}}
                            </span>   
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="form-group mb-2">
                        <label for="password_confirmation" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    
<br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.admin.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
       </div>

       
    </div>
@endsection