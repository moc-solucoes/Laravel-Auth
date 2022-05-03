@extends('Core::shared.able-pro')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('auth.admin.usuario.perfil')}}">Perfis</a>
    </li>
@endsection

@section('title')
    Perfis
@endsection

@section('content')
    <div class="row">
        @include('Core::shared._messages')
    </div>
    <div class="row mb-3">
        <div class="col col-12">
            <a href="{{route('auth.admin.usuario.perfil.cadastrar')}}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>
                Novo Perfil
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col col-12">
            <table class="table dataTable table-bordered" width="100%">
                <colgroup>
                    <col width="10%"/>
                    <col width="45%"/>
                    <col width="15%"/>
                    <col width="15%"/>
                    <col width="15%"/>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th class="text-center">Criado Em</th>
                    <th class="text-center">Atualizado Em</th>
                    <th class="text-center">Opções</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th class="text-center">Criado Em</th>
                    <th class="text-center">Atualizado Em</th>
                    <th class="text-center">Opções</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @include('Core::shared.modais._excluir')
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('module/shared/css/datatable.css')}}" type="text/css" media="all"/>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('module/shared/js/datatable.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var translate = '{{asset("json/Portuguese-Brasil.json")}}';
            var rotaListaApi = '{{route('auth.admin.api.usuario.perfil')}}';
            var rotaEditar = '{{route('auth.admin.usuario.perfil.editar')}}';

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
                {
                    'data': function (data) {
                        return '<label class="">' + data.nome + '</label>';
                    }, 'className': 'text-wrap'
                },
                {
                    'data': function (data) {
                        return '<label class="">' + data.criado + '</label>';
                    }, 'className': 'text-wrap text-center'
                },
                {'data': 'atualizado', 'className': 'text-wrap text-center'},
                {
                    'data': function (data) {
                        return '<a href="' + rotaEditar + '/' + data.id + '" class="btn btn-xs btn-' + getCor(data.deleted_at) + ' text-white"><i class="fa fa-edit small"></i> Editar </a> &nbsp;';
                    }, className: 'text-center'
                },
            ];

            var table = RenderDataTableServerSideOnPost(rotaListaApi, translate, columns, null, null, function (d) {
            }, createdRow);


            $('.dataTable tbody').on('click', 'tr', function () {
                var data = table.row(this).data();
                $(this).find('.modal-detalhes')[0].click();
            });
        });
    </script>
@endsection
