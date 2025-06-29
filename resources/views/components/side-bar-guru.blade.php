@php
    use Illuminate\Support\Facades\Auth;
    $mapelList = \App\Models\mata_pelajaran::where('id_user', Auth::id())->get();
    $user = Auth::user();
@endphp

<aside class="fixed inset-y-0 left-0 top-12 h-[calc(100vh-3rem)] bg-gray-900 text-white p-4 shadow-lg w-64 hidden md:block">
    <ul class="space-y-2">

        {{-- Tombol admin --}}
        @if ($user && $user->role === 'admin')
            <li>
                <a href="{{ route('admin.guru.index') }}" class="block p-3 text-sm bg-blue-800 hover:bg-blue-700 rounded flex items-center">
                    👨‍🏫 Data Guru
                </a>
            </li>
            <li>
                <a href="{{ route('admin.siswa.index') }}" class="block p-3 text-sm bg-green-800 hover:bg-green-700 rounded flex items-center">
                    👨‍🎓 Data Siswa
                </a>
            </li>
        @endif

        {{-- Dropdown mapel guru --}}
        <li x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left p-3 text-sm bg-gray-800 hover:bg-gray-700 rounded flex justify-between items-center">
                📚 Mata Pelajaran Saya
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

    </ul>
</aside>
