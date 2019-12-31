@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('admin.usuario.listar')}}">Usuários</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.usuario.detalhes', ['usuario' => $usuario->id])}}">Detalhes do Usuário</a>
    </li>
@endsection

@section('title')
    Detalhes do Usuário
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('fatura'))
                {{alert("Fatura <code>".session('fatura')."</code> editada com sucesso.", 'success')}}
            @endif
            @if(session('message'))
                {{alert(session("message"), 'success')}}
            @endif
            <!-- tab header start -->
            <div class="tab-header card">
                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                    <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#personal" role="tab"
                           aria-selected="true">
                            Informações Pessoais
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#projetos" role="tab" aria-selected="false">
                            Projetos
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#documentos" role="tab" aria-selected="false">
                            Documentos
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#faturas" role="tab" aria-selected="false">
                            Faturas
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>
            </div>
            <!-- tab header end -->
            <!-- tab content start -->
            <div class="tab-content">
                <!-- tab panel personal start -->
                <div class="tab-pane active show" id="personal" role="tabpanel">
                    <!-- personal card start -->
                    @include('admin.usuario._meus_dados')
                    <!-- personal card end-->
                </div>
                <!-- tab pane personal end -->
                <!-- start: aba de projetos -->
                <div class="tab-pane" id="projetos" role="tabpanel">
                    @if(hasPermission('administrar.projetos'))
                        @include('admin.projeto._projetos')
                    @else
                        {{alert("Não possui permissões para efetuar esta manutenção.", 'warning')}}
                    @endif
                </div>
                <!-- End: aba de projetos -->
                <!-- tab pane info start -->
                <div class="tab-pane" id="documentos" role="tabpanel">
                    @if(hasPermission('administrar.documentos'))
                        @include('admin.usuario._documento')
                    @else
                        {{alert("Não possui permissões para efetuar esta manutenção.", 'warning')}}
                    @endif
                </div>
                <!-- tab pane info end -->
                <!-- tab pane contact start -->
                <div class="tab-pane" id="faturas" role="tabpanel">
                    @if(hasPermission('administrar.faturas'))
                        @include('admin.fatura._faturas')
                    @else
                        {{alert("Não possui permissões para efetuar esta manutenção.", 'warning')}}
                    @endif
                </div>
            </div>
            <!-- tab content end -->
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dataTable').DataTable({
                "aaSorting": [[0, "desc"]],
                "language": {
                    "url": '{{asset("json/Portuguese-Brasil.json")}}'
                }
            });
        });
    </script>
@endsection
