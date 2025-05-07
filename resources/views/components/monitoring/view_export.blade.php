@extends('layouts.app')
@section("title", "Export Monitoring")


@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Platform</h1>
    
    <div class="row">
        @foreach($links as $link)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <strong>{{ $link->link }}</strong>
                    <hr>
                    {{ $link->context }}
                    <a href="{{ route('convert.docx', ['id' => $link->id]) }}" class="col-md-12 btn btn-danger mt-3">Export</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection