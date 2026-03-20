@extends('adminlte::page')

@section('title', 'Filtros')

@section('content_header')
<h1>Crear nuevo Filtro</h1>
@stop

@section('content')

<div class="float-left w-2/4">
    <div class="float-left w-2/4">
        <div class="p-4 overflow-x-auto bg-white rounded-lg shadow-md">
            <form id="cloradoresForm" class="space-y-4">
                @csrf

                <div class="grid gap-4 mb-2">
                    <div>
                        <label for="tipo_filtro" class="block text-sm font-medium text-gray-700">Tipo de
                            piscina</label>
                        <select name="tipo_filtro" id="tipo_filtro" onchange="toggleInput()"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="privada">Privada</option>
                            <option value="publica">Pública</option>
                        </select>
                        <span class="text-sm text-red-500" id="error-tipo_filtro"></span>
                    </div>
                </div>
                <div>
                    <input type="text" name="codigo" id="codigo" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Código artículo">
                    <span class="text-sm text-red-500" id="error-codigo"></span>
                </div>
                <div>
                    <input type="text" name="descripcion" id="descripcion" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Descripción">
                    <span class="text-sm text-red-500" id="error-descripcion"></span>
                </div>
                <div>
                    <select name="fk_modelo" id="fk_modelo" class="w-full px-3 py-2 border border-gray-400 rounded-md">
                        @foreach ($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->descripcion }}</option>
                        @endforeach
                    </select>
                    <span class="text-sm text-red-500" id="error-fk_modelo"></span>
                </div>
                <div>
                    <input type="text" name="diametro" id="diametro" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Diámetro filtro">
                    <span class="text-sm text-red-500" id="error-diametro"></span>
                </div>
                <div>
                    <input type="text" name="superficie_filtrante" id="superficie_filtrante" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Superficie filtrante">
                    <span class="text-sm text-red-500" id="error-superficie_filtrante"></span>
                </div>
                <div>
                    <input type="text" name="url" id="url" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Url web">
                    <span class="text-sm text-red-500" id="error-url"></span>
                </div>
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Guardar
                    </button>
                </div>
            </form>
            <div id="successMessage"
                class="hidden px-4 py-3 mt-4 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md"
                role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="w-6 h-6 mr-4 text-teal-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
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
        document.getElementById('error-diametro').textContent = '';
        document.getElementById('error-url').textContent = '';

        // Ocultar mensaje de éxito
        document.getElementById('successMessage').classList.add('hidden');

        // Obtener datos del formulario
        const formData = new FormData(this);

        // Enviar solicitud AJAX
        axios.post('{{ route('admin.filtros.store') }}', formData)
            .then(response => {
                // Manejar respuesta exitosa
                document.getElementById('successMessage').classList.remove('hidden');
                this.reset();
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
                    if (errors.diametro) {
                        document.getElementById('error-diametro').textContent = errors.valor[0];
                    }
                    if (errors.url) {
                        document.getElementById('error-url').textContent = errors.url[0];
                    }
                    if (errors.tipo_filtro) {
                        document.getElementById('error-url').textContent = errors.tipo_filtro[0];
                    }
                }
            });
    });
</script>
@stop