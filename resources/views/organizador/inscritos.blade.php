@extends('layouts.app')

@section('title')
    Inicio
@endsection

@section('content')
    <div class="bg-neutral-200 w-full h-full py-6 md:px-32 sm:px-10">
        <div class="md:p-4 p-2 py-4 bg-neutral-50 border shadow-xl flex flex-col items-center">
            <h2 class="text-2xl font-semibold w-full border-b-2 pb-1 mb-4 border-neutral-200">{{ $deporte['name'] }}</h2>

            <div class="sm:w-3/4 w-full bg-white">

                <a data-te-ripple-init data-te-ripple-color="light"
                    class="mb-4 ml-auto inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                    href="{{ route('participante.formulario', ['rol' => $current_rol, 'deporte' => $deporte]) }}">
                    Nueva inscripción
                </a>

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

                @if ($inscritos->count() == 0)
                    <p class="p-4 w-full text-center">No existen inscritos</p>
                @else
                    <table class="w-full mb-10 md:text-sm text-xs">
                        <thead class="bg-neutral-300">
                            <tr>
                                <th class="border-2 p-1 py-2 border-neutral-300">#</th>
                                <th class="border-2 p-1 py-2  border-neutral-300">Apelidos y nombres</th>
                                <th class="border-2 p-1 py-2  border-neutral-300">Código</th>
                                <th class="border-2 p-1 py-2 border-neutral-300">Acciones</th>
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
                                    <td class="border-2 p-1 py-2 border-neutral-300">
                                        <div class="flex gap-x-2">
                                            <a href="{{ route('participante.editar', ['rol' => $current_rol, 'deporte' => $deporte, 'inscrito' => $inscrito]) }}"
                                                class="rounded block p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="md:w-6 md:h-6 w-5 h-5 text-slate-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>

                                            <!-- Button trigger modal -->
                                            <button type="button" data-te-toggle="modal" data-te-target="#exampleModal"
                                                data-te-ripple-init data-te-ripple-color="light">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="md:w-6 md:h-6 w-5 h-5 text-slate-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>

                                            <!-- Modal -->
                                            <div data-te-modal-init
                                                class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                                                id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div data-te-modal-dialog-ref
                                                    class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
                                                    <div
                                                        class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
                                                        <div
                                                            class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                                            <!--Modal title-->
                                                            <h5 class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
                                                                id="exampleModalLabel">
                                                                Confirmación
                                                            </h5>
                                                            <!--Close button-->
                                                            <button type="button"
                                                                class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                                                                data-te-modal-dismiss aria-label="Close">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="h-6 w-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M6 18L18 6M6 6l12 12" />
                                                                </svg>
                                                            </button>
                                                        </div>

                                                        <!--Modal body-->
                                                        <div class="relative flex-auto p-4" data-te-modal-body-ref>
                                                            <p class="block text-center">¿Esta seguro que borrar el
                                                                registro?</p>
                                                        </div>

                                                        <!--Modal footer-->
                                                        <div
                                                            class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
                                                            <button type="button"
                                                                class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                                                                data-te-modal-dismiss data-te-ripple-init
                                                                data-te-ripple-color="light">
                                                                Cerrar
                                                            </button>
                                                            <a href="{{ route('participante.borrar', ['rol' => $current_rol, 'deporte' => $deporte, 'inscrito' => $inscrito]) }}"
                                                                class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"
                                                                data-te-ripple-init data-te-ripple-color="light">
                                                                Borrar
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
