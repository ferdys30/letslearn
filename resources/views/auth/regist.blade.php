<x-layout-siswa>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <div class="flex min-h-screen">
        <!-- Bagian Kiri: Gambar (1/3 layar) -->
        <div class="hidden md:flex w-1/3 bg-cover bg-center"
            style="background-image: url('img/regist.jpg');">
        </div>
    
        <!-- Bagian Kanan: Form Registrasi (2/3 layar) -->
        <div class="w-full md:w-2/3 flex items-center justify-center bg-gray-50 px-4">
            <div class="w-full max-w-4xl bg-white p-10 rounded-2xl shadow-xl">
                <h2 class="text-4xl font-bold text-center text-blue-700 mb-2">Registrasi</h2>
                <p class="text-sm text-gray-500 text-center mb-8">Buat akun baru untuk melanjutkan</p>

                <form method="POST" action="/regist" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Role -->
                    <div>
                        <label class="block text-gray-700 text-sm font-medium mb-1">Daftar Sebagai</label>
                        <select id="roleSelect" name="role"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-4">
                            <!-- NIS -->
                            <div class="field-siswa">
                                <label class="block text-sm font-medium text-gray-700">NIS</label>
                                <input type="text" name="nis" id="nis" placeholder="Masukkan NIS"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('nis') border-red-500 @enderror"
                                    value="{{ old('nis') }}">
                                @error('nis')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- NIP -->
                            <div class="field-guru">
                                <label class="block text-sm font-medium text-gray-700">NIP</label>
                                <input type="text" name="nip" id="nip" placeholder="Masukkan NIP"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('nip') border-red-500 @enderror"
                                    value="{{ old('nip') }}">
                                @error('nip')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Nama -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                                    value="{{ old('nama') }}">
                                @error('nama')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Foto -->
                            <div class="field-siswa">
                                <label class="block text-sm font-medium text-gray-700">Foto</label>
                                <input type="file" name="foto" id="foto"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('foto') border-red-500 @enderror">
                                @error('foto')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Jurusan -->
                            <div class="field-siswa">
                                <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                                <input type="text" name="jurusan" id="jurusan" placeholder="Masukkan jurusan"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('jurusan') border-red-500 @enderror"
                                    value="{{ old('jurusan') }}">
                                @error('jurusan')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Kelas -->
                            <div class="field-siswa">
                                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="id_kelas" id="id_kelas"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->Kelas }}" {{ old('kelas') == $k->Kelas ? 'selected' : '' }}>
                                            {{ $k->Kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Paralel -->
                            <div class="field-siswa">
                                <label class="block text-sm font-medium text-gray-700">Paralel</label>
                                <select name="paralel" id="paralel"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Paralel --</option>
                                    @foreach ([1, 2, 3] as $p)
                                        <option value="{{ $p }}" {{ old('paralel') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-4">
                            <!-- Alamat -->
                            <div class="field-siswa">
                                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Email -->
                            <div class="field-siswa field-guru">
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" placeholder="Masukkan email"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                    value="{{ old('email') }}">
                                @error('email')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Username -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" name="username" id="username" placeholder="Masukkan username"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror"
                                    value="{{ old('username') }}">
                                @error('username')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" placeholder="Masukkan password"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                                @error('password')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                            Daftar
                        </button>
                    </div>
                </form>

                <p class="text-sm text-gray-600 text-center mt-6">
                    Sudah punya akun?
                    <a href="/login" class="text-blue-600 hover:underline">Login</a>
                </p>
            </div>
        </div>
       
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('roleSelect');
        const fieldGuru = document.querySelectorAll('.field-guru');
        const fieldSiswa = document.querySelectorAll('.field-siswa');

        function toggleFields(role) {
            // Sembunyikan semua dulu
            fieldGuru.forEach(el => el.style.display = 'none');
            fieldSiswa.forEach(el => el.style.display = 'none');

            if (role === 'guru') {
                fieldGuru.forEach(el => el.style.display = 'block');
            } else if (role === 'siswa') {
                fieldSiswa.forEach(el => el.style.display = 'block');
            }
            // Admin tidak punya field tambahan
        }

        // Event listener saat role berubah
        roleSelect.addEventListener('change', function () {
            toggleFields(this.value);
        });

        // Jalankan saat halaman pertama kali load
        toggleFields(roleSelect.value);
    });
</script>

</x-layout-siswa>