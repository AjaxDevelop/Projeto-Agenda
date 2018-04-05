<?php
/**
 * @var \App\View\AppView $this
 */

$tabindex = 1;

//Controle CSS.
echo $this->Html->css('Agenda.pessoas/pessoas_controle');

//Insere o script da API de busca do CEP.
echo $this->Html->script('Agenda.busca-cep');

//JQuery Validator
echo $this->Html->script('Agenda.jquery.validate.min');

//Controle JS.
echo $this->Html->script('Agenda.pessoas/pessoas_controle');

//Socios Table.
echo $this->Html->script('Agenda.pessoas/socios_table');

//Validação.
echo $this->Html->script('Agenda.pessoas/validacao_edit');

//Mascaras.
echo $this->Html->script('Agenda.jquery.mask.min');
echo $this->Html->script('Agenda.mascaras');

?>

<script id="listarSocios" type="text/x-handlebars-template">
    <tr id="socio_{{id_table}}">
        <td>{{nome}}</td>
        <td>{{cpf}}</td>
        <td>{{telefone}}</td>
        <td class="center"><i class="material-icons trash remove_socio" data-id="{{id_table}}" data-cpf="{{cpf}}">delete</i></td>
        <input type="hidden" name="socio[{{id_table}}][id]" value="{{id_socio}}">
        <input type="hidden" name="socio[{{id_table}}][nome]" value="{{nome}}">
        <input type="hidden" name="socio[{{id_table}}][cpf_cnpj]" value="{{cpf}}">
        <input type="hidden" name="socio[{{id_table}}][tipoj]" value="{{PF}}">
        <input type="hidden" name="socio[{{id_table}}][contatos][0][contato]" value="{{telefone}}">
        <input type="hidden" name="socio[{{id_table}}][contatos][0][tipo]" value="telefone">
        <input type="hidden" name="socio[{{id_table}}][contatos][0][id]" value="{{conato_id}}">
    </tr>
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
        <li>
            <a href="<?php echo $this->Url->build(['controller'=>'pessoas', 'action'=>'index'],true) ?>" class="btn-floating blue">
                <i class="material-icons tooltipped" data-position="left" data-delay="50" data-tooltip="Empresas Cadastradas">visibility</i>
            </a>
        </li>
    </ul>
</div>

<div class="row" style="margin-top: 20px">
    <ul class="tabs">
        <li class="tab col col l4 m4 s4"><a id="tab1" class="active" href="#tab-organizacao">Empresa</a></li>
        <li class="tab col col l4 m4 s4"><a id="tab2" href="#tab-representante">Representante</a></li>
        <li class="tab col col l4 m4 s4"><a id="tab3" href="#tab-socios">Sócios</a></li>
    </ul>
</div>

<div class="row">
    <div class="col l4 m4 s14 offset-l4 offset-m4 offset-s14">
        <p class="center">
            <?= $this->Flash->render('pessoas'); ?>
        </p>
    </div>
</div>

<?= $this->Form->create($pessoa, ['name' => 'form_empresa', 'id' => 'form_empresa']) ?>

<div class="row page-header">
    <div class="col l12 m12 s12">
    </div>
</div>

<div id="tab-organizacao">

    <div class="row">
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('nome',[
                'label'=>['class'=>'','text'=>'Nome da Empresa*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">store_mall_directory</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'nome',
                'class'=>'',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php  echo $this->Form->hidden('cpf_cnpj', [
                'value' => $pessoa->masked_cpf_cnpj
            ]); ?>
        </div>

        <?php  echo $this->Form->hidden('tipo', [
            'id' => 'tipo',
            'value' => 'PJ'
        ]); ?>
    </div>

    <div class="row page-header">
        <div class="col l12 m12 s12">
            <h5><small>Endereço</small></h5>
        </div>
    </div>
    <div id="section-endereco">
        <div class="row">
            <div class="input-field col l2 m4 s6">
                <?php
                echo $this->Form->input('endereco.cep',[
                    'label'=>['id'=>'label-cep','class'=>'','text'=>'CEP*'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'cep',
                    'class'=>'cep',
                    'required' => true,
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
            <div class="input-field col l3 m3 s3">
                <a id="buscar_cep" class="waves-effect waves-light btn"><i class="material-icons center">search</i></a>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l4 m6 s12">
                <?php
                echo $this->Form->input('endereco.endereco',[
                    'label'=>['id'=>'label-endereco','class'=>'','text'=>'Logradouro*'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'endereco',
                    'class'=>'',
                    'required' => true,
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
            <div class="input-field col l2 m6 s12">
                <?php
                echo $this->Form->input('endereco.numero',[
                    'label'=>['class'=>'','text'=>'Número*'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'numero',
                    'class'=>'',
                    'required' => true,
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l4 m6 s12">
                <?php
                echo $this->Form->input('endereco.complemento',[
                    'label'=>['class'=>'','text'=>'Complemento'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'complemeto',
                    'class'=>'',
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
            <div class="input-field col l4 m6 s12">
                <?php
                echo $this->Form->input('endereco.referencia',[
                    'label'=>['class'=>'','text'=>'Ponto de Referência'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'referencia',
                    'class'=>'',
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
        </div>
        <div class="row">
            <div class="input-field col l4 m6 s12">
                <?php
                echo $this->Form->input('endereco.bairro',[
                    'label'=>['id'=>'label-bairro','class'=>'','text'=>'Bairro*'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'bairro',
                    'class'=>'',
                    'required' => true,
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
            <div class="input-field col l4 m6 s12">
                <?php
                echo $this->Form->input('endereco.cidade',[
                    'label'=>['id'=>'label-cidade','class'=>'','text'=>'Cidade*'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'cidade',
                    'class'=>'',
                    'required' => true,
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
            <div class="input-field col l2 m6 s12">
                <?php
                echo $this->Form->input('endereco.estado',[
                    'label'=>['id'=>'label-estado','class'=>'','text'=>'Estado*'],
                    'templates'=>[
                        'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                    ],
                    'type' => 'text',
                    'id' => 'estado',
                    'class'=>'',
                    'required' => true,
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="loading-endereco col l12 m12 s12" style="display: none;">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
    <div class="row page-header">
        <div class="col l12 m12 s12">
            <h5><small>Contatos</small></h5>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('contatos.0.contato',[
                'label'=>['class'=>'','text'=>'Telefone*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">phone</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'telefone_01',
                'class'=>'telefone_celular',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php  echo $this->Form->hidden('contatos.0.tipo', [
                'value' => 'telefone'
            ]); ?>
            <?php  echo $this->Form->hidden('contatos.0.id'); ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('contatos.1.contato',[
                'label'=>['class'=>'','text'=>'Telefone'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">phone</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'telefone_02',
                'class'=>'telefone_celular',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php  echo $this->Form->hidden('contatos.1.tipo', [
                'value' => 'telefone'
            ]); ?>
            <?php  echo $this->Form->hidden('contatos.1.id'); ?>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('contatos.2.contato',[
                'label'=>['class'=>'','text'=>'E-mail'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">email</i>{{content}}</div>'
                ],
                'type' => 'email',
                'id' => 'email',
                'class'=>'',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php  echo $this->Form->hidden('contatos.2.tipo', [
                'value' => 'email'
            ]); ?>
            <?php  echo $this->Form->hidden('contatos.2.id'); ?>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('contatos.3.contato',[
                'label'=>['class'=>'','text'=>'Web Site'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">web</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'site',
                'class'=>'',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php  echo $this->Form->hidden('contatos.3.tipo', [
                'value' => 'site'
            ]); ?>
            <?php  echo $this->Form->hidden('contatos.3.id'); ?>
        </div>
    </div>
    <div class="row page-header">
        <div class="col l12 m12 s12">
            <h5><small>Observação</small></h5>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l12 m12 s12">
            <?php
            echo $this->Form->input('observacoe.observacao', [
                'label'=>['class'=>'','text'=>'Oberservação'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">description</i>{{content}}</div>'
                ],
                'type' => 'textarea',
                'id' => 'observacao',
                'class'=>'materialize-textarea',
                'tabindex'=>$tabindex
            ]);

            ++$tabindex;
            ?>
        </div>
    </div>
    <div class="navegacao">
        <div class="row page-header"></div>

        <div class="row">
            <div class="col l2 m4 s6 offset-l10 offset-m8 offset-s6 right">
                <a class="waves-effect waves-light right touch_tab" data-tab="tab2" tabindex="<?php echo $tabindex; ++$tabindex; ?>" accesskey=”13″>Avançar</a>
            </div>
        </div>
    </div>
</div>

<div id="tab-representante">
    <div class="row">
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('representante', [
                'label' => ['class' => '', 'text' => 'Nome*'],
                'templates' => [
                    'inputContainer' => '<div class""><i class="material-icons prefix">face</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'representante_nome',
                'class' => '',
                'required' => true,
                'tabindex' => $tabindex
            ]);

            ++$tabindex;
            ?>
        </div>
    </div>

    <div class="row">
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('funcao', [
                'label' => ['class' => '', 'text' => 'Função*'],
                'templates' => [
                    'inputContainer' => '<div class=""><i class="material-icons prefix">work</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'representante_funcao',
                'class' => '',
                'required' => true,
                'tabindex' => $tabindex
            ]);

            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m4 s12">
            <?php
            echo $this->Form->input('contatos.4.contato', [
                'label' => ['class' => '', 'text' => 'Telefone*'],
                'templates' => [
                    'inputContainer' => '<div class=""><i class="material-icons prefix">phone</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'representante_telefone',
                'class' => 'telefone_celular',
                'required' => true,
                'tabindex' => $tabindex
            ]);

            echo $this->Form->hidden('contatos.4.tipo', [
                'value' => 'representante'
            ]);

            echo $this->Form->hidden('contatos.4.id');

            ++$tabindex;
            ?>
        </div>
    </div>

    <div class="navegacao">
        <div class="row page-header"></div>
        <div class="row">
            <div class="col l2 m4 s6">
                <a class="waves-effect waves-light left touch_tab" data-tab="tab1" tabindex="<?php echo $tabindex; ++$tabindex; ?>">Voltar</a>
            </div>
            <div class="col l2 m4 s6 offset-l8 offset-m4">
                <a class="waves-effect waves-light right touch_tab" data-tab="tab3" tabindex="<?php echo $tabindex; ++$tabindex; ?>">Avançar</a>
            </div>
        </div>
    </div>
</div>

<div id="tab-socios">
    <div class="row">
        <div class="input-field col l4 m6 s12">
            <?php
            echo $this->Form->input('socio_nome', [
                'label' => ['class' => '', 'text' => 'Nome*'],
                'templates' => [
                    'inputContainer' => '<div class=""><i class="material-icons prefix">face</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'socio_nome',
                'class' => '',
                'tabindex' => $tabindex
            ]);

            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('socio_cpf', [
                'label' => ['class' => '', 'text' => 'CPF*'],
                'templates' => [
                    'inputContainer' => '<div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'socio_cpf',
                'class' => 'cpf_mask',

                'tabindex' => $tabindex
            ]);

            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('socio_telefone', [
                'label' => ['class' => '', 'text' => 'Telefone*'],
                'templates' => [
                    'inputContainer' => '<div class=""><i class="material-icons prefix">phone</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'socio_telefone',
                'class' => 'telefone_celular',
                'tabindex' => $tabindex
            ]);

            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l1 m1 s1 pull-l1 offset-l1 offset-m5 offset-s10">
            <a id="adicionar" class="btn-floating btn waves-effect waves-light green"><i class="material-icons">add</i></a>
        </div>
    </div>

    <div class="row page-header"></div>

    <div class="row">
        <table class="responsive-table bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="liSocios">
            <!-- Template -->
                <?php

                    $socios_count = 0;

                    if (count($socios) > 0) {

                        foreach ($socios as $socio):
                ?>
                <tr id="socio_<?php echo $socios_count ?>">
                    <td><?php echo $socio->nome ?></td>
                    <td><?php echo $socio->cpf_cnpj ?></td>
                    <td><?php echo $socio->contatos[0]->contato ?></td>
                    <td class="center"><i class="material-icons trash remove_socio" data-id="<?php echo $socios_count ?>" data-cpf="{{cpf}}">delete</i></td>
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][id]" value="<?php echo $socio->id ?>">
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][nome]" value="<?php echo $socio->nome ?>">
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][cpf_cnpj]" id="list_cpf_<?php echo $socios_count ?>" value="<?php echo $socio->cpf_cnpj ?>">
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][tipoj]" value="PF">
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][contatos][0][contato]" value="<?php echo $socio->contatos[0]->contato ?>">
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][contatos][0][tipo]" value="telefone">
                    <input type="hidden" name="socio[<?php echo $socios_count ?>][contatos][0][id]" value="<?php echo $socio->contatos[0]->id ?>">
                </tr>
                <?php

                            ++$socios_count;

                        endforeach;
                    }
                ?>
            </tbody>
        </table>
        <input type="hidden" id="socios_count" value="<?php echo $socios_count ?>">
    </div>

    <div class="navegacao">
        <div class="row page-header"></div>
        <div class="row">
            <div class="col l2 m4 s6">
                <a class="waves-effect waves-light left touch_tab" data-tab="tab2" tabindex="<?php echo $tabindex; ++$tabindex; ?>">Voltar</a>
            </div>
            <div class="col l3 m4 s6 offset-l7 offset-m4">
                <?php
                echo $this->Form->button('Salvar<i class="material-icons right">cloud</i>', [
                    'type' => 'button',
                    'id' => 'salvar',
                    'class'=>'waves-effect waves-light btn right',
                    'tabindex'=>$tabindex
                ]);
                ++$tabindex;
                ?>
            </div>
        </div>
    </div>
</div>

<?= $this->Form->end() ?>

<div id="modal_validacao" class="modal blue-grey darken-1 white-text">
    <div class="modal-content">
        <div class="row">
            <div class="col l8 m8 s8 offset-l2 offset-m2 offset-s2">
                <h4><small>Ops!</small></h4>
                <p>
                    Existem dados inválidos no seu formulário. Por favor, verifique os
                    dados informados.
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</div>


<div id="modal_cadastro" class="modal blue-grey darken-1 white-text">
    <div class="modal-content">
        <div class="row">
            <div id="mensagem-cadastro" class="col l8 m8 s8 offset-l2 offset-m2 offset-s2">
                <h4><small>Empresa já Cadastrada!</small></h4>
                <p>
                    Verificamos em nosso sistema que a empresa que você esta tentando
                    cadastrar já consta em nossa base de dados. Por favor, verifique os
                    dados informados ou acesse a página de edição dos dados da empresa.
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
        <a id="editar_cadastro" href="#!" class="waves-effect waves-brown btn-flat">Editar Cadastro</a>
    </div>
</div>

<div id="modal_socioExistente" class="modal blue-grey darken-1 white-text">
    <div class="modal-content">
        <div class="row">
            <div class="col l8 m8 s8 offset-l2 offset-m2 offset-s2">
                <h4><small>Cliente já Cadastrado!</small></h4>
                <p>
                    Verificamos em nosso sistema que o cliente de CPF <b id="mensagem_cpf"></b>
                    já consta em nossa base de dados. Ao prosseguir você estará editando os dados
                    deste cliente e o associando como sócio desta organização.
                </p>
                <p>
                    Deseja prosseguir?
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="waves-effect waves-brown btn-flat" id="prosseguir">Continuar</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Cancelar</a>
    </div>
</div>



