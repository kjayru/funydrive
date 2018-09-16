@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>Dashboard</h1>
       
</section>
<section class="content">
  <div class="row">

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ @$activa }}</h3>
        
                    <p> Activas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>

                <a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ @$respondida }}</h3>
        
                    <p> Respondidas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>

                <a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ @$asignada }}</h3>
            
                        <p> Asignadas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
    
                    <a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
        </div>


        <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ @$finalizada }}</h3>
            
                        <p> Finalizadas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
    
                    <a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
        </div>

        <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ @$importeFinal }}</h3>
            
                        <p> Importe</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
    
                    <a href="#" class="small-box-footer">Mas info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
        </div>


  </div>

  <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                
            </div>
                <div class="box-body">
    

                    <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Estado</th>
                                <th scope="col">Nº Orden</th>
                                <th scope="col">Causa</th>
                                <th scope="col">Servicio</th>
                               
                                <th scope="col">Fecha Servicio</th>
                                <th scope="col">Fecha Creación</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trabajos as $key => $tra)
                               
                                
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <th>
                                    @if($tra->workshoporder->status == 1)
                                        <span style="color:yellow"><i class="fa fa-circle"></i></span>
                                    @elseif( $tra->workshoporder->status==2)
                                    <span style="color:green"><i class="fa fa-circle"></i></span>
                                    @else
                                    <span style="color:red"><i class="fa fa-circle"></i></span>
                                    @endif
                                    </th>
                                    <td>{{ $tra->order_id }} </td>
                                    <td>{{$tra->workshoporder->cause}}</td>
                                    <td>{{$tra->workshoporder->detail}}</td>
                                    <td>{{$tra->workshoporder->request_date}}</td>
                                    <td>{{ $tra->workshoporder->created_at }}</td>
                                    <td>
                                            @if($tra->workshoporder->status == 1)
                                            <a href="#" data-type="{{ $tra->workshoporder->type }}" data-id="{{$tra->order_id}}" data-idcliente="{{ $tra->workshoporder->user_id }}" data-idasociado="{{ $user_id }}" class="btn btn-default btn-accept-job btn-xs">Aceptar</a>
                                            <a href="#" data-type="{{ $tra->workshoporder->type }}" data-id="{{$tra->order_id}}" class="btn btn-danger btn-refuse-job btn-xs">Rechazar</a>
                                            @endif
                                            @if($tra->workshoporder->status == 2)
                                            <a href="#" data-type="{{ $tra->workshoporder->type }}" data-id="{{$tra->order_id}}" data-idcliente="{{ $tra->workshoporder->user_id }}" data-idasociado="{{ $user_id }}" class="btn btn-default btn-edit-job btn-xs">Modificar</a>
                                            @endif
                                           
                                    </td>
                                </tr>
                               
                            @endforeach
                            </tbody>
                    </table>        
               
           
                </div>
        </div>             
    </div>  
</div> 
</section>

<div class="modal modal-default fade" id="modal-job">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="fr-job">
              {{ csrf_field() }}
            <input name="_method" id="metodo" type="hidden" value="POST">
            <input type="hidden" name="order_id" id="order_id" value="">
            <input type="hidden" name="cliente_id" id="cliente_id" value="">
            <input type="hidden" name="asociado_id" id="asociado_id" value="{{ $user_id }}">
            <input type="hidden" name="type" id="type" value="">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Aceptar propuesta</h4>
          </div>
          
          <div class="modal-body">


              
            <div class="form-group">
                  <label for="respuesta">Mensaje:</label>
                 
                    <textarea name="respuesta" id="respuesta" cols="30" rows="10"  class="form-control"></textarea>
              </div>
            
              <div class="form-group">
                <label for="duracion">Tiempo de trabajo:</label>
                <input type="numeric" name="duracion" id="duracion"  class="form-control" />
                <p class="help-block">ejemplo: para 1 hora ingrese 1 para 30 minutos ingrese 0.5</p>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio"  class="form-control" />
                  
            </div>
                           
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger btn-save-job">Enviar</button>
          </div>
      </form>
    </div>
  </div>    
</div>


<div class="modal modal-default fade" id="modal-trash-job">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="fr-trash-job">
              {{ csrf_field() }}
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="order_id" id="order_id" value="">
            <input type="hidden" name="cliente_id" id="cliente_id" value="">
            <input type="hidden" name="asociado_id" id="asociado_id" value="{{ $user_id }}">
            <input type="hidden" name="type" id="type" value="">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Rechazar propuesta</h4>
          </div>
          
          <div class="modal-body">


              
            <div class="form-group">
                  <label for="respuesta">Motivo</label>
                 
                    <textarea name="motivo" id="motivo" cols="30" rows="10"  class="form-control"></textarea>
              </div>
            
              
                           
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger btn-save-trash-job">Enviar</button>
          </div>
      </form>
    </div>
  </div>    
</div>
@endsection