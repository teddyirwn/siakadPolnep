<?php

namespace App\Http\Controllers;

use App\Exports\MataKuliahExport;
use App\Models\MataKuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index()
    {
        return view('matakuliah.index');
    }

    public function data():JsonResponse
     {
        $query = MataKuliah::query()->select([
            'id','kode_mk','nama_mk','sks'
        ]);

        return DataTables::eloquent($query)->addIndexColumn()->addColumn('aksi',function(MataKuliah $mk){
            return view('matakuliah._aksi',compact('mk'))->render();
        })->rawColumns(['aksi'])->toJson();
        
    }

    public function create():View {

        return view('matakuliah.create',[
            'matakuliah' => new MataKuliah()
        ]);
    }

    public function store(Request $req):RedirectResponse
    {
        $mk = MataKuliah::create($this->validated($req));

        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah '.$mk->nama_mk.' Berhasil Ditambahkan');
    }

    public function show(MataKuliah $matakuliah):View
    {
        if (!$matakuliah) {
            abort(404);
        }
        return view('matakuliah.show', [
            'mk' => $matakuliah
        ]);
    }

    public function edit(MataKuliah $matakuliah):View
    {
        return view('matakuliah.edit',[
            'mk' => $matakuliah
        ]);
    }

    public function update(Request $req, MataKuliah $matakuliah):RedirectResponse
    {
        $matakuliah->update($this->validated($req,$matakuliah));

        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah '.$matakuliah->nama_mk.' Berhasil Diubah');
    }

    public function destroy(MataKuliah $matakuliah) :JsonResponse
    {
        try {
            $matakuliah->delete();
           
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data Mata Kuliah '.$matakuliah->nama_mk.' Gagal Dihapus'
            ]);
        }
         return response()->json([
                'message' => 'Data Mata Kuliah '.$matakuliah->nama_mk.' Berhasil Dihapus'
            ]);
        
    }

    public function exportExcel()
    {
        return Excel::download(new MataKuliahExport, 'data_mata_kuliah.xlsx');
    }
    public function exportPdf()
    {
        $matakuliah = MataKuliah::all();
        $pdf = Pdf::loadView('matakuliah.pdf', compact('matakuliah'))->setPaper('a4', 'portrait');
        return $pdf->download('laporan-mata-kuliah.pdf');
    }

    public function validated(Request $req, ?MataKuliah $matakuliah = null): array
    {
       return $req->validate([
        'kode_mk'=>['required','string','max:10',Rule::unique(MataKuliah::class,'kode_mk')->ignore($matakuliah?->id)],
        'nama_mk'=>['required','string','max:100'],
        'sks'=>['required','integer','min:1','max:6']
       ],[
        'kode_mk.required' => 'Kode Mata Kuliah Wajib Diisi',
        'kode_mk.unique' => 'Kode Mata Kuliah Sudah Digunakan',
        'nama_mk.required' => 'Nama Mata Kuliah Wajib Diisi',
        'sks.required' => 'SKS Mata Kuliah Wajib Diisi',
        'sks.integer' => 'SKS Mata Kuliah Harus Berupa Angka',
        'sks.min' => 'SKS Mata Kuliah Minimal 1',
        'sks.max' => 'SKS Mata Kuliah Maksimal 6',
       ]);
    }
}


