@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width: 440px;">
    <h1>Pelanggan &amp; Member</h1>
    <h2>Silakan login</h2>

    @if (session('success'))
        <div class="alert-sukses">{{ session('success') }}</div>
    @endif

    <form action="{{ route('login.proses') }}" method="POST">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" autofocus>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Login</button>
    </form>
</div>
@endsection
