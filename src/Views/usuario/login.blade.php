@extends('Core::shared.able-pro-externo')

@section('js')
    {{--
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="735816093549-cgu9d95uur1d1vkglmq3ec62dbeeid7n.apps.googleusercontent.com">
        --}}
    <script src="https://apis.google.com/js/platform.js?onload=onLoadGoogleCallback" async defer></script>

    <script type="text/javascript">
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        }

        function onLoadGoogleCallback() {
            gapi.load('auth2', function () {
                auth2 = gapi.auth2.init({
                    client_id: '735816093549-cgu9d95uur1d1vkglmq3ec62dbeeid7n.apps.googleusercontent.com',
                    cookiepolicy: 'http://localhost',
                    scope: 'profile'
                });

                auth2.attachClickHandler(element, {},
                    function (googleUser) {
                        onSignIn(googleUser);
                    }, function (error) {
                        console.log('Sign-in error', error);
                    }
                );
            });

            element = document.getElementById('googleSignIn');
        }
    </script>
@endsection

@section('content')
    <div class="col col-md-5 col-lg-4 col-sm-12 col-xs-12 mx-auto">
    @include('Core::shared/_messages')
    <!-- Authentication card start -->
    <form action="{{route('usuario.logar')}}" method="post"
          class="md-float-material form-material m-t-40 m-b-40">
        {{csrf_field()}}
        <div class="auth-box card">
            <div class="card-block">
                <div class="row m-b-20">
                    <div class="col-md-12">
                        <h3 class="text-center txt-primary">Logar</h3>
                    </div>
                </div>
                <div class="row m-b-20">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-facebook m-b-20 btn-block" disabled
                                onclick="javascript:alert('Em desenvolvimento, em breve disponível.')"><i
                                class="icofont icofont-social-facebook"></i>facebook
                        </button>
                    </div>
                    <div class="col-md-6">
                        {{--<button type="button" class="btn btn-google-plus m-b-20 btn-block" disabled
                                onclick="javascript:alert('Em desenvolvimento, em breve disponível.')">
                            <i class="icofont icofont-social-google-plus"></i> Google+
                        </button>--}}
                        <button type="button" class="btn btn-google-plus m-b-20 btn-block" data-onsuccess="onSignIn" id="googleSignIn" disabled>
                            <i class="icofont icofont-social-google-plus"></i> Google+
                        </button>
                    </div>
                </div>
                <p class="text-muted text-center p-b-5">Entrar com sua conta MOC Soluções.</p>
                <div class="form-group form-primary">
                    <input type="email" name="email" class="form-control fill" required="" value="{{old("email")}}">
                    <span class="form-bar"></span>
                    <label class="float-label">E-mail</label>
                </div>
                <div class="form-group form-primary">
                    <input type="password" name="senha" class="form-control fill" required>
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
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                            LOGIN
                        </button>

                    </div>
                </div>
                <p class="text-inverse text-left">
                    Ainda não é cadastrado?
                    <a href="{{route('usuario.cadastrar')}}"> <b>Registre-se agora</b></a> gratuítamente!
                </p>
            </div>
        </div>
    </form>
    <!-- Authentication card end -->
    </div>
@endsection
