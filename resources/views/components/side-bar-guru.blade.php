<aside class="fixed inset-y-0 left-0 top-12 h-[calc(100vh-3rem)] bg-gray-900 text-white p-4 shadow-lg w-64 hidden md:block">
    <ul class="space-y-2">
        <li><a href="/guru/materi" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 rounded flex items-center">📖 Materi</a></li>
        <li><a href="/guru/kuis" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 rounded flex items-center">🎯 Kuis</a></li>
        <li x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left p-3 text-sm bg-gray-800 hover:bg-gray-700 rounded flex justify-between items-center">
                🏗 Project Based Learning
                <span :class="{'rotate-180': open}" class="transition-transform">▼</span>
            </button>
            <ul x-show="open" class="mt-1 space-y-1 pl-6">
                <li><a href="/guru/mapel" class="block p-2 text-sm bg-gray-800 hover:bg-gray-700 rounded">Detail Mata Pelajaran</a></li>
                <li><a href="/guru/syntax" class="block p-2 text-sm bg-gray-800 hover:bg-gray-700 rounded">Syntax Project Based Learning</a></li>
                <li><a href="/guru/pjbl/kelompok" class="block p-2 text-sm bg-gray-800 hover:bg-gray-700 rounded">Kelompok</a></li>
                <li><a href="/guru/pjbl/studi_kasus" class="block p-2 text-sm bg-gray-800 hover:bg-gray-700 rounded">Studi Kasus</a></li>
            </ul>
        </li>
        <li><a href="/guru/penilaian" class="block p-3 text-sm bg-gray-800 hover:bg-gray-700 rounded flex items-center">📊 Penilaian</a></li>
    </ul>
</aside>