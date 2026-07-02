<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Guru
        </h2>
    </x-slot>

    <div class="py12">
        <div class="max-w-2x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">
                            Nama Lengkap
                        </label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class=" mt-1 block w-full rounded border-gray-300">
                        @error('nama')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="mt-1 block w-full rounded border-gray-300">
                        @error('email')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">
                            NIP
                        </label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                            class="mt-1 block w-full rounded border-gray-300">
                        @error('nip')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">
                            NUPTK
                        </label>
                        <input type="text" name="nuptk" value="{{ old('nuptk') }}"
                            class="mt-1 block w-full rounded border-gray-300">
                        @error('nuptk')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">
                            No. HP
                        </label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                            class="mt-1 block w-full rounded border-gray-300">
                        @error('no_hp')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="mb-4 border-t pt-4">
                        <!-- <p class="text-sm texgra500 mb-3">
                            Kosongkan Password jika tidak ingin mengubahnya.
                        </p> -->
                        <div class="mb-4">
                            <label for="" class="block font-medium text-sm text-gray-700">
                                Password
                            </label>
                            <input type="password" name="password"
                                class="mt-1 block w-full rounded border-gray-300">
                            @error('password')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="block font-medium text-sm text-gray-700">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                class="mt-1 block w-full rounded border-gray-300">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="" class="block font-medium text-sm text-gray-700">
                            Foto Profil
                        </label>
                        <input type="file" name="foto_profil" accept="image/*"
                            class="mt-1 block w-full text-sm text-gray-500">
                        <p class="text-gray-400 text-xs mt-1">
                            Format: JPG, JPEG, PNG. Maks 2MB.
                        </p>
                        @error('foto_profil')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class=" bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="{{ route('guru.index') }}"
                            class="bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>