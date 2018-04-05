<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pessoa'), ['action' => 'edit', $pessoa->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pessoa'), ['action' => 'delete', $pessoa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pessoa->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pessoas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pessoa'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Contatos'), ['controller' => 'Contatos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contato'), ['controller' => 'Contatos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Enderecos'), ['controller' => 'Enderecos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Endereco'), ['controller' => 'Enderecos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pessoas view large-9 medium-8 columns content">
    <h3><?= h($pessoa->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nome') ?></th>
            <td><?= h($pessoa->nome) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apelido') ?></th>
            <td><?= h($pessoa->apelido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cpf Cnpj') ?></th>
            <td><?= h($pessoa->cpf_cnpj) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Insc Estadual') ?></th>
            <td><?= h($pessoa->insc_estadual) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Insc Municipal') ?></th>
            <td><?= h($pessoa->insc_municipal) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rg') ?></th>
            <td><?= h($pessoa->rg) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($pessoa->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pessoa->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nascimento') ?></th>
            <td><?= h($pessoa->nascimento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pessoa->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pessoa->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Clientes') ?></h4>
        <?php if (!empty($pessoa->clientes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Pessoa Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pessoa->clientes as $clientes): ?>
            <tr>
                <td><?= h($clientes->id) ?></td>
                <td><?= h($clientes->pessoa_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Clientes', 'action' => 'view', $clientes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Clientes', 'action' => 'edit', $clientes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Clientes', 'action' => 'delete', $clientes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clientes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Contatos') ?></h4>
        <?php if (!empty($pessoa->contatos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Venda Id') ?></th>
                <th scope="col"><?= __('Pessoa Id') ?></th>
                <th scope="col"><?= __('Contato') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pessoa->contatos as $contatos): ?>
            <tr>
                <td><?= h($contatos->id) ?></td>
                <td><?= h($contatos->venda_id) ?></td>
                <td><?= h($contatos->pessoa_id) ?></td>
                <td><?= h($contatos->contato) ?></td>
                <td><?= h($contatos->tipo) ?></td>
                <td><?= h($contatos->created) ?></td>
                <td><?= h($contatos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Contatos', 'action' => 'view', $contatos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Contatos', 'action' => 'edit', $contatos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contatos', 'action' => 'delete', $contatos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contatos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Usuarios') ?></h4>
        <?php if (!empty($pessoa->usuarios)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Pessoa Id') ?></th>
                <th scope="col"><?= __('Display') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Senha') ?></th>
                <th scope="col"><?= __('Role') ?></th>
                <th scope="col"><?= __('Ativo') ?></th>
                <th scope="col"><?= __('Interno') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pessoa->usuarios as $usuarios): ?>
            <tr>
                <td><?= h($usuarios->id) ?></td>
                <td><?= h($usuarios->pessoa_id) ?></td>
                <td><?= h($usuarios->display) ?></td>
                <td><?= h($usuarios->email) ?></td>
                <td><?= h($usuarios->senha) ?></td>
                <td><?= h($usuarios->role) ?></td>
                <td><?= h($usuarios->ativo) ?></td>
                <td><?= h($usuarios->interno) ?></td>
                <td><?= h($usuarios->created) ?></td>
                <td><?= h($usuarios->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Usuarios', 'action' => 'view', $usuarios->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Usuarios', 'action' => 'edit', $usuarios->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Usuarios', 'action' => 'delete', $usuarios->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuarios->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Enderecos') ?></h4>
        <?php if (!empty($pessoa->enderecos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Venda Id') ?></th>
                <th scope="col"><?= __('Pessoa Id') ?></th>
                <th scope="col"><?= __('Cep') ?></th>
                <th scope="col"><?= __('Endereco') ?></th>
                <th scope="col"><?= __('Numero') ?></th>
                <th scope="col"><?= __('Complemento') ?></th>
                <th scope="col"><?= __('Referencia') ?></th>
                <th scope="col"><?= __('Bairro') ?></th>
                <th scope="col"><?= __('Cidade') ?></th>
                <th scope="col"><?= __('Estado') ?></th>
                <th scope="col"><?= __('Cep Instalacao') ?></th>
                <th scope="col"><?= __('Endereco Instalacao') ?></th>
                <th scope="col"><?= __('Numero Instalacao') ?></th>
                <th scope="col"><?= __('Complemento Instalacao') ?></th>
                <th scope="col"><?= __('Referencia Instalacao') ?></th>
                <th scope="col"><?= __('Bairro Instalacao') ?></th>
                <th scope="col"><?= __('Cidade Instalacao') ?></th>
                <th scope="col"><?= __('Estado Instalacao') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pessoa->enderecos as $enderecos): ?>
            <tr>
                <td><?= h($enderecos->id) ?></td>
                <td><?= h($enderecos->venda_id) ?></td>
                <td><?= h($enderecos->pessoa_id) ?></td>
                <td><?= h($enderecos->cep) ?></td>
                <td><?= h($enderecos->endereco) ?></td>
                <td><?= h($enderecos->numero) ?></td>
                <td><?= h($enderecos->complemento) ?></td>
                <td><?= h($enderecos->referencia) ?></td>
                <td><?= h($enderecos->bairro) ?></td>
                <td><?= h($enderecos->cidade) ?></td>
                <td><?= h($enderecos->estado) ?></td>
                <td><?= h($enderecos->cep_instalacao) ?></td>
                <td><?= h($enderecos->endereco_instalacao) ?></td>
                <td><?= h($enderecos->numero_instalacao) ?></td>
                <td><?= h($enderecos->complemento_instalacao) ?></td>
                <td><?= h($enderecos->referencia_instalacao) ?></td>
                <td><?= h($enderecos->bairro_instalacao) ?></td>
                <td><?= h($enderecos->cidade_instalacao) ?></td>
                <td><?= h($enderecos->estado_instalacao) ?></td>
                <td><?= h($enderecos->created) ?></td>
                <td><?= h($enderecos->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Enderecos', 'action' => 'view', $enderecos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Enderecos', 'action' => 'edit', $enderecos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Enderecos', 'action' => 'delete', $enderecos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $enderecos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
