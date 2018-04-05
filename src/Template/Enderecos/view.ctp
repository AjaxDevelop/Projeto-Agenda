<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Endereco'), ['action' => 'edit', $endereco->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Endereco'), ['action' => 'delete', $endereco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $endereco->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Enderecos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Endereco'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="enderecos view large-9 medium-8 columns content">
    <h3><?= h($endereco->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Venda') ?></th>
            <td><?= $endereco->has('venda') ? $this->Html->link($endereco->venda->id, ['controller' => 'Vendas', 'action' => 'view', $endereco->venda->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cep') ?></th>
            <td><?= h($endereco->cep) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endereco') ?></th>
            <td><?= h($endereco->endereco) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= h($endereco->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Complemento') ?></th>
            <td><?= h($endereco->complemento) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Referencia') ?></th>
            <td><?= h($endereco->referencia) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bairro') ?></th>
            <td><?= h($endereco->bairro) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cidade') ?></th>
            <td><?= h($endereco->cidade) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($endereco->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cep Instalacao') ?></th>
            <td><?= h($endereco->cep_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Endereco Instalacao') ?></th>
            <td><?= h($endereco->endereco_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero Instalacao') ?></th>
            <td><?= h($endereco->numero_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Complemento Instalacao') ?></th>
            <td><?= h($endereco->complemento_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Referencia Instalacao') ?></th>
            <td><?= h($endereco->referencia_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bairro Instalacao') ?></th>
            <td><?= h($endereco->bairro_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cidade Instalacao') ?></th>
            <td><?= h($endereco->cidade_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado Instalacao') ?></th>
            <td><?= h($endereco->estado_instalacao) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($endereco->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pessoa Id') ?></th>
            <td><?= $this->Number->format($endereco->pessoa_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($endereco->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($endereco->updated) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Pessoas') ?></h4>
        <?php if (!empty($endereco->pessoas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Nome') ?></th>
                <th scope="col"><?= __('Apelido') ?></th>
                <th scope="col"><?= __('Nascimento') ?></th>
                <th scope="col"><?= __('Cpf Cnpj') ?></th>
                <th scope="col"><?= __('Insc Estadual') ?></th>
                <th scope="col"><?= __('Insc Municipal') ?></th>
                <th scope="col"><?= __('Rg') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($endereco->pessoas as $pessoas): ?>
            <tr>
                <td><?= h($pessoas->id) ?></td>
                <td><?= h($pessoas->nome) ?></td>
                <td><?= h($pessoas->apelido) ?></td>
                <td><?= h($pessoas->nascimento) ?></td>
                <td><?= h($pessoas->cpf_cnpj) ?></td>
                <td><?= h($pessoas->insc_estadual) ?></td>
                <td><?= h($pessoas->insc_municipal) ?></td>
                <td><?= h($pessoas->rg) ?></td>
                <td><?= h($pessoas->tipo) ?></td>
                <td><?= h($pessoas->created) ?></td>
                <td><?= h($pessoas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pessoas', 'action' => 'view', $pessoas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pessoas', 'action' => 'edit', $pessoas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pessoas', 'action' => 'delete', $pessoas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pessoas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Clientes') ?></h4>
        <?php if (!empty($endereco->clientes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Pessoa Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($endereco->clientes as $clientes): ?>
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
</div>
