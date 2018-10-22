@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>ESTADO DE TRABAJOS</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Perfil</li>
        </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="box">
            
        <div class="box" id="estados">
            <div class="box-header with-border">
                
            </div>
                <div class="box-body">
    

                    <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th scope="col">Nº Orden</th>
                                
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trabajos as $key => $tra)
                               
                                
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                   
                                    <td>{{ $tra->order_id }}<br>
                                   
                                        <a href="#" class="cambio-estado btn btn-xs btn-primary" data-order="{{ $tra->order_id }}">Cambiar estado</a>
                                     </td>
                                   
                                   <td>
                                   @switch(@$tra->estado->status)
                                      @case(1)
                                       @php
                                        $op1 = true;
                                        $op2 = false;
                                        $op3 = false;
                                        $op4 = false;
                                        $op5 = false;
                                       @endphp
                                      @break

                                      @case(2)
                                       @php
                                        $op1 = true;
                                        $op2 = true;
                                       
                                        $op3 = false;
                                        $op4 = false;
                                        $op5 = false;
                                       @endphp
                                      @break

                                      @case(3)
                                       @php
                                        $op1 = true;
                                        $op2 = true;
                                        $op3 = true;
                                        
                                        $op4 = false;
                                        $op5 = false;
                                       @endphp
                                      @break

                                      @case(4)
                                       @php
                                        $op1 = true;
                                        $op2 = true;
                                        $op3 = true;
                                        $op4 = true;
                                       
                                        $op5 = false;
                                       @endphp
                                      @break

                                      @case(5)
                                       @php
                                        $op1 = true;
                                        $op2 = true;
                                        $op3 = true;
                                        $op4 = true;
                                        $op5 = true;
                                       @endphp
                                      @break
                                   @endswitch
                                   
                                    <!-- linea de estado-->
                                    <ul class="timeline {{$tra->order_id}}" id="timeline">
                                        <li class="li @if(@$op1)  complete  @endif ">
                                            <div class="timestamp">
                                           
                                           
                                            </div>
                                            <div class="status">
                                            <h4>Recepción del vehículo </h4>
                                            </div>
                                        </li>
                                        <li class="li  @if(@$op2)  complete  @endif">
                                            <div class="timestamp">
                                           
                                           
                                            </div>
                                            <div class="status">
                                            <h4> Comienzo reparación </h4>
                                            </div>
                                        </li>
                                        <li class="li   @if(@$op3)  complete  @endif">
                                            <div class="timestamp">
                                            
                                            
                                            </div>
                                            <div class="status">
                                            <h4> Incidencia</h4>
                                            </div>
                                        </li>
                                        <li class="li  @if(@$op4)  complete  @endif">
                                            <div class="timestamp">
                                           
                                           
                                            </div>
                                            <div class="status">
                                            <h4> Fin de Reparación</h4>
                                            </div>
                                        </li>
                                        <li class="li  @if(@$op5)  complete  @endif">
                                            <div class="timestamp">
                                           
                                           
                                            </div>
                                            <div class="status">
                                            <h4>Disponible para recoger</h4>
                                            </div>
                                        </li>
                                        </ul>      
                                   
                                   </td>
                                    
                                  
                                </tr>
                               
                            @endforeach
                            </tbody>
                    </table>        
               
           
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