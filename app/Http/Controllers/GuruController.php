<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreGuruRequest;
use App\Http\Requests\UpdateGuruRequest;
//use App\Http\Requests\UpdateGuruRequest as RequestsUpdateGuruRequest;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::with('user')->orderBy('nama')->paginate(10);

        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuruRequest $request)
    {
        //Handle upload foto profil
        $fotoProfil = null;
        if ($request->hasFile('foto_profil')) {
            $fotoProfil = $request->file('foto_profil')->store('profil', 'public');
        }

        //Buat akun user (untuk login)
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto_profil' => $fotoProfil,
        ]);

        //Assign role guru
        $user->assignRole('guru');

        //buat data guru, hubungkan ke user
        Guru::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'nuptk' => $request->nuptk,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guru $guru)
    {
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        //handle upload foto profil baru(jika ada)
        $fotoProfil = $guru->user?->foto_profil;
        if ($request->hasFile('foto_profil')) {
            //hapus foto lama (jika ada)
            if ($fotoProfil) {
                Storage::disk('public')->delete($fotoProfil);
            }

            $fotoProfil = $request->file('foto_profil')->store('profil', 'public');
        }

        //update akun user
        $dataUser = [
            'name' => $request->nama,
            'email' => $request->email,
            'foto_profil' => $fotoProfil,
        ];


        //update data password(jika diisi)
        if ($request->filled('password')) {
            $dataUser['password'] = Hash::make($request->password);
        }

        // simpan data foto profil & akun user
        if ($guru->user) {
            $guru->user->update($dataUser);
        } else {
            $dataUser['password'] = Hash::make($request->password ?? 'password');
            $user = User::create($dataUser);
            $user->assignRole('guru');
            $guru->update(['user_id' => $user->id]);
        }

        // update data guru
        $guru->update([
            'nama'  => $request->nama,
            'email' => $request->email,
            'nip'   => $request->nip,
            'nuptk' => $request->nuptk,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil diperbaruhi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        //hapus foto profil (jika ada)
        if ($guru->user && $guru->user->foto_profil) {
            Storage::disk('public')->delete($guru->user->foto_profil);
        }

        // hapus user (cascade akan handle data guru via foreign key )
        $guru->user->delete();

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }
}
