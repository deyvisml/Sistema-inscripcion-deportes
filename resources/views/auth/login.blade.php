<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body>
    <div class=" bg-[#2d2e48] w-full min-h-screen flex flex-col justify-center items-center p-2">
        <div class="w-full max-w-[400px] h-auto p-2 mx-2 text-white flex flex-col justify-center items-center">
            <a href="/" class="w-auto mb-4">
                <img src="{{ asset('https://aulavirtual2.unap.edu.pe/images/logos/unap/logo.png') }}" alt="imagen logo"
                    class="object-contain max-h-[70px] py-2">
            </a>
            <h2 class="text-2xl">Deportes - UNA Puno</h2>
        </div>

        <div class="bg-white shadow-lg rounded w-full max-w-[400px] h-auto p-2 my-4 mx-2">
            <h3 class="text-center font-semibold text-2xl">Login</h3>
            <form action="{{ route('login.store') }}" method="post" class="p-4">
                @if (session('message'))
                    <p class="bg-red-500 text-white text-sm p-1 text-center my-1">
                        {{ session('message') }}
                    </p>
                @endif

                @csrf

                <div class="mb-2">
                    <label for="user">Usuario</label> <br>
                    <input autofocus value="{{ old('user') }}" type="text" name="user" id="user"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('user') border-red-700 @enderror">
                    @error('user')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password">Contraseña</label> <br>
                    <div
                        class="flex rounded w-full border border-gray-500 p-2  my-1 @error('password') border-red-700 @enderror">
                        <input type="password" name="password" id="password" class="w-full outline-none">

                        <div class="w-5 self-end cursor-pointer" id="show_password">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="eye">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden" id="hidden_eye">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                        </div>
                    </div>
                    @error('password')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <input type="submit" value="Iniciar sesión"
                        class="rounded w-full border bg-primary hover:bg-primary-600 font-semibold text-white p-2 outline-none my-1 cursor-pointer">
                </div>
            </form>
        </div>
    </div>


    <script>
        let selectFacultades = document.getElementById('facultad');
        let selectEscuelas = document.getElementById('escuela');

        selectFacultades.addEventListener('change', function() {
            let facultadSeleccionada = selectFacultades.value;

            // Ocultar todas las opciones del segundo select
            for (let i = 0; i < selectEscuelas.options.length; i++) {
                selectEscuelas.options[i].style.display = 'none';
            }

            // Mostrar solo las opciones que pertenecen a la facultad seleccionada
            for (let i = 0; i < selectEscuelas.options.length; i++) {
                if (selectEscuelas.options[i].getAttribute('data-facultad') == facultadSeleccionada) {
                    selectEscuelas.options[i].style.display = 'block';
                }
            }
        });
    </script>

    <script>
        const show_password = document.querySelector("#show_password");

        show_password.addEventListener("click", () => {
            const password = document.querySelector("#password");
            const eye = document.querySelector("#eye");
            const hidden_eye = document.querySelector("#hidden_eye");

            if (password.type === "password") {
                password.type = "text";

                eye.classList.add("hidden")
                hidden_eye.classList.remove("hidden")
            } else {
                password.type = "password";

                eye.classList.remove("hidden")
                hidden_eye.classList.add("hidden")
            }
        });
    </script>

</body>

</html>
