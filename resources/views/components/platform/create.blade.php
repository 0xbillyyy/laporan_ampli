@extends('layouts.app')
@section("title", "Create Platform")

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Platform</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Monitoring List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">    
                <form action="{{ route('platform.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Platform Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama platform" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Masukkan deskripsi platform">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Platform</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
