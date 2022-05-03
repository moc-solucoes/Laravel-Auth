<?php


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailTemplateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mail_templates')->insert([
            [
                'codigo' => 'notificar_documento',
                'assunto' => 'Novo documento disponível',
                'descricao' => 'Ao inserir um novo documento na plataforma',
                'email' => '<p>Foi inserido um novo documento para sua empresa em sua &aacute;rea do cliente, conforme dados abaixo:</p>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span style="color:rgb(255, 240, 245)"><strong>Descri&ccedil;&atilde;o do documento:</strong></span></span></td>
    </tr>
    <tr>
        <td>
            <p><strong>Nome:</strong> {documento_descricao}<br />
                <strong>Tamanho total: </strong>{documento_tamanho}<br />
                <strong>Tipo:</strong> {documento_tipo}</p>
        </td>
    </tr>
    </tbody>
</table>

<p>Para efetuar o download destes documentos basta seguir as seguintes etapas:</p>

<ol>
    <li>Entre em sua central do cliente com usu&aacute;rio e senhas cadastrados pr&eacute;viamente.</li>
    <li>No menu localizado no canto esquerdo de sua central do cliente clique em <strong>&quot;Documentos&quot;. </strong></li>
    <li>Feito este procedimento ser&aacute; exibida a lista de todos os seus servi&ccedil;os com seus respectivos documentos, basta buscar pelo documento desejado e clicar no bot&atilde;o <strong>&quot;Download&quot;</strong>.</li>
</ol>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span style="color:rgb(255, 240, 245)"><strong>Central do Cliente</strong></span></span></td>
    </tr>
    <tr>
        <td>
            <p><strong>E-mail:</strong> {usuario_email}<br />
                <strong>Senha:</strong> *******<br />
                <strong>Central do Cliente:</strong> <a href="{global_url}" target="_BLANK">{global_url} </a></p>
        </td>
    </tr>
    </tbody>
</table>

<p>Para acessar automaticamente a Central do Cliente <a href="{global_url}" target="_blank">Clique aqui</a>.</p>
',
                'ativo' => true,
            ],
            [
                'codigo' => 'nova_empresa',
                'assunto' => 'Nova empresa vinculada',
                'descricao' => 'Nova empresa vinculada ao usuário',
                'email' => '<p>Foi vinculada uma nova empresa para seu usu&aacute;rio conforme os dados fornecidos abaixo:</p>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span style="color:rgb(255, 240, 245)"><strong>Dados da empresa:</strong></span></span></td>
		</tr>
		<tr>
			<td>
			<p><strong>Raz&atilde;o Social:</strong> {cliente_razao_social}<br />
			<strong>Nome Fantasia: </strong>{cliente_fantasia}<br />
			<strong>CNPJ:</strong> {cliente_cnpj}<br />
			<strong>E-mail: </strong>{cliente_email}</p>
			</td>
		</tr>
	</tbody>
</table>

<p><br />
<strong><span style="color:#FF0000">Obs.:</span> </strong>Caso n&atilde;o seja o propriet&aacute;rio da mesma ou possua alguma inrregularidade no cadastro por gentileza entre em contato conosco para que possamos efetuar as devidas corre&ccedil;&otilde;es.</p>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span style="color:rgb(255, 240, 245)"><strong>Central do Cliente</strong></span></span></td>
		</tr>
		<tr>
			<td>
			<p><strong>E-mail:</strong> {usuario_email}<br />
			<strong>Senha:</strong> *******<br />
			<strong>Central do Cliente:</strong> <a href="http://{global_url}" target="_BLANK">{global_url} </a></p>
			</td>
		</tr>
	</tbody>
</table>

<p>Para acessar automaticamente a Central do Cliente <a href="http://{global_url}" target="_blank">Clique aqui</a>.</p>
',
                'ativo' => true,
            ],
            [
                'codigo' => 'novo_usuario',
                'assunto' => 'Novo usuario cadastrado',
                'descricao' => 'Ao cadastrar um novo usuário',
                'email' => '<p><strong>Foi criado um usu&aacute;rio em nossa central do cliente com seu email, abaixo seguem seus dados para acesso:</strong></p>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span style="color:rgb(255, 240, 245)"><strong>Acesso a sua central do cliente:</strong></span></span></td>
		</tr>
		<tr>
			<td><strong>Endere&ccedil;o:</strong> {global_url}<br />
			<strong>Seu Usu&aacute;rio:</strong> {usuario_email}<br />
			<strong>Sua Senha:</strong> {usuario_senha}</td>
		</tr>
	</tbody>
</table>

<p>&nbsp;</p>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
	<tbody>
		<tr>
			<td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span style="color:rgb(255, 240, 245)"><strong>Central do Cliente</strong></span></span></td>
		</tr>
		<tr>
			<td>
			<p><strong>E-mail:</strong> {usuario_email}<br />
			<strong>Senha:</strong> *******<br />
			<strong>Central do Cliente:</strong> <a href="http://{global_url}" target="_BLANK">{global_url} </a></p>
			</td>
		</tr>
	</tbody>
</table>

<p><strong><span style="color:#FF0000">Obs.:</span> </strong>Caso n&atilde;o seja o propriet&aacute;rio da mesma, e/ou possua alguma inrregularidade no cadastro, por gentileza entre em contato conosco para que possamos efetuar as devidas corre&ccedil;&otilde;es.</p>

<p>Para acessar automaticamente a Central do Cliente <a href="http://{global_url}" target="_BLANK">Clique aqui</a>.</p>
',
                'ativo' => true,
            ],
            [
                'codigo' => 'recuperar_senha',
                'assunto' => 'Recuperação de senha',
                'descricao' => 'Recuperação de senha',
                'email' => '<p>
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
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Acesso a sua central do cliente:</strong></span></span></td>
    </tr>
    <tr>
        <td>
            <strong>URL:</strong>
            <a href="{global_url}/usuario/recuperar-senha/{token_token}">
                {global_url}/usuario/recuperar-senha/{token_token}
            </a>
            <br/>
            <strong>Seu Usu&aacute;rio:</strong> {usuario_email}<br/>
            <strong>Data De Expiração:</strong> {token_expiracao}
        </td>
    </tr>
    </tbody>
</table>

<p>&nbsp;</p>

<table align="center" border="0" cellspacing="3"
       style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Central do Cliente</strong></span></span></td>
    </tr>
    <tr>
        <td>
            <p><strong>E-mail:</strong> {usuario_email}<br/>
                <strong>Senha:</strong> *******<br/>
                <strong>Central do Cliente:</strong> <a href="http://{global_url}" target="_BLANK">{global_url} </a></p>
        </td>
    </tr>
    </tbody>
</table>

<p>&nbsp;</p>

<p>Para acessar automaticamente a Central do Cliente <a href="http://{global_url}" target="_blank">Clique aqui</a>.</p>
',
                'ativo' => true,
            ],
            [
                'codigo' => 'shared',
                'assunto' => 'Header e Footer',
                'descricao' => 'Começo e final do e-mail.',
                'email' => '<div style="margin: 0px; background-color: #f7f2e4;" bgcolor="#f7f2e4" leftmargin="0">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f7f2e4">
        <tr>
            <td>
                <!--top links-->
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="middle" align="center" height="45">
                            <p style="font-size: 14px; line-height: 24px; font-family: Georgia; color: #b0a08b; margin: 0px;">
        Não consegue ver o conteúdo corretamente? <a style="color: #2989D8;
							text-decoration: none;" href="#">Utilize a
                                versão web.</a></p></td>
                    </tr>
                </table>
                <!--header-->
                <table
                    style="background:url({global_headerBg}); background-repeat: no-repeat; background-position: center; background-color: #fffdf9;"
                    width="684" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td valign="top" width="173">
                                        <!--ribbon-->
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="120" width="45"></td>
                                                <td background="{global_ribbonBlue}"
                                                    valign="top" bgcolor="#c72439" height="120" width="80">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td valign="bottom" align="center" height="35">
                                                                <p style="font-size: 14px; font-family: Georgia, Times, serif; color: #ffffff; margin-top: 0px; margin-bottom: 0px;">
                                                                    {global_mesNome}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top" align="center">
                                                                <p style="font-size: 36px; font-family: Georgia, Times, serif; color: #ffffff; margin-top: 0px; margin-bottom: 0px; text-shadow: 1px 1px 1px #333;">
                                                                    {global_dia}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table><!--ribbon-->
                                    </td>
                                    <td valign="middle" width="493">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td height="60">
                                                    <b> Sr(a).:</b> {usuario_nome}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h1 style="color: #333; margin-top: 0px;  margin-left:120px; margin-bottom: 0px; font-weight: normal; font-size: 30px; font-family: Georgia, \"Times New Roman\", Times, serif">
                                                        <a href="{global_url}">
                                                            <img src="{global_logo}" style="width: 120px;"/>
                                                        </a>
                                                    </h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th height="40">
                                                    <b>
                                                        <i> Seu serviço com melhor preço e maior Qualidade! </i>
                                                    </b>
                                                </th>
                                            </tr>
                                        </table>
                                        <!--date-->
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td valign="top" align="center" bgcolor="#312c26"
                                                    background="{global_dateBg}" width="430"
                                                    height="42">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td height="5"></td>
                                                        </tr>
                                                    </table>
                                                    <p style="font-size: 24px; font-family: Georgia, \"Times New Roman\", Times, serif; color: #ffffff; margin-top: 0px; margin-bottom: 0px;">
                                                        <em>{template_assunto}</em>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table><!--/date-->
                                    </td>
                                    <td width="18"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div style="max-width: 664px; margin: auto; background:#fff; padding: 10px; margin-top: 0px;">
                    {content}
                </div>
                <table bgcolor="#fffdf9" cellspacing="0" border="0" align="center" cellpadding="0" width="684">
                    <tr>
                        <td height="72">
                            <img src="{global_line2}" width="622" height="72"/>
                        </td>
                    </tr>
                    <tr>
                        <td height="72">
        Entre já e confira:
                            <a style="color: #2989D8; text-decoration: none;" href="{global_site}">
        MOC Soluções
    </a> <br/>
                            Acesse seu painel do Cliente:
                            <a style="color: #2989D8; text-decoration: none;" href="{global_url}">
        Painel do Cliente
    </a> <br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="680" border="0" align="center" cellpadding="30" cellspacing="0">
        <tr>
            <td valign="top">
                <p style="font-size: 14px; line-height: 24px; color: #b0a08b; margin: 0px;">
                    <b> <i> Contatos: </i> </b> <br/>
                    <b> Telefone: </b> {global_telefone} <br/>
                    <b> E-mail: </b> {global_email}
            </td>
        </tr>
    </table>
</div>
    ',
                'ativo' => true,
            ],
            [
                'codigo' => 'notificar_fatura',
                'assunto' => 'Nova fatura disponível',
                'descricao' => 'Nova fatura disponível',
                'email' => '<p>
    Existe uma fatura em aberto com o vencimento para no dia <strong>{fatura_vencimento}</strong>.
</p>

<p>Estamos enviando os dados para pagamento referente aos servi&ccedil;os prestados.</p>

<table align="center" border="0" cellspacing="3"
       style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Descri&ccedil;&atilde;o da fatura:</strong></span> </span></span></span>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                <strong>Vencimento:</strong> {fatura_vencimento}<br/>
                <strong>Valor Total:</strong> {fatura_total}
            </p>
        </td>
    </tr>
    </tbody>
</table>

<p>* Caso o pagamento n&atilde;o ocorra em at&eacute; 3 dias ap&oacute;s o vencimento, o servi&ccedil;o contratado ficar&aacute;
    fora do ar, e/ou o contrato estará temporariamente congelado conforme especificações previstas em contrato, at&eacute;
    a compensa&ccedil;&atilde;o da mesma.</p>

<p>* Transa&ccedil;&otilde;es realizadas por <strong>Dep&oacute;sito Banc&aacute;rio</strong> deve ser informado a Data,
    Hora e N&uacute;mero do pagamento, ou enviada foto do comprovante de dep&oacute;sito / transferência, no e-mail
    <strong>
        {global_email}</strong>. Ap&oacute;s o envio destas informa&ccedil;&otilde;es efetuamos a baixa do pagamento em
    aberto em nosso sistema.</p>

<p>Para efetuar o pagamento via cartões siga os passos abaixo:
<ul>
    <li>Entre na <a href="http://{global_url}"> central do cliente </a></li>
    <li>Efetue autenticação no sistema com seu e-mail e senha cadastrados</li>
    <li>Clique no menu <strong> &quot;Faturas&quot; </strong></li>
    <li>Clique em <strong> &quot;detalhes&quot; </strong> na fatura que deseja efetuar o pagamento.</li>
    <li>Na parte inferior da página terá um botão para adicionar um novo cartão e/ou utilizar um já cadastrado.</li>
</ul>
</p>

<p>* Para transa&ccedil;&otilde;es realizadas por <strong>Cart&atilde;o de Cr&eacute;dito, dep&oacute;sito, boleto e
    transfer&ecirc;ncia,</strong> podem levar de 24h &agrave; 48h para serem aprovadas.</p>

<table align="center" border="0" cellpadding="5" cellspacing="5"
       style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="4" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Contas para Dep&oacute;sito ou Transfer&ecirc;ncia:</strong></span></span>
        </td>
    </tr>
    <tr>
        <td>
            <strong><u>Nu Pagamentos S.A. (260) </u></strong><br/>
            <strong>Ag&ecirc;ncia: </strong> 0001<br/>
            <strong>Conta:</strong> 5996728-0<br/>
            <strong>Tipo:</strong> Conta Corrente<br/>
            <strong>Nome:</strong> Maike Oliveira Carvalho<br/>
            &nbsp;
        </td>
        <td>
            <strong><u>Caixa Econ&ocirc;mica Federal (CEF) </u></strong><br/>
            <strong>Ag&ecirc;ncia: </strong> 0882<br/>
            <strong>Conta:</strong> 00173171-6<br/>
            <strong>Tipo:</strong> Conta Poupan&ccedil;a - 13<br/>
            <strong>Nome:</strong> Maike Oliveira Carvalho<br/>
            &nbsp;
        </td>
        <td>
            <p><strong><u>Banco do Brasil (BB) </u></strong><br/>
                <strong>Ag&ecirc;ncia: </strong> 3049-x<br/>
                <strong>Conta:</strong> 56250-5<br/>
                <strong>Tipo:</strong> Conta Poupan&ccedil;a<br/>
                <strong>Varia&ccedil;&atilde;o:</strong> 51<br/>
                <strong>Nome:</strong> Maike Oliveira Carvalho<br/>
                &nbsp;</p>
        </td>
        <td><strong><u>Bradesco </u></strong><br/>
            <strong>Ag&ecirc;ncia: </strong> 2998-0<br/>
            <strong>Conta: </strong> 14698-6<br/>
            <strong>Tipo: </strong> Conta Poupan&ccedil;a<br/>
            <strong>Nome: </strong> Maike Oliveira Carvalho<br/>
            &nbsp;
        </td>
    </tr>
    </tbody>
</table>

<p><span style="font-size:14px">Lembrando que ao efetuar o pagamento &eacute; necess&aacute;rio que nos confirme por email ou via ticket no </span>
    <a href="http://{global_url}" target="_blank">Clique aqui</a>.</p>

<table align="center" border="0" cellspacing="3"
       style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Central do Cliente</strong></span></span></span></span></td>
    </tr>
    <tr>
        <td>
            <p><strong>E-mail:</strong> {usuario_email}<br/>
                <strong>Senha:</strong> *******<br/>
                <strong>Central do Cliente:</strong> <a href="http://{global_url}" target="_BLANK">{global_url} </a>
            </p>
        </td>
    </tr>
    </tbody>
</table>

<p>Para acessar automaticamente a Central do Cliente <a href="http://{global_url}" target="_blank">Clique
    aqui</a>.</p>
    ',
                'ativo' => true,
            ],
            [
                'codigo' => 'notificar_projeto',
                'assunto' => 'Novo projeto vinculado',
                'descricao' => 'Novo projeto vinculado ao usuário
',
                'email' => '<p>Foi vinculado um novo projeto para seu usu&aacute;rio conforme os dados fornecidos abaixo:</p>

<table align="center" border="0" cellspacing="3"
       style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Dados da Projeto:</strong></span></span></td>
    </tr>
    <tr>
        <td>
            <p>
                <strong>Nome:</strong> {projeto_nome}<br/>
                <strong>Descrição: </strong>{projeto_descricao}<br/>
            </p>
        </td>
    </tr>
    </tbody>
</table>

<p>
    <br />
    <strong><span style="color:#FF0000">Obs.:</span> </strong>Caso n&atilde;o seja o propriet&aacute;rio deste projeto ou possua alguma irregularidade no cadastro por gentileza entre em contato conosco para que possamos efetuar as devidas corre&ccedil;&otilde;es.</p>

<table align="center" border="0" cellspacing="3" style="border-radius:5px; border:2px solid #2989d8; padding:3px; width:100%">
    <tbody>
    <tr>
        <td colspan="2" style="background-color:#2989d8"><span style="font-size:16px"><span
                style="color:rgb(255, 240, 245)"><strong>Central do Cliente</strong></span></span></td>
    </tr>
    <tr>
        <td>
            <p><strong>E-mail:</strong> {usuario_email}<br/>
                <strong>Senha:</strong> *******<br/>
                <strong>Central do Cliente:</strong> <a href="http://{global_url}" target="_BLANK">{global_url} </a></p>
        </td>
    </tr>
    </tbody>
</table>

<p>Para acessar automaticamente a Central do Cliente <a href="http://{global_url}" target="_blank">Clique aqui</a>.</p>
    ',
                'ativo' => true,
            ],
        ]);
    }
}
