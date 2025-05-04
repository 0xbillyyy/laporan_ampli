@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Monitoring Sosial Media</h1>

    <div class="alert alert-success">
        Halaman ini otomatis save input anda
    </div>

    @foreach($links as $link)
    <div class="card mb-3">
        <div class="card-body">
            <p class="text-uppercase text-center">{{ $link->context }}</p>
            <hr style="margin-top: -10px; width: 100px; height: 1px;color:grey; background-color: grey;">
            <div class="row text-center mb-3">
                <div class="col">
                    <p class="text-uppercase" style="margin-top: -10px;">{{ $link->link }}</p>
                    <a class="text-uppercase" style="">[ {{ $link->link }} ]</a>
                </div>
            </div>

            <div class="row">
                @foreach($platforms as $platform)
                <div class="col">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <p class="text-uppercase text-center">{{ $platform->name }}</p>
                            <hr
                                style="margin-top: -10px; width: 100px; height: 1px;color:grey; background-color: grey;">
                            <label for="link"><strong>LINK REPOST</strong></label>

                            <input type="text" class="form-control autosave-input" placeholder="LINK REPOST..."
                                data-platform-id="{{ $platform->id }}" data-context="{{ $link->context }}"
                                data-monitoring-id="" data-identity="{{ $link->link }}"
                                value="{{ $monitorings_by_platform[$link->context][$platform->id]->link ?? '' }}">

                            <!-- <input type="text" class="form-control autosave-input" placeholder="LINK REPOST..."
                                data-platform-id="" data-context="{{ $link->context }}"
                                data-monitoring-id="" data-identity="{{ $link->link }}"
                                value="{{ $monitorings_by_platform[$link->context][$platform->id]->link ?? '' }}"> -->
                            <div class="invalid-feedback autosave-error">
                                Gagal menyimpan. Silakan coba lagi.
                            </div>

                            <!-- <input type="text" class="form-control autosave-input" placeholder="LINK REPOST..."
                                data-platform-id="{{ $platform->id }}" data-context="{{ $link->context }}"> -->
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    <!-- <form action="{{ route('monitoring.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="platform_id">Platform</label>
            <select class="form-control" name="platform_id" id="platform_id" required>
                <option value="">Pilih Platform</option>
                @foreach ($links as $link)
                <option value="{{ $link->id }}">{{ $link->link }}</option>
                @endforeach
            </select>
            @error('platform_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="user_id">User</label>
            <input type="text" class="form-control" name="user_id" id="user_id" value="{{ Auth::id() }}" readonly>
            @error('user_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="link">Link Monitoring</label>
            <input type="url" class="form-control" name="link" id="link" placeholder="Masukkan link monitoring"
                value="{{ old('link') }}" required>
            @error('link')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Konten</label>
            <textarea class="form-control" name="content" id="content" rows="3"
                placeholder="Masukkan konten">{{ old('content') }}</textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div> -->

    <!-- <div class="form-group">
            <label for="author">Penulis</label>
            <input type="text" class="form-control" name="author" id="author" placeholder="Masukkan nama penulis" value="{{ old('author') }}">
            @error('author')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="like">Likes</label>
                <input type="text" class="form-control" name="like" id="like" placeholder="Jumlah likes" value="{{ old('like') }}">
                @error('like')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="comment">Komentar</label>
                <input type="text" class="form-control" name="comment" id="comment" placeholder="Jumlah komentar" value="{{ old('comment') }}">
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="share">Shares</label>
                <input type="text" class="form-control" name="share" id="share" placeholder="Jumlah shares" value="{{ old('share') }}">
                @error('share')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="view">Views</label>
                <input type="text" class="form-control" name="view" id="view" placeholder="Jumlah views" value="{{ old('view') }}">
                @error('view')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div> -->

    <!-- <div class="form-group">
            <label for="published_at">Tanggal Terbit</label>
            <input type="date" class="form-control" name="published_at" id="published_at" value="{{ old('published_at') }}">
            @error('published_at')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div> -->

    <!-- <button type="submit" class="btn btn-primary">Simpan Monitoring</button>
    </form> -->
</div>
@endsection
@push('scripts')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.autosave-input').on('blur', function() {
    const platformId = $(this).data('platform-id');
    const context = $(this).data('context');
    const identity = $(this).data('identity');
    const link = $(this).val();
    const monitoringId = $(this).data('monitoring-id');
    // const platform = $(this).data('platform');

    if (!link) return;

    $.ajax({
        url: '/autosave-monitoring',
        method: monitoringId ? 'PUT' : 'POST',
        data: {
            platform_id: platformId,
            link: link,
            context: context,
            monitoring_id: monitoringId,
            identity: identity,
            // platformId: platformId
        },
        success: function(response) {
            console.log("Berhasil simpan:", response);
            if (response.id) {
                // Tambahkan id ke input supaya update di klik selanjutnya
                $(`[data-platform-id="${platformId}"][data-context="${context}"]`)
                    .attr('data-monitoring-id', response.id);
            }
        },
        error: function(xhr) {
            console.error("Gagal simpan:", xhr.responseText);
        }
    });
});
</script>
@endpush