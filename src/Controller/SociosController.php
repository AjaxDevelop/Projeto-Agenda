<?php
namespace Agenda\Controller;

use Agenda\Controller\AppController;

/**
 * Socios Controller
 *
 * @property \Agenda\Model\Table\SociosTable $Socios
 */
class SociosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Empresas', 'Pessoas']
        ];
        $socios = $this->paginate($this->Socios);

        $this->set(compact('socios'));
        $this->set('_serialize', ['socios']);
    }

    /**
     * View method
     *
     * @param string|null $id Socio id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $socio = $this->Socios->get($id, [
            'contain' => ['Pessoas']
        ])->toArray(); debug($socio);

        $this->set('socio', $socio);
        $this->set('_serialize', ['socio']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $socio = $this->Socios->newEntity();
        if ($this->request->is('post')) {
            $socio = $this->Socios->patchEntity($socio, $this->request->data);
            if ($this->Socios->save($socio)) {
                $this->Flash->success(__('The socio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The socio could not be saved. Please, try again.'));
        }
        $empresas = $this->Socios->Empresas->find('list', ['limit' => 200]);
        $pessoas = $this->Socios->Pessoas->find('list', ['limit' => 200]);
        $this->set(compact('socio', 'empresas', 'pessoas'));
        $this->set('_serialize', ['socio']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Socio id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $socio = $this->Socios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $socio = $this->Socios->patchEntity($socio, $this->request->data);
            if ($this->Socios->save($socio)) {
                $this->Flash->success(__('The socio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The socio could not be saved. Please, try again.'));
        }
        $empresas = $this->Socios->Empresas->find('list', ['limit' => 200]);
        $pessoas = $this->Socios->Pessoas->find('list', ['limit' => 200]);
        $this->set(compact('socio', 'empresas', 'pessoas'));
        $this->set('_serialize', ['socio']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Socio id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $socio = $this->Socios->get($id);
        if ($this->Socios->delete($socio)) {
            $this->Flash->success(__('The socio has been deleted.'));
        } else {
            $this->Flash->error(__('The socio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
