<?php

namespace Database\Seeders;

use App\Models\Auth\Perfil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissoesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {


        Perfil::all()->each(function (Perfil $perfil) {
            $perfil->Permissoes()->createMany([
                [
                    'nome' => 'administrar.usuarios',
                    'descricao' => 'Permite administrar usuários.',
                    'tipo' => 'Administrador',
                    'grupo' => 'Admin'
                ],
                [
                    'nome' => 'administrar.faturas',
                    'descricao' => 'Permite administrar faturas.',
                    'tipo' => 'Administrador',
                    'grupo' => 'Admin'
                ],
                [
                    'nome' => 'administrar.documentos',
                    'descricao' => 'Permite administrar documentos.',
                    'tipo' => 'Administrador',
                    'grupo' => 'Admin'
                ],
                [
                    'nome' => 'administrar.projetos',
                    'descricao' => 'Permite administrar os projetos.',
                    'tipo' => 'Administrador',
                    'grupo' => 'Admin'
                ],
                [
                    'nome' => 'administrar.usuarios.perfis',
                    'descricao' => 'Permite administrar os perfis do sistema.',
                    'tipo' => 'Administrador',
                    'grupo' => 'Admin'
                ],
                [
                    'nome' => 'administrar.usuarios.permissoes',
                    'descricao' => 'Permite administrar as permissões do usuário.',
                    'tipo' => 'Administrador',
                    'grupo' => 'Admin'
                ],
                [
                    'nome' => 'tarefa.cadastrar',
                    'descricao' => 'Permite cadastrar novas tarefas.',
                    'tipo' => 'Tarefa',
                    'grupo' => 'Tarefa'
                ],
                [
                    'nome' => 'tarefa.detalhes',
                    'descricao' => 'Detalhes da tarefa.',
                    'tipo' => 'Tarefa',
                    'grupo' => 'Tarefa'
                ],
                [
                    'nome' => 'tarefa.listar',
                    'descricao' => 'Listar tarefas.',
                    'tipo' => 'Tarefa',
                    'grupo' => 'Tarefa'
                ],
                [
                    'nome' => 'tarefa.editar',
                    'descricao' => 'Edição de tarefas.',
                    'tipo' => 'Tarefa',
                    'grupo' => 'Tarefa'
                ],
                [
                    'nome' => 'tempo.registrar',
                    'descricao' => 'Registrar tempo em tarefas.',
                    'tipo' => 'Tempo',
                    'grupo' => 'Tempo'
                ],
                [

                    'nome' => 'tempo.listar',
                    'descricao' => 'Listar tempo em tarefa',
                    'tipo' => 'Tempo',
                    'grupo' => 'Tempo'
                ],
                [
                    'nome' => 'tempo.detalhe',
                    'descricao' => 'Detalhes do tempo em tarefa',
                    'tipo' => 'Tempo',
                    'grupo' => 'Tempo'
                ],
                [
                    'nome' => 'tempo.editar',
                    'descricao' => 'Editar tempo em tarefa',
                    'tipo' => 'Tempo',
                    'grupo' => 'Tempo'
                ],
                [
                    'nome' => 'tempo.cadastrar',
                    'descricao' => 'Cadastrar tempo em tarefas',
                    'tipo' => 'Tempo',
                    'grupo' => 'Tempo'
                ],
                [
                    'nome' => 'tempo.excluir',
                    'descricao' => 'Excluir o tempo',
                    'tipo' => 'Tempo',
                    'grupo' => 'Tempo'
                ],
                [
                    'nome' => 'administrar.os',
                    'descricao' => 'Administrar a OS',
                    'tipo' => 'Ordem-Servico',
                    'grupo' => 'Ordem-Servico'
                ],
                [
                    'nome' => 'os.fechar',
                    'descricao' => 'Fechar a Ordem de serviço',
                    'tipo' => 'Ordem-Servico',
                    'grupo' => 'Ordem-Servico'
                ],
                [
                    'nome' => 'os.editar',
                    'descricao' => 'Editar a Ordem de serviço',
                    'tipo' => 'Ordem-Servico',
                    'grupo' => 'Ordem-Servico'
                ],
                [
                    'nome' => 'fatura.pagamento',
                    'descricao' => 'Pagamento da fatura',
                    'tipo' => 'Pagamento',
                    'grupo' => 'Pagamento'
                ],
                [
                    'nome' => 'tarefa.excluir',
                    'descricao' => 'Excluir a tarefa',
                    'tipo' => 'Tarefa',
                    'grupo' => 'Tarefa'
                ],
            ]);
        });
    }
}
