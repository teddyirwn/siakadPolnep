<div class="mb-3">
    <x-form-input name="kode_mk" label="Kode Matakuliah" :value="$mk->kode_mk ?? old('kode_mk')" />
</div>
<div class="mb-3">
    <x-form-input name="nama_mk" label="Nama Matakuliah" :value="$mk->nama_mk ?? old('nama_mk')" />
</div>
<div class="mb-3">
    <x-form-input name="sks" label="SKS" type="number" :value="$mk->sks ?? old('sks')" />
</div>