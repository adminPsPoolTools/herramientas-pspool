@extends('adminlte::page')

@section('title', 'Cloradores')

@section('content_header')
    <h1>Modelos</h1>
@stop

@section('content')
    <div class="w-1/3 float-left">
        <a class="text-primary tamaño-logos mb-1 mr-1" href="{{ route('admin.modelos.bombas.create') }}">Nuevo modelo <i
            class='fas fa-plus-circle'></i></a>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left">Descripción</th>
                        <th class="py-3 px-6 text-left">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modelos as $modelo)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{$modelo->descripcion}}</td>

                            <td class="w-1/12 align-middle">
                                <div class="align-middle text-center">
                                    <a class="text-primary tamaño-logos mb-1 mr-1"
                                        href="{{ route('admin.modelos.bombas.edit', $modelo->id) }}">
                                        <i class='fas fa-edit'></i>
                                    </a>
                                </div>
                                <div class="align-middle text-center">
                                    <form action="{{ route('admin.modelos.bombas.delete', $modelo->id) }}" method="GET"
                                        class="formulario-eliminar">
                                        @csrf
                                        @method('delete')
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
