@extends('layouts.app')
@section("title", "View Monitoring")

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Monitoring Sosial Media</h1>
    
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
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Platform</th>
                            <th>Link</th>
                            <th>Content</th>
                            <th>Platform</th>
                            <th>Name</th>
                            @if(auth()->user()->role == "admin")
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monitorings as $index => $monitoring)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $monitoring->platform->name }}</td>
                                <td><a href="{{ $monitoring->link }}" target="_blank">{{ $monitoring->link }}</a></td>
                                <td>{{ $monitoring->content }}</td>
                                <td>{{ $monitoring->platform->name }}</td>
                                <td>{{ $monitoring->user->name ?? 'Tidak ada user' }}</td>
                                @if(auth()->user()->role == "admin")
                                <td>
                                    <form action="{{ route('monitoring.destroy', $monitoring->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus monitoring ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>
@endpush