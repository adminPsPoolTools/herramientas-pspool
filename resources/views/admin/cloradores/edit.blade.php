@extends('adminlte::page')

@section('title', 'Cloradores')

@section('content_header')
    <h1>Crear nuevo clorador</h1>
@stop

@section('content')

<div class="w-2/4 float-left">
    <div class="w-2/4 float-left">
        <div class="overflow-x-auto p-4 bg-white shadow-md rounded-lg">
            <form id="cloradoresForm" class="space-y-4">
                @csrf
                <input type="hidden" value="{{$cloradores->id}}" name="id" id="id">
                <div>
                    <input type="text" name="codigo" id="codigo" value="{{$cloradores->codigo}}" class="border border-gray-400 rounded-md px-3 py-2 w-full" placeholder="Código artículo">
                    <span class="text-red-500 text-sm" id="error-codigo"></span>
                </div>
                <div>
                    <input type="text" name="descripcion" id="descripcion" value="{{$cloradores->descripcion}}" class="border border-gray-400 rounded-md px-3 py-2 w-full" placeholder="Descripción">
                    <span class="text-red-500 text-sm" id="error-descripcion"></span>
                </div>
                <div>
                    <select name="fk_modelo" id="fk_modelo" class="border border-gray-400 rounded-md px-3 py-2 w-full">
                        @foreach ($modelos as $modelo)
                            <option value="{{ $modelo->id }}">{{ $modelo->descripcion }}</option>
                        @endforeach
                    </select>
                    <span class="text-red-500 text-sm" id="error-fk_modelo"></span>
                </div>
                <div>
                    <input type="text" name="valor" id="valor" value="{{$cloradores->valor}}" class="border border-gray-400 rounded-md px-3 py-2 w-full" placeholder="Valor producción">
                    <span class="text-red-500 text-sm" id="error-valor"></span>
                </div>
                <div>
                    <input type="text" name="url" id="url" value="{{$cloradores->url}}" class="border border-gray-400 rounded-md px-3 py-2 w-full" placeholder="Url web">
                    <span class="text-red-500 text-sm" id="error-url"></span>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
                        Guardar
                    </button>
                </div>
            </form>
            <div id="successMessage" class="hidden bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mt-4" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Registro guardado con éxito</p>
                        <p class="text-sm">El nuevo clorador ha sido guardado correctamente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('cloradoresForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Limpiar errores previos
        document.getElementById('error-codigo').textContent = '';
        document.getElementById('error-descripcion').textContent = '';
        document.getElementById('error-fk_modelo').textContent = '';
        document.getElementById('error-valor').textContent = '';
        document.getElementById('error-url').textContent = '';

        // Ocultar mensaje de éxito
        document.getElementById('successMessage').classList.add('hidden');

        // Obtener datos del formulario
        const formData = new FormData(this);
        const id = document.getElementById('id').value;

        // Enviar solicitud AJAX
        axios.post(`/admin/ActualizarClorador/${id}`, formData)
            .then(response => {
                // Manejar respuesta exitosa
                document.getElementById('successMessage').classList.remove('hidden');
                //this.reset();
            })
            .catch(error => {
                if (error.response && error.response.data.errors) {
                    // Manejar errores de validación
                    const errors = error.response.data.errors;
                    if (errors.codigo) {
                        document.getElementById('error-codigo').textContent = errors.codigo[0];
                    }
                    if (errors.descripcion) {
                        document.getElementById('error-descripcion').textContent = errors.descripcion[0];
                    }
                    if (errors.fk_modelo) {
                        document.getElementById('error-fk_modelo').textContent = errors.fk_modelo[0];
                    }
                    if (errors.valor) {
                        document.getElementById('error-valor').textContent = errors.valor[0];
                    }
                    if (errors.url) {
                        document.getElementById('error-url').textContent = errors.url[0];
                    }
                }
            });
    });
</script>
@stop
