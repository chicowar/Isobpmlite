<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Objetivo;
use App\Models\Indicadores;
use App\Models\Quejas;
use App\Models\Proceso;
use App\Models\Empresas;
use App\Models\Noticias;
use App\Models\User;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mail;



class BienvenidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contacto()
    {
        return view('contacto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mail(Request $request)
    {
      Mail::send('emails.contact',$request->all(), function($msj){
        $msj->subject('Correo de contacto');
        $msj->to('jgomezg@japsoft.com.mx');
      });
      Session::flash('message','Eviado correctamente');
      return Redirect::to('/');
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

    public function cambioempresa(Request $request){

      $usuarios = Auth::user();
      $empresa = new Empresas;


      if($usuarios->perfil == 1){

        $user = User::findorfail($usuarios->id);
        $empresas = $empresa->where('id',$request->input('empresa'))->first();
        $user->id_compania = $request->input('empresa');
        if($request->input('empresa') == 0){
          $user->empresa = 'Sin empresa';
        }else {
          $user->empresa = $empresas->razonSocial;
        }

        $user->save();

      }

      return redirect('/bienvenida');

    }


    public function show()
    {
      $usuarios = Auth::user();
      if($usuarios->perfil == 1){
        $empresas = new Empresas;
        $empresa = $empresas->get();
      }else{
        $empresas = new Empresas;
        $empresa = $empresas->where('id_creador',$usuarios->id)->get();
      }

      return View('bienvenida', compact('empresa'));
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
