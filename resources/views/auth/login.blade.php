<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <div class="flex min-h-screen">
        <!-- Bagian Kiri: Gambar -->
        <div class="hidden md:flex w-1/2 bg-cover bg-center"
            style="background-image: url('img/login.jpg');">
        </div>
    
        <!-- Bagian Kanan: Form Login -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-white">
            <div class="w-full max-w-md p-8">
                <h2 class="text-3xl font-bold text-gray-800 text-center">Login</h2>
                <p class="text-sm text-gray-500 text-center mb-6">Masukkan akun Anda untuk melanjutkan</p>
                {{-- Flasher Message --}}
                @if(session('success'))
                <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                    <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('LoginError'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {{ session('LoginError') }}
                    </div>
                @endif
                <form action="/login" method="post">
                    @csrf
                    {{-- Username --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Username</label>
                        <input type="text" name="username" placeholder="Masukkan Username"
                            value="{{ old('username') }}"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror">
                        @error('username')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                        <input type="password" name="password" placeholder="Masukkan password"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

    
                    <div class="flex items-center justify-between mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="text-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
                    </div>
    
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">Login</button>
                </form>
    
                <p class="text-sm text-gray-600 text-center mt-4">Belum punya akun? 
                    <a href="/regist" class="text-blue-600 hover:underline">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</x-layout-siswa>