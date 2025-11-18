@php
    use Illuminate\Support\Facades\Auth;
    $mapelList = \App\Models\Mapel::where('id_user', Auth::id())->get();
    $user = Auth::user();
@endphp

<aside class="fixed inset-y-0 left-0 top-12 h-[calc(100vh-3rem)] bg-gray-900 text-white p-4 shadow-lg w-64 hidden md:block">
    <ul class="space-y-2">

        {{-- Tombol admin --}}
        @role('admin')
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('admin.mapel') }}" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 text-white rounded flex items-center gap-2">
                        📚 {{ __('guru.Mata_Pelajaran') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.guru') }}" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 text-white rounded flex items-center gap-2">
                        👨‍🏫 Data Guru
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa') }}" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 text-white rounded flex items-center gap-2">
                        👨‍🎓 Data Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kelas') }}" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 text-white rounded flex items-center gap-2">
                        🏫 Data Kelas
                    </a>
                </li>
            </ul>
        @endrole

        {{-- Dropdown mapel guru --}}
        @role('guru')
        <li x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left p-3 text-sm bg-gray-800 hover:bg-gray-700 rounded flex justify-between items-center">
                📚 {{ __('guru.Mata_Pelajaran_Saya') }}
                <span :class="{'rotate-180': open}" class="transition-transform">▼</span>
            </button>
            <ul x-show="open" class="mt-2 space-y-1 pl-4" x-transition>
                @forelse ($mapelList as $mapel)
                    <li>
                        <a href="{{ route('guru.mapel', $mapel->slug) }}"
                           class="block p-2 text-sm bg-gray-800 hover:bg-gray-700 rounded">
                            {{ $mapel->nama_mapel }}
                        </a>
                    </li>
                @empty
                    <li class="text-gray-400 text-sm px-2">Tidak ada mapel</li>
                @endforelse
            </ul>
        </li>
        @endrole

    </ul>
</aside>
