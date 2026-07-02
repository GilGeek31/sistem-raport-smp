<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Guru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('guru.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Guru
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-3">Foto</th>
                            <th class="py-2 px-3">Nama</th>
                            <th class="py-2 px-3">Email</th>
                            <th class="py-2 px-3">NIP</th>
                            <th class="py-2 px-3">NUPTK</th>
                            <th class="py-2 px-3">No.Hp</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gurus as $guru)
                        <tr class="border-b">
                            <td class="py-2 px-3">
                                @if ($guru->user && $guru->user->foto_profil)
                                <img src="{{ asset('storage/' . $guru->user->foto_profil) }}"
                                    alt="Foto {{ $guru->nama }}"
                                    class="w-10 h-10 rounded-full object-cover">
                                @else
                                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-600 font-bold">
                                        {{ substr($guru->nama, 0 ,1) }}
                                    </span>
                                </div>
                                @endif
                            </td>
                            <td class="py-2 px-3">{{ $guru->nama }}</td>
                            <td class="py-2 px-3">{{ $guru->email }}</td>
                            <td class="py-2 px-3">{{ $guru->nip ?? '-' }}</td>
                            <td class="py-2 px-3">{{ $guru->nuptk ?? '-' }}</td>
                            <td class="py-2 px-3">{{ $guru->no_hp ?? '-' }}</td>
                            <td class="py-2 px-3 space-x-2">
                                <a href="{{ route('guru.edit', $guru) }}"
                                    class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form action="{{ route('guru.destroy', $guru) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus guru ini ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="py-4 text-center text-gray-500">
                                Belum ada data guru.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $gurus->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>