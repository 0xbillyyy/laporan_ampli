@extends('layouts.app')

@section("title", "View Link")

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Link</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Link</th>
                <th>Platform</th>
                <th>Context</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($links as $link)
                <tr>
                    <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                    <td>{{ $link->platform->name ?? '-' }}</td>
                    <td>{{ $link->context }}</td>
                    <td>{{ $link->created_at->format('d-m-Y') }}</td>
                    <td>
                        <form action="{{ route('links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada link tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
