@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="center-text">
            <h1>{{__('home_titulo')}}</h1>
            <p>{{ __('home_subtitulo')}}</p>
        </div>

    <div class="col-md-12 col-sm-12 col-lg-8">
            <div class="card" id="zip-locator">
                <div class="card-header">
                    @if(!Auth::check())
                        <span class="bd-login-link">
                            <span>{{ __('home_tiene_cuenta')}}</span>
                            <a href="{{ route('login') }}" class="logueo">{{ __('log_in')}}</a>
                        </span>
                    @endif    
                </div>

                <div class="card-body">
                   <h3 class="g-section-header-text">{{__('localizacion')}}</h3>
                   <div class="row">
                    <div class="col-md-6">
                        <form action="">
                            <div class="form-group ">
                                <label  for="zipcode">{{__('zipcode')}}</label>
                                <input type="text" id="zipcode" class="form-control" maxlength="5" autocomplete="off">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="box-msn" style="display:none;">
                                <span>{{ __("saludo")}}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a href="#" class="btn btn-primary btn-lg btn-confirmar" style="display:none;">{{ __('home_confirm')}}</a>   
                    </div>
                    
                </div>                   
                </div>
            </div>

            

            <div class="card" id="tipocar" style="display:none">
                <div class="card-header">{{ __('home_tab1')}}</div>
                <div class="card-body">
                <div class="botones">
                    <div class="bd-car-selection-car-option ymake">{{ __('home_titulo_1') }}</div>
                   
                </div>
                
                    <div class="bd-car-selection-container"  id="seccioncar">
                        <div class="bd-car-selection-container" id="box1">
                            <span class="bd-car-selection-step-name">{{ __('home_titulo_1')}}</span>
                            <div class="bd-car-selection-flex-container" >
                                <ul class="bd-car-selection-flex-column ">
                                    <li class="filter">
                                        <span>A-G</span>
                                    </li>
                                   @foreach($list1 as $list)
                                    <li data-make="{{$list->name}}" data-id="{{ $list->id }}">{{ ucfirst(strtolower($list->name))}}</li>
                                   @endforeach     
                                </ul>

                                <ul class="bd-car-selection-flex-column">
                                    <li class="filter">
                                        <span>H-L</span>
                                    </li>
                                    @foreach($list2 as $list)
                                    <li data-make="{{$list->name}}" data-id="{{ $list->id }}">{{ ucfirst(strtolower($list->name))}}</li>
                                    @endforeach  
                                </ul>

                                <ul class="bd-car-selection-flex-column">
                                    <li class="filter">
                                        <span>M-P</span>
                                    </li>
                                    @foreach($list3 as $list)
                                    <li data-make="{{$list->name}}" data-id="{{ $list->id }}">{{ ucfirst(strtolower($list->name))}}</li>
                                    @endforeach 
                                </ul>
                                <ul class="bd-car-selection-flex-column">
                                    <li class="filter">
                                        <span>R-Z</span>
                                    </li>
                                    @foreach($list4 as $list)
                                    <li data-make="{{$list->name}}" data-id="{{ $list->id }}">{{ ucfirst(strtolower($list->name))}}</li>
                                    @endforeach 
                                </ul>
                            </div>
                        </div>
                        <div class="bd-car-selection-container" style="display:none" id="box2">
                                <span class="bd-car-selection-step-name">{{ __('home_year')}}</span>
                            <div class="bd-car-selection-flex-container" >
                                    <ul class="bd-car-selection-flex-column">
                                        <li class="filter">
                                            <span>2010-2107</span>
                                        </li>
                                        @for($i=2017; $i>=2010; $i--)
                                        <li data-year="{{ $i }}">{{ $i }}</li>
                                        @endfor
                                    </ul>
    
                                    <ul class="bd-car-selection-flex-column">
                                        <li class="filter">
                                            <span>2004-2009</span>
                                        </li>
                                        @for($i=2009; $i>=2004; $i--)
                                        <li data-year="{{ $i }}">{{ $i }}</li>
                                        @endfor
                                    </ul>
                                    <ul class="bd-car-selection-flex-column">
                                            <li class="filter">
                                                <span>2001-2004</span>
                                            </li>
                                            @for($i=2004; $i>=2001; $i--)
                                            <li data-year="{{ $i }}">{{ $i }}</li>
                                            @endfor
                                    </ul>
    
                                   
                            </div>
                        </div>
                        <div class="bd-car-selection-container" style="display:none" id="box3">
                                <span class="bd-car-selection-step-name">{{ __('home_modelo')}}</span>
                            <div class="bd-car-selection-flex-container" id="box3">
                                    <ul class="bd-car-selection-flex-column" id="mimodelo">
                                       
                                        
                                        <li>ILX</li>
                                       
                                    </ul>
                                    <ul class="bd-car-selection-flex-column" id="mimodelo2">
                                       
                                        
                                        <li></li>
                                       
                                    </ul>
                                    <ul class="bd-car-selection-flex-column" id="mimodelo3">
                                       
                                        
                                        <li></li>
                                       
                                    </ul>
                                    <ul class="bd-car-selection-flex-column" id="mimodelo4">
                                       
                                        
                                        <li></li>
                                       
                                    </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


      <div class="card" id="services" style="display:none">
                    <div class="card-header">{{ __('home_servicio')}}</div>
                    <div class="card-body">

                        <div class="service-selection">
                          <div class="bd-service-tabs-container" >
                            <div class="bd-service--tab bd-service--tab__active" data-id="1">
                              <h4>{{ __('home_titulo_2')}}</h4>
                            </div>
                            <div class="bd-service--tab " data-id="2">
                                    <h4>{{ __('No encuentro lo que busco')}}</h4>
                            </div>                                      
                          
                        </div> 
                            <div class="content-tab tab-servicio-1 active">  
                            <form class="cd-form floating-labels js" >
                              

                                <div class="bd-service-list-container">
                                    <div class="bd-service-list bd-service-list--categories">
                                        <div class="bd-service-list--items">
                                            <ul>
                                                @foreach($servicios as $service)
                                                <li data-id="{{ $service->id }}">{{$service->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="bd-service-list bd-service-list--services">
                                        <div class="bd-service-list--category">
                                            {{ __('home_popular')}}
                                        </div>
                                        <div id="contsubs">

                                        </div>
                                        
                                    </div>
                                </div>


                            </form>
                            </div>
                            <div class="content-tab tab-servicio-2">
                                
                                    <div class="form-group" >
                                        <label for="cd-search" >{{ __('search') }}</label>
                                        <input class="search form-control" id="cd-search" type="text" autocomplete="off" value="">
                                    </div>
                                    <div id="contsub2">

                                    </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="card" id="detalle" style="display:none">
                <div class="card-header">
                        <h3 class="g-section-header-text pull-left">{{__('localizacion')}}</h3>
                        <div class="bd-service-options-container pull-right" >
                            <div class="bd-service-list__details" >{{ __('detalle')}}</div>
                            <div class="bd-service-list__delete" >
                                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iMTQiIHZpZXdCb3g9IjAgMCAxMiAxNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSIjNjY2QjdDIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0xLjEyIDEyLjg4MmMwIC40NjQuMzc3Ljg0Ljg0My44NGg3LjU4NWEuODQyLjg0MiAwIDAgMCAuODQ1LS44NFY0LjIzOEgxLjEyMXY4LjY0NHptNi42ODgtNy44MWgxLjMwN3Y2Ljk4OWEuNjUzLjY1MyAwIDAgMS0xLjMwNyAwVjUuMDd6bS0yLjcwNSAwSDYuNDF2Ni45ODlhLjY1My42NTMgMCAwIDEtMS4zMDcgMFY1LjA3em0tMi43MjUgMGgxLjMwNnY2Ljk4OWEuNjUzLjY1MyAwIDAgMS0xLjMwNiAwVjUuMDd6TTEwLjM5IDEuMTc4SDcuMDgydi0uNDhTNy4wNjcuMjggNi42NDUuMjhINC44MzhjLS40MiAwLS40MDYuNDItLjQwNi40MnYuNDc5aC0zLjMxYS44NDIuODQyIDAgMCAwLS44NDQuODR2MS4zOGgxMC45NTZ2LTEuMzhhLjg0Mi44NDIgMCAwIDAtLjg0NC0uODR6Ii8+PC9nPjwvc3ZnPg==">
                            </div>
                            <div class="clearfix"></div>
                        </div>
                </div>
                <div class="card-body">
                        <div class="mainblue-info-box"><img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTciIGhlaWdodD0iMjUiIHZpZXdCb3g9IjAgMCAxNyAyNSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSIjMUU3QkUyIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik02LjA0OCAxNy4yOTJsLS40ODUtLjUyMWMtLjAzNi0uMDM1LS4wNy0uMDctLjE0LS4wN2wtLjcyOS4xNGMtLjE3My4wMzUtLjM0OC4wMzUtLjUyLjAzNS0uNDE3IDAtLjc5OS0uMDY5LTEuMTQ3LS4yNDNhLjM5OS4zOTkgMCAwIDAtLjU1Ni4yNDNMLjM4OCAyMi41N2MtLjE0LjQxNy4yNzcuNzk4LjY2LjYyNWwyLjA4NC0uOTcyYy4yNDMtLjEwNS41MiAwIC42Ni4yNDNsLjk3MiAyLjA4M2MuMTczLjM4Mi43NjUuMzgyLjkwMy0uMDM1bDIuMTUyLTUuODY4YS40NDYuNDQ2IDAgMCAwLS4zMTItLjU1NiAyLjY1IDIuNjUgMCAwIDEtMS40NTktLjc5OHpNMTMuODYgMTYuOTFjLS4wNjgtLjI0My0uMzQ3LS4zMTItLjU1NS0uMjQzLS4zNDguMTM5LS43My4yNDMtMS4xNDYuMjQzLS4xNzMgMC0uMzQ4IDAtLjUyMS0uMDM1bC0uNjk0LS4xNGMtLjA2OSAwLS4xMDQuMDM2LS4xNC4wMzZsLS40ODUuNTJjLS4zODIuNDE3LS45MDIuNjk1LTEuNDIzLjgzNGEuNDQ2LjQ0NiAwIDAgMC0uMzEzLjU1NmwyLjE1MyA1Ljg2OGMuMTM5LjQxNy43MjkuNDE3LjkwMi4wMzZsLjk3My0yLjA4NGMuMTA0LS4yNDMuNDE2LS4zNDcuNjYtLjI0M2wyLjA4My45NzJjLjM4Mi4xNzQuNzk4LS4yMDguNjYtLjYyNWwtMi4xNTMtNS42OTV6TTE1LjYzMiA5LjIzNmExLjU0NiAxLjU0NiAwIDAgMSAwLTEuNDU5bC4zNDctLjYyNWMuNDE3LS43NjQuMTA0LTEuNzM1LS42OTQtMi4xNTJsLS42MjUtLjMxM2MtLjQ4Ni0uMjQzLS43OTgtLjY2LS44NjgtMS4xOGwtLjEwNS0uNjk0Yy0uMTA0LS44NjktLjkzNy0xLjQ5NC0xLjgwNS0xLjMybC0uNjk1LjE0YTEuNDczIDEuNDczIDAgMCAxLTEuMzg5LS40NTJMOS4zMTMuNjZhMS41OTIgMS41OTIgMCAwIDAtMi4yNTcgMGwtLjQ4Ni41MjFhMS41MDMgMS41MDMgMCAwIDEtMS4zODkuNDUybC0uNjk0LS4xNGMtLjg2OS0uMTM5LTEuNzAyLjQ1Mi0xLjgwNiAxLjMybC0uMTA0LjY5NGMtLjA3LjUyLS4zODIuOTcyLS44NjkgMS4xOEwxLjA4MyA1Qy4yODUgNS4zODItLjAyNyA2LjM1NC4zOSA3LjE1MmwuMzQ4LjYyNWExLjU0OCAxLjU0OCAwIDAgMSAwIDEuNDU5bC0uMzQ4LjYyNWMtLjQxNi43NjQtLjEwNCAxLjczNS42OTQgMi4xNTJsLjYyNS4zMTNjLjQ4Ni4yNDMuNzk5LjY2Ljg2OSAxLjE4bC4xMDQuNjk1Yy4xMDQuODY4LjkzNyAxLjQ5MyAxLjgwNiAxLjMxOWwuNjk0LS4xNGExLjQ3NCAxLjQ3NCAwIDAgMSAxLjM5LjQ1MmwuNDg1LjUyMWExLjU5MiAxLjU5MiAwIDAgMCAyLjI1NyAwbC40ODUtLjUyMWExLjUwMyAxLjUwMyAwIDAgMSAxLjM5LS40NTJsLjY5NC4xNGMuODY4LjEzOSAxLjcwMS0uNDUyIDEuODA1LTEuMzJsLjEwNS0uNjkzYy4wNjktLjUyMS4zODEtLjk3My44NjgtMS4xODFsLjYyNS0uMzEzYy43OTgtLjM4MSAxLjExMS0xLjM1NC42OTQtMi4xNTJsLS4zNDctLjYyNXptLTcuNDY1IDQuOTY2YTUuNzM0IDUuNzM0IDAgMCAxLTUuNzMtNS43M2MwLTMuMTI0IDIuNTctNS42OTUgNS43My01LjY5NSAzLjE2IDAgNS43MjkgMi41NyA1LjcyOSA1LjczIDAgMy4xMjUtMi41NyA1LjY5NS01LjczIDUuNjk1eiIvPjxwYXRoIGQ9Ik04LjE2NyAzLjgxOWMtMi41NyAwLTQuNjg4IDIuMTE4LTQuNjg4IDQuNjg4IDAgMi41NjkgMi4xMTkgNC42ODcgNC42ODggNC42ODcgMi41NjkgMCA0LjY4Ny0yLjExOCA0LjY4Ny00LjY4N2E0LjY5IDQuNjkgMCAwIDAtNC42ODctNC42ODh6Ii8+PC9nPjwvc3ZnPg==" class="bd-guarantee-icon">
                            <p>
                                <span>{{ __('home_garantia')}} </span>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnservice" class="btn-orange-fill">{{__('home_continuar')}}</button>
                        </div>
                </div>
            </div>


            <div class="card" id="appoint" style="display: none">
                <div class="card-header">
                        {{__('home_agenda')}}
                </div>
                <div class="card-body">
                    <div class="bd-time-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="green-info-box">
                                    <div class="exclamation-circle">!</div>
                                    <p>{{ __('home_mensaje_agenda')}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bd-time--header" >
                                <div class="bd-time--header--innerpadding">
                                   <div class="bd-time--header__value">
                                      <div class="row-flex-centered">
                                         <div class="col-sm-6">
                                            
                                           
                                         </div>
                                      </div>
                                   </div>
                                </div>
                        </div>

                        <!--horas-->

                            <div class="bd-time--zone" >
                                <div class="form-group">
                                    <div id="datetimepicker1">
                                            <input type='hidden' class="form-control" name="timepicker" id="fechaservicio" />
                                    </div> 
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-5 col-centered">
                                <div class="btn-orange-fill spacet-20 btn-fecha">{{ __('home_continuar')}}</div>
                                 </div>
                             </div>
                    </div>

                    </div>
            </div>

        <section class="bd-section bd-section-mechanic-notes bd-section--active bd-section-mechanic-notes--active" id="notes" style="display: none">
                <div class="shadow-box-fill bd-box-padding" >
                    <div class="row" >
                        <div class="col-xs-12 col-md-12" >
                            <h3 class="g-section-header-text1 pull-left" >{{ __('home_notas')}}</h3>
                            <div class="bd-service-options-container pull-right">
                                <div class="bd-service-list__delete" >
                                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTIiIGhlaWdodD0iMTQiIHZpZXdCb3g9IjAgMCAxMiAxNCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSIjNjY2QjdDIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxwYXRoIGQ9Ik0xLjEyIDEyLjg4MmMwIC40NjQuMzc3Ljg0Ljg0My44NGg3LjU4NWEuODQyLjg0MiAwIDAgMCAuODQ1LS44NFY0LjIzOEgxLjEyMXY4LjY0NHptNi42ODgtNy44MWgxLjMwN3Y2Ljk4OWEuNjUzLjY1MyAwIDAgMS0xLjMwNyAwVjUuMDd6bS0yLjcwNSAwSDYuNDF2Ni45ODlhLjY1My42NTMgMCAwIDEtMS4zMDcgMFY1LjA3em0tMi43MjUgMGgxLjMwNnY2Ljk4OWEuNjUzLjY1MyAwIDAgMS0xLjMwNiAwVjUuMDd6TTEwLjM5IDEuMTc4SDcuMDgydi0uNDhTNy4wNjcuMjggNi42NDUuMjhINC44MzhjLS40MiAwLS40MDYuNDItLjQwNi40MnYuNDc5aC0zLjMxYS44NDIuODQyIDAgMCAwLS44NDQuODR2MS4zOGgxMC45NTZ2LTEuMzhhLjg0Mi44NDIgMCAwIDAtLjg0NC0uODR6Ii8+PC9nPjwvc3ZnPg==">
                                </div>
                                <div class="clearfix" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="/verificar" method="POST" enctype="multipart/form-data" id="fr-worked">
                            @csrf
                        <div class="row">

                           
                                <div class="col-xs-12 col-md-12">
                                <div class="cd-form floating-labels spacet-10">
                                    <div class="no-icon">
                                        <textarea name="anotacion" class="small-textarea" placeholder="{{ __('home_anotacion')}}"></textarea>
                                    </div>
                                </div>
                               

                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" class="form-control" name="picture1">
                                </div>
                                <div class="form-group">
                                        <label for="imagen">Imagen</label>
                                        <input type="file" class="form-control" name="picture2">
                                </div>
                                <div class="form-group">
                                        <label for="imagen">Imagen</label>
                                        <input type="file" class="form-control" name="picture3">
                                </div>
                                <div class="form-group">
                                        <label for="imagen">Imagen</label>
                                        <input type="file" class="form-control" name="picture4">
                                </div>
                                <div class="form-group">
                                        <label for="imagen">Imagen</label>
                                        <input type="file" class="form-control" name="picture5">
                                </div>
                            </div>

                                <input type="hidden" name="codepostal" id="codepostal">
                                <input type="hidden" name="makecar" id="makecar">
                                <input type="hidden" name="modelcar" id="modelcar">
                                <input type="hidden" name="yearcar" id="yearcar">
                                <input type="hidden" name="service" id="service">
                                <input type="hidden" name="subservice" id="subservice">
                                <input type="hidden" name="datework" id="datework">
                                <input type="hidden" name="price" id="price">
                                <input type="hidden" name="latitud" id="latitud">
                                <input type="hidden" name="longitud" id="longitud"> 
                                <input type="hidden" name="namestore" id="namestore"> 
                                <input type="hidden" name="fechaservicio" id="fechaservicio"> 

                                <input type="hidden" name="iduserservice" id="iduserservice">

                        </div>


                        <div class="row">
                            <div class="col-sm-5 col-centered">
                                <div class="btn-orange-fill spacet-20 btn-notas">{{ __('home_continuar')}}</div>
                             </div>
                         </div>
                    
                        </form>
                     </div>
            </section>
           
            <section class="row bd-section bd-section--payment bd-section" id="fr-contact" style="display:none" >
                    <div class="col-xs-12 col-md-12" >
                       <div class="shadow-box-fill bd-box-padding" >
                          <h3 class="g-section-header-text1">{{__('home_information')}}/h3>
                          <div class="row spacet-10">
                             <div class="col-sm-6">
                                <div class="cd-form floating-labels js" >
                                   <div class="icon" >
                                       <label for="contactName" class="cd-label" >{{__('home_nombres')}}</label>
                                       <input id="contactName" class="user" type="text" value="" >
                                    </div>
                                </div>
                             </div>
                             <div class="col-sm-6" >
                                <div class="cd-form floating-labels js" >
                                   <div class="icon" >
                                       <label for="contactEmail" class="cd-label">{{__('home_email')}}</label>
                                       <input id="contactEmail" class="email" type="text" value="">
                                    </div>
                                </div>
                             </div>
                          </div>
                          <div class="row spacet-10">
                             <div class="col-sm-6">
                                <div class="cd-form floating-labels js">
                                   <div class="icon">
                                       <label for="contactPhone" class="cd-label">{{__('home_phone')}}</label>
                                       <input id="contactPhone" class="phonenumber" type="text" value=""></div>
                                </div>
                             </div>
                          </div>


                    
                       </div>

                       <div class="row">
                           <div class="col-sm-5 col-centered">
                               <div class="btn-orange-fill spacet-20 btn-contact">{{ __('home_continuar')}}</div>
                            </div>
                        </div>
                    </div>
                 </section>

    </div>
<!-- side-->
    <div class="col-lg-4 hidden-sm hidden-md">
                <div class="map" id="canvas">
                                   
                </div>
            <div class="card">
                <div class="card-header bd-sidebar-price-box">
                   
                </div>
                <div class="card-body detallesservicio" style="display:none">
                    <div class="col-xs-12">
                        <h3 class="g-section-header-text">{{ __('home_summary') }}</h3>
                        <div id="sidebar-zip" class="bd-sidebar-property bd-sidebar-property--scrollable spacet-10">
                            30301 - atlanta
                        </div>
                        <div id="sidebar-car" class="bd-sidebar-property bd-sidebar-property--scrollable">
                            Select car
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="bd-optional-services">
                            <div class="bd-optional-services__text">
                                {{__('Services')}}
                            </div>
                            <div class="bd-optional-services__line">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="bd-sidebar-service-list__item">
                           

                            <div class="bd-sidebar-property bd-sidebar-job-name bd-sidebar-property--scrollable pull-left">
                                    Change Oil and Filter
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="datatool">
    @csrf
 
                                         
</form>
@endsection
