<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Usuario'), ['action' => 'edit', $usuario->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Usuario'), ['action' => 'delete', $usuario->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usuario->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pessoas'), ['controller' => 'Pessoas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pessoa'), ['controller' => 'Pessoas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Listas'), ['controller' => 'Listas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lista'), ['controller' => 'Listas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Observacoes'), ['controller' => 'Observacoes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Observaco'), ['controller' => 'Observacoes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Reagendamentos'), ['controller' => 'Reagendamentos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reagendamento'), ['controller' => 'Reagendamentos', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Userconfs'), ['controller' => 'Userconfs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Userconf'), ['controller' => 'Userconfs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pdvs'), ['controller' => 'Pdvs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pdv'), ['controller' => 'Pdvs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usuarios view large-9 medium-8 columns content">
    <h3><?= h($usuario->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Pessoa') ?></th>
            <td><?= $usuario->has('pessoa') ? $this->Html->link($usuario->pessoa->id, ['controller' => 'Pessoas', 'action' => 'view', $usuario->pessoa->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Display') ?></th>
            <td><?= h($usuario->display) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($usuario->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Senha') ?></th>
            <td><?= h($usuario->senha) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= h($usuario->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ativo') ?></th>
            <td><?= h($usuario->ativo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interno') ?></th>
            <td><?= h($usuario->interno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usuario->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usuario->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usuario->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Listas') ?></h4>
        <?php if (!empty($usuario->listas)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Lista') ?></th>
                <th scope="col"><?= __('Processando') ?></th>
                <th scope="col"><?= __('Concluida') ?></th>
                <th scope="col"><?= __('Baixada') ?></th>
                <th scope="col"><?= __('Tipo') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->listas as $listas): ?>
            <tr>
                <td><?= h($listas->id) ?></td>
                <td><?= h($listas->usuario_id) ?></td>
                <td><?= h($listas->lista) ?></td>
                <td><?= h($listas->processando) ?></td>
                <td><?= h($listas->concluida) ?></td>
                <td><?= h($listas->baixada) ?></td>
                <td><?= h($listas->tipo) ?></td>
                <td><?= h($listas->created) ?></td>
                <td><?= h($listas->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Listas', 'action' => 'view', $listas->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Listas', 'action' => 'edit', $listas->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Listas', 'action' => 'delete', $listas->id], ['confirm' => __('Are you sure you want to delete # {0}?', $listas->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Observacoes') ?></h4>
        <?php if (!empty($usuario->observacoes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Venda Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('Observacao') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->observacoes as $observacoes): ?>
            <tr>
                <td><?= h($observacoes->id) ?></td>
                <td><?= h($observacoes->venda_id) ?></td>
                <td><?= h($observacoes->usuario_id) ?></td>
                <td><?= h($observacoes->observacao) ?></td>
                <td><?= h($observacoes->created) ?></td>
                <td><?= h($observacoes->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Observacoes', 'action' => 'view', $observacoes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Observacoes', 'action' => 'edit', $observacoes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Observacoes', 'action' => 'delete', $observacoes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $observacoes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Reagendamentos') ?></h4>
        <?php if (!empty($usuario->reagendamentos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Venda Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col"><?= __('De') ?></th>
                <th scope="col"><?= __('Para') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->reagendamentos as $reagendamentos): ?>
            <tr>
                <td><?= h($reagendamentos->id) ?></td>
                <td><?= h($reagendamentos->venda_id) ?></td>
                <td><?= h($reagendamentos->usuario_id) ?></td>
                <td><?= h($reagendamentos->de) ?></td>
                <td><?= h($reagendamentos->para) ?></td>
                <td><?= h($reagendamentos->created) ?></td>
                <td><?= h($reagendamentos->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Reagendamentos', 'action' => 'view', $reagendamentos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Reagendamentos', 'action' => 'edit', $reagendamentos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reagendamentos', 'action' => 'delete', $reagendamentos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reagendamentos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Userconfs') ?></h4>
        <?php if (!empty($usuario->userconfs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Usuario Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->userconfs as $userconfs): ?>
            <tr>
                <td><?= h($userconfs->id) ?></td>
                <td><?= h($userconfs->usuario_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Userconfs', 'action' => 'view', $userconfs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Userconfs', 'action' => 'edit', $userconfs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Userconfs', 'action' => 'delete', $userconfs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userconfs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Pdvs') ?></h4>
        <?php if (!empty($usuario->pdvs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Pdv') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($usuario->pdvs as $pdvs): ?>
            <tr>
                <td><?= h($pdvs->id) ?></td>
                <td><?= h($pdvs->pdv) ?></td>
                <td><?= h($pdvs->created) ?></td>
                <td><?= h($pdvs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pdvs', 'action' => 'view', $pdvs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pdvs', 'action' => 'edit', $pdvs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pdvs', 'action' => 'delete', $pdvs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pdvs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
