@extends('adminlte::page')

@section('title', 'Cloradores')

@section('content_header')
    <h1>Editar Modelo - {{$modelo->descripcion}} </h1>
@stop

@section('content')

<div class="w-1/3 float-left">
    <div class="overflow-x-auto">
        <form action="{{ route('admin.modelos.update' , $modelo->id) }}" method="POST" class="float-right">
            
            @csrf
            <input type="text" name="descripcion" value="{{$modelo->descripcion}}" class="border border-gray-400 rounded-md px-3 py-1 mr-2" placeholder="Descripción">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar
            </button>
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
