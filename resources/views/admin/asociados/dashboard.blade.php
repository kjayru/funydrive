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
</section>
@endsection