<div class="btn-group btn-group-sm" role="group">
    <a href="{{route('mahasiswa.show',$mhs)}}" class="btn btn-outline-info"
        title="Detail" aria-label="Detail {{$mhs->nama}}">
        <i class="bi bi-eye"></i> 


    </a>
    @if (Auth::user()->role === "admin")

        <a href="{{route('mahasiswa.edit',$mhs)}}" class="btn btn-outline-warning"
            title="Ubah" aria-label="Ubah {{$mhs->nama}}">
            <i class="bi bi-pencil-square"></i>
        </a>
        <button type="button" class="btn btn-outline-danger btn-hapus"
            data-url="{{route('mahasiswa.destroy',$mhs,false)}}"
            $data-nama="{{$mhs->nama}}"
            title="Hapus" aria-label="Hapus {{$mhs->nama}}">
            <i class="bi bi-trash"></i>
        </button>
    @endif
    
</div>