<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Mata Pelajaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                <div class="mb-4  p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                <div class="mb-4">
                    <a href="{{ route('mapel.create') }}"
                        class="bg-blue-600 text-white px-4 py-4 rounded hover:bg-blue-700">
                        + Tambah Mapel
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-3">Kode</th>
                            <th class="py-2 px-3">Nama Mapel</th>
                            <th class="py-2 px-3">Kategori</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mapels as $mapel)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $mapel->kode_mapel }}</td>
                            <td class="py-2 px-3">{{ $mapel->nama_mapel }}</td>
                            <td class="py-2 px-3">{{ ucfirst($mapel->kategori) }}</td>
                            <td class="py-2 px-3 space-x-2">
                                <a href="{{ route('mapel.edit', $mapel) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('mapel.destroy', $mapel) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus mapel ini ?')">
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
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Belum ada data mata pelajaran.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $mapels->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>