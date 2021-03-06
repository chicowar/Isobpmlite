<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Productos;
use App\Models\Clientes;
use App\Models\User;
use App\Models\Areas;
use App\Models\Empresas;
use App\Models\Status;
use App\Models\Plans;
use App\Models\Documentos;
use App\Models\documentoseliminados;
use App\Models\Noticias;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades;

class AdministradosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //  $Users = Auth::user();

      //$usuario = \Illuminate\Support\Collection::make(DB::table('users')
    //  ->join('areas','areas.id','=','users.id_area')
    //  ->select('users.*','areas.nombre as area')
    //  ->where('users.id',3)
    //  ->get());

      return view('/Principales/perfil');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function documentos()
    {
      $usuarios = Auth::user();
      if ($usuarios->perfil != 4) {
        $documentos = new Documentos;
        $documento = $documentos->where('id_compania',$usuarios->id_compania)->where('status','!=',1)->get();

        return view('/Principales/admindoc', compact('documento'));
      }else {
        return redirect('bienvenida');
      }
    }

    public function doceliminados()
    {
      $usuarios = Auth::user();
      if ($usuarios->perfil != 4) {
        $documento = $mejorasid = \DB::table('documentoseliminados')
                     ->leftjoin('users','documentoseliminados.id_user','=','users.id')
                     ->select('documentoseliminados.*', 'users.nombre as responsable')
                     ->where('documentoseliminados.id_compania',$usuarios->id_compania)
                     ->get();

        return view('/Principales/doceliminados', compact('documento'));
      }else {
        return redirect('bienvenida');
      }
    }

    //Funciones para los Productos y servicios
    public function productos()
    {
      $Users = Auth::user();
      $productos = new Productos;
      $producto = $productos->where('idcompañia',$Users->id_compania)->get();


      return view('/Principales/productos', compact('producto'));
    }


    public function productostore(Request $request)
    {
      $usuarios = Auth::user();
      $productos = new Productos;

      $productos->codigo = $request->input('codigo');
      $productos->nombre = $request->input('nombre');
      $productos->descripcion = $request->input('descripcion');
      $productos->idcompañia =  $usuarios->id_compania;

      $productos->save();

      return redirect('/productos');
    }

    public function productosdestroy($id)
    {
      $productos = Productos::findorfail($id);
      $productos-> delete();
      return Redirect('/productos');
    }

    public function productosedit($id,Request $request)
    {
      $productos = Productos::findorfail($id);

      $productos->codigo = $request->input('codigo');
      $productos->nombre = $request->input('nombre');
      $productos->descripcion = $request->input('descripcion');

      $productos->save();

      return Redirect('/productos');


    }


      //Funciones para los clientes

      public function clientes()
      {
        $Users = Auth::user();

        $clientes = new Clientes;
        $cliente = $clientes->where('id_compania',$Users->id_compania)->get();


        return view('/Principales/clientes', compact('cliente'));
      }


      public function clientestore(Request $request)
      {
        $usuarios = Auth::user();
        $clientes = new Clientes;

        $clientes->nombre = $request->input('nombre');
        $clientes->correo = $request->input('correo');
        $clientes->telefono = $request->input('telefono');
        $clientes->direccion = $request->input('direccion');
        $clientes->id_compania =  $usuarios->id_compania;
        $clientes->save();

        return redirect('/clientes');
      }

      public function clientesdestroy($id)
      {
        $clientes = Clientes::findorfail($id);
        $clientes-> delete();
        return Redirect('/clientes');
      }

      public function clientesedit($id,Request $request)
      {
        $clientes = Clientes::findorfail($id);

        $clientes->nombre = $request->input('nombre');
        $clientes->correo = $request->input('correo');
        $clientes->telefono = $request->input('telefono');
        $clientes->direccion = $request->input('direccion');

        $clientes->save();

        return redirect('/clientes');


      }

      //Funciones para las Areas

      public function areas()
      {
        $Users = Auth::user();

        $areas = new Areas;
        $area = $areas->where('id_compania',$Users->id_compania)->get();
        return view('/Principales/areas', compact('area'));
      }

      public function areastore(Request $request)
      {
        $usuarios = Auth::user();
        $areas = new Areas;
        $areas->nombre = $request->input('nombre');
        $areas->id_compania = $usuarios->id_compania;
        $areas->save();
        return redirect('/areas');
      }

      public function areasdestroy($id)
      {
        $areas = Areas::findorfail($id);
        $areas-> delete();
        return Redirect('/areas');
      }

      public function areasedit($id,Request $request)
      {
        $areas = Areas::findorfail($id);
        $areas->nombre = $request->input('nombre');
        $areas->save();
        return redirect('/areas');
      }

      //Funciones para las Empresas
      public function empresas()
      {
        $user = Auth::user();
        if($user->perfil == 1){
          $empresas = new Empresas;
          $empresa = $empresas->all();
        }else {
          $empresas = new Empresas;
          $empresa = $empresas->where('id_creador',$user->id)->get();
        }
        $status = new Status;
        $statuses = $status->all();
        $plans = new Plans;
        $plan = $plans->all();
        return view('/Principales/empresas', compact('empresa','statuses','plan'));
      }
      //protected $fillable = ['id_plan','razonSocial','domicilio','correo','telefono','rubro','uso','codigo','fecha','status_id','cuota_usada','img'];
      public function empresastore(Request $request)
      {
        $date = Carbon::now();
        $user = Auth::user();
        $empresas = new Empresas;
        $empresas->id_plan = $request->input('id_plan');
        $empresas->razonSocial = $request->input('razonSocial');
        $empresas->domicilio = $request->input('domicilio');
        $empresas->correo = $request->input('correo');
        $empresas->telefono = $request->input('telefono');
        $empresas->rubro = $request->input('rubro');
        $empresas->uso = $request->input('uso');
        $empresas->codigo = 'Campo unico';
        $empresas->fecha = $date->toDateTimeString();
        $empresas->status_id = $request->input('status_id');
        $empresas->cuota_usada = '1';
        $empresas->img = $request->input('img');
        $empresas->id_creador = $user->id;
        $empresas->save();
        return redirect('/empresas');
      }

      public function empresasdestroy($id)
      {
        $empresas = Empresas::findorfail($id);
        $empresas-> delete();
        return Redirect('/empresas');
      }

      public function empresasedit($id,Request $request)
      {
        $date = Carbon::now();
        $empresas = Empresas::findorfail($id);
        $empresas->id_plan = $request->input('id_plan');
        $empresas->razonSocial = $request->input('razonSocial');
        $empresas->domicilio = $request->input('domicilio');
        $empresas->correo = $request->input('correo');
        $empresas->telefono = $request->input('telefono');
        $empresas->rubro = $request->input('rubro');
        $empresas->uso = $request->input('uso');
        $empresas->codigo = 'Campo unico';
        $empresas->fecha = $date->toDateTimeString();
        $empresas->status_id = $request->input('status_id');
        $empresas->cuota_usada = '1';
        $empresas->img = $request->input('img');
        $empresas->save();
        return redirect('/empresas');
      }



      //Funciones para las Usuarios
      public function usuarios()
      {
        $Users = Auth::user();

        $usuario = DB::table('users')
        ->leftjoin('areas','areas.id','=','users.id_area')
        ->select('users.*','areas.nombre as area')
        ->where('users.id_compania',$Users->id_compania)
        ->where('perfil','!=','1')
        ->get();

        $empresas = new Empresas;
        $empresa = $empresas->get();
        $status = new Status;
        $statuses = $status->all();
        $areas = new Areas;
        $area = $areas->where('id_compania',$Users->id_compania)->get();


        return view('/Principales/usuarios', compact('usuario','empresa','statuses','area'));
      }
      //protected $fillable = ['id_plan','razonSocial','domicilio','correo','telefono','rubro','uso','codigo','fecha','status_id','cuota_usada','img'];
      public function usuariostore(Request $request)
      {

        $user = Auth::user();
        $usuarios = new User;

        $empresa = new Empresas;

        if($user->perfil == 1){
          $empresas = $empresa->where('id',$request->input('id_compania'))->first();
          $usuarios->id_compania = $request->input('id_compania');
          $usuarios->empresa = $empresas->razonSocial;
        }else{
          $empresas = $empresa->where('id', $user->id_compania)->first();
          $usuarios->id_compania = $user->id_compania;
          $usuarios->empresa = $empresas->razonSocial;
        }
        //No se para que este campo
        $usuarios->usuario = $request->input('email');
        //Campos normales
        $usuarios->password = bcrypt($request->input('password'));
        $usuarios->nombre = $request->input('nombre');
        $usuarios->perfil = $request->input('perfil');
        $usuarios->email = $request->input('email');
        $usuarios->telefono = $request->input('telefono');
        $usuarios->status = $request->input('status');
        //No se como se llenan estos
        $usuarios->quota = 0;
        $usuarios->num_com = 1;
        //Nunca se llenan
        $usuarios->direccion = '';
        $usuarios->descripcion = '';
        //Falta agregar el area
        $usuarios->save();
        return redirect('/usuarios');
      }

      public function usuariosdestroy($id)
      {
        $usuarios = User::findorfail($id);
        $usuarios-> delete();
        return Redirect('/usuarios');
      }

      public function usuariosedit($id,Request $request)
      {
        $user = Auth::user();
        $usuarios = User::findorfail($id);

        $empresa = new Empresas;

        if($user->perfil == 1){
          $empresas = $empresa->where('id',$request->input('id_compania'))->first();
          $usuarios->id_compania = $request->input('id_compania');
          $usuarios->empresa = $empresas->razonSocial;
        }else{
          $empresas = $empresa->where('id', $user->id_compania)->first();
          $usuarios->id_compania = $user->id_compania;
          $usuarios->empresa = $empresas->razonSocial;
        }
        //No se para que este campo
        $usuarios->usuario = $request->input('email');
        //Campos normales
        if ($request->input('password') != null) {
          $usuarios->password = bcrypt($request->input('password'));
        }


        $usuarios->nombre = $request->input('nombre');
        $usuarios->perfil = $request->input('perfil');
        $usuarios->email = $request->input('email');
        $usuarios->telefono = $request->input('telefono');
        $usuarios->status = $request->input('status');
        //No se como se llenan estos
        $usuarios->quota = 0;
        $usuarios->num_com = 1;
        //Nunca se llenan
        $usuarios->direccion = '';
        $usuarios->descripcion = '';
        //Falta agregar el area
        $usuarios->save();
        return redirect('/usuarios');
      }
      //functiones para las noticias
      public function noticiastore(Request $request)
      {
       $user = Auth::user();
       $noticia = new Noticias;
       $date = date("Y-m-d");
       $empresa = new Empresas;
        if($user->perfil == 1){
          $noticia->id_empresa = $user->id_compania;
          $noticia->id_UsuarioCreo = $user->id;
          $noticia->fecha_creacion=$date;
          $noticia->Noticia = $request->input('descripcionNoticia');
          $noticia->save();
          return Redirect('/bienvenida');
        }else{
          return Redirect('/');
        }
      }


}
