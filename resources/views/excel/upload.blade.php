<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Copiar SQL con código presupuesto</title>
    <!-- Google Material Icons CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f9fb;
            padding: 2rem 0;
            margin: 0;
        }

        .csv-upload-form {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            background: #fff;
            padding: 2rem 2rem 1.5rem 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(50, 50, 50, 0.07);
            max-width: 420px;
            margin: 0 auto 2rem auto;
        }

        .csv-upload-form label {
            font-weight: bold;
            color: #555;
            font-size: 1.1rem;
        }

        .csv-upload-form input[type="file"],
        .csv-upload-form input[type="text"] {
            padding: 0.2rem;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn-main {
            background: linear-gradient(90deg, #57bb8a 0%, #31a1ec 100%);
            color: white;
            border: none;
            font-weight: bold;
            padding: 0.7rem 1.4rem;
            border-radius: 6px;
            font-size: 1.1rem;
            box-shadow: 0 1px 4px rgba(50, 50, 50, 0.07);
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-main:hover {
            background: linear-gradient(90deg, #31a1ec 0%, #57bb8a 100%);
        }

        .sql-buttons-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 1.5rem 0;
        }

        .btn-copy {
            display: flex;
            align-items: center;
            background: linear-gradient(90deg, #8839fd 0%, #3753e8 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 700;
            font-size: 1rem;
            padding: 0.7rem 1.3rem;
            gap: 0.5em;
            min-width: 120px;
            cursor: pointer;
            transition: background 0.18s;
            box-shadow: 0 2px 6px rgba(30, 80, 208, 0.04);
        }

        .btn-copy.copied {
            background: #4CAF50 !important;
            color: white;
        }

        .btn-copy[disabled] {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .blue-text {
            color: #1976D2;
        }

        .green-text {
            color: #02954a;
        }

        .input-error {
            border-color: #e74242 !important;
        }

        .input-hint {
            color: #e74242;
            font-size: 0.98em;
        }
    </style>
</head>

<body>

    <div class="csv-upload-form" style="max-width:600px;">
        <label for="codigo_presu">Código de presupuesto:</label>
        <input type="text" id="codigo_presu" name="codigo_presu" placeholder="Ejemplo: 2508352">
        <div id="presu-hint" class="input-hint" style="display:none">Introduce un código de presupuesto</div>

        <div class="sql-buttons-container">
            <button id="btn-copy-english" type="button" class="btn-copy">
                <span class="material-icons">content_copy</span> Copiar SQL ING
            </button>
            <button id="btn-copy-spanish" type="button" class="btn-copy">
                <span class="material-icons">content_copy</span> Copiar SQL ESP
            </button>
        </div>
    </div>

    <form action="{{ route('csv.to.excel') }}" method="POST" enctype="multipart/form-data" class="csv-upload-form">
        @csrf
        <label for="csv_file">Selecciona un archivo CSV:</label>
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit" class="btn-main">Convertir a Excel</button>
    </form>

    <script>
        function copiarAlPortapapeles(lang) {
    const codigo = document.getElementById('codigo_presu').value.trim();
    const input = document.getElementById('codigo_presu');
    const hint = document.getElementById('presu-hint');

    if (!codigo || isNaN(codigo)) {
        input.classList.add('input-error');
        hint.style.display = "";
        setTimeout(() => {
            input.classList.remove('input-error');
            hint.style.display = "none";
        }, 2000);
        return;
    }

    input.classList.remove('input-error');
    hint.style.display = "none";

    // Generar SQL según el idioma
    const sql = (lang === 'en') ? `
select
linpresu.linea, articulos.codigo, articulos.libre6 as Descripcion, articulos.libre7 as Comentario, linpresu.cantidad, linpresu.pvp,
round(linpresu.dto,2), linpresu.importe, subctapresu.codigo as Subcuenta, subctapresu.descripcion as Descripcion_Subcuenta,
clientes.codigo as Codigo_Cliente, clientes.descripcion as Cliente, clientes.direccion as Direccion, clientes.cp as cp,
clientes.poblacion as poblacion, clientes.provincia as provincia, clientes.telefonofijo as tlf, clientes.correo as correo,
presupuestos.codigo cod_presu, presupuestos.fecha as fecha, presupuestos.titulo, presupuestos.proyecto as proyecto,
presupuestos.baseimponiblebruto as base_imponible_bruto, round(presupuestos.pdto, 2) as dto_adicional,
presupuestos.importedto as importe_dto, presupuestos.baseimponible as base_imponible, presupuestos.total as total,
impuestos.iva as impuesto, formaspago.descripcion as FORMA_PAGO
from presupuestos
left join formaspago on formaspago.codigo = presupuestos.formadepago
left join impuestos on impuestos.codigo = presupuestos.impuesto
left join clientes on clientes.codigo = presupuestos.cliente
left join linpresu on presupuestos.codigo = linpresu.presupuesto
left join articulos on articulos.codigo = linpresu.articulo
left join familias on familias.codigo = articulos.familia
left join referencia_proveedor(0,0,articulos.codigo) on 0=0
left join subctapresu on subctapresu.codigo = linpresu.subcuenta
where presupuestos.codigo = ${codigo}
order by linpresu.linea;
` : `
select
linpresu.linea,
articulos.codigo,
articulos.descripcion as Descripcion,
articulos.comentario as Comentario,
linpresu.cantidad,
linpresu.pvp,
round(linpresu.dto,2),
linpresu.importe,
subctapresu.codigo as Subcuenta,
subctapresu.descripcion as Descripcion_Subcuenta,
clientes.codigo as Codigo_Cliente,
clientes.descripcion as Cliente,
clientes.direccion as Direccion,
clientes.cp as cp,
clientes.poblacion as poblacion,
clientes.provincia as provincia,
clientes.telefonofijo as tlf,
clientes.correo as correo,
presupuestos.codigo cod_presu,
presupuestos.fecha as fecha,
presupuestos.titulo,
presupuestos.proyecto as proyecto,
presupuestos.baseimponiblebruto as base_imponible_bruto,
round(presupuestos.pdto, 2) as dto_adicional,
presupuestos.importedto as importe_dto,
presupuestos.baseimponible as base_imponible,
presupuestos.total as total,
impuestos.iva as impuesto,
formaspago.descripcion as FORMA_PAGO
from presupuestos
left join formaspago on formaspago.codigo = presupuestos.formadepago
left join impuestos on impuestos.codigo = presupuestos.impuesto
left join clientes on clientes.codigo = presupuestos.cliente
left join linpresu on presupuestos.codigo = linpresu.presupuesto
left join articulos on articulos.codigo = linpresu.articulo
left join familias on familias.codigo = articulos.familia
left join referencia_proveedor(0,0,articulos.codigo) on 0=0
left join subctapresu on subctapresu.codigo = linpresu.subcuenta
where presupuestos.codigo = ${codigo}
order by linpresu.linea;
`;

    // Copiar al portapapeles
    if (navigator.clipboard) {
        navigator.clipboard.writeText(sql.trim()).then(() => {
            mostrarExito();
        }, mostrarError);
    } else {
        const areaTemp = document.createElement('textarea');
        areaTemp.value = sql.trim();
        document.body.appendChild(areaTemp);
        areaTemp.select();
        try {
            document.execCommand('copy');
            mostrarExito();
        } catch (err) {
            mostrarError();
        }
        document.body.removeChild(areaTemp);
    }

    function mostrarExito() {
        alert('Sql copiada');
    }

    function mostrarError() {
        alert("No se pudo copiar la sentencia al portapapeles.");
    }
}

// Asignar eventos
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('btn-copy-english').addEventListener('click', function (e) {
        copiarAlPortapapeles('en', e.target);
    });
    document.getElementById('btn-copy-spanish').addEventListener('click', function (e) {
        copiarAlPortapapeles('es', e.target);
    });
});
    </script>

</body>

</html>
