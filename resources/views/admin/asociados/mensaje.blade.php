@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>MENSAJES</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Perfil</li>
        </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="box">
            
        <div class="box">
            <div class="box-header with-border">
                
            </div>
                <div class="box-body">
    
                @foreach($trabajos as $key => $tra)
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{ $key+1}}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key+1}}" aria-expanded="@if($key==0) true @endif" aria-controls="collapse{{ $key+1}}">
                                   ORDEN: {{ $tra->order_id }}
                                    </a>
                                </h4>
                                
                                 <a href="#" class="btn btn-xs btn-primary pull-right">Valorar</a>

                            </div>
                            <div id="collapse{{ $key+1}}" class="panel-collapse collapse @if($key==0) in @endif" role="tabpanel" aria-labelledby="heading{{ $key+1}}">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                      
                                        @php @$result = \App\ConversationReply::where('conversation_id',$tra->conversation[0]->id)->get(); @endphp

                                      
                                        <ul class="timeline">

                                            <!-- timeline time label -->
                                            <li class="time-label">
                                                <span class="bg-red">
                                                    {{ @$tra->conversation[0]->created_at }}
                                                </span>
                                            </li>
                                            <!-- /.timeline-label -->

                                            <!-- timeline item -->
                                            @foreach(@$result as $conv)
                                            <li>
                                                <!-- timeline icon -->
                                                <i class="fa fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fa fa-clock-o"></i>  {{ $conv->time }}</span>

                                                    <h3 class="timeline-header"><a href="#">@if($conv->user_id === $user_id ) Representante @else Usuario @endif: </a>  {{ $conv->user->name }}</h3>

                                                    <div class="timeline-body">
                                                       
                                                      {{ $conv->reply }}
                                                    </div>

                                                    <div class="timeline-footer">
                                                       
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                           
                                            <!-- END timeline item -->

                                        </ul>
                                    
                                        </div>
                                    </div>
  

                                </div>
                            </div>
                        </div>
                   
                    
                    </div>
                @endforeach
           
                </div>
        </div>   
        </div>
    </div>
  </div>
</section>


<div class="modal modal-default fade" id="modal-estado">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="fr-estado">
              {{ csrf_field() }}
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="order_id" id="order_id" value="">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cambiar de estado</h4>
          </div>
          
          <div class="modal-body">


              
            <div class="form-group">
                  <label for="respuesta">Estado</label>
                 <select class="form-control" name="estado" id="estado">
                    <option>Seleccione</option>
                    <option value="1">Recepción del vehículo</option>
                    <option value="2">Comienzo reparación</option>
                    <option value="3">Incidencia</option>
                    <option value="4">Fin de reparación</option>
                    <option value="5">Disponible para recoger</option>
                 </select>
              </div>
            
              
                           
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger btn-save-estado">Enviar</button>
          </div>
      </form>
    </div>
  </div>    
</div>

@endsection