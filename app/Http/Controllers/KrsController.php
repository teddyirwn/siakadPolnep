<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index()
    {

        return view('krs.index');
    }

    public function data() : JsonResponse
    {
        $query = Krs::with('mahasiswa')->select([
            'krs.id',
            'krs.mahasiswa_id',
            'krs.tahun_akademik',
            'krs.semester',
            'krs.status',
        ]);

        return DataTables::eloquent($query)->addIndexColumn()->editColumn('status', function (Krs $krs) {
            $badgeColor = match ($krs->status) {
                'disetujui' => 'bg-success text-white',
                'diajukan'  => 'bg-warning text-dark',
                'ditolak'   => 'bg-danger text-white',
                default     => 'bg-secondary text-white',
            };
            return '<span class="badge ' . $badgeColor . '">' . ucfirst($krs->status) . '</span>';
        })->addColumn('aksi',function(Krs $krs){
            return view('krs._aksi',compact('krs'))->render();
        })->rawColumns(['status','aksi',])->toJson();
    }
    
    public function create():View
     {

        $krs = new Krs();
        $mahasiswa = Mahasiswa::orderBy('nama', 'asc')->get();
        $mataKuliah = MataKuliah::orderBy('nama_mk', 'asc')->get();
        return view('krs.create', compact('krs', 'mahasiswa', 'mataKuliah'));
    }

    public function store(Request $req):RedirectResponse
    {
        $data = $this->validated($req);
        // dd($req->all());

        $krs = Krs::create([
            'mahasiswa_id' => $data['mahasiswa_id'],
            'tahun_akademik' => $data['tahun_akademik'],
            'semester' => $data['semester'],
            'status' => $data['status'],
        ]);

        $krs->mataKuliah()->attach($data['mata_kuliah_id']);

        return redirect()->route('krs.index')->with('success', 'Data KRS '.$krs->mahasiswa->nama.' Berhasil Ditambahkan');
    }

    public function show(Krs $kr):View
    {
        if (!$kr) {
            abort(404);
        }
        return view('krs.show', compact('kr'));
    }

    public function edit(Krs $kr):View
    {
        $krs = $kr->load('mataKuliah');
        $mahasiswa = Mahasiswa::orderBy('nama', 'asc')->get();
        $mataKuliah = MataKuliah::orderBy('nama_mk', 'asc')->get();
        return view('krs.edit',compact('krs', 'mahasiswa','mataKuliah'));
    }

    public function update(Request $req, Krs $kr):RedirectResponse
    {
        $data = $this->validated($req, $kr);
        // dd($data);

        $kr->update([
            'mahasiswa_id' => $data['mahasiswa_id'],
            'tahun_akademik' => $data['tahun_akademik'],
            'semester' => $data['semester'],
            'status' => $data['status'],
        ]);

        $kr->mataKuliah()->sync($data['mata_kuliah_id']);

        return redirect()->route('krs.index')->with('success', 'Data KRS '.$kr->id.' Berhasil Diubah');
        
    }

    public function destroy(Krs $kr): JsonResponse
    {
        
        try {
            $kr->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data KRS '.$kr->mahasiswa->nama.' Tidak Dapat Dihapus Karena Memiliki Relasi Dengan Data Lain',
            ]);
        }

        return response()->json([
            'message' => 'Data KRS untuk'.$kr->mahasiswa->nama.' Berhasil Dihapus',
        ]);
    }



    private function validated(Request $req, ?Krs $kr = null): array
    {
        return $req->validate([
            'mahasiswa_id' => ['required','exists:mahasiswa,id',Rule::unique('krs','mahasiswa_id')->where(function ($query) use ($req) {
                return $query->where('tahun_akademik', $req->input('tahun_akademik'))
                             ->where('semester', $req->input('semester'));
            })->ignore($kr?->id) ],
            'mata_kuliah_id' => ['required','exists:mata_kuliah,id'],
            'tahun_akademik' => ['required','string','max:9'],
            'semester' => ['required','string','max:6',Rule::in(['Ganjil','Genap'])],
            'status' => ['required','string','max:10',Rule::in(['draft','diajukan','disetujui','ditolak'])],
        ],[
            'mahasiswa_id.required' => 'Mahasiswa harus diisi',
            'mahasiswa_id.exists' => 'Mahasiswa tidak ditemukan',
            'mahasiswa_id.unique' => 'Mahasiswa sudah memiliki KRS di tahun akademik dan semester ini',
            'tahun_akademik.required' => 'Tahun Akademik harus diisi',
            'tahun_akademik.max' => 'Tahun Akademik maksimal 9 karakter',
            'semester.required' => 'Semester harus diisi',
            'semester.max' => 'Semester maksimal 6 karakter',
            'semester.in' => 'Semester harus berupa Ganjil atau Genap',
            'status.required' => 'Status harus diisi',
            'status.max' => 'Status maksimal 10 karakter',
            'status.in' => 'Status harus berupa draft, diajukan, disetujui, atau ditolak',
            'mata_kuliah_id.required' => 'Mata Kuliah harus diisi',
            'mata_kuliah_id.exists' => 'Mata Kuliah tidak ditemukan',
        ]);
    }
}
