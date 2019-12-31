@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('admin.usuario.listar')}}">Usuários</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.usuario.cadastrar')}}">Cadastrar Usuário</a>
    </li>
@endsection

@section('title')
    Cadastrar Usuário
@endsection

@section('content')
    <div class="row">
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
            @if (isset($mensagem))
                <div class="alert alert-success alert-dismissible">
                    <ul>
                        {{$mensagem}}
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <form class="form-material" action="{{route('admin.usuario.salvar')}}" method="post">
        @csrf
        <div class="row">
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" name="nome" class="form-control" required="">
                    <span class="form-bar"></span>
                    <label class="float-label">Nome Completo</label>
                </div>
            </div>
            <div class="col col-6">
                <div class="form-group form-default">
                    <input type="text" name="email" class="form-control" required="">
                    <span class="form-bar"></span>
                    <label class="float-label">E-mail (contato@mocsolucoes.com.br)</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-12">
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i> Salvar</button>
            </div>
        </div>
        {{--<div class="col col-12">
            <div class="form-group form-default form-static-label">
                <input type="password" name="footer-email" class="form-control" placeholder="Enter Password"
                       required="">
                <span class="form-bar"></span>
                <label class="float-label">Password</label>
            </div>
            <div class="form-group form-default form-static-label">
                <input type="text" name="footer-email" class="form-control" required="" placeholder="Pre define value"
                       value="My value">
                <span class="form-bar"></span>
                <label class="float-label">Predefine value</label>
            </div>
            <div class="form-group form-default form-static-label">
                <input type="text" name="footer-email" class="form-control" required="" placeholder="disabled Input"
                       disabled="">
                <span class="form-bar"></span>
                <label class="float-label">Disabled</label>
            </div>
            <div class="form-group form-default form-static-label">
                <input type="text" name="footer-email" class="form-control" required="" maxlength="6"
                       placeholder="Enter only 6 char">
                <span class="form-bar"></span>
                <label class="float-label">Max length 6 char</label>
            </div>
            <div class="form-group form-default form-static-label">
                <textarea class="form-control" required="">Enter Text hear</textarea>
                <span class="form-bar"></span>
                <label class="float-label">Text area Input</label>
            </div>
        </div>--}}
    </form>
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
