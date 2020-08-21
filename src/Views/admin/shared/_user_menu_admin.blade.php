@if(
   hasPermission('administrar.usuarios') ||
   hasPermission('administrar.usuarios.perfis') ||
   hasPermission('administrar.usuarios.permissoes') ||
   hasPermission('administrar.usuarios.servicos')
)
    <div class="pcoded-navigation-label">Usuários</div>
    <li class="" {{!hasPermission('administrar.usuarios') ? 'hidden' : ''}}>
        <a href="{{route('auth.admin.usuario')}}" class="waves-effect waves-dark">
                <span class="pcoded-micon">
                    <i class="feather icon-user"></i>
                </span>
            <span class="pcoded-mtext">Usuários</span>
        </a>
    </li>
    <li class="" {{!hasPermission('administrar.usuarios.perfis') ? 'hidden' : ''}}>
        <a href="{{route('auth.admin.usuario.perfil')}}" class="waves-effect waves-dark">
                <span class="pcoded-micon">
                    <i class="fa fa-product-hunt"></i>
                </span>
            <span class="pcoded-mtext">Perfis</span>
        </a>
    </li>
    <li class="" {{!hasPermission('administrar.usuarios.permissoes') ? 'hidden' : ''}}>
        <a href="{{route('auth.admin.usuario.permissao')}}" class="waves-effect waves-dark">
                    <span class="pcoded-micon">
                        <i class="fa fa-user-secret"></i>
                    </span>
            <span class="pcoded-mtext">Permissões</span>
        </a>
    </li>
@endif