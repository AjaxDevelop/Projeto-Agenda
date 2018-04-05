<?php
namespace Agenda\Controller;

use Agenda\Controller\AppController;

/**
 * Observacoes Controller
 *
 * @property \Agenda\Model\Table\ObservacoesTable $Observacoes
 */
class ObservacoesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendas', 'Visitas', 'Usuarios']
        ];
        $observacoes = $this->paginate($this->Observacoes);

        $this->set(compact('observacoes'));
        $this->set('_serialize', ['observacoes']);
    }

    /**
     * View method
     *
     * @param string|null $id Observaco id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $observaco = $this->Observacoes->get($id, [
            'contain' => ['Vendas', 'Visitas', 'Usuarios']
        ]);

        $this->set('observaco', $observaco);
        $this->set('_serialize', ['observaco']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $observaco = $this->Observacoes->newEntity();
        if ($this->request->is('post')) {
            $observaco = $this->Observacoes->patchEntity($observaco, $this->request->getData());
            if ($this->Observacoes->save($observaco)) {
                $this->Flash->success(__('The observaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The observaco could not be saved. Please, try again.'));
        }
        $vendas = $this->Observacoes->Vendas->find('list', ['limit' => 200]);
        $visitas = $this->Observacoes->Visitas->find('list', ['limit' => 200]);
        $usuarios = $this->Observacoes->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('observaco', 'vendas', 'visitas', 'usuarios'));
        $this->set('_serialize', ['observaco']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Observaco id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $observaco = $this->Observacoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $observaco = $this->Observacoes->patchEntity($observaco, $this->request->getData());
            if ($this->Observacoes->save($observaco)) {
                $this->Flash->success(__('The observaco has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The observaco could not be saved. Please, try again.'));
        }
        $vendas = $this->Observacoes->Vendas->find('list', ['limit' => 200]);
        $visitas = $this->Observacoes->Visitas->find('list', ['limit' => 200]);
        $usuarios = $this->Observacoes->Usuarios->find('list', ['limit' => 200]);
        $this->set(compact('observaco', 'vendas', 'visitas', 'usuarios'));
        $this->set('_serialize', ['observaco']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Observaco id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $observaco = $this->Observacoes->get($id);
        if ($this->Observacoes->delete($observaco)) {
            $this->Flash->success(__('The observaco has been deleted.'));
        } else {
            $this->Flash->error(__('The observaco could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
