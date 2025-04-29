@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Platform</h1>
    
    <a href="{{ route('platform.create') }}" class="btn btn-primary mb-3">Tambah Platform</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($platforms as $platform)
            <tr>
                <td>{{ $platform->id }}</td>
                <td>{{ $platform->name }}</td>
                <td>{{ $platform->description }}</td>
                <td>
                    <!-- Button Delete -->
                    <form action="{{ route('platform.destroy', $platform->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus platform ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
