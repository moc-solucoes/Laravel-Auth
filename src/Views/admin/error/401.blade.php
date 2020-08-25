@extends('shared.able-pro')

@section('css')
@endsection

@section('breadcrumbs')
@endsection

@section('title')
    Permissão Negada
@endsection

@section('content')
    <div class="col-sm-5 offset-sm-1 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
        <div class="row text-center m-2 text-danger">
            <div class="col col-12">
                <h2 class="error-code text-center mb-2"> 401 </h2>
            </div>
        </div>
        <div class="row text-center m-2 text-danger">
            <div class="col col-12">
                <h3 class="text-uppercase text-center"> Permissão Negada </h3>
            </div>
        </div>
        <div class="row text-center m-2">
            <div class="col col-12">
                Contate um administrador para obter acesso a este recurso.
            </div>
        </div>
        <div class="row px-2 text-center m-4">
            <div class="col-12 text-center">
                <a href="{{back()}}" class="btn btn-md btn-outline-danger">
                    <i class="fa fa-home"></i>
                    Voltar
                </a>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
