@props(['user'])

@php
$userEncoded = base64_encode($user);
@endphp

<div>
    <a href="{{ route('home', ['token' => 'l31ucJISzo6nI4s7y7wpict2EsDtPONc8HeiIXFYHiu59S8ErUUSl9K7pxdjW1Fs', 'user' => $userEncoded]) }}"
        class="mt-3 btn-volver">Volver</a>
</div>