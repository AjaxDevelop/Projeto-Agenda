<?php
namespace Agenda\Controller;

use Agenda\Controller\AppController;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
 * Visitas Controller
 *
 * @property \Agenda\Model\Table\VisitasTable $Visitas
 */
class VisitasController extends AppController
{

    protected $calc;

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        $visitas = $this->paginate($this->Visitas);

        //Variáveis
        $filtro = [];

        //Gera as variáveis correspondente ao usuário logado.
        $usuarios_model = TableRegistry::get('Agenda.Usuarios');
        $user_id = $this->Auth->user('id');
        $user_function = $usuarios_model->get($user_id);

        //Deifine o dia atual
        $dia_atual = new Date();
        $dia_atual = $dia_atual->format('d/m/Y');

    //###### LISTAR VENDEDORES ######//

        if ($user_function->isVendedor()) {
            array_push($filtro, ['Usuarios.id' => $user_id]);
            $user_select = "";
        } else {
            $user_select = "all";
        }

        array_push($filtro, ['Usuarios.role' => 'VENDEDOR_EXTERNO', 'Usuarios.ativo' => true]);

        //Buscar vendedores no banco.
        $vendedores = $usuarios_model->find('all', [
            'fields' => ['id', 'display'],
            'conditions' => [$filtro]
        ])->toArray();

        //Zera o array caso ele esteja vazío.
        if(count($vendedores) == 0) {
            $vendedores = [];
        }

    ////


        $this->set(compact(['visitas', 'dia_atual', 'user_id', 'user_select', 'vendedores']));
        $this->set('_serialize', ['visitas', 'dia_atual', 'vensdedores']);
    }

    /**
     * View method
     *
     * @param string|null $id Visita id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        //Variáveis
        $visitas = [];
        $visitas_realizadas = [];
        $filtro = [];
        $find = false;
        $serialize = '';

        //Gera as variáveis correspondente ao usuário logado.
        $usuarios_model = TableRegistry::get('Agenda.Usuarios');
        $user_id = $this->Auth->user('id');
        $user_function = $usuarios_model->get($user_id);

        //Define o filtro de busca
        if ($user_function->isVendedor()) {
            array_push($filtro, ['Visitas.usuario_id' => $user_id]);
        }

        if (isset($this->request->query['month'])) { //Inicializa o calendário.

            array_push($filtro, ['MONTH(data)' => $this->request->query['month']]);
            array_push($filtro, ['YEAR(data)' => $this->request->query['year']]);

            //Libera a busca no banco.
            $find = true;

            //Define a serialização.
            $serialize = 'visitas_realizadas';
        } else if (isset($this->request->data['data'])) { //Busca com base em uma data específica.

            array_push($filtro, ['Visitas.data' => $this->request->data['data']]);

            //Verifica se há um filtro vindo da 'view'.
            if (isset($this->request->data['vendedor']) && is_numeric($this->request->data['vendedor'])) {
                //Realiza a busca filtrando por vendedor.
                array_push($filtro, ['Visitas.usuario_id' => $this->request->data['vendedor']]);
            }

            //Libera a busca no banco.
            $find = true;

            //Define a serialização.
            $serialize = 'visitas';
        } else if ($this->request->is('put') && isset($this->request->data['id'])) { //Busca com base no id passado (Modal).

            array_push($filtro, ['Visitas.id' => $this->request->data['id']]);

            //Libera a busca no banco.
            $find = true;

            //Define a serialização.
            $serialize = 'visitas';
        }

        if ($find == true && $serialize == "visitas_realizadas") {
            $visitas = $this->Visitas->find()
                ->where([$filtro])
                ->toArray();

            foreach ($visitas as $visita) {

                $dados = [
                    "date" => $visita->data->format('Y-m-d'),
                    "badge" => false,
                    "id" => $visita->id
                ];

                array_push($visitas_realizadas, $dados);
            }
        } else if ($find == true && $serialize == "visitas") {

            $visitas_list = $this->Visitas->find('all', [
                'conditions' => [$filtro]
            ])->contain(['Usuarios', 'Observacoe', 'Pessoas', 'Pessoas.Enderecos', 'Pessoas.Contatos'])->toArray();

            if (count($visitas_list) > 0) {
                foreach ($visitas_list as $value) {
                    $value->pessoa->cpf_cnpj = $value->pessoa->masked_cpf_cnpj;
                    $value->noEdit = ['REAGENDADA', 'REVISITAR'];
                }
            }

            $visitas['visitas'] = $visitas_list;
            $visitas['count_visitas'] = count($visitas_list);

        }

        $this->set(compact(['visitas_realizadas', 'visitas']));
        $this->set('_serialize', $serialize);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user_id = $this->Auth->user('id');
        $historico_model = TableRegistry::get('historicos_visitas');
        $historico = $historico_model->newEntity();
        $historico->created = new Time();
        $historico->modified = new Time();
        $visita = $this->Visitas->newEntity();
        $visitas = [];
        $erro = false;


        if ($this->request->is('post')) {

            $this->request->data['ativo'] = true;
            $this->request->data['status'] = 'AGENDADA';
            $this->request->data['responsavel_id'] = $user_id;
            $this->request->data['vendedor_id'] = $this->request->data['usuario_id'];

            $check = $this->Visitas->checkVisitas($this->request->data); debug(count($check));

            if (count($check) == 0) {

                $visita = $this->Visitas->patchEntity($visita, $this->request->data);
                $historico = $historico_model->patchEntity($historico, $this->request->data);


                if ($this->Visitas->save($visita)) {

                    if ($historico_model->save($historico)) {

                    }

                    return $this->redirect(['action' => 'index']);

                } else {
                    $erro = true;
                }

            } else {
                $erro = true;
            }

            if ($erro) {

                $this->Flash->error(__('Não foi possível salvar os dados informados. Por favor, verifique os dados e tente novamente.'), [
                    'key' => 'visitas'
                ]);

                return $this->redirect(['action' => 'index']);

            }

        }

        if ($this->request->is(['put'])) {

        }

        $this->set(compact('visita'));
        $this->set('_serialize', ['visita']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Visita id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        //Gera as variáveis correspondente ao usuário logado.
        $historico_model = TableRegistry::get('historicos_visitas');
        $usuarios_model = TableRegistry::get('Agenda.Usuarios');
        $user_id = $this->Auth->user('id');
        $user_function = $usuarios_model->get($user_id);
        $erro = false;

        $visita = $this->Visitas->get($id, [
            'contain' => ['Observacoe']
        ]);

        if($user_function->isVendedor()) { //Verifica se o cliente logado é um vendedor.
            if ($visita->usuario_id != $user_id) { //Verifica se a 'Visita' pertence ao usuário logado.
                return $this->redirect(['action' => 'index']);
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $this->request->data['responsavel_id'] = $user_id;
            $this->request->data['status'] = strtoupper($this->request->data['status']);

            $visitas = $this->Visitas->gerarEntidades($visita, $this->request->data);


            if(count($visitas) > 0) {

                if ($this->Visitas->saveMany($visitas['visitas'])) {

                    if ($historico_model->saveMany($visitas['historicos'])) {

                    }

                    return $this->redirect(['action' => 'index']);

                } else {

                    $erro = true;

                }

            } else {

                $erro = true;

            }

            if ($erro) {
                $this->Flash->error(__('Não foi possível salvar os dados informados. Por favor, verifique os dados e tente novamente.'), [
                    'key' => 'visitas'
                ]);
            }

        }

        $visita->data = $visita->data->format('d/m/Y');

        $statusOpt = $this->Visitas->getStatusVisita($visita->status);

        $this->set(compact('visita', 'user_id', 'statusOpt'));
        $this->set('_serialize', ['visita', 'statusOpt']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Visita id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visita = $this->Visitas->get($id);
        if ($this->Visitas->delete($visita)) {
            $this->Flash->success(__('The visita has been deleted.'));
        } else {
            $this->Flash->error(__('The visita could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/

    /**
     * Pesquisa Empresa method
     *
     *
     */
    public function relatorio() {

        $pacote = [];
        $usuarios_model = TableRegistry::get('Agenda.Usuarios');
        $data_inicial = date('Y-m-01');
        $data_final = date('Y-m-t');
        $filtro = [];
        $model = $this->Visitas;
        $vendedor_id = "";

        if ($this->request->is(['post', 'put'])) {
            if ($this->request->data['usuario_id'] != "") {
                $vendedor_id = $this->request->data['usuario_id'];
                array_push($filtro, ['Visitas.usuario_id' => $vendedor_id]);
            }

            array_push($filtro, ['Visitas.data >=' => $model->converteData($this->request->data['data_inicial'])]);
            array_push($filtro, ['Visitas.data <=' => $model->converteData($this->request->data['data_final'])]);
        }


        if ($this->request->is(['put'])) { //Gerar histórico de visitas.


            array_push($filtro, ['Visitas.status' => $this->request->data['topping']]);

            $pacote = $this->Visitas->getVisitas($filtro);


        } else if ($this->request->is(['post'])) { //Relatório com filtro.

            $pacote = $this->Visitas->gerarRelatorio($filtro);

            $data_inicial = $this->request->data['data_inicial'];
            $data_final = $this->request->data['data_final'];

        } else { //Relatório sem filtro.

            array_push($filtro, ['Visitas.data >=' => $data_inicial]);
            array_push($filtro, ['Visitas.data <=' => $data_final]);

            $pacote = $this->Visitas->gerarRelatorio($filtro);

            $data_inicial = $model->converteData($data_inicial);
            $data_final = $model->converteData($data_final);
        }

        //Buscar vendedores no banco.
        $vendedores = $usuarios_model->find('all', [
            'fields' => ['id', 'display'],
            'conditions' => ['OR' => [['role' => 'ADMIN'], ['role' => 'SUPERVISOR'], ['role' => 'VENDEDOR_EXTERNO']]]
        ])->toArray();

        $this->set(compact('pacote', 'vendedores', 'data_inicial', 'data_final', 'vendedor_id'));
        $this->set('_serialize', ['pacote', 'vendedores', 'data_inicial', 'data_final', 'vendedor_id']);

    }

    /**
     * Pesquisa Empresa method
     *
     *
     */
    public function historico() {

        $pacote = $this->Visitas->gerarHistorico($this->request->data['id_empresa']);

        $this->set(compact('pacote'));
        $this->set('_serialize', ['pacote']);

    }

}
