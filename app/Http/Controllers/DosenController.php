<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    public function index() : View {
       
        return view('dosen.index');
    }

    public function data() : JsonResponse
    {
        $query = Dosen::query()->select(['id', 'nidn', 'nama', 'jabatan_fungsional', 'email', 'telpon', 'alamat']);

        return DataTables::eloquent($query)->addIndexColumn()->addColumn('aksi',function(Dosen $dosen){
            return view('dosen._aksi', compact('dosen'))->render();
        })->rawColumns(['aksi'])->toJson();
    }

    public function create():View
    {
        return view('dosen.create',[
            'dosen' => new Dosen()
        ]);
    }

    public function store(Request $request):RedirectResponse
    {
        $dosen = Dosen::create($this->validated($request));

        return redirect()->route('dosen.index')->with('success', 'Data Dosen'.$dosen->nama.'Berhasil Ditambahkan');

    }
    public function show(Dosen $dosen):View
    {
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen){
        return view('dosen.edit',compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen):RedirectResponse
    {
        $dosen->update($this->validated($request,$dosen));

        return redirect()->route('dosen.index')->with('success', 'Data Dosen '.$dosen->nama.' Berhasil diperbarui');
    }

    public function destroy(Dosen $dosen) : JsonResponse
    {
       try {
        $dosen->delete();
       } catch (QueryException $e) {
        return response()->json([
            'message' => 'data dosen tidak dapat di hapus: Masih dipakai di data lain'
        ],409);
       }

       return response()->json([
        'message' => 'Data Dosen'.$dosen->nama.'Berhasil dihapus'
       ]);

    }

    // aturan validasi bersama untuk store dan update
    private function validated(Request $request, ?Dosen $dosen = null):array
    {
        return $request->validate([
            'nidn' => ['required','string','max:20', Rule::unique(Dosen::class, 'nidn')->ignore($dosen?->id )],
            'nama' => ['required','string','max:120'],
            'jabatan_fungsional' => ['required','string','max:50',Rule::in(['Asisten Ahli','Lektor','Lektor Kepala','Guru Besar'])],
            'email' => ['required','email','max:255', Rule::unique(Dosen::class, 'email')->ignore($dosen?->id )],
            'telpon' => ['nullable','string','max:20'],
            'alamat' => ['nullable','string','max:255']
        ],[
            'nidn.required' => 'NIDN wajib diisi',
            'nidn.unique' => 'NIDN sudah digunakan',
            'nama.required' => 'Nama wajib diisi',
            'jabatan_fungsional.required' => 'Jabatan fungsional wajib diisi',
            'jabatan_fungsional.in' => 'Jabatan fungsional tidak valid',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
        ]);
    }
}