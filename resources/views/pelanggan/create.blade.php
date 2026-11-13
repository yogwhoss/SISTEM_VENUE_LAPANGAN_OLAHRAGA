@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="card">
    <h1>Pelanggan &amp; Member</h1>
    <h2>Form Tambah Pelanggan</h2>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        @include('pelanggan._form')

        <button type="submit">Tambah Pelanggan</button>
    </form>

    <p class="link-tengah">
        <a href="{{ route('pelanggan.index') }}">Lihat Data Pelanggan</a>
    </p>
</div>
@endsection