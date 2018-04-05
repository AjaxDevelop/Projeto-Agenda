<?php
namespace Agenda\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Date;

/**
 * Visitas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Pessoas
 * @property \Cake\ORM\Association\HasOne $Observacoes
 *
 * @method \Agenda\Model\Entity\Visita get($primaryKey, $options = [])
 * @method \Agenda\Model\Entity\Visita newEntity($data = null, array $options = [])
 * @method \Agenda\Model\Entity\Visita[] newEntities(array $data, array $options = [])
 * @method \Agenda\Model\Entity\Visita|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Agenda\Model\Entity\Visita patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Visita[] patchEntities($entities, array $data, array $options = [])
 * @method \Agenda\Model\Entity\Visita findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VisitasTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('visitas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Pessoas', [
            'foreignKey' => 'pessoa_id',
            'joinType' => 'INNER',
            'className' => 'Agenda.Pessoas'
        ]);

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'className' => 'Agenda.Usuarios'
        ]);


        $this->hasOne('Observacoe', [
            'targetForeignKey' => 'visita_id',
            'className' => 'Agenda.Observacoes'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        /*$validator
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        $validator
            ->requirePresence('hora_inicial', 'create')
            ->notEmpty('hora_inicial');

        $validator
            ->requirePresence('hora_final', 'create')
            ->notEmpty('hora_final');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');*/

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['pessoa_id'], 'Pessoas'));

        return $rules;
    }

    /***
     * Function Get Status Visita.
     *
     * Objetivo: Retornar os Status de controle da visita.
     *
     * Request:
     *
     * Response: $status: Array com os status a serem utilizados.
     *
     **/

    public function getStatusVisita($status_atual = null) {

        $status_atual = strtoupper($status_atual);
        $status = [];

        if ($status_atual == "AGENDADA") {

            $status = [
                '' => '',
                'CANCELADA' => 'Cancelada',
                'FINALIZADA' => 'Finalizada',
                'REVISITAR' => 'Revisitar',
                'REAGENDADA' => 'Reagendada',
                'VENDIDO' => 'Vendido'
            ];

        }

        /*if ($status_atual == "REAGENDADA" || $status_atual == "REVISITAR") {

            $status = [
                '' => '',
                'CANCELADA' => 'Cancelada',
                'FINALIZADA' => 'Finalizada',
                'REVISITAR' => 'Revisitar',
                'REAGENDADA' => 'Reagendada',
                'VENDIDO' => 'Vendido'
            ];

        }*/

        if ($status_atual == "CANCELADA" || $status_atual == "FINALIZADA" || $status_atual == "VENDIDO") {

            $status = [
                '' => '',
                'CANCELADA' => 'Cancelada',
                'FINALIZADA' => 'Finalizada',
                'VENDIDO' => 'Vendido'
            ];

        }

        return $status;
    }

    /***
     * Function Gerar Entidades
     *
     * Objetivo: Gerar Entidades do tipo Visita a serem salvas no banco de dados.
     *
     * Request: $visita: Array com a entidade da visita atual. $data: Array com os
     * dados a serem atualizadas.
     *
     * Response: $visitas: Array com as entidades a serem salvas no banco de dados.
     *
     **/

    public function gerarEntidades($visita = null, $data = null) {

        if (!is_array($data)) {
            return [];
        }

        $model = $this;
        $historico_model = TableRegistry::get('historicos_visitas');
        $visitas = [
            'noEdit' => ['REAGENDADA', 'REVISITAR'],
            'visitas' => [],
            'historicos' => []
        ];
        $status_atual = strtoupper($visita->status);
        $status_novo = strtoupper($data['status']);
        $time = date("Y-m-d H:i:s");
        $time = date('Y-m-d H:i:s', strtotime('+45 seconds',strtotime($time)));

        if (($status_atual == $status_novo) || ($status_novo == "CANCELADA" || $status_novo == "FINALIZADA" || $status_novo == "VENDIDO")) {

            $data['pessoa_id'] = $visita->pessoa_id;
            $data['vendedor_id'] = $visita->usuario_id;
            $data['ativo'] = false;

            $visita_temp = $model->patchEntity($visita, $data);

            array_push($visitas['visitas'], $visita_temp);

            $historico = $historico_model->newEntity();
            $historico->created = new Time();
            $historico->modified = new Time();
            $historico = $historico_model->patchEntity($historico, $data);

            array_push($visitas['historicos'], $historico);

        } else if ($status_novo == "REAGENDADA" || $status_novo == "REVISITAR") {

                $visita_temp = $model->newEntity();

                $dados_atual = [
                    'pessoa_id' => $visita->pessoa_id,
                    'responsavel_id' => $data['responsavel_id'],
                    'vendedor_id' => $visita->usuario_id,
                    'data' => $visita->data,
                    'hora_inicial' => $visita->hora_inicial,
                    'hora_final' => $visita->hora_final,
                    'status' => $data['status'],
                    'ativo' => false
                ];

                $dados_novo = [
                    'pessoa_id' => $visita->pessoa_id,
                    'usuario_id' => $visita->usuario_id,
                    'responsavel_id' => $data['responsavel_id'],
                    'vendedor_id' => $visita->usuario_id,
                    'data' => $data['data'],
                    'hora_inicial' => $data['hora_inicial'],
                    'hora_final' => $data['hora_final'],
                    'observacoe' => ['observacao' => $data['observacoe']['observacao']],
                    'status' => 'AGENDADA',
                    'ativo' => true
                ];

                $check = $model->checkVisitas($dados_novo);

                if (count($check) > 0 ) {
                    return [];
                }

                $visita->status = $status_novo;
                array_push($visitas['visitas'], $visita);

                $visita_temp = $model->patchEntity($visita_temp, $dados_novo);
                array_push($visitas['visitas'], $visita_temp);

                $historico = $historico_model->newEntity();
                $historico->created = new Time();
                $historico->modified = new Time();
                $historico = $historico_model->patchEntity($historico, $dados_atual);
                array_push($visitas['historicos'], $historico);

                $historico_novo = $historico_model->newEntity();
                $historico_novo->created = $time;
                $historico_novo->modified = $time;
                $historico_novo = $historico_model->patchEntity($historico_novo, $dados_novo);
                array_push($visitas['historicos'], $historico_novo);

        }

        return $visitas;

    }

    /***
     * Function Gerar Historico
     *
     * Objetivo: Retorar os dados de todas as visitas realizadas por em uma empresa.
     *
     * Request: $id: Int com o id da empresa a ser pesquisada.
     *
     * Response: $visitas: Array com as visitas associadas a empresa.
     *
     **/

    public function gerarHistorico($id = null) {

        //Variáveis.
        $model = TableRegistry::get('historicos_visitas');
        $usuarios_model = TableRegistry::get('Usuarios');
        $visitas = [
            'visitas' => [],
            'count_visitas' => 0,
        ];

        //Verificação de parâmetro.
        if ($id == null || empty($id)) {
            return $visitas;
        }

        //Pesquisa por visitas relacionadas a empresa.
        $visitas_list = $model->find('all', [
            'conditions' => ['pessoa_id' => $id],
            'order' => ['created' => 'ASC']
        ])->toArray();

        if (count($visitas_list) > 0) {

            foreach ($visitas_list as $visita) {

                $vendedor = $usuarios_model->get($visita->vendedor_id);
                $responsavel = $usuarios_model->get($visita->responsavel_id);

                $visita->data = $visita->data->format('d/m/Y');
                $visita->created = 'Por '. $responsavel->display .'. Dia: ' .$visita->created->format('d/m/Y'). ' às ' .$visita->created->format('H:i');
                $visita->vendedor = $vendedor->display;

            }

            $visitas['visitas'] = $visitas_list;
            $visitas['count_visitas'] = count($visitas_list);
        }

        //Responde a requisição.
        return $visitas;

    }

    /***
     * Function Get Visitas
     *
     * Objetivo: Retorar os dados de todas as visitas de acordo com um filtro
     * específico.
     *
     * Request: $filtro: Array as definições de busca.
     *
     * Response: $visitas: Array com as visitas ao filtro.
     *
     **/

    public function getVisitas($filtro = null) {

        $model = $this;
        $visitas = [
            'noEdit' => ['REAGENDADA', 'REVISITAR'],
            'visitas' => [],
            'count_visitas' => 0,
        ];

        $visitas_list = $model->find('all', [
            'conditions' => [$filtro]
        ])->contain('Usuarios')->toArray();

        if (count($visitas_list) > 0) {

            foreach ($visitas_list as $visita) {

                $visita->data = $visita->data->format('d/m/Y');

            }

            $visitas['visitas'] = $visitas_list;
            $visitas['count_visitas'] = count($visitas_list);
        }

        return $visitas;
    }

    /***
     * Function Gerar relatorio
     *
     * Objetivo: Gera um relatório com os dados do agendamento.
     *
     * Request: $filtro: Array com as regras de busca.
     *
     * Response: $pacote: array com os dados do relatório.
     *
     **/

    public function gerarRelatorio($filtro = null) {

        $model = $this;
        $pacote = [
            'total' => 0,
            'dados' => [
                'AGENDADA' => 0,
                'CANCELADA' => 0,
                'FINALIZADA' => 0,
                'REVISITAR' => 0,
                'REAGENDADA' => 0,
                'VENDIDO' => 0
            ]
        ];

        $visitas = $model->find()
            ->where([$filtro])
            ->toArray();

        if (count($visitas) > 0) {
            $pacote['total'] = count($visitas);

            foreach ($visitas as $visita) {

                ++$pacote['dados'][$visita->status];

            }
        }

        return $pacote;

    }

    /***
     * Function Check visitas
     *
     * Objetivo: Verifica se não existe uma visita agendada para a mesma empresa no
     * mesmo horario.
     *
     * Request: $dados: Array com os dados da visita a serem agendados.
     *
     * Response: $visitas: Array com entidades enconrtradas.
     *
     **/

    public function checkVisitas($dados = null) {

        //Variáveis
        $model = $this;
        $filtro = [];

        //Regras de busca
        /*if (isset($dados['pessoa_id'])) {
            array_push($filtro, ['Visitas.pessoa_id' => $dados['pessoa_id']]);
        }*/

        if (isset($dados['usuario_id'])) {
            array_push($filtro, ['Visitas.usuario_id' => $dados['usuario_id']]);
        }

        if (isset($dados['data'])) {
            array_push($filtro, ['Visitas.data' => $model->converteData($dados['data'])]);
        }

        if (isset($dados['hora_inicial']) && isset($dados['hora_final'])) {
            array_push($filtro, ['OR' => [
                [
                    'Visitas.hora_inicial <=' => $dados['hora_inicial'],
                    'Visitas.hora_final >' => $dados['hora_inicial']
                ],
                [
                    'Visitas.hora_inicial <' => $dados['hora_final'],
                    'Visitas.hora_final >=' => $dados['hora_final']
                ],
                [
                    'Visitas.hora_inicial >=' => $dados['hora_inicial'],
                    'Visitas.hora_final <' => $dados['hora_final']
                ],
            ]
            ]);
        }

        array_push($filtro, ['Visitas.status !=' => 'CANCELADA']);

        array_push($filtro, ['Visitas.status !=' => 'REAGENDADA']);


        //Busca junto ao banco de dados.
        $visitas = $model->find('all', [
            'conditions' => [$filtro]
        ])->toArray();

        //Responde a requisição.
        return $visitas;

    }

    /***
     * Function Converte Data.
     *
     * Objetivo: Converter a data do padrão 'Y-m-d' para o padrão 'd/m/Y' ou do padrão
     * 'd/m/y para o padrão 'Y-m-d'.
     *
     * Request: $data: String contendo a data no padão 'Y-m-d' ou no padrão 'd/m/Y'.
     *
     * Response: $data: String com a data convertida.
     *
     **/

    public function converteData($data = null) {

        if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $data)) { //Se a data estiver no padão 'Y-m-d'.

            //Formata para o padrão 'd/m/Y'.


            if(! empty($data)){

                list ($ano, $mes, $dia) = explode('-', $data);
                $data = $dia."/".$mes."/".$ano;

            }

        } else if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $data)) {  //Se a data estiver no padão 'd/m/Y'.

            //Formata para o padrão Y-m-d.
            if(! empty($data)){

                list ($dia, $mes, $ano) = explode('/', $data);
                $data = $ano."-".$mes."-".$dia;

            }

        }

        return $data;
    }

}
