@extends('layouts.app')

@section('title')
    Inicio
@endsection

@section('content')
    <div class="bg-transparent sm:px-10 md:px-32 py-6 w-full h-full">
        <div class="bg-neutral-50 shadow-xl p-2 md:p-4 py-4 border">
            <h2 class="mb-6 pb-3 border-neutral-200 border-b-2 w-full font-sans font-semibold text-2xl text-center">
                Olimpiadas Inter
                Escuelas
                Profesionales UNA-PUNO 2023</h2>

            <ul class="flex flex-wrap gap-10 md:gap-4">
                @foreach ($group_deportes as $group_deporte)
                    <li class="w-full sm:w-56">
                        <div class="bg-white shadow border-2 rounded-lg overflow-hidden">
                            <div class="relative bg-gray-600 w-full h-32 overflow-hidden">
                                <p
                                    class="z-20 absolute inset-0 flex justify-center items-center p-1.5 font-semibold text-white text-center">
                                    {{ $group_deporte['deporte']['name'] }}</p>
                                <img src="{{ asset('deportes/' . $group_deporte['deporte']['image']) }}" alt=""
                                    class="z-10 opacity-40 w-full h-full object-cover">
                            </div>
                            <div class="p-2 text-sm">
                                <p><span class="font-semibold text-gray-700">Inscritos:</span>
                                    <span>{{ $group_deporte['num_inscritos'] }}</span>
                                </p>
                                <p><span class="font-semibold text-gray-700">Cantidad max:</span>
                                    <span>{{ $group_deporte['deporte']['num_max_players'] }}</span>
                                </p>
                                <p><span class="font-semibold text-gray-700">Fecha limite:</span>
                                    <span>{{ \Carbon\Carbon::parse($group_deporte['deporte']->fecha_limite)->locale('es')->formatLocalized('%e de %B') }}</span>
                                </p>

                                <div class="flex gap-x-2 mt-2">
                                    @if (\Carbon\Carbon::parse($group_deporte['deporte']->fecha_limite)->isPast())
                                        <a href="{{ route('reporte.index', ['deporte' => $group_deporte['deporte']]) }}"
                                            class="block bg-info hover:bg-info-600 p-1 py-2 rounded w-full font-semibold text-white text-xs text-center uppercase cursor-pointer">Reporte</a>
                                    @else
                                        <a href="{{ route('inscrito.index', ['deporte' => $group_deporte['deporte']]) }}"
                                            class="block bg-primary hover:bg-primary-600 p-1 py-2 rounded w-1/2 font-semibold text-white text-xs text-center uppercase cursor-pointer">Inscribir</a>
                                        <a href="{{ route('reporte.index', ['deporte' => $group_deporte['deporte']]) }}"
                                            class="block bg-info hover:bg-info-600 p-1 py-2 rounded w-1/2 font-semibold text-white text-xs text-center uppercase cursor-pointer">Reporte</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
