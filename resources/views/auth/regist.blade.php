<x-layout-siswa>
    <div class="flex min-h-screen">
        <!-- Bagian Kiri: Gambar (1/3 layar) -->
        <div class="hidden md:flex w-1/3 bg-cover bg-center"
            style="background-image: url('img/FE.jpeg');">
        </div>
    
        <!-- Bagian Kanan: Form Registrasi (2/3 layar) -->
        <div class="w-full md:w-2/3 flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center">Registrasi</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Buat akun baru untuk melanjutkan</p>
    
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
                        <input type="text" placeholder="Masukkan nama lengkap" 
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
    
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
    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Konfirmasi Password</label>
                        <input type="password" placeholder="Konfirmasi password" 
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
    
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Daftar</button>
                </form>
    
                <p class="text-sm text-gray-600 text-center mt-4">Sudah punya akun? 
                    <a href="login.html" class="text-blue-600 hover:underline">Login</a>
                </p>
            </div>
        </div>
    </div>
    
</x-layout-siswa>