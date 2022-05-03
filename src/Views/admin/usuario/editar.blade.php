@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario')}}">Usuário</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.editar', ['id' => $usuario->id])}}">Editar Usuário</a>
    </li>
@endsection

@section('title')
    Cadastrar Usuário
@endsection

@section('content')
    <div class="row">
        @include('Core::shared._messages')
    </div>
    <div class="row">
        <div class="col col-12">
            {{alert("Para não alterar a senha basta deixar o campo em branco.")}}
        </div>
    </div> <br />
    <form class="form-material" action="{{route('auth.admin.usuario.editar', ['id' => $usuario->id])}}" method="post">
        @csrf
        <div class="row">
            <div class="col col-3">
                <div class="form-group form-default">
                    <input type="text" name="nome" class="form-control fill" required
                           title="Necessário mais que 3 caracteres."
                           value="{{$usuario->nome}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">Nome</label>
                </div>
            </div>
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="email" name="email" class="form-control fill" required value="{{$usuario->email}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">E-mail</label>
                </div>
            </div>
            <div class="col col-3">
                <div class="form-group form-default">
                    <input type="password" name="senha" class="form-control fill"
                           title="Mínimo 4 caracteres para senha."/>
                    <span class="form-bar"></span>
                    <label class="float-label">Senha</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-3">
                <div class="form-group form-default">
                    <input type="text" name="nascimento" class="form-control fill data"
                           value="{{$usuario->nascimento}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">Nascimento</label>
                </div>
            </div>
            <div class="col col-9">
                <div class="form-group form-default">
                    <input type="text" name="cpf" class="form-control fill cpf" required value="{{$usuario->cpf}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">CPF</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <h5>Perfis vinculados</h5>
                <div class="row">
                    @foreach($perfis as $key => $perfil)
                        <div class="col-6">
                            <div class="custom-control custom-checkbox checkbox-inline">
                                <input type="checkbox" class="custom-control-input"
                                       name="perfis[{{$perfil->id}}]" value="{{$perfil->id}}"
                                       {{$perfil->checked ? 'checked' : ''}}
                                       id="{{$perfil->id}}">
                                <label class="custom-control-label" for="{{$perfil->id}}">
                                    {{$perfil->nome}}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-3">
                    <div class="col col-12">
                        <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i>
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('module/shared/js/select2.js')}}"></script>
    <script type="text/javascript">
        $(".cpf").mask("999.999.999-99");
        $(".data").mask("99/99/9999");
    </script>
@endsection
