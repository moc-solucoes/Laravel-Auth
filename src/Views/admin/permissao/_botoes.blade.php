@if (hasPermission('administrar.usuarios.permissoes'))
    <a class="btn btn-xs btn-outline-primary"
       href="{{route('auth.admin.usuario.permissao.editar', ['id' => $permissao->id])}}" data-toggle="tooltip"
       data-placement="top"
       title="Editar Permissão">
        <i class="fa fa-edit"></i>
    </a>
@endif
<button data-toggle="modal" data-target="#modalDetalhes"
        class="btn btn-xs btn-primary text-white modal-detalhes"><i class="fa fa-eye small"></i>
</button> &nbsp;