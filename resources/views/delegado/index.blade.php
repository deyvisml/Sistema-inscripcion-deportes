@extends('layouts.app')

@section('title')
    Inscripción Delegados
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl flex flex-col items-center">
            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">Delegados</h2>

            <div class="sm:w-3/4 w-full bg-white">

                @if (session('inscripcion_success'))
                    <p class="bg-green-500 text-white text-sm p-1 text-center my-1">
                        {{ session('inscripcion_success') }}
                    </p>
                @elseif (session('update_success'))
                    <p class="bg-green-500 text-white text-sm p-1 text-center my-1">
                        {{ session('update_success') }}
                    </p>
                @elseif (session('delete_success'))
                    <p class="bg-green-500 text-white text-sm p-1 text-center my-1">
                        {{ session('delete_success') }}
                    </p>
                @endif

                <table id="tabla" class="w-full mb-10 md:text-sm text-xs">
                    <thead class="bg-neutral-300">
                        <tr>
                            <th class="border-2 p-1 py-2 border-neutral-300">#</th>
                            <th class="border-2 p-1 py-2 border-neutral-300">Deporte</th>
                            <th class="border-2 p-1 py-2 border-neutral-300">Apelidos y Nombres</th>
                            <th class="border-2 p-1 py-2 border-neutral-300">Código</th>
                            <th class="border-2 p-1 py-2 border-neutral-300">DNI</th>
                            <th class="border-2 p-1 py-2 border-neutral-300">Teléfono</th>
                            <th class="border-2 p-1 py-2 border-neutral-300">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($group_deportes as $group_deporte)
                            <tr>
                                <td class="border-2 p-1 py-2 border-neutral-300 font-semibold">{{ $i }}</td>
                                <td class="border-2 p-1 py-2 border-neutral-300 uppercase">
                                    {{ $group_deporte['deporte']['name'] }}</td>
                                <td class="border-2 p-1 py-2 border-neutral-300 uppercase">
                                    {{ $group_deporte['delegado']['name'] ?? '' }}
                                </td>
                                <td class="border-2 p-1 py-2 border-neutral-300 ">
                                    {{ $group_deporte['delegado']['code'] ?? '' }}
                                </td>
                                <td class="border-2 p-1 py-2 border-neutral-300">
                                    {{ $group_deporte['delegado']['dni'] ?? '' }}
                                </td>
                                <td class="border-2 p-1 py-2 border-neutral-300">
                                    {{ $group_deporte['delegado']['phone_number'] ?? '' }}
                                </td>
                                <td class="border-2 p-1 py-2 border-neutral-300">
                                    <a href="{{ $group_deporte['delegado'] ? route('delegado.edit', ['delegado' => $group_deporte['delegado']]) : route('delegado.create', ['deporte' => $group_deporte['deporte']]) }}"
                                        class="rounded block p-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="md:w-6 md:h-6 w-5 h-5 text-slate-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js-scripts')
@endpush
