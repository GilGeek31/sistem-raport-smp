<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
            Tambah Tahun Ajaran
        </h2>
    </x-slot>

    <div class=" py-12">
        <div class=" max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('tahun-ajaran.store') }}" method="POST">
                    @csrf

                    <div class=" mb-4">
                        <label class=" block font-medium text-sm text-gray-700">
                            Tahun Ajaran
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            placeholder="contoh: 2025/2026" class=" mt-1 block w-full rounded border-gray-300">
                        @error('nama')
                        <p class=" text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class=" block font-medium text-sm to-gray-700">
                            Semester
                        </label>
                        <select name="semester" class=" mt-1 block w-full rounded border-gray-300">
                            <option value="">-- Pilih Semester --</option>
                            <option value="ganjil" {{ old('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="genap" {{ old('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('semester')
                        <p class=" to-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="" class=" flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="status_aktif" value="1"
                                {{ old('status_aktif') ? 'checked' : '' }}
                                class=" rounded border-gray-300">
                            <span class=" text-sm to-gray-700">
                                Jadikan tahun ajaran aktif
                            </span>
                        </label>
                        <p class=" text-xs to-gray-400 mt-1">
                            Mencentang ini otomatis akan menonaktifkan tahun ajaran lain
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class=" bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('tahun-ajaran.index') }}"
                            class=" bg-gray-200 to-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>