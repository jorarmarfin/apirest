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
}
