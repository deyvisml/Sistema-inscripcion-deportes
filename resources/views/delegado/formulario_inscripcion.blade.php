@extends('layouts.app')

@section('title')
    Inicio
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl flex flex-col items-center">
            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">{{ $deporte['name'] }}</h2>

            <div class="md:w-2/4 sm:w-4/5 w-full bg-white border rounded shadow-lg">

                <h3 class="text-2xl w-full pb-1 border-neutral-200 text-center p-2">Nueva
                    inscripción</h3>

                <form action="{{ route('participante.store', ['rol' => $current_rol, 'deporte' => $deporte]) }}"
                    method="post" class="p-4 md:text-base text-sm">

                    @if (session('error_num_limit_players'))
                        <p class="bg-red-500 text-white text-sm p-1 text-center my-1">
                            {{ session('error_num_limit_players') }}
                        </p>
                    @endif

                    @csrf

                    <div class="mb-2">
                        <label for="codigo">Código</label> <br>
                        <input value="{{ old('codigo') }}" type="text" name="codigo" id="codigo"
                            class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('codigo') border-red-700 @enderror">
                        @error('codigo')
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

                    <input type="submit" value="Inscribir" data-te-ripple-init data-te-ripple-color="light"
                        class="w-full mt-2 ml-auto inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-sm cursor-pointer font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                        href="{{ route('participante.formulario', ['rol' => $current_rol, 'deporte' => $deporte]) }}">
                </form>
            </div>
        </div>
    </div>
@endsection
