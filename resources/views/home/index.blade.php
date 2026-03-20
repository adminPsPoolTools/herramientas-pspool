@extends('layouts.app')

@section('content')
    <main class="home">
        <x-header title="Herramientas"
            description="PS POOL quiere ayudarte con distintas herramientas que hemos desarrollado y recopilado, para facilitarte la puesta a punto de tu piscina."
            background="background-image: url({{ asset('storage/img/home/home.jpg') }})" :user="$user" />

        {{-- // IDs de usuarios que NO deben ver 'pscover.index' --}}
        @php
            $usuariosExcluidos = ['14509', '14522', '14591'];
        @endphp

        <div class="py-5 album bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-2">
                    @foreach ($cards as $index => $card)
                        @if (!in_array($user, $usuariosExcluidos) || $card->url != 'pscover.index')
                            <div class="col">
                                <div class="shadow-blue card">
                                    <div class="card-body">
                                        <h4>{{ $card->titulo }}</h4>
                                        <p class="card-text">{{ $card->parrafo }}</p>
                                    </div>
                                    <div class="card-img" style="background-image:url(storage/img/{{ $card->imagen }});">
                                        @if ($card->int_ext == 'externa')
                                            <form id="form_{{ $index }}" method="GET"
                                                action="{{ route('redirect') }}" target="_blank">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $card->id }}">
                                                <button type="button" class="border btn btn-acceder"
                                                    onclick="submitForm('{{ $index }}')">{{ $card->boton }}</button>
                                            </form>
                                        @else
                                            <form id="form_{{ $index }}" method="GET"
                                                action="{{ route($card->url) }}">

                                                @csrf
                                                <input type="hidden" name="id" value="{{ $card->id }}">
                                                <input type="hidden" name="user" value="{{ $user }}">
                                                <button type="button" class="border btn btn-acceder"
                                                    onclick="submitForm('{{ $index }}')">{{ $card->boton }}</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <script>
        function submitForm(index) {
            document.getElementById('form_' + index).submit();
        }
    </script>
@endsection
