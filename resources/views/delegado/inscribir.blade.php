@extends('layouts.app')

@section('title')
    Inicio
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl">
            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">Deportes</h2>

            <ul class="flex flex-wrap md:gap-4 gap-10">
                @foreach ($group_deportes as $group_deporte)
                    <li class="sm:w-56 w-full ">
                        <div class="bg-white border-2 rounded-lg overflow-hidden shadow ">
                            <div class="w-full bg-gray-600 h-32 overflow-hidden relative ">
                                <p class="text-white font-semibold absolute z-20 inset-0 flex items-center justify-center ">
                                    {{ $group_deporte['deporte']['name'] }}</p>
                                <img src="{{ asset('deportes/' . $group_deporte['deporte']['image']) }}" alt=""
                                    class="object-cover w-full h-full z-10 opacity-40 ">
                            </div>
                            <div class="p-2 text-sm ">
                                <p><span class="font-semibold text-gray-700 ">Inscritos:</span>
                                    <span>{{ $group_deporte['num_inscritos'] }}</span>
                                </p>
                                <p><span class="font-semibold text-gray-700 ">Cantidad max:</span>
                                    <span>{{ $group_deporte['deporte']['num_max_players'] }}</span>
                                </p>
                                <p><span class="font-semibold text-gray-700 ">Fecha limite:</span>
                                    <span>{{ \Carbon\Carbon::parse($group_deporte['deporte']->fecha_limite)->locale('es')->formatLocalized('%e de %B') }}</span>
                                </p>

                                <div class="flex mt-2 gap-x-2">
                                    @if (\Carbon\Carbon::parse($group_deporte['deporte']->fecha_limite)->isPast())
                                        <a href="{{ route('delegado.inscritos', ['escuela' => $escuela, 'deporte' => $group_deporte['deporte']]) }}"
                                            class="cursor-pointer bg-info hover:bg-info-600 text-xs uppercase font-semibold block p-1 py-2 w-full text-center rounded text-white">Reporte</a>
                                    @else
                                        <a href="{{ route('participante.index', ['rol' => $current_rol, 'deporte' => $group_deporte['deporte']]) }}"
                                            class="cursor-pointer bg-primary hover:bg-primary-600 text-xs uppercase font-semibold block p-1 py-2 w-1/2 text-center rounded text-white">Inscribir</a>
                                        <a href="{{ route('delegado.inscritos', ['escuela' => $escuela, 'deporte' => $group_deporte['deporte']]) }}"
                                            class="cursor-pointer bg-info hover:bg-info-600 text-xs uppercase font-semibold block p-1 py-2 w-1/2 text-center rounded text-white">Reporte</a>
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
