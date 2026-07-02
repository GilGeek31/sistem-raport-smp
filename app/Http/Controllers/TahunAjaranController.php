<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTahunAjaranRequest;
use App\Http\Requests\UpdateTahunAjaranRequest;
use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjarans = TahunAjaran::orderBy('nama')->orderBy('semester')->paginate(10);

        return view('tahun-ajaran.index', compact('tahunAjarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahun-ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTahunAjaranRequest $request)
    {
        //jika status_aktif dicentang, nonaktifkan tahun ajaran lain
        if ($request->boolean('status_aktif')) {
            TahunAjaran::query()->update(['status_aktif' => false]);
        }

        TahunAjaran::create([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Tahun Ajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TahunAjaran $tahunajaran)
    {
        return view('tahun-ajaran.show', compact('tahunAjaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TahunAjaran $tahunAjaran)
    {
        return view('tahun-ajaran.edit', compact('tahunAjaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTahunAjaranRequest $request, TahunAjaran $tahunAjaran)
    {
        //nonaktifkan tahun ajaran lain selain yang diupdate
        if ($request->boolean('status_aktif')) {
            TahunAjaran::query()->update(['status_aktif' => false]);
        }

        $tahunAjaran->update([
            'nama' => $request->nama,
            'semester' => $request->semester,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Tahun Ajaran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjaran $tahunAjaran)
    {
        //cegah hapus tahun ajaran yang aktif
        if ($tahunAjaran->status_aktif) {
            return redirect()->route('tahun-ajaran.index')
                ->with('error', 'Tidak Bisa Menghapus tahun ajaran yang sedang aktif');
        }

        $tahunAjaran->delete();

        return redirect()->route('tahun-ajaran.index')
            ->with('success', 'Tahun Ajaran Berhasil di Hapus.');
    }
}
