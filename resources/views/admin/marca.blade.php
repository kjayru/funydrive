@extends('layouts.master')

@section('content')
<section class="content-header">
        <h1>Marcas de auto</h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Marcas</li>
          
        </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <a href="#" class="btn bt-xs btn-nuevo-marca btn-block btn-info">Nueva Marca</a>
            </div>
                <div class="box-body">
            

        
                            <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Año</th>
                                       
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                @foreach($marcas as $key=>$marc) 
                                    <tr>
                                       <th>{{ $key + 1}}</th>
                                       <td>{{ $marc->name }}</td>
                                       <td>

                                        @foreach($marc->makeyears as $y)
                                            {{ $y->year }} -
                                        @endforeach
                                       </td>
                                       <td>
                                           <div class="btn-group">
                                            <a  href="#" data-id="{{$marc->id}}" class="btn btn-success marca-edit"><i class="fa fa-fw  fa-pencil"></i></a>
                                            <a href="#" data-id="{{ $marc->id }}" class="btn btn-danger marca-borrar"><i class="fa fa-fw  fa-trash"></i></a>
                                            </div>
                                       </td>
                                       
                                    </tr>
                                @endforeach
                                    </tbody>
                            </table>        
                            
                            {{ $marcas->links() }}
                   
                        </div>
                    </div>             
                </div>  
        </div>            
 </section>

   

 <div class="modal modal-default fade" id="modal-edit-marca">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id="fr-edit-marca" method="POST">
                  {{ csrf_field() }}
                  
                <input name="_method" type="hidden" value="POST">
                <input type="hidden" name="id" id="id" value="">
              
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nueva Marca</h4>
              </div>
              
              <div class="modal-body">

                  <div class="form-group">
                      <label for="marca">Nombre</label>
                      <input type="text" name="marca" id="marca" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="marca">Años</label>
                     
                      <select class="form-control select2" name="yearsmake" id="yearsmake" multiple="multiple" data-placeholder="Selecione los años" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          @for($i=2018;$i>1930;$i--)   
                          <option value="{{$i}}">{{$i}}</option>
                          @endfor
                       </select>
                  </div> 

                 
                 
      
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger btn-save-marca">Guardar</button>
              </div>
          </form>
        </div>
      </div>    
  </div>

    <form id="fr-listcliente-service" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
    </form>

<form id="fr-delete">
      {{ csrf_field() }}
      <input name="_method" type="hidden" value="DELETE">  
</form>


@endsection
