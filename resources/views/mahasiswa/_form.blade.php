<div class="mb-3">
    <x-form-input label="NIM" name="nim" :value="$mhs->nim ?? old('nim')" />
</div>
<div class="mb-3">
    <x-form-input label="Nama Lengkap" name="nama" :value="$mhs->nama ?? old('nama')" />
</div>
<div class="mb-3">
    <x-form-input label="Email" name="email" :value="$mhs->email ?? old('email')" />
</div>
<div class="mb-3">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" value="{{ $mhs->jenis_kelamin ?? old('jenis_kelamin') }}">
        <option value="L" {{ ( $mhs->jenis_kelamin ?? old('jenis_kelamin') ) === 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ ( $mhs->jenis_kelamin ?? old('jenis_kelamin') ) === 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>
<div class="mb-3">
    <x-form-input label="Angkatan" type="number" name="angkatan" :value="$mhs->angkatan ?? old('angkatan')" />
</div>
<div class="mb-3">
    <x-form-input label="Program Studi" name="program_studi" :value="$mhs->program_studi ?? old('program_studi')" />
</div>
