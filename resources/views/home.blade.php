@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="center-text">
            <h1>{{__('Answer a few simple questions to get a quote.')}}</h1>
            <p>{{ __('Service at your home or office 7 days a week Fair and trasparent pricing')}}</p>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Already have an account?')}} <a href="{{ route('login') }}" class="logueo">{{ __('log in')}}</a></div>

                <div class="card-body">
                   <h2>Enter your location</h2>
                   <div class="row">
                    <div class="col-md-6">
                        <form action="">
                            <div class="form-group">
                                <label for="zipcode">ZIP CODE</label>
                                <input type="text" id="zipcode" class="form-control" maxlength="5" >
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="box-msn" style="display:none;">
                            {{ __("Great! we have certified mobile mechanics in")}}
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary btn-lg btn-confirmar" style="display:none;">{{ __('Confirm ZIP CODE')}}</a>
                </div>                   
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('detail') }}
                </div>
                <div class="card-body">
                    {{ __('cuerpo detalle') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
