<?php
/**
  * @var \App\View\AppView $this
  */

    //Controle JS.
    echo $this->Html->script('Agenda.pessoas/pessoas_controle');

    //Mascaras.
    echo $this->Html->script('Agenda.jquery.mask.min');
    echo $this->Html->script('Agenda.mascaras');

    //Tab Index
    $tabindex = 1;

?>

<!-- Template Script -->
<script id="listarPessoa" type="text/x-handlebars-template">
    <div class="modal-content">
        {{#if contem_socios}}
        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Sócios</span>
            </div>
        </div>
        <div class="row col l11 m10 s10 offset-l1 offset-m1 offset-s1">
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                    {{#each socios}}
                    <tr>
                        <td>{{nome}}</td>
                        <td>{{cpf_cnpj}}</td>
                        <td>{{contatos.0.contato}}</td>
                    </tr>
                    {{/each}}
                </tbody>
            </table>
        </div>
        {{/if}}
        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Endereço</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p><strong>CEP:</strong> {{empresa.endereco.cep}}</p>
                <p><strong>Logradouro:</strong> {{empresa.endereco.endereco}} , {{empresa.endereco.numero}}</p>
                <p><strong>Complemento:</strong> {{empresa.endereco.complemento}}</p>
                <p><strong>Bairro:</strong> {{empresa.endereco.bairro}}</p>
                <p><strong>Cidade:</strong> {{empresa.endereco.cidade}}</p>
                <p><strong>Estado:</strong> {{empresa.endereco.estado}}</p>
            </div>
        </div>

        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Demais Contatos</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p><strong>Telefone:</strong> {{empresa.contatos.1.contato}}</p>
                <p><strong>E-mail:</strong> {{empresa.contatos.2.contato}}</p>
                <p><strong>Site:</strong> {{empresa.contatos.3.contato}}</p>
            </div>
        </div>

        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Observação</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p>{{empresa.observacoe.observacao}}</p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</script>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large blue">
        <i class="large material-icons">business</i>
    </a>
    <ul>
        <li>
            <a href="<?php echo $this->Url->build(['controller'=>'pessoas', 'action'=>'add'],true) ?>" class="btn-floating blue">
                <i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Cadastrar Empresa">queue</i>
            </a>
        </li>
    </ul>
</div>

<div class="pessoas index large-9 medium-8 columns content">
    <div class="row page-header">
        <div class="col l12 m12 s12">
            <h5><small>Lista de Clientes</small></h5>
        </div>
    </div>

    <div class="row">
        <?= $this->Form->create(null, ['id' => 'form_visita', 'url' => ['action' => 'index']]) ?>
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('nome',[
                'label'=>['class'=>'','text'=>'Nome da Empresa'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">store_mall_directory</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'nome',
                'class'=>'',
                'value' => $filtro_view['nome'],
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('cpf_cnpj',[
                'label'=>['class'=>'','text'=>'CNPJ'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'cnpj',
                'class'=>'cnpj_mask',
                'value' => $filtro_view['cnpj'],
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <div class="col l3 m4 s7">
            <?php
            echo $this->Form->button('<i class="material-icons center">search</i>', [
                'type' => 'submit',
                'id' => 'pesquisar',
                'class'=>'waves-effect waves-light btn',
                'style' => 'margin-top: 8%',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="row page-header">
        <div class="col l12 m12 s12">
        </div>
    </div>
    <table class="responsive-table striped">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('nome','Empresa') ?></th>
                <th><?= $this->Paginator->sort('cpf_cnpj','CNPJ') ?></th>
                <th><?= $this->Paginator->sort('contato.0.contato','Telefone da Empresa') ?></th>
                <th><?= $this->Paginator->sort('representante','Representante') ?></th>
                <th><?= $this->Paginator->sort('funcao','Função') ?></th>
                <th><?= $this->Paginator->sort('contato.4.contato','Telefone do Representante') ?></th>
                <th><?= __('') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $pessoa):?>
            <tr>
                <td><?= h($pessoa->nome) ?></td>
                <td><?= h($pessoa->masked_cpf_cnpj) ?></td>
                <td><?= h($pessoa->contatos[0]->contato) ?></td>
                <td><?= h($pessoa->representante) ?></td>
                <td><?= h($pessoa->funcao) ?></td>
                <td><?= h($pessoa->contatos[4]->contato) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('mode_edit'), ['action' => 'edit', $pessoa->id], ['class' => 'material-icons prefix']) ?>
                    <i class="pessoa_selecionada material-icons prefix" data-id="<?= $pessoa->id ?>" style="cursor: pointer; color: #039ae4">visibility</i>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?php
            $this->Paginator->options(array(
                'url' => $filtro_view,
            ));
            ?>

            <?=
            $this->Paginator->prev(__('Anterior'),[
                'templates'=>[
                    'prevDisabled'=>'<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>',
                    'prevActive'=>'<li><a href="#!"><i class="material-icons">chevron_left</i></a></li>'
                ]
            ])
            ?>

            <?= $this->Paginator->numbers() ?>

            <?=
            $this->Paginator->next(__('Próximo'),[
                'templates'=>[
                    'nextDisabled'=>'<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>',
                    'nextActive'=>'<li aria-label="Next"><a href="#!"><i class="material-icons">chevron_right</i></a></li>'
                ]
            ])
            ?>
        </ul>
        <p>
            <?=
            $this->Paginator->counter(
                'Página {{page}} de {{pages}}. Exibindo: {{current}}, Total:  {{count}}.'
            );
            ?>
        </p>
    </div>
</div>

<div id="modal_pessoa" class="modal modal-fixed-footer">

</div>