<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfmController extends Controller
{
    //Grados afm
    private $afmGrado1      = null;
    private $afmGrado2      = null;
    private $afmGrado3      = null;
    //Sacos
    private $sacosGrado1    = null;
    private $sacosGrado2    = null;
    private $sacosGrado3    = null;
    private $totalKilosSegunSacos       = null;
    private $totalKilosSegunCalculos    = null;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->query('user');
        return view('afm.index', compact('user'));
    }
    public function calcular(Request $request)
    {

        //Pedimos valores obligatorios
        $request->validate([
            'carga'         => 'required|numeric|min:0',
            'tipo_filtro'   => 'required',
            'diametro'      => 'required'
        ]);

        $cargaSilex     = $request->carga;
        $diametroFiltro = $request->diametro;
        $tipoFiltro     = $request->tipo_filtro;



        if ($tipoFiltro == "brazo") {
            //Calculamos los sacos de afm grado 2 y 3 en funcion del diamtero del filtro es mayor a 800.
            if ($diametroFiltro == 'si') { //con brazos colectores
                //Calculamos el afm grado 1
                $this->afmGrado1 =  round((0.5 * ($cargaSilex * 0.85)), 0);
                $this->afmGrado2 =  round((0.25 * ($cargaSilex * 0.85)), 0);
                $this->afmGrado3 =  round((0.25 * ($cargaSilex * 0.85)), 0);
            } else {
                $this->afmGrado1 = round((0.5 * ($cargaSilex * 0.85)), 0);
                $this->afmGrado2 = round((0.5 * ($cargaSilex * 0.85)), 0);
                $this->afmGrado3 = 0.00;
            }
        } else if ($tipoFiltro == "crepina") {
            $this->afmGrado1 = round((0.5 * ($cargaSilex * 0.85)), 0);
            $this->afmGrado2 = round((0.5 * ($cargaSilex * 0.85)), 0);
            $this->afmGrado3 = 0.00;
        }


        //Calculamos los sacos que necesitamos
        $this->sacosGrado1 = ceil($this->afmGrado1 / 21);       //ceil redondea hacia arriba: 2.01 = 3
        $this->sacosGrado2 = floor($this->afmGrado2 / 21);    //floor redondea hacia abajo: 2.99 = 2
        $this->sacosGrado3 = floor($this->afmGrado3 / 21);    //floor redondea hacia abajo: 2.99 = 2

        //Calculamos el total de kilos con sacos de 21 kg.
        $saco21kg = 21;
        $this->totalKilosSegunSacos = ($this->sacosGrado1 + $this->sacosGrado2 + $this->sacosGrado3) * $saco21kg;

        //Sacamos el calculo de kilos segun la carga de afm calculada.
        $this->totalKilosSegunCalculos = $this->afmGrado1 + $this->afmGrado2 + $this->afmGrado3;


        // Devolver la respuesta en formato JSON
        return response()->json([
            'carga'         => $cargaSilex,
            'diametro'      => $diametroFiltro,
            'afmGrado1'     => $this->afmGrado1,
            'afmGrado2'     => $this->afmGrado2,
            'afmGrado3'     => $this->afmGrado3,
            'sacosGrado1'   => $this->sacosGrado1,
            'sacosGrado2'   => $this->sacosGrado2,
            'sacosGrado3'   => $this->sacosGrado3,
            'totalKilosSegunSacos'      => $this->totalKilosSegunSacos,
            'totalKilosSegunCalculos'   => $this->totalKilosSegunCalculos,
            'tipoFiltro'                => $tipoFiltro
        ]);
    }
}
