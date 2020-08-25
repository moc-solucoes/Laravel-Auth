@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.permissao')}}">Permissões</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.permissao.cadastrar')}}">Cadastrar Permissão</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.permissao.editar', ['permissao' => $permissao->id])}}">Editar Permissão</a>
    </li>
@endsection

@section('title')
    Cadastrar Permissão
@endsection

@section('content')
    <div class="row">
        @include('Core::shared._messages')
    </div>
    <form class="form-material" action="{{route('auth.admin.usuario.permissao.editar')}}" method="post">
        @csrf
        <div class="row">
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" value="{{$permissao->nome}}" name="nome" class="form-control" required pattern="[a-zA-Z0-9\.\-]{3,}"
                           title="Apenas caracteres de a à Z, 0 á 9 e de '.-' são permitidos."/>
                    <span class="form-bar"></span>
                    <label class="float-label">Nome</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" value="{{$permissao->descricao}}" name="descricao" class="form-control" required>
                    <span class="form-bar"></span>
                    <label class="float-label">Descrição</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" value="{{$permissao->tipo}}" name="tipo" class="form-control" required pattern="[a-zA-Z0-9\.\-]{3,20}"
                           title="Apenas caracteres de a à Z, 0 á 9 e de '.-' são permitidos.">
                    <span class="form-bar"></span>
                    <label class="float-label">Tipo</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" value="{{$permissao->grupo}}" name="grupo" class="form-control" required pattern="[a-zA-Z0-9\.\-]{3,}"
                           title="Apenas caracteres de a à z - 0 á 9 e de '.' são permitidos.">
                    <span class="form-bar"></span>
                    <label class="float-label">Grupo</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-12">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Salvar</button>
            </div>
        </div>
    </form>
@endsection

@section('js')
@endsection
