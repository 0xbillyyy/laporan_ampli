@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar User</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th width="200px">Nama</th>
                <th width="200px">Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if(auth()->user()->id !== $user->id) <!-- Cegah delete diri sendiri -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    Delete
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled>Tidak bisa hapus diri sendiri</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
