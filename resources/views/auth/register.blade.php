<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    @vite('resources/css/app.css')
</head>

<body>
    <div class=" bg-[#2d2e48] w-full min-h-screen flex justify-center items-center">
        <div class="bg-white shadow-lg rounded w-full max-w-[400px] h-auto p-2 my-4 mx-2">
            <h3 class="text-center font-semibold text-2xl">Registro</h3>
            <form action="{{ route('register.store') }}" method="post" class="p-4">

                @csrf

                <div class="mb-2">
                    <label for="user">Usuario</label> <br>
                    <input value="{{ old('user') }}" type="text" name="user" id="user"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('user') border-red-700 @enderror">
                    @error('user')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="password">Contraseña</label> <br>
                    <input type="password" name="password" id="password"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('password') border-red-700 @enderror">
                    @error('password')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="name">Nombres</label> <br>
                    <input value="{{ old('name') }}" type="text" name="name" id="name"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('name') border-red-700 @enderror">
                    @error('name')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="ap_paterno">Apellido paterno</label> <br>
                    <input value="{{ old('ap_paterno') }}" type="text" name="ap_paterno" id="ap_paterno"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('ap_paterno') border-red-700 @enderror">
                    @error('ap_paterno')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="ap_materno">Apellido materno</label> <br>
                    <input value="{{ old('ap_materno') }}" type="text" name="ap_materno" id="ap_materno"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('ap_materno') border-red-700 @enderror">
                    @error('ap_materno')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="facultad">Facultad</label> <br>
                    <select name="facultad" id="facultad"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('facultad') border-red-700 @enderror">
                        <option value="0" selected>Seleccione una facultad</option>
                        @foreach ($facultades as $facultad)
                            @if (old('facultad') == $facultad['id'])
                                <option value="{{ $facultad['id'] }}" selected>{{ $facultad['name'] }}</option>
                            @else
                                <option value="{{ $facultad['id'] }}">{{ $facultad['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('facultad')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-2">
                    <label for="escuela">Escuela</label> <br>
                    <select name="escuela" id="escuela"
                        class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('escuela') border-red-700 @enderror">
                        <option value="0" selected>Seleccione una escuela</option>
                        @foreach ($escuelas as $escuela)
                            @if (old('escuela') == $escuela['id'])
                                <option value="{{ $escuela['id'] }}" data-facultad="{{ $escuela->facultad_id }}"
                                    selected>{{ $escuela['name'] }}</option>
                            @else
                                <option value="{{ $escuela['id'] }}" data-facultad="{{ $escuela->facultad_id }}">
                                    {{ $escuela['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('escuela')
                        <div class="text-red-700">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <input type="submit" value="Registrarse"
                        class="rounded w-full border bg-blue-700 font-semibold text-white p-2 outline-none my-1 cursor-pointer">
                </div>

                <a href="{{ route('login.index') }}" class="block text-center pt-2 underline text-blue-700">Iniciar
                    sesión</a>
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

</body>

</html>
