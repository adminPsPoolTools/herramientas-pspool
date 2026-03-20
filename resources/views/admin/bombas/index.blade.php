@extends('adminlte::page')

@section('title', 'Filtros')

@section('content_header')
<h1>Bombas</h1>
@stop

@section('content')

<div class="float-left w-full mb-5 ">
    <a class="text-primary tamaño-logos mb-1 mr-1" href="{{ route('admin.bombas.create') }}">Nueva Bomba <i
            class='fas fa-plus-circle'></i></a>

    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3">
        @foreach ($modelos as $modelo)
        @if ($bombasPorModelo->has($modelo->id))
        <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="p-1 text-white bg-blue-500">
                <h6 class="text-sm font-bold">Modelo: {{ $modelo->descripcion }}</h2>
            </div>
            <table class="min-w-full table-auto">
                <thead class="text-white bg-blue-500">
                    <tr>
                        <th class="px-2 py-1 text-left">Cod.</th>
                        <th class="px-2 py-1 text-left">Descr.</th>
                        <th class="px-2 py-1 text-left">Caudal</th>
                        <th class="px-2 py-1 text-left">Url</th>
                        <th class="px-2 py-1 text-left">Acc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bombasPorModelo[$modelo->id] as $bomba)
                    <tr>
                        <td class="px-2 py-1">{{ $bomba->codigo }}</td>
                        <td class="px-2 py-1">{{ $bomba->descripcion }}</td>
                        <td class="px-2 py-1">{{ $bomba->caudal }}</td>
                        <td class="px-2 py-1">
                            @if (empty($bomba->url))
                            No
                            @else
                            <a target="_blank" href="{{ $bomba->url }}">Url</a>
                            @endif
                        </td>
                        <td class="w-1/12 px-2 py-1 align-middle">
                            <div class="flex justify-center">
                                <a class="text-primary tamaño-logos mb-1 mr-1"
                                    href="{{ route('admin.bombas.edit', $bomba->id) }}">
                                    <i class='fas fa-edit'></i>
                                </a>
                                <form action="{{ route('admin.bombas.delete', $bomba->id) }}" method="GET"
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
  
    </script>
    @stop