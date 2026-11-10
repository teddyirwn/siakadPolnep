<div class="mb-3">
    <label for="mahsiswa_id">Nama Mahasiswa</label>
    <select name="mahasiswa_id" id="mahaisiswa_id" class="form-select @error('mahasiswa_id') is-invalid @enderror">
        <option value="">Pilih Mahasiswa</option>
        @foreach ($mahasiswa as $item)
            <option value="{{ $item->id }}"
                {{ old('mahasiswa_id', $krs->mahasiswa_id ?? '') == $item->id ? 'selected' : '' }}>{{ $item->nama }}
            </option>
        @endforeach
    </select>
    @error('mahasiswa_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



<div class="mb-3">
    <x-form-input name="tahun_akademik" label="Tahun Akademik" type="text" placeholder="Masukkan Tahun Akademik"
        :value="$krs->tahun_akademik ?? old('tahun_akademik')" />
</div>
<div class="mb-3">
    <label for="semester">Semester</label>
    <select name="semester" id="semester" class="form-select @error('semester') is-invalid @enderror">
        <option value="">Pilih Semester</option>
        <option value="Ganjil" {{ $krs->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
        <option value="Genap" {{ $krs->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
    </select>
    @error('semester')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
        <option value="">Pilih Status</option>
        <option value="draft" {{ $krs->status == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="diajukan" {{ $krs->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
        <option value="disetujui" {{ $krs->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
        <option value="ditolak" {{ $krs->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<div class="mb-3">
    <label for="mata_kuliah_id">Pilih Mata Kuliah</label>

    <div class="bg-light border p-3 rounded overflow-auto w-100 @error('mata_kuliah_id') is-invalid @enderror"
        style="max-height: 200px;">
        @php
            $selectMk = old('mata_kuliah_id', isset($krs) ? $krs->matakuliah->pluck('id')->toArray() : []);
        @endphp

        @foreach ($mataKuliah as $item)
            <div class="form-check">
                <input class="form-check-input " name="mata_kuliah_id[]" type="checkbox" value="{{ $item->id }}"
                    id="mk_{{ $item->id }}" {{ in_array($item->id, $selectMk) ? 'checked' : '' }}>
                <label class="form-check-label" for="mk_{{ $item->id }}">
                    {{ $item->nama_mk }} - {{ $item->sks }} SKS
                </label>
            </div>
        @endforeach
    </div>
    @error('mata_kuliah_id')
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
