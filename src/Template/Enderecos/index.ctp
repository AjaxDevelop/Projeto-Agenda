<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Endereco'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Vendas'), ['controller' => 'Vendas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Venda'), ['controller' => 'Vendas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clientes'), ['controller' => 'Clientes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cliente'), ['controller' => 'Clientes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="enderecos index large-9 medium-8 columns content">
    <h3><?= __('Enderecos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('venda_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pessoa_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cep') ?></th>
                <th scope="col"><?= $this->Paginator->sort('endereco') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('complemento') ?></th>
                <th scope="col"><?= $this->Paginator->sort('referencia') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bairro') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cidade') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cep_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('endereco_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('numero_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('complemento_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('referencia_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('bairro_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cidade_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado_instalacao') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enderecos as $endereco): ?>
            <tr>
                <td><?= $this->Number->format($endereco->id) ?></td>
                <td><?= $endereco->has('venda') ? $this->Html->link($endereco->venda->id, ['controller' => 'Vendas', 'action' => 'view', $endereco->venda->id]) : '' ?></td>
                <td><?= $this->Number->format($endereco->pessoa_id) ?></td>
                <td><?= h($endereco->cep) ?></td>
                <td><?= h($endereco->endereco) ?></td>
                <td><?= h($endereco->numero) ?></td>
                <td><?= h($endereco->complemento) ?></td>
                <td><?= h($endereco->referencia) ?></td>
                <td><?= h($endereco->bairro) ?></td>
                <td><?= h($endereco->cidade) ?></td>
                <td><?= h($endereco->estado) ?></td>
                <td><?= h($endereco->cep_instalacao) ?></td>
                <td><?= h($endereco->endereco_instalacao) ?></td>
                <td><?= h($endereco->numero_instalacao) ?></td>
                <td><?= h($endereco->complemento_instalacao) ?></td>
                <td><?= h($endereco->referencia_instalacao) ?></td>
                <td><?= h($endereco->bairro_instalacao) ?></td>
                <td><?= h($endereco->cidade_instalacao) ?></td>
                <td><?= h($endereco->estado_instalacao) ?></td>
                <td><?= h($endereco->created) ?></td>
                <td><?= h($endereco->updated) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $endereco->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $endereco->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $endereco->id], ['confirm' => __('Are you sure you want to delete # {0}?', $endereco->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
