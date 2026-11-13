<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:pelanggans,email',
            'telepon'      => 'required|string|max:20',
            'level_member' => ['required', Rule::in(Pelanggan::LEVEL)],
            'alamat'       => 'required|string|max:255',
        ]);

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama'         => 'required|string|max:255',
            'email'        => ['required', 'email', 'max:255', Rule::unique('pelanggans', 'email')->ignore($pelanggan->id)],
            'telepon'      => 'required|string|max:20',
            'level_member' => ['required', Rule::in(Pelanggan::LEVEL)],
            'alamat'       => 'required|string|max:255',
        ]);

        $pelanggan->update($data);

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus!');
    }
}