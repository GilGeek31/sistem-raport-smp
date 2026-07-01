<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use App\Models\Mapel;
use View;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapels = Mapel::orderBy('nama_mapel')->paginate(10);

        return view('mapel.index', compact('mapels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMapelRequest $request)
    {
        Mapel::create($request->validated());

        return redirect()->route('mapel.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mapel $mapel)
    {
        return view('mapel.show', compact('mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMapelRequest $request, Mapel $mapel)
    {
        $mapel->update($request->validated());

        return redirect()->route('mapel.index')
            ->with('success', 'Mata pelajaran berhasil diperbaruhi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $mapel->delete();

        return redirect()->route('mapel.index')
            ->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
