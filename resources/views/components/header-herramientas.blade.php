@props(['user'])

<x-header title="{{ $title }}" description="{{ $description }}" background="{{ $background }}" :user="$user" />

<style>
    /* General styles */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -1rem;
        margin-left: -1rem;
    }

    .col {
        padding-right: 1rem;
        padding-left: 1rem;
        margin-bottom: 1rem;
        /* Espaciado entre columnas */
    }

    .py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .text-center {
        text-align: center;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    /* Responsive styles */
    @media screen and (max-width: 1268px) {
        .container-wrapper {
            width: 100%;
            padding: 0 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container_titulo,
        .texto {
            width: 100% !important;
            text-align: center;
            font-size: 18px !important;

        }

        .texto h1 {
            width: 100% !important;
            text-align: left;
            font-size: 40px !important;

        }

        .menu ul {
            flex-direction: column;
            align-items: center;
            width: 100% !important;
        }

        .menu ul li {
            margin: 10px 0;
            width: 100% !important;
            border-bottom: solid 1px white;
        }

        .album {
            margin-top: 100px !important;
        }

        .contenido {
            margin-top: -20px !important;
        }

        .container_menu {
            width: 100% !important;
        }

        .btn-calcular {
            width: 100% !important;
        }

        .flex {
            display: inline;
        }

    }
</style>
