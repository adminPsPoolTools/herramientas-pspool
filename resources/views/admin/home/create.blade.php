@extends('adminlte::page')

@section('title', 'Nuevo Card')

@section('content_header')
<h1>Crear nuevo card</h1>
@stop

@section('content')

<div class="float-left w-3/4">
    <div class="float-left w-3/4">
        <div class="p-4 overflow-x-auto bg-white rounded-lg shadow-md">
            <form id="cardsForm" class="space-y-4">
                @csrf
                <input type="hidden" value="" name="id" id="id">
                <div>
                    <label for="">¿Url interna laravel o externa https?</label>
                    <select name="int_ext" id="int_ext" class="w-full px-3 py-2 border border-gray-400 rounded-md">
                        <option value="interna">Url Interna</option>
                        <option value="externa">Url Externa</option>
                    </select>
                    <span class="text-sm text-red-500" id="error-int_ext"></span>
                </div>
                <div>
                    <label for="">Ruta laravel o Ruta externa https</label>
                    <input type="text" name="url" id="url" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Url Card">
                    <span class="text-sm text-red-500" id="error-url"></span>
                </div>
                <div>
                    <label for="">Alt imagen</label>
                    <input type="text" name="alt_title" id="alt_title" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Descripción">
                    <span class="text-sm text-red-500" id="error-alt_title"></span>
                </div>
                <div>
                    <label for="">Nombre imagen(dentro de storage/img)</label>
                    <input type="text" name="imagen" id="imagen" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Imagen">
                    <span class="text-sm text-red-500" id="error-imagen"></span>
                </div>
                <div>
                    <label for="">Titulo card</label>
                    <input type="text" name="titulo" id="titulo" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Titulo Card">
                    <span class="text-sm text-red-500" id="error-titulo"></span>
                </div>
                <div>
                    <label for="">Parrafo card</label>
                    <input type="text" name="parrafo" id="parrafo" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Parrafo Card">
                    <span class="text-sm text-red-500" id="error-parrafo"></span>
                </div>
                <div>
                    <label for="">Nombre boton</label>
                    <input type="text" name="boton" id="boton" value=""
                        class="w-full px-3 py-2 border border-gray-400 rounded-md" placeholder="Nombre Botón">
                    <span class="text-sm text-red-500" id="error-boton"></span>
                </div>
                <div>
                    <label for="">Tarjeta Activa en producción</label>
                    <select name="activo" id="activo" class="w-full px-3 py-2 border border-gray-400 rounded-md">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                    </select>

                    <span class="text-sm text-red-500" id="error-int_ext"></span>
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
    document.getElementById('cardsForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Limpiar errores previos
        document.getElementById('error-url').textContent = '';
        document.getElementById('error-alt_title').textContent = '';
        document.getElementById('error-imagen').textContent = '';
        document.getElementById('error-titulo').textContent = '';
        document.getElementById('error-parrafo').textContent = '';
        document.getElementById('error-boton').textContent = '';

        // Ocultar mensaje de éxito
        document.getElementById('successMessage').classList.add('hidden');

        // Obtener datos del formulario
        const formData = new FormData(this);
        const id = document.getElementById('id').value;

        // Enviar solicitud AJAX
        axios.post('{{ route('admin.home.store') }}', formData)
            .then(response => {
                // Manejar respuesta exitosa
                document.getElementById('successMessage').classList.remove('hidden');
                this.reset();
            })
            .catch(error => {
                if (error.response && error.response.data.errors) {
                    // Manejar errores de validación
                    const errors = error.response.data.errors;
                    if (errors.url) {
                        document.getElementById('error-url').textContent = errors.url[0];
                    }
                    if (errors.alt_title) {
                        document.getElementById('error-alt_title').textContent = errors.alt_title[0];
                    }
                    if (errors.imagen) {
                        document.getElementById('error-imagen').textContent = errors.imagen[0];
                    }
                    if (errors.titulo) {
                        document.getElementById('error-titulo').textContent = errors.titulo[0];
                    }
                    if (errors.parrafo) {
                        document.getElementById('error-parrafo').textContent = errors.parrafo[0];
                    }
                    if (errors.boton) {
                        document.getElementById('error-boton').textContent = errors.boton[0];
                    }
                }
            });
    });
</script>
@stop
