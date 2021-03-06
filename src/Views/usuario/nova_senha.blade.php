@extends('Core::shared.able-pro-externo')

@section('content')
    <div class="col col-md-5 col-lg-4 col-sm-12 col-xs-12 mx-auto">
        <!-- Authentication card start -->
        @include('Core::shared._messages')

        <form action="{{route('usuario.recuperar-senha.token', ['token' => $token->token])}}" method="post"
              class="md-float-material form-material m-t-40 m-b-40">
            {{csrf_field()}}
            <div class="auth-box card">
                <div class="card-block">
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            <h3 class="text-center txt-primary">Recuperação de Senha</h3>
                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-md-6">
                            <button class="btn btn-facebook m-b-20 btn-block btn-disabled" disabled><i
                                    class="icofont icofont-social-facebook"></i>facebook
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-google-plus m-b-20 btn-block btn-disabled" disabled>
                                <i class="icofont icofont-social-google-plus"></i> Google+
                            </button>
                        </div>
                    </div>
                    <p class="text-muted text-center p-b-5">
                    <h5 class="mx-auto text-center">Olá, {{$token->Usuario->nome}}</h5> <br/>
                    <i class="fa-fw fa fa-info-circle"></i>
                    Para alterar sua senha digite sua <code>Nova Senha</code> e sua <code>Repetição de Senha</code>,
                    feito isto basta
                    clicar no botão <code>Alterar</code>.
                    </p>
                    <div class="form-group form-primary">
                        @csrf
                        <div class="row">
                            <div class="col col-12">
                                <div class="form-group form-default">
                                    <input type="text" class="form-control readonly fill" name="token"
                                           value="{{$token->token}}" disabled required>
                                    <input type="hidden" value="{{$token->token}}" required>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Token</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12">
                                <div class="form-group form-default">
                                    <input type="password" name="new" class="form-control" required>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Senha Nova</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12">
                                <div class="form-group form-default">
                                    <input type="password" name="re-new" class="form-control" required>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Repetição de Senha</label>
                                </div>
                            </div>
                        </div>
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
                                <a href="{{route('usuario.logar')}}" class="text-right f-w-600">
                                    Voltar para tela de login?
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <button type="submit"
                                    class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                Recuperar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Authentication card end -->
    </div>
@endsection
