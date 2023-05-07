@extends('layouts.app')

@section('title')
    Deportes
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl">

            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">Filtrar</h2>
            <form action="{{ route('organizador.filter', ['rol' => $current_rol]) }}" method="post"
                class="flex items-end flex-wrap gap-3 mb-5 text-sm sm:text-base">
                @csrf

                <div class="md:w-96 w-full">
                    <label class="text-xs font-semibold uppercase">Facultad</label>
                    <select name="facultad" id="facultad"
                        class="border box-border border-neutral-400 rounded p-2 w-full outline-none">
                        <option value="" selected disabled>Seleccione una facultad</option>
                        @foreach ($facultades as $facultad_i)
                            <option value="{{ $facultad_i['id'] }}" @if (isset($facultad) && $facultad_i->id == $facultad->id) selected @endif>
                                {{ $facultad_i['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:w-96 w-full">
                    <label class="text-xs font-semibold uppercase">Escuela</label>
                    <select name="escuela" id="escuela" class="border border-neutral-400 rounded p-2 w-full outline-none">
                        <option value="" selected disabled>Seleccione una escuela</option>
                        @foreach ($escuelas as $escuela_i)
                            <option value="{{ $escuela_i['id'] }}" @if (isset($escuela) && $escuela_i->id == $escuela->id) selected @endif
                                data-facultad="{{ $escuela_i->facultad_id }}">
                                {{ $escuela_i['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <input type="submit"
                        class="uppercase text-xs cursor-pointer bg-green-500 hover:bg-green-600 rounded p-2.5 px-4 text-white block"
                        value="FILTRAR">
                </div>
            </form>

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
                                    <a href="{{ route('organizador.inscritos', ['rol' => $current_rol, 'escuela' => $escuela, 'deporte' => $group_deporte['deporte']]) }}"
                                        class="cursor-pointer bg-info hover:bg-info-600 text-xs uppercase font-semibold block p-1 py-2 w-full text-center rounded text-white">Reporte</a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection


@push('js-scripts')
    <script>
        let selectFacultades = document.getElementById('facultad');
        let selectEscuelas = document.getElementById('escuela');

        selectFacultades.addEventListener('change', function() {
            show_escuelas_by_facultad();
            selectEscuelas.selectedIndex = 0;
        });

        const show_escuelas_by_facultad = () => {
            let selectFacultades = document.getElementById('facultad');
            let selectEscuelas = document.getElementById('escuela');

            let facultadSeleccionada = selectFacultades.value;

            // Ocultar todas las opciones del segundo select
            for (let i = 1; i < selectEscuelas.options.length; i++) {
                selectEscuelas.options[i].hidden = true;
                console.log(selectEscuelas.options[i]);
            }

            // Mostrar solo las opciones que pertenecen a la facultad seleccionada
            for (let i = 1; i < selectEscuelas.options.length; i++) {
                if (selectEscuelas.options[i].getAttribute('data-facultad') == facultadSeleccionada) {
                    selectEscuelas.options[i].hidden = false;
                }
            }
        }

        window.addEventListener('load', () => {
            show_escuelas_by_facultad();
        });
    </script>
@endpush
