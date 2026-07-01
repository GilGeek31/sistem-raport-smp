<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-800 leading-tight">
            Tambah Mata Pelajaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('mapel.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kode Mapel</label>
                        <input type="text" name="kode_mapel" value="{{ old('kode_mapel') }}"
                            class="mt-1 block w-full rounded border gray-300">
                        @error('kode_mapel')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">Nama Mapel</label>
                        <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}"
                            class="mt-1 block w-full rounded border-gray-300">
                        @error('nama_mapel')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">Kategori</label>
                        <select name="kategori" class="mt-1 block w-full rounded border-gray-300">
                            <option value="umum {{ old('kategori') == 'umum' ? 'selected' : '' }}">Umum</option>
                            <option value="peminatan {{ old('kategori') == 'peminatan' ? 'selected' : '' }}">Peminatan</option>
                            <option value="mulok {{ old('kategori') == 'mulok' ? 'selected' : '' }}">Mulok</option>
                        </select>
                        @error('kategori')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('mapel.index') }}"
                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>