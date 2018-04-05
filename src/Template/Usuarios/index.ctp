<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Listas'), ['controller' => 'Listas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lista'), ['controller' => 'Listas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Observacoes'), ['controller' => 'Observacoes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Observaco'), ['controller' => 'Observacoes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Reagendamentos'), ['controller' => 'Reagendamentos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Reagendamento'), ['controller' => 'Reagendamentos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Userconfs'), ['controller' => 'Userconfs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Userconf'), ['controller' => 'Userconfs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Pdvs'), ['controller' => 'Pdvs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Pdv'), ['controller' => 'Pdvs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usuarios index large-9 medium-8 columns content">
    <h3><?= __('Usuarios') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pessoa_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('display') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('senha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ativo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interno') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $this->Number->format($usuario->id) ?></td>
                <td><?= $usuario->has('pessoa') ? $this->Html->link($usuario->pessoa->id, ['controller' => 'Pessoas', 'action' => 'view', $usuario->pessoa->id]) : '' ?></td>
                <td><?= h($usuario->display) ?></td>
                <td><?= h($usuario->email) ?></td>
                <td><?= h($usuario->senha) ?></td>
                <td><?= h($usuario->role) ?></td>
                <td><?= h($usuario->ativo) ?></td>
                <td><?= h($usuario->interno) ?></td>
                <td><?= h($usuario->created) ?></td>
                <td><?= h($usuario->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usuario->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usuario->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id)]) ?>
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
