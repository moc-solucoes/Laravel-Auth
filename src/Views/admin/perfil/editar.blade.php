@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.perfil')}}">Perfil</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.perfil.cadastrar')}}">Editar Perfil</a>
    </li>
@endsection

@section('title')
    Editar Perfil
@endsection

@section('content')
    <div class="row">
        @include('Core::shared._messages')
    </div>
    <form class="form-material" action="{{route('auth.admin.usuario.perfil.editar', ['id'=> $perfil->id])}}" method="post">
        @csrf
        <div class="row">
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" name="nome" class="form-control fill" required pattern="[a-zA-Z0-9\.\-]{3,}"
                           value="{{$perfil->nome}}"
                           title="Apenas caracteres de a à Z, 0 á 9 e de '.-' são permitidos."/>
                    <span class="form-bar"></span>
                    <label class="float-label">Nome</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <h5>Permissões do Perfil</h5>
                <form method="POST">
                    <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                        @foreach($permissoes as $key => $permissao)
                            <li class="nav-item">
                                <a class="nav-link flex-sm-fill {{$key == "Administrativa" ? 'active' : ''}}"
                                   id="home-tab"
                                   data-toggle="tab" href="#{{$key}}" role="tab"
                                   aria-controls="home" aria-selected="true">{{$key}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($permissoes as $key => $permissao)
                            <div class="tab-pane fade show {{$key == "Administrativa" ? 'active' : ''}}" id="{{$key}}"
                                 role="tabpanel"
                                 aria-labelledby="home-tab">
                                <br/>
                                <div class="row">
                                    @foreach($permissao as $key => $permission)
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox checkbox-inline">
                                                <input type="checkbox" class="custom-control-input"
                                                       value="{{$permission->id}}"
                                                       name="permissoes[]"
                                                       {{$permission->checked ? 'checked' : ''}} id="{{$permission->id}}">
                                                <label class="custom-control-label"
                                                       for="{{$permission->id}}">{{$permission->descricao}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-5">
                        <div class="col col-12">
                            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i>
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>
@endsection

@section('js')
@endsection
