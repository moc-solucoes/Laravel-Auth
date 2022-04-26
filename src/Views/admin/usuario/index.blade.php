@extends('Core::shared.able-pro')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario')}}">Usuários</a>
    </li>
@endsection

@section('title')
    Usuários
@endsection

@section('content')
    <div class="row">
        @include('Core::shared._messages')
    </div>
    <div class="row mb-3">
        <div class="col col-12">
            <a href="{{route('auth.admin.usuario.cadastrar')}}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>
                Novo Usuário </a>
        </div>
    </div>

    <div class="row">
        <div class="col col-12">
            <table class="table dataTable table-bordered" width="100%">
                <colgroup>
                    <col width="10%"/>
                    <col width="30%"/>
                    <col width="25%"/>
                    <col width="25%"/>
                    <col width="10%"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfis</th>
                    <th>Opções</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfis</th>
                    <th>Opções</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @include('Core::shared.modais._excluir')
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset(mix('module/shared/css/datatable.css'))}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{asset(mix('module/shared/css/select2.css'))}}" type="text/css" media="all">
@endsection

@section('js')
    <script type="text/javascript" src="{{asset(mix('module/shared/js/datatable.js'))}}"></script>

    <script type="text/javascript">
        $('#servico').val('0').trigger('change');

        $(document).ready(function () {
            var translate = '{{asset("json/Portuguese-Brasil.json")}}';
            var rotaListaApi = '{{route('auth.admin.api.usuario')}}';

            function getCor(situacao) {
                return situacao != null ? 'danger' : 'primary';
            }

            function createdRow(row, data, dataIndex) {
                if (data.deletd_at != null)
                    $(row).addClass('bg-' + getCor(data.situacao) + '-dt');
            }

            var columns = [
                {
                    'data': function (data) {
                        return '<label class="badge badge-' + getCor(data.deleted_at) + '">' + data.id + '</label>'
                    }, 'className': 'text-center'
                },
                {'data': 'nome', 'className': 'text-wrap'},
                {'data': 'email', 'className': 'text-wrap'},
                {'data': 'perfilImplode', 'className': 'text-wrap'},
                {'data': 'botoes', className: 'text-center'},
            ];


            function aditionalParam(d) {
            }

            var table = RenderDataTableServerSideOnPost(rotaListaApi, translate, columns, null, null, aditionalParam, createdRow);


            $('.dataTable tbody').on('click', 'tr', function () {
                var data = table.row(this).data();
                $(this).find('.modal-detalhes')[0].click();
            });

            function alimentaModalDetalhes(data) {

            }
        });
    </script>
@endsection
