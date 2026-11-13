@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
<div class="card" style="max-width: 520px; text-align:center;">
    <h1>403</h1>
    <h2>Akses ditolak</h2>
    <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk melakukan tindakan ini.' }}</p>
    <p class="link-tengah"><a href="{{ route('pelanggan.index') }}">Kembali ke Data Pelanggan</a></p>
</div>
@endsection
