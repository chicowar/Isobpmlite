<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Indicadores;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Proceso;
use App\Models\User;
use App\Models\tipoproceso;
use App\Models\Analisisriesgos;
use App\Models\Abcriesgos;
use App\Models\lista_envio;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\Auth;

class ProcesosControllerVisual extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('procesosvisual');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $usuario = Auth::user();
      //
      if ($usuario->perfil == 4) {
        $iduser = $usuario->id;
        $collection_one = \Illuminate\Support\Collection::make(DB::table('procesos')
        ->join('lista_envios', function($join) use ($iduser)
          {
              $join->on('procesos.lista_de_distribucion', '=', 'lista_envios.id_proceso');
              $join->on(function($query) use ($iduser)
              {
                $query->on('lista_envios.id_usuario', '=', DB::raw("'".$iduser."'"));
              });
          })
        ->select('procesos.*')
        ->get());

        $collection_two = \Illuminate\Support\Collection::make(DB::table('procesos')
        ->leftjoin('lista_envios', function($join) use ($iduser)
          {
              $join->on('procesos.lista_de_distribucion', '=', 'lista_envios.id_proceso');
              $join->on(function($query) use ($iduser)
              {
                $query->on('lista_envios.id_usuario', '=', DB::raw("'".$iduser."'"));
              });
          })
        ->whereNull('id_proceso')
        ->where('usuario_responsable_id',$usuario->id)
        ->orwhere(function ($querys) use ($iduser) {
          $querys->whereNull('id_proceso')
          ->Where('Creador_id', '=', DB::raw("'".$iduser."'"));
        })
        ->get());

        $proceso = new \Illuminate\Database\Eloquent\Collection;
        $proceso = $collection_one->merge($collection_two);

      }else {
        $procesos = new Proceso;
        $proceso = $procesos
        ->where('idcompañia',$usuario->id_compania)
        ->get();
      }

      $Users = new User;
      $User = $Users->where('id_compania',$usuario->id_compania)
      ->where('perfil',4)
      ->get();

      $tipoprocesos = new tipoproceso;
      $tipoproceso = $tipoprocesos->orderBy('id')->get();

      $indicador = \DB::table('indicadores')
                               ->join('objetivos','indicadores.objetivo_id','=','objetivos.id')
                               ->select('indicadores.*','objetivos.id_compania')
                               ->where('objetivos.id_compania','=',$usuario->id_compania)
                               ->get();

      //dd($objetivos->all());
      //return view('CreateProceso',compact('proceso','user')); //=> $proceso->toArray()], User);
      return View('/Principales/procesosvisual', compact('proceso','User','tipoproceso','indicador'));
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $usuario = Auth::user();
      $procesos = new Proceso;
      $proceso = $procesos->where('id',$id)->first();
      //
      $archivoabrir = $proceso->nombreunicoarchivo;
      if (!empty($archivoabrir)) {
        $rutacompleta = public_path(). "/storage/$archivoabrir";
        //$rutacompleta = "public/storage/$archivoabrir";
        $zipper = new Zipper();
        $zipper->make($rutacompleta)->folder('')->extractTo('storage/bizagi');

        foreach ($zipper->listFiles() as $lista):
          if ((stripos($lista,"index.html") !== false))
          {
            $rutaalindex = $lista;
            // $rutaalindex2 = $lista;
          }
        endforeach;

        $rutaalindex = str_replace("/","\\",$rutaalindex);

        $rutaalindex = "\storage\bizagi\\$rutaalindex";
      }

      $indicator = $proceso['indicadores'];
      $lista = $proceso['lista_de_distribucion'];

      $procesos = new Proceso;
      $proceso = $procesos->where('id',$id)->get();

      $Users = new User;
      $User = $Users->where('id_compania',$usuario->id_compania)
      ->where('perfil',4)
      ->get();

      $tipoprocesos = new tipoproceso;
      $tipoproceso = $tipoprocesos->orderBy('id')->get();


      $procesosrelacion = \DB::table('procesos')
                               ->select('procesos.*','users.usuario')
                               ->join('users','procesos.usuario_responsable_id','=','users.id')
                               ->where('procesos.id',$id)->first();

      $listaenvio = \DB::table('lista_envios')
                      ->select('lista_envios.id_proceso','users.id','users.nombre')
                      ->join('users','users.id', '=', 'lista_envios.id_usuario')
                      ->where('lista_envios.id_proceso',$lista)
                      ->get();

      //return(dd($listaenvio));

      $Users = \DB::table('users')
                      ->select('lista_envios.id_proceso','users.id','users.nombre')
                      ->leftJoin('lista_envios', function($join) use ($lista)
                        {
                            $join->on('users.id', '=', 'lista_envios.id_usuario');
                            $join->on(function($query) use ($lista)
                            {
                              $query->on('lista_envios.id_proceso', '=', DB::raw("'".$lista."'"));
                            });
                        })
                      ->where('id_compania',$usuario->id_compania)
                      ->where('perfil',4)
                      ->whereNull('id_proceso')
                      //->where('lista_envios.id_proceso',$lista)
                      ->get();
      //return(dd($User));

      $indicadoresrelacion = \DB::table('indicadores')
                               ->select('lista_indicadores_procesos.id_proceso','indicadores.id','indicadores.nombre')
                               ->leftjoin('lista_indicadores_procesos','indicadores.id','=','lista_indicadores_procesos.id_indicador')
                               ->leftjoin('procesos','lista_indicadores_procesos.id_proceso','=','procesos.indicadores')
                               ->where('lista_indicadores_procesos.id_proceso',$indicator)
                               ->get();

    //  $indicador = \DB::table('indicadores')
    //                ->select('indicadores.id','indicadores.nombre')
    //                ->join('objetivos','indicadores.objetivo_id','=','objetivos.id')
    //                ->where('objetivos.id_compania',$usuario->id_compania)
    //                ->get();

      $indicador = \DB::table('indicadores')
                       ->select('procesos.proceso','indicadores.id','indicadores.nombre')
                       ->leftJoin('lista_indicadores_procesos', function($join) use ($indicator)
                         {
                             $join->on('indicadores.id', '=', 'lista_indicadores_procesos.id_indicador');
                             $join->on(function($query) use ($indicator)
                             {
                               $query->on('lista_indicadores_procesos.id_proceso', '=', DB::raw("'".$indicator."'"));
                             });
                         })
                         ->leftjoin('procesos','lista_indicadores_procesos.id_proceso', '=', 'procesos.indicadores')
                         ->join('objetivos','indicadores.objetivo_id','=','objetivos.id')
                         ->where('objetivos.id_compania',$usuario->id_compania)
                         ->whereNull('procesos.proceso')
                       //->where('lista_indicadores_procesos.id_proceso',$indicator)
                       ->get();

    //  return(dd($indicador));

       return View('/Secundarias/ProcesosMostrar', compact('proceso','User','Users','tipoproceso','procesosrelacion','listaenvio','indicadoresrelacion','indicador','rutaalindex'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
