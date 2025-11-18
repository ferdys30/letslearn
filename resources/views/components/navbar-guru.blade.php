<nav class="fixed w-full top-0 z-50 bg-gray-800 text-white p-3 flex justify-between items-center shadow-md">
    <!-- Mobile menu button -->
    <button class="md:hidden text-white" onclick="document.querySelector('aside').classList.toggle('hidden')">
        ☰
    </button>

    <!-- Dashboard -->
    <a href="/guru" class="text-lg font-semibold">{{ __('Dashboard Guru') }}</a>

    <div class="flex items-center gap-4">

        <!-- 🌐 LANGUAGE SWITCH -->
        <div class="relative" x-data="{ openLang: false }">
            <button @click="openLang = !openLang" class="text-xl">
                🌐
            </button>
{{-- Debug sementara --}}
{{-- <div class="text-white">{{ app()->getLocale() }}</div> --}}
            <div x-show="openLang" @click.away="openLang = false"
                class="absolute right-0 mt-2 w-32 bg-white text-gray-800 shadow-lg rounded-md py-1">

                <a href="{{ route('locale',['locale'=>'id'])}}"
                   class="block px-3 py-2 hover:bg-gray-200 {{ app()->getLocale() == 'id' ? 'font-bold' : '' }}">
                    🇮🇩 Indonesia
                </a>

                <a href="{{ route('locale',['locale'=>'en'])}}"
                   class="block px-3 py-2 hover:bg-gray-200 {{ app()->getLocale() == 'en' ? 'font-bold' : '' }}">
                    🇺🇸 English
                </a>

            </div>
        </div>

        <!-- User dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                <span class="hidden md:block text-sm">Pak {{ auth()->user()->nama }}</span>
                <img src="{{ asset('img/' . (Auth::user()->foto ?? 'profile.png')) }}"
                    alt="Admin Profile"
                    class="w-8 h-8 rounded-full border-2 border-white">
            </button>

            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-40 bg-white text-gray-800 shadow-lg hidden md:block">
                <a href="#" class="w-full block px-3 py-2 hover:bg-gray-700 hover:text-white">
                    {{ __('Settings') }}
                </a>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left block px-3 py-2 hover:bg-gray-700 hover:text-white">
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
</nav>
