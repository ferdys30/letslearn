<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <div class="flex min-h-screen">
        <!-- Bagian Kiri: Gambar -->
        <div class="hidden md:flex w-1/2 bg-cover bg-center"
            style="background-image: url('img/FE.jpeg');">
        </div>
    
        <!-- Bagian Kanan: Form Login -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center">Login</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Masukkan akun Anda untuk melanjutkan</p>
    
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                        <input type="email" placeholder="Masukkan email" 
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                        <input type="password" placeholder="Masukkan password" 
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
    
                    <div class="flex items-center justify-between mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="text-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
                    </div>
    
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Login</button>
                </form>
    
                <p class="text-sm text-gray-600 text-center mt-4">Belum punya akun? 
                    <a href="/regist" class="text-blue-600 hover:underline">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</x-layout-siswa>