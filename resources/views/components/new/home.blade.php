
@extends("layouts.app")

@section("title", "dashboard")

@section("content")
<div class="d-sm-flex align-items-center justify-content-between mb-4 container-fluid">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->

</div>
<div class="container-fluid">
    @if(auth()->user()->role == "admin")
    <form action="{{ route('reset.tables') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua data?')">
        @csrf
        <button type="submit" class="btn btn-danger btn btn-danger col-md-12">Reset Semua Tabel</button>
    </form>    
    @endif
</div>
@endsection