@extends('adminlte::page')

@section('title', 'Filtros')

@section('content_header')
<h1>Filtros</h1>
@stop

@section('content')

<div class="float-left w-full mb-5 ">
    <a class="text-primary tamaño-logos mb-1 mr-1" href="{{ route('admin.filtros.create') }}">Nuevo Filtro <i
            class='fas fa-plus-circle'></i></a>

    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3">
        @foreach ($modelos as $modelo)
        @if ($filtrosPorModelo->has($modelo->id))
        <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="p-1 text-white bg-blue-500">
                <h6 class="text-sm font-bold">Modelo: {{ $modelo->descripcion }}</h2>
            </div>
            <table class="min-w-full table-auto">
                <thead class="text-white bg-blue-500">
                    <tr>
                        <th class="px-2 py-1 text-left">Cod.</th>
                        <th class="px-2 py-1 text-left">Descr.</th>
                        <th class="px-2 py-1 text-left">Ø</th>
                        <th class="px-2 py-1 text-left">m²</th>
                        <th class="px-2 py-1 text-left">Url</th>
                        <th class="px-2 py-1 text-left">Acc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filtrosPorModelo[$modelo->id] as $filtro)
                    <tr>
                        <td class="px-2 py-1">{{ $filtro->codigo }}</td>
                        <td class="px-2 py-1">{{ $filtro->descripcion }}</td>
                        <td class="px-2 py-1">{{ $filtro->diametro }}</td>
                        <td class="px-2 py-1">{{ $filtro->superficie_filtrante }}</td>
                        <td class="px-2 py-1">
                            @if (empty($filtro->url))
                            No
                            @else
                            <a target="_blank" href="{{ $filtro->url }}">Url</a>
                            @endif
                        </td>
                        <td class="w-1/12 px-2 py-1 align-middle">
                            <div class="flex justify-center">
                                <a class="text-primary tamaño-logos mb-1 mr-1"
                                    href="{{ route('admin.filtros.edit', $filtro->id) }}">
                                    <i class='fas fa-edit'></i>
                                </a>
                                <form action="{{ route('admin.filtros.delete', $filtro->id) }}" method="GET"
                                    class="inline-block formulario-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button class="tamaño-logos" type="submit"
                                        style="background: none; border: none; padding: 0; color: red;">
                                        <i class='fas fa-eraser'></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        @endif
        @endforeach
    </div>

    @stop

    @section('css')
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    @stop

    @section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
    @stop