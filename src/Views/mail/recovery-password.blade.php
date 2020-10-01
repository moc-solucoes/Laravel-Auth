@extends('Core::mail.shared.moc-01')

@section('assunto')
    {{$assunto}}
@endsection

@section('nome')
    {{$usuario->nome}}
@endsection

@section('content')
    <p>
        <strong>
            Foi solicitado sua uma recupera&ccedil;&atilde;o de senha atrav&eacute;s de nossa central do
            cliente.
        </strong>
    </p>

    <p> Para prosseguir com a solicitação basta seguir os passos abaixo citados: </p>

    <ul>
        <li>Clicar na URL abaixo enviada.</li>
        <li>Inserir os dados para sua nova senha solicitados no formulário.</li>
    </ul>

    <table align="center" border="0" cellspacing="3"
           style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
        <tbody>
        <tr>
            <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px">
                        <span style="color:rgb(255, 240, 245)">
                            <strong>
                                Acesso a sua central do cliente:
                            </strong>
                        </span>
                    </span>
            </td>
        </tr>
        <tr>
            <td>
                <strong>URL:</strong>
                <a href="{{route('usuario.recuperar-senha.token', ['token' => $token->token])}}">
                    {{route('usuario.recuperar-senha.token', ['token' => $token->token])}}
                </a>
                <br/>
                <strong>Seu Usu&aacute;rio:</strong> {{$usuario->email}}<br/>
                <strong>Data De Expiração:</strong> {{$token->expiracaoBrl}}
            </td>
        </tr>
        </tbody>
    </table>

    <table align="center" border="0" cellspacing="3"
           style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
        <tbody>
        <tr>
            <td colspan="2" style="background-color:#2989d8">
                <span style="font-size:16px;color:rgb(255, 240, 245);">
                    <strong>Central do Cliente</strong>
                </span>
            </td>
        </tr>
        <tr>
            <td>
                <p>
                    <strong>E-mail:</strong> {{$usuario->email}}<br/>
                    <strong>Senha:</strong> *******<br/>
                    <strong>Central do Cliente:</strong>
                    <a href="{{url('/')}}" target="_BLANK">
                        {{url('/')}}
                    </a>
                </p>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
