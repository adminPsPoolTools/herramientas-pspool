@extends('adminlte::page')

@section('title', 'Cards Home')

@section('content_header')
<h1>Cards de la home.</h1>
@stop

@section('content')

<div class="float-left w-full mb-5 ">
    <a class="text-primary tamaño-logos mb-1 mr-1" href="{{ route('admin.home.create') }}">Nuevo Card <i
            class='fas fa-plus-circle'></i></a>

    <div class="grid grid-cols-1 gap-2">

        <div class="col-span-1 overflow-hidden bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="text-white bg-blue-500">
                    <tr>
                        <th class="px-2 py-1 text-left">id</th>
                        <th class="px-2 py-1 text-left">url</th>
                        <th class="px-2 py-1 text-left">Alt_Title_url</th>
                        <th class="px-2 py-1 text-left">imagen</th>
                        <th class="px-2 py-1 text-left">Titulo</th>
                        <th class="px-2 py-1 text-left">Parrafo</th>
                        <th class="px-2 py-1 text-left">Texto Boton</th>
                        <th class="px-2 py-1 text-left">Activo</th>
                        <th class="px-2 py-1 text-left">Accion</th>
                    </tr>
                </thead>
                @foreach ($cards as $card)
                <tbody>
                    <tr>
                        <td class="px-2 py-1">{{ $card->id }}</td>
                        <td class="px-2 py-1">{{ $card->url }}</td>
                        <td class="px-2 py-1">{{ $card->alt_title }}</td>
                        <td class="px-2 py-1">{{ $card->imagen }}</td>
                        <td class="px-2 py-1">{{ $card->titulo }}</td>
                        <td class="px-2 py-1">{{ $card->parrafo }}</td>
                        <td class="px-2 py-1">{{ $card->boton }}</td>
                        <td class="px-2 py-1">{{ $card->activo }}</td>

                        <td class="w-1/12 px-2 py-1 align-middle">
                            <div class="flex justify-center">
                                <a class="text-primary tamaño-logos mb-1 mr-1"
                                    href="{{ route('admin.home.edit', $card->id) }}">
                                    <i class='fas fa-edit'></i>
                                </a>
                                <form action="{{ route('admin.home.delete', $card->id) }}" method="GET"
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
                </tbody>
                @endforeach
            </table>
        </div>
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
