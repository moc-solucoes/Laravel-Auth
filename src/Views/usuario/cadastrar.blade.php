@extends('Core::shared.able-pro-externo')

@section('content')
    <div class="col col-md-5 col-lg-4 col-sm-12 col-xs-12 mx-auto">
    @include('Core::shared/_messages')
    <!-- Authentication card start -->
        <form action="{{route('usuario.cadastrar')}}" method="post"
              class="md-float-material form-material m-t-40 m-b-40">
            {{csrf_field()}}
            <div class="auth-box card">
                <div class="card-block">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <h3 class="text-center txt-primary">Cadastro de Usuário</h3>
                        </div>
                    </div>
                    <p class="text-muted text-center p-b-5">Cadastrar conta na MOC Soluções, todos os campos são
                        obrigatórios.</p>
                    <div class="form-group form-primary">
                        <input type="text" name="nome" class="form-control fill" required="" value="{{old("nome")}}">
                        <span class="form-bar"></span>
                        <label class="float-label">Nome Completo</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="email" name="email" class="form-control fill" required="" value="{{old("email")}}">
                        <span class="form-bar"></span>
                        <label class="float-label">E-mail</label>
                    </div>

                    <div class="form-group form-primary">
                        <input type="text" name="telefone" class="form-control fill telefone"
                               value="{{old("telefone")}}">
                        <span class="form-bar"></span>
                        <label class="float-label">Telefone</label>
                    </div>

                    <div class="form-group form-primary">
                        <input type="text" name="celular" class="form-control fill celular" value="{{old("celular")}}">
                        <span class="form-bar"></span>
                        <label class="float-label">Celular</label>
                    </div>

                    <div class="form-group form-primary">
                        <input type="text" name="cpf" class="form-control fill cpf" value="{{old("cpf")}}">
                        <span class="form-bar"></span>
                        <label class="float-label">CPF</label>
                    </div>
                    <div class="form-group form-primary">
                        <input type="text" name="senha" class="form-control fill" value="{{old("senha")}}">
                        <span class="form-bar"></span>
                        <label class="float-label">Senha</label>
                    </div>
                    <div class="row m-t-25 text-left">
                        <div class="col-12">
                            {{--<div class="checkbox-fade fade-in-primary">
                                <label>
                                    <input type="checkbox" value="">
                                    <span class="cr"><i
                                            class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse">Remember me</span>
                                </label>
                            </div>--}}
                            <div class="forgot-phone text-right float-right">
                                <a href="{{route('usuario.recuperar-senha')}}" class="text-right f-w-600">
                                    Recuperar senha?
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-30">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-md waves-effect text-center m-b-20">
                                Cadastrar
                            </button>
                            <button type="reset" class="btn btn-danger btn-md waves-effect text-center m-b-20">
                                Limpar
                            </button>
                        </div>
                    </div>
                    <p class="text-inverse text-center">
                        <a href="{{route('usuario.logar')}}">Voltar para tela de login?</a>
                    </p>
                </div>
            </div>
        </form>
        <!-- Authentication card end -->
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset(elixir('module/shared/js/select2.js'))}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".telefone").mask("(99) 9999-99990");
            $(".celular").mask("(99) 9999-99990");
            $(".cpf").mask("999.999.999-99");
        });
    </script>
@endsection
