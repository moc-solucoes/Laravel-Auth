@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('admin.usuario.listar')}}!">Usuários</a>
    </li>
@endsection

@section('title')
    Usuários
@endsection

@section('content')
    <div class="row">
        <div class="col col-12">
            <a href="{{route('admin.usuario.cadastrar')}}" class="btn btn-primary text-white mb-2 btn-sm">
                <i class="fa fa-plus"></i> Adicionar Usuário
            </a>
        </div>
        <div class="col col-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col col-12">
            <table id="dataTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th class="text-center">Criada em</th>
                    <th class="text-center">Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr class="{{'text-'.$usuario->cor}}">
                        <th>#{{$usuario->id}}</th>
                        <td>{{$usuario->nome}}</td>
                        <td>{{$usuario->email}}</td>
                        <td class="text-center">{{$usuario->dt_criacao}}</td>
                        <th class="text-center">
                            <a class="btn btn-mini {{'btn-'.$usuario->cor}}"
                               href="{{route('admin.usuario.detalhes', ['usuario' => $usuario->id])}}" data-toggle="tooltip"
                               data-placement="top"
                               title="Detalhes da usuário">
                                <i class="fa fa-list-alt"></i>
                            </a>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "aaSorting": [[0, "desc"]],
                "language": {
                    "url": '{{asset("json/Portuguese-Brasil.json")}}'
                }
            });
        });
    </script>
@endsection
