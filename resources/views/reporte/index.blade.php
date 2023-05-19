@extends('layouts.app')

@section('title')
    Inicio
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl flex flex-col items-center">
            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">{{ $deporte['name'] }}</h2>

            <div class="sm:w-3/4 w-full bg-white">
                @if ($inscritos->count() > 0)
                    <a data-te-ripple-init data-te-ripple-color="light"
                        class="mb-4 ml-auto inline-block rounded bg-danger hover:bg-danger-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 "
                        href="{{ route('reporte.pdf', ['escuela' => $escuela, 'deporte' => $deporte]) }}">
                        Generar PDF
                    </a>
                @endif

                @if (session('success'))
                    <p class="bg-green-500 text-white text-sm p-1 text-center my-1">
                        {{ session('success') }}
                    </p>
                @endif

                @if ($inscritos->count() == 0)
                    <p class="p-4 w-full text-center">No existen inscritos</p>
                @else
                    <table class="w-full mb-10 md:text-sm text-xs">
                        <thead class="bg-neutral-300">
                            <tr>
                                <th class="border-2 p-1 py-2 border-neutral-300">#</th>
                                <th class="border-2 p-1 py-2  border-neutral-300">Apelidos y nombres</th>
                                <th class="border-2 p-1 py-2  border-neutral-300">Código</th>
                                <th class="border-2 p-1 py-2 border-neutral-300">Fecha de inscripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($inscritos as $inscrito)
                                <tr>
                                    <td class="border-2 p-1 py-2 border-neutral-300 font-semibold">{{ $i }}</td>
                                    <td class="border-2 p-1 py-2 border-neutral-300 uppercase">
                                        {{ $inscrito['ap_paterno'] . ' ' . $inscrito['ap_materno'] . ' ' . $inscrito['name'] }}
                                    </td>
                                    <td class="border-2 p-1 py-2 border-neutral-300 uppercase">
                                        {{ $inscrito['codigo'] }}
                                    </td>
                                    <td class="border-2 p-1 py-2 border-neutral-300 uppercase">
                                        {{ \Carbon\Carbon::parse($inscrito['created_at'])->format('d/m/Y') }}
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
