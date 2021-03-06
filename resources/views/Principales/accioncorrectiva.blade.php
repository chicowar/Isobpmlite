@extends('layouts.principal2')

@section('content')


<br><br><br><br><br><br><br><br>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header" style="margin-bottom: 0px; margin: 0px; border-bottom: none">
                <ol class="breadcrumb iso-breadcumb">
                    <li><a href="/mejoras" downloadFile="58e66b9a4f84c.pdf" style='color:#FFF'> Acciones correctivas</a></li>
                </ol>
            </h2>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-lg-12 text-right">
            <center>
            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modalUpload"><i class="glyphicon glyphicon-upload"></i> Subir Accion</button>
            </center>
        </div>
    </div>
  -->
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Accion <button type="button" class="btn btn-green btn-xs" data-toggle="modal" data-target="#modalUpload"><i class="glyphicon glyphicon-upload"></i></button>
                </div>
            <div class="panel-body">
              <div class="table-responsive">
                <div class="dataTable_wrapper">
                    <table width="100%" class="table table-responsive table-striped table-bordered table-hover" id="tblProIn">
                      <thead style='background-color: #868889; color:#FFF'>
                        <tr>
                          <th><div class="th-inner sortable both">  ID</div></th>
                          <th><div class="th-inner sortable both">  fecha alta</div></th>
                          <th><div class="th-inner sortable both">  Indicador</div></th>
                          <th><div class="th-inner sortable both">  Proceso</div></th>
                          <th><div class="th-inner sortable both">  Producto</div></th>
                          <th><div class="th-inner sortable both">  Documento</div></th>
                          <th><div class="th-inner sortable both">  Archivo 1</div></th>
                          <th><div class="th-inner sortable both">  Descripcion</div></th>
                          <th><div class="th-inner sortable both">  Responsable</div></th>
                          <th><div class="th-inner sortable both">  Analisis</div></th>
                          <th><div class="th-inner sortable both">  Accion correctiva</div></th>
                          <th><div class="th-inner sortable both">  Fecha de accion</div></th>
                          <th><div class="th-inner sortable both">  Evidencia</div></th>
                          <th><div class="th-inner sortable both">  Archivo 2</div></th>
                          <th><div class="th-inner sortable both">  Fecha Cierre</div></th>
                          <th><div class="th-inner sortable both">  Status</div></th>
                          <th><div class="th-inner sortable both">   Subir Evidencia</div></th>
                        </tr>
                      </thead>
                      <!-- aqui va la consulta a la base de datos para traer las filas se hace desde el controlador-->
                      <tbody>
                        <?php foreach ($relaciontabla as $accioncorrectivas): ?>
                        <tr>
                          <td> <?=$accioncorrectivas->id?> </td>
                          <td> <?=$accioncorrectivas->fechaalta?> </td>
                          <td> <?=$accioncorrectivas->indicadornombre?> </td>
                          <td> <?=$accioncorrectivas->procesonombre?> </td>
                          <td> <?=$accioncorrectivas->productonombre?> </td>
                          <td> <?=$accioncorrectivas->documento?> </td>
                          <td> <?=$accioncorrectivas->porque2?>
                            <a href="/storage/accioncorrectiva/<?=$accioncorrectivas->uniquedocumento?>" downloadFile="<?=$accioncorrectivas->uniquedocumento?>" style='color:#FFF'>
                              <button type="button" class="btn btn-default btn-xs">
                                   <span class="glyphicon glyphicon-download-alt"></span>
                              </button>
                            </a>
                          </td>
                          <td> <?=$accioncorrectivas->descripcion?> </td>
                          <td> <?=$accioncorrectivas->usernombre?> </td>
                          <td> <?=$accioncorrectivas->porque1?> </td>
                          <td> <?=$accioncorrectivas->accioncorrectiva?> </td>
                          <td> <?=$accioncorrectivas->fechaaccion?> </td>
                          <td> <?=$accioncorrectivas->respuestaaccion?> </td>
                          <td> <?=$accioncorrectivas->evidencia?>
                            <a href="/storage/accioncorrectiva/<?=$accioncorrectivas->uniqueevidencia?>" downloadFile="<?=$accioncorrectivas->uniqueevidencia?>" style='color:#FFF'>
                              <button type="button" class="btn btn-default btn-xs">
                                   <span class="glyphicon glyphicon-download-alt"></span>
                              </button>
                            </a>
                          </td>
                          <td> <?=$accioncorrectivas->fechacierre?> </td>
                          <td> <?=$accioncorrectivas->statusnombre?> </td>
                          <td>
<!-- se creara un bucle para generar los n modales necesarios para la edicion de datos -->
                            <form class="" action="/subirevidencia/evidencia/<?=$accioncorrectivas->id?>">
                              <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
                              <input type="hidden" name="responsable_id" value="<?=$accioncorrectivas->responsable_id?>">
                                <button type="submit" class="btnobjetivo" ><i class="glyphicon glyphicon-pencil">Evidencia</i></button>
                            </form>
                          </td>

                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>
</div>
</div>
    <div class="modal fade" id="modalUpload" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h2 class="modal-title">ALTA DE ACCION CORRECTIVA</h2>
                </div>
                <div class="modal-body">
                    <form  action="/accioncorrectiva/store" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                      <input type="hidden" name="_token" value="{{ csrf_token()}}">
                      <input type="hidden" name="creador_id" value="{{Auth::user()->id}}">
                      <input type="hidden" name="id_compania" value="{{Auth::user()->id_compania}}">

                    <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <h3><label>Fecha Alta:</label></h3>
                          <input class="form-control input-lg" id="fechaalta" type="date" placeholder="Fecha" name="fechaalta" required="">
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Indicador:</label></h3>
                            <select class="form-control input-lg" name="indicador_id" id="indicador_id">
                              <option value=""></option>
                              <?php foreach ($indicador as $indicadores): ?>
                                <option value="<?=$indicadores->id?>"><?=$indicadores->nombre?></option>
                              <?php endforeach ?>
                            </select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Proceso:</label></h3>
                        <select class="form-control input-lg" name="proceso_id">
                          <option value=""></option>
                          <?php foreach ($proceso as $procesos): ?>
                            <option value="<?=$procesos['id']?>"><?=$procesos['proceso']?></option>
                          <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Producto:</label></h3>
                          <select class="form-control input-lg" name="producto_id">
                            <option value=""></option>
                            <?php foreach ($producto as $productos): ?>
                              <option value="<?=$productos['id']?>"><?=$productos['nombre']?></option>
                            <?php endforeach ?>
                          </select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Area:</label></h3>
                            <select class="form-control input-lg" name="id_area" id="id_area">
                              <option value="2"></option>
                              <?php foreach ($area as $areas): ?>
                                <option value="<?=$areas['id']?>"><?=$areas['nombre']?></option>
                              <?php endforeach ?>
                            </select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Monto:</label></h3>
                            <input class="form-control input-lg" type="text" placeholder="monto" name="monto">
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Documento:</label></h3>
                            <input class="form-control input-lg" id="documento" type="Text" placeholder="S/N" name="documento" >
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h3><label>Archivo de Accion correctiva:</label></h3>
                            <input class="file" id="file-1" type="file" placeholder="Archivo" name="archivo1">
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3><label> Decripcion:</label></h3>
                            <textarea class="form-control" id = "descripcion" rows="3" placeholder="Descripcion de la accion correctiva" name="descripcion" required=""></textarea>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h3><label>Responsable:</label></h3>
                            <select class="form-control input-lg" name="responsable_id" id="responsable_id" required="">
                              <?php foreach ($User as $Users): ?>
                                <option value="<?=$Users['id']?>"><?=$Users['nombre']?></option>
                              <?php endforeach ?>
                            </select>
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h3><label for="Usuario" class="control-label col-md-12">
                        Analisis de causa
                        </label></h3>
                            <textarea class="form-control" id = "porque1" rows="3" placeholder="Acciones tomadas" name="analisis"></textarea>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3><label>
                        Accion correctiva
                        </label></h3>
                            <textarea class="form-control" id = "accion" rows="3" placeholder="Acciones tomadas" name="accioncorrectiva"></textarea>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4">
                      <h3><label>Fecha Accion:</label></h3>
                          <input class="form-control input-lg" id="fechaaccion" type="date" placeholder="Fecha" name="fechaaccion">
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h3>
                        <label>
                          Evidencia de accion correctiva:
                        </label>
                        </h3>
                            <textarea class="form-control" id = "respuestaaccion" rows="3" placeholder="Acciones tomadas" name="evidenciaaccion"></textarea>
                    </div>

                    <!-- <div class="form-group form-group-lg">
                        <h2><label for="Usuario" class="control-label col-md-12">Evidencia:</label></h2>
                        <div class="col-md-6">
                            <input class="form-control input-lg" id="evidencia" type="text" placeholder="evidencia" name="evidencia">
                        </div>
                    </div> -->

                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <h3><label for="tipo" class="control-label col-md-12" >Archivo de evidencia:</label></h3>
                            <input class="file" id="file-1" type="file" placeholder="Archivo" name="archivo2">
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5">
                      <h3><label for="fecha requerimiento" class="control-label col-md-12">Fecha Cierre:</label></h3>
                          <input class="form-control input-lg" id="fechacierre" type="date" placeholder="Fecha" name="fechacierre">
                    </div>

                    <!-- <div class="form-group form-group-lg">
                      <h2><label for="criterio" class="control-label col-md-12">Criterio:</label></h2>
                      <div class="col-md-6">
                          <textarea class="form-control" id = "crierio" rows="3" placeholder="" name="crierio"></textarea>
                      </div>
                    </div> -->

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3><label>Status:</label></h3>
                            <select class="form-control input-lg" name="estatus_id" id="estatus_id" required="">
                              <?php foreach ($estatus as $estatuses): ?>
                                <option value="<?=$estatuses['id']?>"><?=$estatuses['nombre']?></option>
                              <?php endforeach ?>
                            </select>
                    </div>

        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btnobjetivo" id="btnaltaindicador" style="font-family: Arial;">Alta de Accion</button>
                    </form>
                            <button type="button" class="btnobjetivo" data-dismiss="modal" id="btnCloseUpload">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop
