@extends('layouts.master')

@section('content')
<section class="content-header">
      <h1>VALORACION</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Valorar</li>
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
                    @foreach (@$trabajos as $key => $tra)  
                    {{ $tra->workshopresponse }}
                    @if($tra->workshopresponse!='')                             
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>                         
                            <th scope="col">WS_ID</th>
                            <th scope="col">Order</th>
                            <th scope="col">Response day</th>
                            <th scope="col">Response date</th>                         
                            <th scope="col">Response price</th>
                            <th scope="col">Valoración</th>                                                
                        </tr>
                        </thead>
                        <tbody>
                            @foreach(@$tra->workshopresponse as $k => $wk) 
                            @if($wk->id)                                                  
                            <tr>
                                <th scope="row">{{ $k+1 }}</th>  
                                <td>{{ $wk->id }} </td>                            
                                <td>{{ $wk->ws_id }} </td>
                                <td>{{ $wk->order_id }} </td>
                                <td>{{ $wk->response_days }}</td>
                                <td>{{ $wk->response_date }}</td>
                                <td>{{ $wk->response_price }}</td>
                                <td><a href="#" class="btn btn-xs btn-primary btn-valorar" data-order="{{ @$tra->order_id }}">Valorar</a></td>                               
                            </tr>                          
                       
                            <tr>
                              <td>Mensajes:</td><td colspan="4">
                                  <ul class="timeline">
                                      <li class="time-label">
                                          <span class="bg-red">
                                              {{ @$wk->created_at }}
                                          </span>
                                      </li>
                                      <li>         
                                        <ul class="timeline">
                                            <li>
                                                <i class="fa fa-envelope bg-blue"></i>
                                                <div class="timeline-item">
                                                    

                                                    <h3 class="timeline-header"> Usuario:  {{ @$wk->user->name }}</h3>

                                                    <div class="timeline-body">
                                                       
                                                      {{ @$wk->response_detail }}
                                                    </div>

                                                    <div class="timeline-footer">
                                                       
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> 
                                      </li>
                                  </ul>
                              </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                </table> 
                @endif
                @endforeach
           
                </div>
        </div>   
        </div>
    </div>
  </div>
</section>


<div class="modal modal-default fade" id="modal-valorar">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="fr-valorar">
              {{ csrf_field() }}
            <input name="_method" type="hidden" value="POST">
            <input type="hidden" name="order_id" id="order_id" value="">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Valorar</h4>
          </div>
          
          <div class="modal-body">


              
              <div class="form-group">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="valorar" name="valorar" value="1">
                      Valorar
                    </label>
                  </div>
              </div>
              <div class="form-group">
                  <label>Nota</label>
                  <textarea class="form-control" name="nota" id="nota" rows="3" placeholder="Nota ..."></textarea>
              </div>
                           
  
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger btn-save-valorar">Enviar</button>
          </div>
      </form>
    </div>
  </div>    
</div>

@endsection