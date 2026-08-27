@extends('layouts.app')


@section('title', 'Create New - Schedule Page')

@section('content')
    <div class="d-sm-felx align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New - Schedule Page</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="{{ route('pages.schedule.store') }}" method="POST">
                    @csrf

                    <div class="card-header">
                        <h5 class="card-title">Create New Schedule</h5>
                    </div>

                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror">

                            @error('tanggal')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="jam_mulai" class="form-label">Jam Mulai</label>
                            <input type="text" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" class="form-control @error('jam_mulai') is-invalid @enderror">

                            @error('jam_mulai')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="jam_selesai" class="form-label">Jam Selesai</label>
                            <input type="text" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}" class="form-control @error('jam_selesai') is-invalid @enderror">

                            @error('jam_selesai')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="kuota" class="form-label">Kuota</label>
                            <input type="text" name="kuota" id="kuota" value="{{ old('kuota') }}" class="form-control @error('kuota') is-invalid @enderror">

                            @error('kuota')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" name="status" id="status" value="{{ old('status') }}" class="form-control @error('status') is-invalid @enderror">

                            @error('status')
                                <div class="invalid-feedback d-block">
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <span class="fa fa-save"></span> Save
                        </button>

                        <a href="{{ route('pages.schedule.index') }}" class="btn btn-secondary">
                            <span class="fa fa-times-circle"></span> Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection