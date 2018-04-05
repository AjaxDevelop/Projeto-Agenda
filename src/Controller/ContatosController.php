<?php
namespace Agenda\Controller;

use Agenda\Controller\AppController;

/**
 * Contatos Controller
 *
 * @property \Agenda\Model\Table\ContatosTable $Contatos
 */
class ContatosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Vendas', 'Pessoas']
        ];
        $contatos = $this->paginate($this->Contatos);

        $this->set(compact('contatos'));
        $this->set('_serialize', ['contatos']);
    }

    /**
     * View method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contato = $this->Contatos->get($id, [
            'contain' => ['Vendas', 'Pessoas']
        ]);

        $this->set('contato', $contato);
        $this->set('_serialize', ['contato']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contato = $this->Contatos->newEntity();
        if ($this->request->is('post')) {
            $contato = $this->Contatos->patchEntity($contato, $this->request->getData());
            if ($this->Contatos->save($contato)) {
                $this->Flash->success(__('The contato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contato could not be saved. Please, try again.'));
        }
        $vendas = $this->Contatos->Vendas->find('list', ['limit' => 200]);
        $pessoas = $this->Contatos->Pessoas->find('list', ['limit' => 200]);
        $this->set(compact('contato', 'vendas', 'pessoas'));
        $this->set('_serialize', ['contato']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contato = $this->Contatos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contato = $this->Contatos->patchEntity($contato, $this->request->getData());
            if ($this->Contatos->save($contato)) {
                $this->Flash->success(__('The contato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contato could not be saved. Please, try again.'));
        }
        $vendas = $this->Contatos->Vendas->find('list', ['limit' => 200]);
        $pessoas = $this->Contatos->Pessoas->find('list', ['limit' => 200]);
        $this->set(compact('contato', 'vendas', 'pessoas'));
        $this->set('_serialize', ['contato']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contato id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contato = $this->Contatos->get($id);
        if ($this->Contatos->delete($contato)) {
            $this->Flash->success(__('The contato has been deleted.'));
        } else {
            $this->Flash->error(__('The contato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
