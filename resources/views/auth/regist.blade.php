<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <div class="flex min-h-screen">
        <!-- Bagian Kiri: Gambar (1/3 layar) -->
        <div class="hidden md:flex w-1/3 bg-cover bg-center"
            style="background-image: url('img/regist.jpg');">
        </div>
    
        <!-- Bagian Kanan: Form Registrasi (2/3 layar) -->
        <div class="w-full md:w-2/3 flex items-center justify-center bg-white">
            <div class="w-full max-w-4xl p-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center">Registrasi</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Buat akun baru untuk melanjutkan</p>
        
                <form method="POST" action="/regist" enctype="multipart/form-data">
                    @csrf
                
                    <div class="md:flex md:space-x-6">
                        <!-- Kolom Kiri -->
                        <div class="md:w-1/2">
                            <!-- NIS -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">NIS</label>
                                <input type="text" name="nis" placeholder="Masukkan NIS"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nis') border-red-500 @enderror"
                                    value="{{ old('nis') }}">
                                @error('nis')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Nama -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" placeholder="Masukkan nama lengkap"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                                    value="{{ old('nama') }}">
                                @error('nama')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Foto -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Foto</label>
                                <input type="file" name="foto"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('foto') border-red-500 @enderror">
                                @error('foto')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Jurusan -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Jurusan</label>
                                <input type="text" name="jurusan" placeholder="Masukkan jurusan"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jurusan') border-red-500 @enderror"
                                    value="{{ old('jurusan') }}">
                                @error('jurusan')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Kelas -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Kelas</label>
                                <input type="text" name="kelas" placeholder="Masukkan kelas"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kelas') border-red-500 @enderror"
                                    value="{{ old('kelas') }}">
                                @error('kelas')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                
                        <!-- Kolom Kanan -->
                        <div class="md:w-1/2">
                            <!-- Alamat -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Alamat</label>
                                <textarea name="alamat" rows="3" placeholder="Masukkan alamat"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Email -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                                <input type="email" name="email" placeholder="Masukkan email"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Username -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                                <input type="text" name="username" placeholder="Masukkan username"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror"
                                    value="{{ old('username') }}">
                                @error('username')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Password -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                                <input type="password" name="password" placeholder="Masukkan password"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                                @error('password')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                
                            <!-- Konfirmasi Password -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" placeholder="Ulangi password"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 mt-4 rounded-lg hover:bg-blue-700 transition">
                        Daftar
                    </button>
                </form>
                
                <p class="text-sm text-gray-600 text-center mt-4">Sudah punya akun? 
                    <a href="/login" class="text-blue-600 hover:underline">Login</a>
                </p>
            </div>
        </div>        
    </div>
    
</x-layout-siswa>