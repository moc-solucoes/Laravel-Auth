@extends('shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('usuario.listar')}}">Usuário</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('usuario.editar', ['id' => $usuario->id])}}">Editar Usuário</a>
    </li>
@endsection

@section('title')
    Cadastrar Usuário
@endsection

@section('content')
    <div class="row">
        @include('shared._messages')
    </div>
    <form class="form-material" action="{{route('usuario.editar', ['id' => $usuario->id])}}" method="post">
        @csrf
        <div class="row">
            <div class="col col-3">
                <div class="form-group form-default">
                    <input type="text" name="usuario" class="form-control fill" required pattern="[a-zA-Z0-9\.]{3,}"
                           title="Apenas caracteres de a à Z, 0 á 9 e de '.' são permitidos."
                           value="{{$usuario->usuario}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">Usuário</label>
                </div>
            </div>
            <div class="col col-3">
                <div class="form-group form-default">
                    <input type="text" name="matricula" class="form-control fill" required pattern="[0-9\.]{2,}"
                           title="Apenas caracteres de 0 á 9 e de '.' são permitidos." value="{{$usuario->matricula}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">Matrícula</label>
                </div>
            </div>
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="email" name="email" class="form-control fill" required value="{{$usuario->email}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">E-mail</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-3">
                <div class="form-group form-default">
                    <input type="text" name="ramal" class="form-control fill" value="{{$usuario->ramal}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">Ramal</label>
                </div>
            </div>
            <div class="col col-9">
                <div class="form-group form-default">
                    <input readonly type="text" name="nome" class="form-control fill" required
                           pattern="[a-zA-Z0-9\.\-]{3,}"
                           title="Apenas caracteres de a à Z, 0 á 9 e de '.-' são permitidos." value="{{$usuario->nome}}"/>
                    <span class="form-bar"></span>
                    <label class="float-label">Nome</label>
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
    <script type="text/javascript">
        $(document).ready(function () {
            $('[name="usuario"]').blur(function () {
                $campoNome = $('[name="nome"]');
                $campoEmail = $('[name="email"]');
                $campoNome.val("Carregando dados...");

                $.getJSON('{{route('api.usuario.ad')}}/' + $(this).val(), function (data) {
                    if (data.resultado == true) {
                        $campoNome.val(data.user.name);
                        $campoEmail.val(data.user.mail);
                    } else {
                        $campoNome.val('');
                    }
                }).fail(() => {
                    $campoNome.val('');
                });
            });
        });
    </script>
@endsection
