<?php
/**
  * @var \App\View\AppView $this
  */

    //Zabuto Calendar.
    echo $this->Html->script('Agenda.visitas/zabuto_calendar.min');
    echo $this->Html->css('Agenda.visitas/zabuto_calendar.min');

    //Controle JS.
    echo $this->Html->script('Agenda.visitas/visitas_controle');

    //Calendário JS.
    echo $this->Html->script('Agenda.visitas/visitas_calendario');

    //Formulário JS.
    echo $this->Html->script('Agenda.visitas/visitas_formulario');

    //Controle CSS.
    echo $this->Html->css('Agenda.visitas/visitas_controle');

    //Mascaras.
    echo $this->Html->script('Agenda.jquery.mask.min');
    echo $this->Html->script('Agenda.mascaras');

    //Tabindex
    $tabindex = 1;

?>

<style>
    .bloco {
        width: 10px;
        height: 25px;
    }

    .status-conf {
        margin-top: 5px;
        font-size: 0.7rem;
    }

    .status-AGENDADA {
        background-color: #2ecb71;
        float: left;
        margin-right: 5px;
    }

    .status-CANCELADA {
        background-color: #e64c3c;
        float: left;
        margin-right: 5px;
    }

    .status-REAGENDADA {
        background-color: #fdd640;
        float: left;
        margin-right: 5px;
    }

    .status-REVISITAR {
        background-color: #94a4a5;
        float: left;
        margin-right: 5px;
    }

    .status-VENDIDO {
        background-color: #3497da;
        float: left;
        margin-right: 5px;
    }

    .status-FINALIZADA {
        background-color: #8d44ac;
        float: left;
        margin-right: 5px;
    }
</style>

<!-- Template Script -->
<script id="listarVisita" type="text/x-handlebars-template">
    <div class="modal-content">
        {{#each visitas}}
        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Status</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p>{{status}}</p>
            </div>
        </div>
        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Endereço</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p><strong>CEP:</strong> {{pessoa.endereco.cep}}</p>
                <p><strong>Logradouro:</strong> {{pessoa.endereco.endereco}} , {{pessoa.endereco.numero}}</p>
                <p><strong>Complemento:</strong> {{pessoa.endereco.complemento}}</p>
                <p><strong>Bairro:</strong> {{pessoa.endereco.bairro}}</p>
                <p><strong>Cidade:</strong> {{pessoa.endereco.cidade}}</p>
                <p><strong>Estado:</strong> {{pessoa.endereco.estado}}</p>
            </div>
        </div>
        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Demais Contatos</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p><strong>E-mail:</strong> {{pessoa.contatos.2.contato}}</p>
                <p><strong>Site:</strong> {{pessoa.contatos.3.contato}}</p>
            </div>
        </div>
        <div class="row page-header">
            <div class="col l12 m12 s12">
                <span class="titulo">Observação</span>
            </div>
        </div>
        <div class="row col offset-l1 offset-m1 offset-s1">
            <div>
                <p>{{observacoe.observacao}}</p>
            </div>
        </div>
        {{/each}}
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</script>

<script id="listarClientes" type="text/x-handlebars-template">
    <div class="modal-content">
        <ul class="collection with-header">
            {{#each pessoas}}
            <li class="collection-item cliente_selecionado" data-id="{{id}}" data-nome="{{nome}}" style="cursor: pointer;">
                <div>
                    <span class="title"><strong>Empresa:</strong> {{nome}}</span>
                    <p><strong>CNPJ:</strong> {{cpf_cnpj}}</p>
                </div>
            </li>
            {{/each}}
        </ul>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</script>

<script id="listarVisitas" type="text/x-handlebars-template">
    <div class="row">
        <div class="col l3 m4 s8 offset-l9 offset-m8 offset-s4 right-align">
            {{count_visitas}} Visita(s) Realizada(s) <!--<i class="material-icons prefix">description</i>-->
        </div>
    </div>
    <div class="row">
        <div class="col l12 m12 s12">
            <table class="responsive-table striped">
                <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Horário Inicial</th>
                        <th>Horário Final</th>
                        <th>Empresa</th>
                        <th>CNPJ</th>
                        <th>Representante</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {{#each visitas}}
                    <tr>
                        <td>{{usuario.display}}</td>
                        <td>{{hora_inicial}}</td>
                        <td>{{hora_final}}</td>
                        <td>{{pessoa.nome}}</td>
                        <td>{{pessoa.cpf_cnpj}}</td>
                        <td>{{pessoa.representante}}</td>
                        <td>{{pessoa.contatos.4.contato}}</td>
                        <td class="center"><div class="bloco status-{{status}}"></div></td>
                        <td></td>
                        <td></td>
                        <td>
                            <i class="visita_historico material-icons prefix" data-id="{{id}}" data-empresa="{{pessoa.id}}" style="cursor: pointer; color: #039ae4">folder_open</i>
                            <i class="visita_selecionada material-icons prefix" data-id="{{id}}" style="cursor: pointer; color: #039ae4">visibility</i>
                            {{#ifComp status noEdit}}
                                <a href="<?php echo $this->Url->build(["controller" => "Visitas", "action" => "edit"]);?>/{{id}}"><i class="material-icons prefix">mode_edit</i></a>
                            {{/ifComp}}
                        </td>
                    </tr>
                    {{/each}}
                </tbody>
            </table>
        </div>
    </div>
</script>

<script id="listarHistorico" type="text/x-handlebars-template">
    <div class="modal-content">
        <ul class="collection with-header">
            <div class="row page-header">
                <div class="col l12 m12 s12">
                    <span class="titulo">Histórico da Empresa</span>
                </div>
            </div>
            <div class="col l4 m6 s10 offset-l8 offset-m6 offset-s2 right-align">
                {{count_visitas}} registro(s) localizado(s).
            </div>
            <div class="row col l12 m12 s12">
                <table class="responsive-table striped">
                    <thead>
                    <tr>
                        <th>Vendedor</th>
                        <th>Data da Visita</th>
                        <th>Horário Inicial</th>
                        <th>Horário Final</th>
                        <th>Status</th>
                        <th>Registrado</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{#each visitas}}
                    <tr>
                        <td>{{vendedor}}</td>
                        <td>{{data}}</td>
                        <td>{{hora_inicial}}</td>
                        <td>{{hora_final}}</td>
                        <td>{{status}}</td>
                        <td>{{created}}</td>
                    </tr>
                    {{/each}}
                    </tbody>
                </table>
            </div>
        </ul>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</script>

<!-- Market Place -->
<div id="market-place">
    <div id="pessoa_controle" data-controle="false"></div>
    <div id="data_controle" data-controle="true" data-value=""></div>
    <div id="horario_controle" data-controle="false"></div>
    <div id="status_controle" data-controle="true"></div>
</div>

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

<div class="row">
    <div class="col l4 m4 s14 offset-l4 offset-m4 offset-s14">
        <p class="center">
            <?= $this->Flash->render('visitas'); ?>
        </p>
    </div>
</div>

<!-- Calendário -->
<div id="calendario" class="row" style="margin-top: 50px;">
    <div class="col l12 m12 s12">
        <div id="my-calendar"></div>
    </div>
</div>

<!-- Lista -->
<div class="row page-header">
    <div class="col l12 m12 s12">
        <h5>Visitas - <span id="dia_atual"><?= $dia_atual ?></span></h5>
    </div>
</div>

<div id="filtro-form" style="display: none">
    <div class="row">
        <div id="filtro_icon">
            <!-- Ícone do filtro -->
        </div>
        <div id="filtro">
            <div class="input-field col l3 m6 s9">
                <select id="filtro_vendedor">
                    <option value="" disabled selected>Selecione um vendedor</option>
                    <?php foreach($vendedores as $vendedor): ?>
                        <option value="<?php echo $vendedor->id; ?>"><?php echo $vendedor->display; ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Filtrar por Vendedor</label>
            </div>
            <div class="input-field col l3 m3 s3">
                <a id="filtrar" class="waves-effect waves-light btn"><i class="material-icons center">search</i></a>
            </div>
        </div>
    </div>
</div>

<div id="listar_visitas">
    <div class="row">
        <div id="lista-table" class="col l12 m12 s12">

        </div>
    </div>
    <div class="row">
        <div class="col l2 m4 s12 status-conf">
            <div class="bloco status-AGENDADA"></div>
            AGENDADA
        </div>
        <div class="col l2 m4 s12 status-conf">
            <div class="bloco status-CANCELADA"></div>
            CANCELADA
        </div>
        <div class="col l2 m4 s12 status-conf">
            <div class="bloco status-FINALIZADA"></div>
            FINALIZADA
        </div>
        <div class="col l2 m4 s12 status-conf">
            <div class="bloco status-REAGENDADA"></div>
            REAGENDADA
        </div>
        <div class="col l2 m4 s12 status-conf">
            <div class="bloco status-REVISITAR"></div>
            REVISITADA
        </div>
        <div class="col l2 m4 s12 status-conf">
            <div class="bloco status-VENDIDO"></div>
            VENDIDO
        </div>
    </div>
</div>

<div class="row">
    <div id="loading-lista" class="col l12 m12 s12 progress" style="display: none;">
        <div class="indeterminate"></div>
    </div>
</div>
<div class="row">
    <div id="mensagem-lista" class="col l6 m6 s12 card blue-grey darken-1" style="display: none;">
        <div class="card-content white-text">
            <span class="card-title">Registro não Encontrado!</span>
            <p>
                Infelizmente não foi possivel localizar nenhum registro de visitas
                realizadas na data requisitada.
            </p>
        </div>
    </div>
</div>

<!-- Cadastro -->
<div class="row page-header">
    <div class="col l12 m12 s12">
        <h5><span>Cadastrar Visita</span></h5>
    </div>
</div>

<?= $this->Form->create(null, ['id' => 'form_visita', 'url' => ['action' => 'add']]) ?>
<div class="visita-form">
    <div class="row">
        <div class="input-field col l6 m6 s9">
            <?php
            echo $this->Form->input('nome',[
                'label'=>['class'=>'','text'=>'Nome da Empresa*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">account_circle</i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'nome',
                'class'=>'formulario',
                'autocomplete' => 'off',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>

            <?php
            echo $this->Form->hidden('pessoa_id', [
                'type' => 'text',
                'id' => 'pessoa_id'
            ]);
            ?>

        </div>
        <div class="input-field col l3 m3 s3">
            <button id="buscar" class="waves-effect waves-light btn" tabindex="<?php echo $tabindex; ++$tabindex; ?>">
                <i class="material-icons center">search</i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('data',[
                'label'=>['class'=>'','text'=>'Data*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'data',
                'class'=>'data formulario',
                'value' => $dia_atual,
                'required' => true,
                'readonly' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('hora_inicial', [
                'label'=>['class'=>'','text'=>'Horário Inicial*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'horario_inicial',
                'class'=>'hora horario formulario',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
        <div class="input-field col l2 m6 s12">
            <?php
            echo $this->Form->input('hora_final',[
                'label'=>['class'=>'','text'=>'Horário Final*'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix"></i>{{content}}</div>'
                ],
                'type' => 'text',
                'id' => 'horario_final',
                'class'=>'hora horario formulario',
                'required' => true,
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
    </div>

    <?php
        if($user_select == "all") {
    ?>

    <div class="row">
        <div class="input-field col l4 m6 s12">
            <i class="material-icons prefix">perm_identity</i>
            <select id="usuario_id" name="usuario_id" tabindex="<?php echo $tabindex; ++$tabindex; ?>">
                <option value="<?php echo $user_id?>">Vendedor</option>
                <?php foreach ($vendedores as $vendedor): ?>
                    <option value="<?php echo $vendedor->id; ?>"><?php echo $vendedor->display; ?></option>
                <?php endforeach; ?>
            </select>
            <label>Representante</label>
        </div>
    </div>

    <?php
        } else {
            echo $this->Form->hidden('usuario_id', [
                'value' => $user_id
            ]);
        }
    ?>

    <div class="row">
        <div class="input-field col l7 m12 s12">
            <?php
            echo $this->Form->input('observacoe.observacao', [
                'label'=>['class'=>'','text'=>'Oberservação'],
                'templates'=>[
                    'inputContainer'=>' <div class=""><i class="material-icons prefix">description</i>{{content}}</div>'
                ],
                'type' => 'textarea',
                'id' => 'observacao',
                'class'=>'materialize-textarea formulario',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>
    </div>

    <?php

        echo $this->Form->hidden('status', [
            'value' => 'AGENDADO'
        ]);

    ?>

    <div style="min-height: 50px;"></div>
    <div class="row">
        <div class="col l3 m4 s7 offset-l9 offset-m8 offset-s5 push-l1 push-m1 push-s1">
            <?php
            echo $this->Form->button('Salvar<i class="material-icons right">cloud</i>', [
                'type' => 'button',
                'id' => 'salvar',
                'class'=>'waves-effect waves-light btn disabled',
                'tabindex'=>$tabindex
            ]);
            ++$tabindex;
            ?>
        </div>

        <div class="loading-submit col l2 m3 s6 offset-l10 offset-m9 offset-s6" style="display: none;">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
</div>


<div class="loading-form col l2 m3 s6 offset-l10 offset-m9 offset-s6" style="display: none;">
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
</div>

<?= $this->Form->end() ?>

<div id="modal_visita" class="modal modal-fixed-footer">

</div>

<div id="modal_clientes" class="modal">

</div>

<div id="modal_historico" class="modal modal-fixed-footer">

</div>

<div id="modal_busca" class="modal">
    <div class="modal-content">
        <h4>Empresa não Cadastrada!</h4>
        <p>Infelizmente não foi possivél encontrar nenhuma empresa em nossa base de dados com o termo informado.</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</div>

<div id="modal_horario" class="modal blue-grey darken-1 white-text">
    <div class="modal-content">
        <div class="row">
            <div id="mensagem-horario" class="col l8 m8 s8 offset-l2 offset-m2 offset-s2">
                <h4><small>Horario Inválido!</small></h4>
                <p>
                    O horário da sua visita é inválido. Por favot, verifique o horário informado.
                </p>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-brown btn-flat">Fechar</a>
    </div>
</div>
