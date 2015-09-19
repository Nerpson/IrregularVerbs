<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Infinitives Controller
 *
 * @property \App\Model\Table\InfinitivesTable $Infinitives
 */
class InfinitivesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('infinitives', $this->paginate($this->Infinitives));
        $this->set('_serialize', ['infinitives']);
    }

    /**
     * View method
     *
     * @param string|null $id Infinitive id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $infinitive = $this->Infinitives->get($id, [
            'contain' => ['Sets', 'PastParticiples', 'Preterits', 'Translations']
        ]);
        $this->set('infinitive', $infinitive);
        $this->set('_serialize', ['infinitive']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $infinitive = $this->Infinitives->newEntity();
        if ($this->request->is('post')) {
            $infinitive = $this->Infinitives->patchEntity($infinitive, $this->request->data);
            if ($this->Infinitives->save($infinitive)) {
                $this->Flash->success(__('The infinitive has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The infinitive could not be saved. Please, try again.'));
            }
        }
        $sets = $this->Infinitives->Sets->find('list', ['limit' => 200]);
        $this->set(compact('infinitive', 'sets'));
        $this->set('_serialize', ['infinitive']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Infinitive id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $infinitive = $this->Infinitives->get($id, [
            'contain' => ['Sets']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $infinitive = $this->Infinitives->patchEntity($infinitive, $this->request->data);
            if ($this->Infinitives->save($infinitive)) {
                $this->Flash->success(__('The infinitive has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The infinitive could not be saved. Please, try again.'));
            }
        }
        $sets = $this->Infinitives->Sets->find('list', ['limit' => 200]);
        $this->set(compact('infinitive', 'sets'));
        $this->set('_serialize', ['infinitive']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Infinitive id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $infinitive = $this->Infinitives->get($id);
        if ($this->Infinitives->delete($infinitive)) {
            $this->Flash->success(__('The infinitive has been deleted.'));
        } else {
            $this->Flash->error(__('The infinitive could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
