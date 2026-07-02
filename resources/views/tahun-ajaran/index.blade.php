<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
            Data Tahun Ajaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                <div class=" mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class=" mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
                @endif

                <div class=" mb-4">
                    <a href="{{ route('tahun-ajaran.create') }}"
                        class=" bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Tambah Tahun Ajaran Baru
                    </a>
                </div>

                <table class=" w-full text-left border-collapse">
                    <thead>
                        <tr class=" border-b">
                            <th class="py-2 px-3">Tahun Ajaran</th>
                            <th class="py-2 px-3">Semester</th>
                            <th class="py-2 px-3">Status</th>
                            <th class="py-2 px-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tahunAjarans as $tahunAjaran)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $tahunAjaran->nama }}</td>
                            <td class="py-2 px-3">{{ ucfirst($tahunAjaran->semester) }}</td>
                            <td class="py-2 px-3">
                                @if ($tahunAjaran->status_aktif)
                                <span class=" bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">
                                    Aktif
                                </span>
                                @else
                                <span class=" bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs font-medium">
                                    Tidak Aktif
                                </span>
                                @endif
                            </td>
                            <td class="py-2 px-3 space-x-2">
                                <a href="{{ route('tahun-ajaran.edit', $tahunAjaran) }}"
                                    class=" text-blue-600 hover:underline">
                                    Edit
                                </a>
                                @if(!$tahunAjaran->status_aktif)
                                <form action="{{ route('tahun-ajaran.destroy', $tahunAjaran) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus tahun ajaran ini ?')">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>
                                @else
                                <span class=" text-gray-400 text-sm">Tidak bisa dihapus</span>
                                @endif

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class=" py-4 text-center text-gray-500">
                                Belum ada data tahun ajaran
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $tahunAjarans->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>