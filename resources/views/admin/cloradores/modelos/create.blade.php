@extends('adminlte::page')

@section('title', 'Cloradores')

@section('content_header')
    <h1>Crear nuevo modelo clorador </h1>
@stop

@section('content')

<div class="w-2/4 float-left">
    <div class="overflow-x-auto p-4 bg-white shadow-md rounded-lg">
        <form action="{{ route('admin.modelos.store') }}" method="POST" class="space-y-4">

            @csrf
            <div class="mb-4">
                <input type="text" name="descripcion" value="" class="border border-gray-400 rounded-md px-3 py-2 w-full" placeholder="Descripción">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                    Guardar
                </button>
            </div>
        </form>
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
