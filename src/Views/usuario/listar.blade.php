@extends('shared.able-pro')
@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{route('usuario.listar')}}">Usuários</a>
    </li>
@endsection

@section('title')
    Usuários
@endsection

@section('content')
    <div class="row">
        @include('shared._messages')
    </div>
    <div class="row mb-3">
        <div class="col col-12">
            <a href="{{route('usuario.cadastrar')}}" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i>
                Novo Usuário </a>
        </div>
    </div>

    <div class="row">
        <div class="col col-12">
            <table class="table dataTable table-bordered" width="100%">
                <colgroup>
                    <col width="10%"/>
                    <col width="10%"/>
                    <col width="25%"/>
                    <col width="25%"/>
                    <col width="20%"/>
                    <col width="10%"/>
                </colgroup>
                <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfis</th>
                    <th class="text-center">Opções</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Usuário</th>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfis</th>
                    <th class="text-center">Opções</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @include('shared.datatable._modal-excluir')
    @include('agendamento.datatable._modal-detalhe')
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset(mix('module/shared/css/datatable.css'))}}" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{asset(mix('module/shared/css/mask-select2.css'))}}" type="text/css" media="all">
    <style type="text/css">
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            /*color: #fff;*/
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            background: #fff;
            background-clip: padding-box;
            color: #495057;
            border-radius: 2px;
            font-size: 14px;
            border: 1px solid #ccc;
            line-height: 1.5;
            font-weight: 400;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #000 transparent transparent transparent;
        }

        .bg-danger-dt {
            background-color: rgba(255, 82, 82, 0.22);
        }

        .bg-success-dt {
            background-color: rgba(156, 204, 101, 0.22);
        }

        .bg-primary-dt {
            background-color: rgba(68, 138, 255, 0.22);
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset(mix('module/shared/js/datatable.js'))}}"></script>
    <script type="text/javascript" src="{{asset(mix('module/shared/js/mask-select2.js'))}}"></script>

    <script type="text/javascript">
        $('#servico').val('0').trigger('change');

        $(document).ready(function () {
            function getFormData(d) {
                var formdata = $("#agendamentos-form").serializeArray();

                var data = {};

                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });

                var datastring = {filtro: data};

                d.filtro = data;
            }

            var translate = '{{asset("json/Portuguese-Brasil.json")}}';
            var rotaListaApi = '{{route('api.usuario.lista')}}';
            var rotaEditar = '{{route('usuario.editar')}}';

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
                        return '<label class="badge badge-' + getCor(data.deleted_at) + '">' + data.usuario + '</label>'
                    }, 'className': 'text-center'
                },
                {
                    'data': function (data) {
                        return '<label class="badge badge-' + getCor(data.deleted_at) + '">' + data.matricula + '</label>';
                    }, 'className': 'text-center'
                },
                {
                    'data': function (data) {
                        return '<label class="">' + data.nome + '</label>';
                    }, 'className': 'text-wrap'
                },
                {'data': 'email', 'className': 'text-wrap'},
                {'data': 'perfilImplode', 'className': 'text-wrap'},
                {
                    'data': function (data) {
                        var valor = data;
                        var botoes = '<a href="' + rotaEditar + '/' + data.id + '" class="btn btn-xs btn-' + getCor(data.deleted_at) + ' text-white"><i class="fa fa-edit small"></i> Editar </a> &nbsp;';
                        return botoes;
                    }, className: 'text-center'
                },
            ];

            var table = RenderDataTableServerSideOnPost(rotaListaApi, translate, columns, null, null, getFormData, createdRow);

            $('.btn-filtro').click(function () {
                table.ajax.reload();
            });

            $('#data, #horaInicio').blur(function () {
                table.ajax.reload();
            });

            $('#servico, #situacao').change(function () {
                table.ajax.reload();
            });

            $('.dataTable tbody').on('click', 'tr', function () {
                var data = table.row(this).data();
                alimentaModalDetalhes(data);
                $(this).find('.modal-detalhes')[0].click();
            });

            function alimentaModalDetalhes(data) {
                $('#dataServico').html(data.Servico.nome);
                $('#dataUnidade').html(data.Unidade.nome);
                $('#dataData').html(data.data);
                $('#dataHora').html(data.hora_inicio);
                $('#dataNome').html(data.nome);
                $('#dataDocumento').html(data.DocumentoTipo.nome + ' - ' + data.documento);
                $('#dataTelefone').html(data.telefone);
                $('#dataSituacao').html("Situação: " + data.situacao);
                $('.modal-cor').removeClass('bg-primary bg-danger bg-success').addClass('bg-' + getCor(data.situacao))
                $('#dataSituacao').removeAttr('class').addClass('badge badge-md badge-' + getCor(data.situacao))
                $("#btnCancelar, #btnConfirmar").attr('data-id', data.id);

                if (data.situacao == 'cancelado' || data.situacao == 'confirmado') {
                    $("#btnCancelar, #btnConfirmar").hide();
                } else {
                    $("#btnCancelar, #btnConfirmar").show();
                }
            }

            $("#btnCancelar").click(function () {
                var id = $(this).data('id');

                window.location.href = '{{route('agendamento.cancelar')}}/' + id;
            });

            $('#btnConfirmar').click(function () {
                var id = $(this).data('id');

                window.location.href = '{{route('agendamento.confirmar')}}/' + id;
            });
        });
    </script>
@endsection
