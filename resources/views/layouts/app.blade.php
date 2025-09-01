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

    <div class="flex flex-col min-h-screen">
        <header>
            <nav
                class="flex flex-wrap items-center gap-x-2 sm:gap-x-4 bg-[#2d2e48] px-4 sm:px-10 md:px-32 py-2 border-neutral-300 border-b-4">
                <div class="flex flex-wrap justify-center md:justify-between items-center w-full md:w-2/12">
                    <a href="/" class="w-auto">
                        <img src="{{ asset('https://aulavirtual2.unap.edu.pe/images/logos/unap/logo.png') }}" alt="imagen logo"
                            class="py-2 max-h-[70px] object-contain">
                    </a>
                </div>

                <ul
                    class="flex sm:flex-row flex-col sm:justify-start items-start sm:items-center gap-x-4 sm:gap-x-5 my-2 w-full sm:w-auto text-neutral-300">
                    @foreach ($permissions as $permission)
                        <li class="w-auto">
                            <a href="{{ route($permission->route_name) }}"
                                class="cursor-pointer px-0.5 text-sm border-neutral-200 hover:text-white @if ($permission['id'] == $current_permission['id']) border-b-2 text-white @endif">
                                {{ $permission['name'] }}
                            </a>
                        </li>
                    @endforeach


                </ul>

                <a href="{{ route('login.logout') }}"
                    class="hidden flex items-center bg-danger hover:bg-danger-600 px-2.5 py-1.5 rounded sm:w-auto font-semibold text-white text-xs text-center uppercase cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="inline-block me-1 w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    Salir
                </a>

                <div class="flex justify-end justify-self-center my-2 ml-auto w-auto">
                    <div class="relative" data-te-dropdown-ref>
                        <!-- Second dropdown trigger -->
                        <a class="hidden-arrow flex justify-center items-center whitespace-nowrap transition motion-reduce:transition-none duration-150 ease-in-out cursor-pointer"
                            href="#" id="dropdownMenuButton2" role="button" data-te-dropdown-toggle-ref
                            aria-expanded="false">
                            <!-- User avatar -->
                            <div
                                class="flex justify-center items-center bg-neutral-100 me-2 border-2 border-neutral-300 rounded-full w-9 h-9 overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <p class="me-1 text-neutral-100 text-sm uppercase cursor-pointer">
                                {{ auth()->user()->name . ' ' . auth()->user()->ap_paterno }}</p>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-4 h-4 text-neutral-100">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </a>
                        <!-- Second dropdown menu -->
                        <ul class="hidden [&[data-te-dropdown-show]]:block right-0 left-auto z-[1000] float-left absolute bg-white dark:bg-neutral-700 bg-clip-padding shadow-lg m-0 mt-1 border-none rounded-lg w-20 min-w-max overflow-hidden text-base text-left list-none"
                            aria-labelledby="dropdownMenuButton2" data-te-dropdown-menu-ref>
                            <!-- Second dropdown menu items -->
                            <li>
                                <a class="block bg-transparent hover:bg-neutral-100 disabled:bg-transparent dark:hover:bg-white/30 px-4 py-2 w-full font-normal text-neutral-700 active:text-neutral-800 disabled:text-neutral-400 dark:text-neutral-200 text-sm active:no-underline whitespace-nowrap disabled:pointer-events-none"
                                    href="{{ route('login.logout') }}" data-te-dropdown-item-ref>Salir</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="flex-1 bg-neutral-200 border-2">
            @yield('content')
        </main>

        <footer class="flex justify-center items-center bg-[#2d2e48] h-14 text-white">
            <p class="text-center">© UNA PUNO 2025</p>
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    @stack('js-scripts')
</body>

</html>
