@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah User Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        
        <!-- Nama -->
        <div class="form-group mb-3">
            <label>Nama:</label>
            <input type="text" 
                   name="name" 
                   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                   value="{{ old('name') }}" 
                   placeholder="Masukkan Nama">
            @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label>Email:</label>
            <input type="email" 
                   name="email" 
                   class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                   value="{{ old('email') }}" 
                   placeholder="Masukkan Email">
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <!-- Password -->
        <div class="form-group mb-3">
            <label>Password:</label>
            <input type="password" 
                   name="password" 
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                   placeholder="Masukkan Password">
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group mb-3">
            <label>Konfirmasi Password:</label>
            <input type="password" 
                   name="password_confirmation" 
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" 
                   placeholder="Konfirmasi Password">
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <!-- Role -->
        <div class="form-group mb-3">
            <label>Role:</label>
            <select name="role" class="form-control {{ $errors->has('role') ? 'is-invalid' : '' }}">
                <option value="" selected disabled>Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @if($errors->has('role'))
                <div class="invalid-feedback">
                    {{ $errors->first('role') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-3">Tambah User</button>
    </form>
</div>
@endsection
