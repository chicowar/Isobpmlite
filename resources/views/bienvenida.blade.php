@extends('layouts.principal2')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header text-center" style="font-weight: bold; text-shadow: 1px 1px #222; color:#0070B0;font-family: 'LeagueGothic';word-spacing: 5px; letter-spacing: 2px; border-bottom: none">Informacion Documentada</h1>
  </div>
</div>

<br><br><br><br><br><br><br><br><br>

  <div class="row">
      <div class="col-lg-3 col-md-6" >
          <div class="panel panel-doc" id="divPartnersPending">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-xs-3">
                          <i class="fa fa-folder fa-5x"></i>
                      </div>
                      <div class="col-xs-9 text-right">
                          <div class="huge" id="divPartnersNumber"></div>
                          <div>DOCUMENTOS</div>
                      </div>
                  </div>
              </div>
              <a href="/infdocumentos" class="pf">
                  <div class="panel-footer">
                      <span class="pull-left" id="spPartnersPending">en base</span>
                      <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                      <div class="clearfix"></div>
                  </div>
              </a>
          </div>
      </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" style="Background-color: #BE5353">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-puzzle-piece fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>ESTRATEGIA</div>
                        </div>
                    </div>
                </div>
                <a href="/infestrategia" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" style="Background-color: #BE5353">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-object-group fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>PROCESOS</div>
                        </div>
                    </div>
                </div>
                <a href="/infprocesos" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" style="Background-color: #BE5353">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-exclamation-triangle fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>RIESGOS</div>
                        </div>
                    </div>
                </div>
                <a href="/infriesgos" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" style="Background-color: #BE5353">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-cubes fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>RECURSOS</div>
                        </div>
                    </div>
                </div>
                <a href="/infrecursos" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" style="Background-color: #BE5353">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-gears fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>OPERACION</div>
                        </div>
                    </div>
                </div>
                <a href="/infoperacion" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" >
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>EVALUACION</div>
                        </div>
                    </div>
                </div>
                <a href="/infevaluacion" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6" >
            <div class="panel panel-doc" id="divPartnersPending" >
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-line-chart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="divPartnersNumber"></div>
                            <div>MEJORA</div>
                        </div>
                    </div>
                </div>
                <a href="/infmejora" class="pf">
                    <div class="panel-footer">
                        <span class="pull-left" id="spPartnersPending">en base</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        @if(Auth::user()->perfil == 1 or Auth::user()->perfil == 2)
 <div class="Row">
   <div class="form-group form-group-lg">
     <form  action="/cambioempresa/edit" method="post">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
       <h2><label for="tipo" class="control-label col-md-12" >Selecciona una empresa:</label></h2>
       <div class="col-md-6">
           <select class="form-control input-lg" name="empresa" id= "empresa">
             <option value="0" selected>Sin Empresa</option>
             <?php foreach ($empresa as $empresas): ?>
               <option value="<?=$empresas['id']?>"><?=$empresas['razonSocial']?></option>
             <?php endforeach ?>
           </select>
       </div>
       <button type="submit" class="btnobjetivo" id="btnEditCli" style="font-family: Arial;">Seleccionar</button>
     </form>
   </div>
 </div>
@endif




  </div>

@stop
