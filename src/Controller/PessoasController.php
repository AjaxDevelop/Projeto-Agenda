<?php
namespace Agenda\Controller;

use Agenda\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Pessoas Controller
 *
 * @property \Agenda\Model\Table\PessoasTable $Pessoas
 */
class PessoasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        //Variáveis
        $filtro = ['Pessoas.plugin' => true, 'Pessoas.tipo' => 'PJ'];
        $filtro_view = ['nome' => '', 'cnpj' => ''];

        if ($this->request->is(['post'])) {

            if (isset($this->request->data['cpf_cnpj']) && !empty($this->request->data['cpf_cnpj'])) {

                $filtro_view['cnpj'] = $this->request->data['cpf_cnpj'];

            }

            if (isset($this->request->data['nome']) && !empty($this->request->data['nome'])) {

                $filtro_view['nome'] = $this->request->data['nome'];

            }

        }

        if ($this->request->is(['get'])) {

            if (isset($this->request->query['cpf_cnpj']) && !empty($this->request->query['cpf_cnpj'])) {

                $filtro_view['cnpj'] = $this->request->query['cpf_cnpj'];

            }

            if (isset($this->request->query['nome']) && !empty($this->request->query['nome'])) {

                $filtro_view['nome'] = $this->request->query['nome'];

            }

        }

        if (isset($filtro_view['cnpj']) && !empty($filtro_view['cnpj'])) {
            $cpf_cnpj = $filtro_view['cnpj'];
            $cpf_cnpj = $this->Pessoas->removerCaracteres($cpf_cnpj);
            $cpf_cnpj = $this->Pessoas->padronizarCpfCnpf($cpf_cnpj);

            array_push($filtro, ['Pessoas.cpf_cnpj' => $cpf_cnpj]);

        } else if (isset($filtro_view['nome']) && !empty($filtro_view['nome'])) {
            $nome = $filtro_view['nome'];

            array_push($filtro, ['Pessoas.nome LIKE' => '%'.$nome.'%']);
        }


        $pessoas_find = $this->Pessoas->find('all', [
            'conditions' => [$filtro]
        ]);

        $pessoas = $this->paginate($pessoas_find, ['limit' => 10, 'contain' => ['Contatos']]);

        $this->set(compact('pessoas', 'filtro_view'));
        $this->set('_serialize', ['pessoas', 'filtro_view']);
    }

    /**
     * View method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pessoas = [
            'empresa' => [],
            'socios' => [],
            'contem_socios' => false,
        ];

        $pessoas_list = $this->Pessoas->find('all', [
            'conditions'=>['Pessoas.id' => $this->request->data['id']]
        ]);

        $pessoas_list = $pessoas_list->contain(['Enderecos', 'Contatos', 'Observacoe', 'Socios'])->first();

        $socios = $this->Pessoas->getSocios($pessoas_list->socios);

        if (count($socios > 0)) {
            $pessoas['contem_socios'] = true;
        }

        $pessoas['empresa'] = $pessoas_list;
        $pessoas['socios'] = $socios;

        $this->set(compact(['pessoas']));
        $this->set('_serialize', ['pessoas']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //Registrar pessoa.
        if ($this->request->is('post')) {

            $acesso = false;

            //Padroniza os dados da Empresa.
            $this->request->data['cpf_cnpj'] = $this->Pessoas->removerCaracteres($this->request->data['cpf_cnpj']);
            $this->request->data['cpf_cnpj'] = $this->Pessoas->padronizarCpfCnpf($this->request->data['cpf_cnpj']);
            $this->request->data['plugin'] = true;
            $this->request->data['tipo'] = "PJ";

            //Verifica se a empresa já esta cadastrada no banco de dados.
            $resposta = $this->Pessoas->getPessoa(['Pessoas.cpf_cnpj' => $this->request->data['cpf_cnpj']]);


            //Verifica o acesso para salvar os dados da empresa.
            if (count($resposta) == 0) {

               $acesso = true;

            }

            if ($acesso && isset($this->request->data['socio']) && !empty($this->request->data['socio'])) {

                $socios = $this->request->data['socio'];

                //Padroniza os dados do(s) sócio(s).
                foreach ($socios as $key => $socio) {

                    $socios[$key]['cpf_cnpj'] = $this->Pessoas->removerCaracteres($socios[$key]['cpf_cnpj']);
                    $socios[$key]['cpf_cnpj'] = $this->Pessoas->padronizarCpfCnpf($socios[$key]['cpf_cnpj']);
                    $socios[$key]['plugin'] = true;
                    $socios[$key]['tipo'] = "PF";

                }

                //Gera as entidades correspondentes.
                $socios = $this->Pessoas->gerarEntidades($socios);

                //Salvar entidades
                if ($this->Pessoas->saveMany($socios)) {

                    $this->request->data['socios'] =  [];

                    foreach ($socios as $socio) {

                        array_push($this->request->data['socios'], ['pessoa_id' => $socio->id]);

                    }

                }  else {

                    $this->Flash->error(__('Não foi possível salvar os dados informados. Por favor, verifique os dados e tente novamente.'), [
                        'key' => 'pessoas'
                    ]);

                }

            }

            $pessoa = $this->Pessoas->newEntity();
            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->data);

            if ($acesso && $this->Pessoas->save($pessoa)) {

                return $this->redirect(['action' => 'index']);

            } else {

                $this->Flash->error(__('Não foi possível salvar os dados informados. Por favor, verifique os dados e tente novamente.'), [
                    'key' => 'pessoas'
                ]);

            }

        }

        $this->set(compact('pessoa', 'resposta'));
        $this->set('_serialize', ['pessoa', 'resposta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        //Variáveis
        $editar = false;
        $resposta = false;
        $socios = [];
        $socios_model = TableRegistry::get('Socios');

        $pessoa = $this->Pessoas->find('all', [
            'conditions' => ['Pessoas.id' => $id]
        ]);

        $pessoa = $pessoa->contain(['Enderecos', 'Contatos', 'Observacoe', 'Socios'])->first();
        $socios_etity = $pessoa->socios;
        $socios = $this->Pessoas->getSocios($pessoa->socios);



        if ($this->request->is('put')) {

            $socios_ids = [];

            if (count($socios) > 0) {

                foreach ($socios_etity as $value) {
                    array_push($socios_ids, $value->id);
                }

            }

            $acesso = false;

            //Padroniza os dados da Empresa.
            $this->request->data['cpf_cnpj'] = $this->Pessoas->removerCaracteres($this->request->data['cpf_cnpj']);
            $this->request->data['cpf_cnpj'] = $this->Pessoas->padronizarCpfCnpf($this->request->data['cpf_cnpj']);
            $this->request->data['plugin'] = true;
            $this->request->data['tipo'] = "PJ";

            //Verifica se a empresa já esta cadastrada no banco de dados.
            $resposta = $this->Pessoas->getPessoa(['Pessoas.cpf_cnpj' => $this->request->data['cpf_cnpj'], 'Pessoas.id' => $id]);


            //Verifica o acesso para salvar os dados da empresa.
            if (count($resposta) > 0) {

                $acesso = true;

            }

            if ($acesso && isset($this->request->data['socio']) && !empty($this->request->data['socio'])) {

                $socios = $this->request->data['socio'];

                //Padroniza os dados do(s) sócio(s).
                foreach ($socios as $key => $socio) {

                    $socios[$key]['cpf_cnpj'] = $this->Pessoas->removerCaracteres($socios[$key]['cpf_cnpj']);
                    $socios[$key]['cpf_cnpj'] = $this->Pessoas->padronizarCpfCnpf($socios[$key]['cpf_cnpj']);
                    $socios[$key]['plugin'] = true;
                    $socios[$key]['tipo'] = "PF";

                }

                //Gera as entidades correspondentes.
                $socios = $this->Pessoas->gerarEntidades($socios);

                //Salvar entidades
                if ($this->Pessoas->saveMany($socios)) {

                    $this->request->data['socios'] =  [];

                    foreach ($socios as $socio) {

                        array_push($this->request->data['socios'], ['pessoa_id' => $socio->id]);

                    }

                }  else {

                    $this->Flash->error(__('Não foi possível salvar os dados informados. Por favor, verifique os dados e tente novamente.'), [
                        'key' => 'pessoas'
                    ]);

                }

            }

            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->data);

            if ($acesso && $this->Pessoas->save($pessoa)) {

                if (count($socios_ids) > 0) {

                    foreach ($socios_ids as $key => $value) {
                        $socios_model->deleteAll(['id' => $value]);
                    }

                }

                return $this->redirect(['action' => 'index']);

            } else {

                $this->Flash->error(__('Não foi possível salvar os dados informados. Por favor, verifique os dados e tente novamente.'), [
                    'key' => 'pessoas'
                ]);

            }

        }

        $this->set(compact('pessoa', 'socios'));
        $this->set('_serialize', ['pessoa', 'socios']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pessoa = $this->Pessoas->get($id);
        if ($this->Pessoas->delete($pessoa)) {
            $this->Flash->success(__('The pessoa has been deleted.'));
        } else {
            $this->Flash->error(__('The pessoa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }*/

    /**
     * Pesquisa method
     *
     *
     */
    public function pesquisa() {

        if ($this->request->is('put')) {
        //VARIÁVEIS
            //$nome = $this->Pessoas->removerCaracteres($this->request->data['nome']);
            $cpf_cnpj = $this->Pessoas->removerCaracteres($this->request->data['cpf_cnpj']);
            $cpf_cnpj = $this->Pessoas->padronizarCpfCnpf($cpf_cnpj);
            $find = false;
            $pessoas = [];
        ////

        //FILTRO DE PESSOA JURÍDICA
            if (strtolower($this->request->data['requisicao']) == "empresa") {
                //Filtro
                $filtro = [
                    'Pessoas.cpf_cnpj' => $cpf_cnpj
                ];

                $find = true;
            }
        ////

        //FILTRO DE PESSOA FÍSICA
            if (strtolower($this->request->data['requisicao']) == "socio") {
                //Filtro
                $filtro = [
                    'Pessoas.cpf_cnpj' => $cpf_cnpj
                ];

                $find = true;
            }
        ////

        //PESQUISAR PESSOA
            if ($find == true) {
                $pessoas = $this->Pessoas->getPessoa($filtro);
            }
        ////


        //RESPONDER REQUISIÇÃO.
            $this->set(compact('pessoas'));
            $this->set('_serialize', ['pessoas']);
        ////
       }

    }

    /**
     * Pesquisa Empresa method
     *
     *
     */
    public function pesquisaEmpresa() {

        $nome = $this->Pessoas->removerCaracteres($this->request->data['nome']);

        $pessoas = $this->Pessoas->getPessoa(['Pessoas.nome LIKE' => '%'.$nome.'%', 'Pessoas.tipo' => 'PJ', 'Pessoas.plugin' => true]);

        $this->set(compact('pessoas'));
        $this->set('_serialize', ['pessoas']);
    }

}
