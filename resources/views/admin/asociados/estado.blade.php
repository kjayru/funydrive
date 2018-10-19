@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>PERFIL</h1>
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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($trabajos as $key => $tra)
                               
                                
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <th>
                                    @if($tra->status == 1)
                                       Solicitada <span style="color:yellow"><i class="fa fa-circle"></i></span>
                                    @elseif($tra->status == 2)
                                    Respondida <span style="color:blue"><i class="fa fa-circle"></i></span>
                                    
                                    @elseif($tra->status == 3)
                                    Asignada <span style="color:brown"><i class="fa fa-circle"></i></span>
                                   
                                    @elseif($tra->status == 4)
                                    Finalizada <span style="color:skyblue"><i class="fa fa-circle"></i></span>
                                    @else
                                    Rechazada <span style="color:red"><i class="fa fa-circle"></i></span>
                                    @endif
                                    </th>
                                    <td>{{ $tra->order_id }} </td>
                                    <td>{{ $tra->cause }}</td>
                                    <td>{{ $tra->detail }}</td>
                                    <td>{{ $tra->request_date }}</td>
                                    <td>{{ $tra->created_at }}</td>
                                    <td>
                                            @if($tra->status == 1)
                                            <a href="#" data-type="{{ $tra->type }}" data-id="{{$tra->order_id}}" data-idcliente="{{ $tra->user_id }}" data-idasociado="{{ $user_id }}" class="btn btn-default btn-accept-job btn-xs">Aceptar</a>
                                            
                                            @endif
                                            @if($tra->status == 2)
                                            <a href="#" data-type="{{ $tra->type }}" data-id="{{$tra->order_id}}" data-idcliente="{{ $tra->user_id }}" data-idasociado="{{ $user_id }}" class="btn btn-default btn-edit-job btn-xs">Modificar</a>
                                            @endif

                                    
                                    </td>
                                    <td>@if($tra->status == 1)
                                            <a href="#" data-type="{{ $tra->type }}" data-id="{{$tra->order_id}}" data-idcliente="{{ $tra->user_id }}" data-idasociado="{{ $user_id }}"  class="btn btn-danger btn-refuse-job btn-xs">Rechazar</a>
                                        @endif</td>
                                    <td>
                                    @if($tra->status < 5)
                                    <a href="#" data-type="{{ $tra->type }}" data-id="{{$tra->order_id}}" data-idcliente="{{ $tra->user_id }}" data-idasociado="{{ $user_id }}"  class="btn btn-info btn-cambiofecha btn-xs">Cambio fecha</a>
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
  </div>
</section>
@endsection