@if (hasPermission('administrar.usuarios'))
    <a href="{{route('auth.admin.usuario.editar', ['id' => $usuario->id])}}"
       class="btn btn-xs btn-primary ' text-white">
        <i class="fa fa-edit small"></i> Editar
    </a> &nbsp;
@endif
@if (hasPermission('administrar.usuarios'))
    <a class="btn btn-xs btn-danger"
       href="{{route('auth.admin.usuario.excluir', ['id' => $usuario->id])}}" data-toggle="tooltip"
       data-placement="top"
       title="Excluir Usuário">
        <i class="fa fa-remove"></i> Excluir
    </a>
@endif