<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Deportes UNA - @yield('title')</title>

    <link href="https://aulavirtual2.unap.edu.pe/images/themes/unap/favicon.ico" rel="icon">



    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>


    @stack('css-scripts')

    @vite('resources/css/app.css')
</head>

<body class="">

    <nav
        class="flex flex-wrap md:px-32 sm:px-10 px-4 items-center py-2 bg-[#2d2e48] sm:gap-x-4 gap-x-2 border-b-4 border-neutral-300">
        <div class="flex items-center md:justify-between justify-center flex-wrap md:w-2/12 w-full">
            <a href="/" class="w-auto">
                <img src="{{ asset('https://aulavirtual2.unap.edu.pe/images/logos/unap/logo.png') }}" alt="imagen logo"
                    class="object-contain max-h-[70px] py-2">
            </a>
        </div>

        <ul
            class="text-neutral-300 flex sm:gap-x-10 gap-x-4 items-center sm:justify-start justify-center sm:w-auto my-2">
            @foreach ($roles as $rol)
                <li class="">
                    <a href="{{ route('delegado.handler', ['rol' => $rol]) }}"
                        class="block cursor-pointer px-0.5 text-sm border-neutral-200 hover:text-white @if ($rol['id'] == $current_rol['id']) border-b-2 text-white @endif">
                        {{ $rol['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="w-auto my-2 justify-self-center flex justify-end ml-auto">
            <div class="relative" data-te-dropdown-ref>
                <!-- Second dropdown trigger -->
                <a class="hidden-arrow flex items-center whitespace-nowrap transition duration-150 ease-in-out motion-reduce:transition-none justify-center cursor-pointer"
                    href="#" id="dropdownMenuButton2" role="button" data-te-dropdown-toggle-ref
                    aria-expanded="false">
                    <!-- User avatar -->
                    <div
                        class="w-9 h-9 rounded-full border-neutral-300 border-2 me-2 flex justify-center items-center overflow-hidden bg-neutral-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <p class="text-neutral-100 me-1 text-sm cursor-pointer uppercase">{{ auth()->user()->name }}</p>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-neutral-100">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
                <!-- Second dropdown menu -->
                <ul class="w-20 absolute left-auto right-0 z-[1000] float-left m-0 mt-1 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
                    aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>
                    <!-- Second dropdown menu items -->
                    <li>
                        <a class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400 dark:text-neutral-200 dark:hover:bg-white/30"
                            href="{{ route('login.logout') }}" data-te-dropdown-item-ref>Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="bg-white">
        @yield('content')
    </main>

    <footer class="h-24 bg-neutral-200 flex justify-center items-center">
        <p class="text-center">© UNA PUNO 2023</p>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    @stack('js-scripts')
</body>

</html>
