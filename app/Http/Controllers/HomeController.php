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
        return response()->json($region, 200);
    }
    public function getProvincia($codigo)
    {
        $region = Region::select('id')->where('codigo',$codigo)->first();
        $provincia = Provincia::select('id','codigo','nombre')
                                ->where('idregion',$region->id)
                                ->get();
        return response()->json($provincia, 200);
    }
    public function getDistrito($codigo)
    {
        $provincia = Provincia::select('id')->where('codigo',$codigo)->first();
        $distrito = Distrito::select('id','codigo','nombre')
                                ->where('idprovincia',$provincia->id)
                                ->get();
        return response()->json($distrito, 200);
    }
    public function getUbigeos()
    {
        $ubigeos = Distrito::select('id','codigo','descripcion')->get();
        return response()->json($ubigeos, 200);
    }
}
