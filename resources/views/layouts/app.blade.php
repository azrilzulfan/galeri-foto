<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <nav class="bg-white border-gray-200">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="{{ route('beranda') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="w-8 h-8 text-purple-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.5 4.6A2 2 0 0 1 8.9 4h6.2c.5 0 1 .2 1.4.6L17.9 6H19a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h1l1.5-1.4ZM10 12a2 2 0 1 1 4 0 2 2 0 0 1-4 0Zm2-4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">Galeri Foto</span>
                </a>
                <div class="flex items-center md:order-2 space-x-3 md:space-x-0">
                    @if (Route::has('login'))
                    @auth
                        <button type="button" class="font-semibold" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            {{ Auth::user()->name }}
                        </button>
                    @else
                        <div>
                            <a href="{{ route('login') }}" class="text-blue-700 hover:text-blue-800 font-semibold rounded-lg text-base px-4 py-2 text-center">Login</a>
                            <a href="{{ route('register') }}" class="text-green-500 hover:text-green-600 font-semibold rounded-lg text-base px-4 py-2 text-center">Register</a>
                        </div>
                    @endauth
                    @endif
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 w-full">Logout</button>
                            </form>
                        </li>
                    </ul>
                    </div>
                    <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                    </button>
                </div>
                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col items-center font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                    <a href="{{ route('beranda') }}" class="block py-2 px-3 text-purple-700 md:p-0" aria-current="page">Beranda</a>
                    </li>
                    <li>
                    <a href="{{ route('explore') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-purple-700 md:p-0">Jelajahi</a>
                    </li>
                    <li>
                    <a href="{{ route('profile.index') }}" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Upload Foto</a>
                    </li>
                </ul>
                </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="py-10 px-20">
                {{ $slot }}
            </main>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>
