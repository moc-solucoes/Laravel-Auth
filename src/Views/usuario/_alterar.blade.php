<div class="alert alert-info">
    <i class="fa-fw fa fa-info-circle"></i>
    Para alterar sua senha digite sua <code>Senha Atual</code> e sua <code>Nova Senha</code>, feito isto basta
    clicar no botão <code>Alterar</code>.
</div>
<form class="form-material" action="{{route("usuario.alterar-senha")}}" method="post">
    @csrf
    <div class="row">
        <div class="col col-8">
            <div class="form-group form-default">
                <input type="password" name="old" class="form-control" required>
                <span class="form-bar"></span>
                <label class="float-label">Senha Atual</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-8">
            <div class="form-group form-default">
                <input type="password" name="new" class="form-control" required>
                <span class="form-bar"></span>
                <label class="float-label">Senha Nova</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-8">
            <div class="form-group form-default">
                <input type="password" name="re-new" class="form-control" required>
                <span class="form-bar"></span>
                <label class="float-label">Repetição de Senha</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col col-12">
            <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fa fa-save"></i>
                Alterar
            </button>
            <button type="reset" class="btn btn-outline-danger btn-sm"><i class="fa fa-remove"></i>
                Limpar
            </button>
        </div>
    </div>
</form>
