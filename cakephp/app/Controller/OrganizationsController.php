<?php

class OrganizationsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Group', 'Organization');


    public function beforeFilter(){
    	// 権限の判定
        $authority = $_SESSION['Auth']['User']['authority'];
        if ($authority == 9){
            // 権限あり
            $this->Auth->allow('index');
         } else {
              //権限なし
             $this->redirect('/tasks/index');
         }
    }


	public function index() {

		$this->set('organizations',$this->Organization->find('all'));

	}


	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $organization = $this->Organization->findById($id);
        if (!$organization) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('organization', $organization);
    }


	public function add() {
		if ($this->request->is('post')) {
			$this->Organization->create();

			if ($this->Organization->save($this->request->data)) {
                $this->Session->setFlash(__('追加されました'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('もう一度入力してください'));
		}
	}

	public function edit($id = null) {

		if (!$id) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

	    $organization = $this->Organization->findById($id);
	    if (!$organization) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Organization->id = $id;
	        if ($this->Organization->save($this->request->data)) {
	            $this->Session->setFlash(__('編集完了'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('編集できませんでした'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $organization;
	    }

	    $this->set('groups', $this->Group->find('list'));
	}


	public function delete($id) {

	    if ($this->request->is('get')) {
        	throw new MethodNotAllowedException();
	    }

	    if ($this->Organization->delete($id)) {

	        $this->Session->setFlash(
	            __('The post with id: %s has been deleted.', h($id))
	        );
	    } else {
	        $this->Session->setFlash(
	            __('The post with id: %s could not be deleted.', h($id))
	        );
	    }

	    return $this->redirect(array('action' => 'index'));
	}

}