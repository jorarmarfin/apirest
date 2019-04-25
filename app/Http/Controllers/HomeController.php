<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Provincia;
use App\Distrito;

class HomeController extends Controller
{
    public function getRegion()
    {
        $region = Region::select('codigo','nombre')->get();
        return $region;
    }
    public function getProvincia($codigo)
    {
        $region = Region::select('id')->where('codigo',$codigo)->first();
        $provincia = Provincia::select('codigo','nombre')
                                ->where('idregion',$region->id)
                                ->get();
        return $provincia;
    }
    public function getDistrito($codigo)
    {
        $provincia = Provincia::select('id')->where('codigo',$codigo)->first();
        $distrito = Distrito::select('codigo','nombre')
                                ->where('idprovincia',$provincia->id)
                                ->get();
        return $distrito;
    }
    public function getDistritos()
    {
        $distritos = Distrito::select(\DB::raw('p.nombre as provincia,distrito.nombre as distrito'))
                                ->join('provincias as p','distrito.idprovincia','=','p.id')
                                ->take('10')
                                ->get();
        return $distritos;
    }
}
