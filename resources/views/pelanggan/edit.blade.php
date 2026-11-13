@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="card">
    <h1>Pelanggan &amp; Member</h1>
    <h2>Form Edit Pelanggan</h2>

    <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
        @csrf
        @method('PUT')

        @include('pelanggan._form')

        <button type="submit">Simpan Perubahan</button>
    </form>

    <p class="link-tengah">
        <a href="{{ route('pelanggan.index') }}">Kembali ke Data Pelanggan</a>
    </p>
</div>
@endsection