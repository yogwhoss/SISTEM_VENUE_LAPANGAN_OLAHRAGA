@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="card">
    <h2 class="judul-tabel">Data Pelanggan</h2>

    @if (session('success'))
        <div class="alert-sukses">{{ session('success') }}</div>
    @endif

    @can('kelola-pelanggan')
        <p style="text-align:center; margin: 0 0 20px;">
            <a href="{{ route('pelanggan.create') }}">+ Tambah Pelanggan</a>
        </p>
    @endcan

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Level Member</th>
                    <th>Alamat</th>
                    @can('kelola-pelanggan')
                        <th>Aksi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggans as $pelanggan)
                    <tr>
                        <td>{{ $pelanggan->nama }}</td>
                        <td>{{ $pelanggan->email }}</td>
                        <td>{{ $pelanggan->telepon }}</td>
                        <td>{{ $pelanggan->level_member }}</td>
                        <td>{{ $pelanggan->alamat }}</td>
                        @can('kelola-pelanggan')
                            <td class="aksi">
                                <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn-edit">Edit</a>
                                @can('hapus-pelanggan')
                                    <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" class="form-hapus"
                                          onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                @endcan
                            </td>
                        @endcan
                    </tr>
                @empty
                    <tr><td colspan="{{ auth()->user()->can('kelola-pelanggan') ? 6 : 5 }}">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection