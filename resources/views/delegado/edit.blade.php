@extends('layouts.app')

@section('title')
    Inicio
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl flex flex-col items-center">
            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">{{ $deporte['name'] }}</h2>

            <div class="md:w-2/4 sm:w-4/5 w-full bg-white border rounded shadow-lg">

                <h3 class="text-2xl w-full pb-1 border-neutral-200 text-center p-2">Editar delegado</h3>

                <form action="{{ route('delegado.update', ['delegado' => $delegado]) }}" method="post"
                    class="p-4 md:text-base text-sm">

                    @csrf

                    <div class="mb-2">
                        <label for="name">Apellidos y Nombres</label> <br>
                        <input value="{{ $delegado->name }}" type="text" name="name" id="name"
                            class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('name') border-red-700 @enderror">
                        @error('name')
                            <div class="text-red-700">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="code">Código</label> <br>
                        <input value="{{ $delegado->code }}" type="text" name="code" id="code"
                            class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('code') border-red-700 @enderror">
                        @error('code')
                            <div class="text-red-700">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="dni">DNI</label> <br>
                        <input value="{{ $delegado->dni }}" type="text" name="dni" id="dni"
                            class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('dni') border-red-700 @enderror">
                        @error('dni')
                            <div class="text-red-700">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="phone_number">Teléfono</label> <br>
                        <input value="{{ $delegado->phone_number }}" type="text" name="phone_number" id="phone_number"
                            class="rounded w-full border border-gray-500 p-2 outline-none my-1 @error('phone_number') border-red-700 @enderror">
                        @error('phone_number')
                            <div class="text-red-700">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="submit" value="Editar" data-te-ripple-init data-te-ripple-color="light"
                        class="w-full mt-2 ml-auto inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-sm cursor-pointer font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">

                    <a class="w-full text-center text-sm block rounded bg-green-500 hover:bg-green-600 cursor-pointer my-2 px-6 pb-2 pt-2.5 font-medium uppercase leading-normal text-white"
                        href="{{ route('delegado.index') }}">Volver</a>

                </form>
            </div>
        </div>
    </div>
@endsection
