@extends('layouts.principal2')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header text-center" style="font-weight: bold; text-shadow: 1px 1px #222; color:#0070B0;font-family: 'LeagueGothic';word-spacing: 5px; letter-spacing: 2px; border-bottom: none">Administración</h1>
  </div>
</div>

<br><br><br><br><br><br><br><br><br>

  <div class="row">

@if(Auth::user()->perfil == 1 or Auth::user()->perfil ==2)
    <div class="col-lg-3 col-md-6" >
      <div class="panel panel-adm" id="divPartnersPending" >
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-building   fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge" id="divCompaniesNumber"></div>
                      <div>Empresas</div>
                  </div>
              </div>
          </div>
          <a href="/empresas" class="pf">
              <div class="panel-footer">
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
    </div>
@endif

    <div class="col-lg-3 col-md-6" >
      <div class="panel panel-adm" id="divPartnersPending" >
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-users   fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge" id="divUsers"></div>
                      <div>Usuarios</div>
                  </div>
              </div>
          </div>
          <a href="/usuarios" class="pf">
              <div class="panel-footer">
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6" >
      <div class="panel panel-adm" id="divPartnersPending" >
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-file-text   fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge" id="divUsers"></div>
                      <div>Documentos</div>
                  </div>
              </div>
          </div>
          <a href="/documentada" class="pf">
              <div class="panel-footer">
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6" >
      <div class="panel panel-adm" id="divPartnersPending" >
          <div class="panel-heading">
              <div class="row">
                  <div class="col-xs-3">
                      <i class="fa fa-file-text   fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                      <div class="huge" id="divUsers"></div>
                      <div>Documentos Obsoletos</div>
                  </div>
              </div>
          </div>
          <a href="/documentoseliminados" class="pf">
              <div class="panel-footer">
                  <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                  <div class="clearfix"></div>
              </div>
          </a>
      </div>
    </div>

  </div>

@stop
