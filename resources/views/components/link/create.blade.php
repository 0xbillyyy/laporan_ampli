@extends('layouts.app') <!-- Sesuaikan layout kamu -->
@section("title", "Create Link")

@section('content')
<div class="container-fluid">
    <h1>Tambah Link Baru</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Monitoring List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('link.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="id_platform">Pilih Platform</label>
                        <select name="id_platform" id="id_platform" class="form-control" required>
                            <option value="">-- Pilih Platform --</option>
                            @foreach($platforms as $platform)
                                <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="link">Link</label>
                        <input type="url" name="link" id="link" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="context">Title</label>
                        <textarea name="context" id="context" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
