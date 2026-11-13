@php $pelanggan = $pelanggan ?? null; @endphp

<div class="field">
    <label for="nama">Nama Lengkap</label>
    <input type="text" id="nama" name="nama" value="{{ old('nama', $pelanggan?->nama) }}">
    @error('nama') <span class="error">{{ $message }}</span> @enderror
</div>

<div class="field">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $pelanggan?->email) }}">
    @error('email') <span class="error">{{ $message }}</span> @enderror
</div>

<div class="row">
    <div class="field">
        <label for="telepon">Nomor Telepon</label>
        <input type="tel" id="telepon" name="telepon" value="{{ old('telepon', $pelanggan?->telepon) }}">
        @error('telepon') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="field">
        <label for="level">Level Member</label>
        <select id="level" name="level_member">
            <option value="">Pilih...</option>
            @foreach (\App\Models\Pelanggan::LEVEL as $lv)
                <option value="{{ $lv }}" @selected(old('level_member', $pelanggan?->level_member) === $lv)>{{ $lv }}</option>
            @endforeach
        </select>
        @error('level_member') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>

<div class="field">
    <label for="alamat">Alamat</label>
    <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $pelanggan?->alamat) }}">
    @error('alamat') <span class="error">{{ $message }}</span> @enderror
</div>