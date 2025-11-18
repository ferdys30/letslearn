@props(['tugas'])

<div class="bg-white p-4 rounded-lg shadow">
  <h3 class="font-semibold text-gray-800">{{ $tugas->judul }}</h3>
  <p class="text-sm text-gray-600 mt-1">{{ $tugas->deskripsi }}</p>
</div>
