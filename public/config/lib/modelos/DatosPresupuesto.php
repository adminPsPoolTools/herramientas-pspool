<?php

namespace Modelos;

class DatosPresupuesto
{
    /* $modelo, $subtipo, $profundidadTapa, $profundidadPiscina, $tipoEscalera, $sentidoEscalera, $largoEscalera,
        $anchoEscalera, $anchoPiscina, $largoPiscina, $tipoLamina, $cliente, $conViga, $conTapa, $escaleraRomana, $colorLamina, $tipoInstalacion, $provincia,
        $importeInstalacion, $datosClienteFinal, */
    public $modelo;
    public $subtipo;
    public $profundidadTapa;
    public $profundidadPiscina;
    public $tipoEscalera;
    public $sentidoEscalera;
    public $largoEscalera;
    public $anchoEscalera;
    public $anchoPiscina;
    public $largoPiscina;
    public $tipoLamina;
    public $cliente;
    public $conViga = false;
    public $conTapa = false;
    public $esRomana = false;
    public $escaleraRomana;
    public $colorLamina;
    public $tipoInstalacion;
    public $provincia;
    public $importeInstalacion;
    public $datosClienteFinal;
    public $tipoTapa;
    public $tipoPiscina;

    public function __construct(
        $modelo,
        $subtipo,
        $profundidadTapa,
        $profundidadPiscina,
        $tipoEscalera,
        $sentidoEscalera,
        $largoEscalera,
        $anchoEscalera,
        $anchoPiscina,
        $largoPiscina,
        $tipoLamina,
        $cliente,
        $conViga,
        $conTapa,
        $escaleraRomana,
        $colorLamina,
        $tipoInstalacion,
        $provincia,
        $importeInstalacion,
        $datosClienteFinal,
        $tipoTapa,
        $tipoPiscina
    ) {
        $this->modelo               = $modelo;
        $this->subtipo              = $subtipo = strtoupper(trim($subtipo));
        $this->profundidadTapa      = $profundidadTapa;
        $this->profundidadPiscina   = $profundidadPiscina;
        $this->tipoEscalera         = $tipoEscalera;
        $this->sentidoEscalera      = $sentidoEscalera;
        $this->largoEscalera        = $largoEscalera;
        $this->anchoEscalera        = $anchoEscalera;
        $this->anchoPiscina         = $anchoPiscina;
        $this->largoPiscina         = $largoPiscina;
        $this->tipoLamina           = $tipoLamina;
        $this->cliente              = $cliente;
        $this->esRomana             = ($escaleraRomana == "ROMANA");
        $this->escaleraRomana       = $escaleraRomana;
        $this->colorLamina          = $colorLamina;
        $this->tipoInstalacion      = $tipoInstalacion;
        $this->provincia            = $provincia;
        $this->importeInstalacion   = $importeInstalacion;
        $this->datosClienteFinal    = $datosClienteFinal;
        $this->tipoTapa             = $tipoTapa;
        $this->tipoPiscina          = $tipoPiscina;

        if ($modelo != "S") // SI LA ESCALERA NO ES SUMERGIDA NO PUEDE TENER NI TAPA, NI VIGA, NI SUBTIPO
        {
            $this->conViga = false;
            $this->conTapa = false;
        } else {
            $this->conViga = $conViga;
            $this->conTapa = $conTapa;
        }
    }

    public function getInstalacion()
    {
        $cInstalacion = null;
        //CALCULAMOS LA INSTALACION EN FUNCION DEL TIPO QUE SE HAYA ELEGIDO
        switch ($this->subtipo) {
            case 'DECK':
                $cInstalacion = "22208";
                break;
            case 'TOP':
                $cInstalacion = "22208";
                break;
            case 'DUO':
                $cInstalacion = "22210";
                break;
            case 'CAVE':
                $cInstalacion = "22210";
                break;
            default:    // ALTEA | Van a tener la misma instalacion
                $cInstalacion = "22209";
                break;
        }
        return $cInstalacion;
    }
}
