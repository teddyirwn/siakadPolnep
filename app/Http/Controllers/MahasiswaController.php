<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        return view('mahasiswa.index');


    }
    public function data(): JsonResponse
    {
        $query = Mahasiswa::query()->select([
            'id','nim','nama','jenis_kelamin','angkatan','email','program_studi'
        ]);

        return DataTables::eloquent($query)->addIndexColumn()->addColumn('aksi',function(Mahasiswa $mhs){
            return view('mahasiswa._aksi',compact('mhs'))->render();
        })->rawColumns(['aksi'])->toJson();
    }

    public function create():View {
        return view('mahasiswa.create',[
            'mhs' => new Mahasiswa()
        ]);
    }

    public function store(Request $req): RedirectResponse
    {
        $mhs = Mahasiswa::create($this->validated($req));

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa '.$mhs->nama.' Berhasil Ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa): View{
       
        if (!$mahasiswa) {
            abort(404);
        }
        return view('mahasiswa.show', [
            'mhs' => $mahasiswa
        ]);
    }

    public function edit(Mahasiswa $mahasiswa):View
    {
        return view('mahasiswa.edit',[
            'mhs' => $mahasiswa
        ]);
    }

    public function update(Request $req, Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->update($this->validated($req,$mahasiswa));

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa '.$mahasiswa->nama.' Berhasil diperbarui');   
    }

    public function destroy(Mahasiswa $mahasiswa):JsonResponse
    {
        try {
            $mahasiswa->delete();
        } catch (QueryExecuted $e) {
            return response()->json([
                'message' => 'Data Mahasiswa '.$mahasiswa->nama.' Tidak dapat dihapus karena memiliki relasi dengan data lain',
            ]);
        }

        return response()->json([
            'message' => 'Data Mahasiswa '.$mahasiswa->nama.' Berhasil dihapus',
        ]);
    }

    public function exportPdf()
    {
        $mahasiswa = Mahasiswa::all();
        $pdf = Pdf::loadView('mahasiswa.pdf', compact('mahasiswa'))->setPaper('a4', 'portrait');
        return $pdf->download('laporan-mahasiswa.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport,'data-mahasiswa.xlsx');
    }

    private function validated(Request  $req, ?Mahasiswa $mhs= null):array
    {
        return $req->validate([
            'nim' => ['required','string','max:15',Rule::unique(Mahasiswa::class,'nim')->ignore($mhs?->id)],
            'nama' => ['required','string','max:100',],
            'jenis_kelamin' => ['required','string',Rule::in(['L','P']),],
            'angkatan' => ['required','integer','min:2000','max:2099',],
            'email' => ['required','string','email','max:100', Rule::unique(Mahasiswa::class,'email')->ignore($mhs?->id)],
            'program_studi' => ['required','string','max:100',],
        ],[
            'nim.required'=>'NIM Wajib diisi',
            'nim.unique'=>'NIM sudah ada',
            'nama.required'=>'Nama Wajib diisi',
            'jenis_kelamin.required'=>'Jenis Kelamin Wajib diisi',
            'angkatan.required'=>'Angkatan Wajib diisi',
            'angkatan.integer'=>'Angkatan harus berupa angka',
            'angkatan.min'=>'Angkatan minimal 2000',
            'angkatan.max'=>'Angkatan maksimal 2099',
            'email.required'=>'Email Wajib diisi',
            'email.email'=>'Email harus berupa email',
            'email.unique'=>'Email sudah ada',
            'program_studi.required'=>'Program Studi Wajib diisi',
        ]);
    }
}
