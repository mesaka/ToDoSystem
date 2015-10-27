<?php

class CategoriesController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');

	public function index() {

		$this->set('categories',$this->Category->find('all'));

	}


	public function view($id = null) {

		if (!$id) {
    		throw new NotFoundException(__('Invalid post'));
    	}

    	$category = $this->Category->findById($id);
    	if (!$category) {
	       throw new NotFoundException(__('Invalid post'));
	    }
	    $this->set('category', $category);
	}


	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('追加されました'));
                return $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
            }
            $this->Session->setFlash(__('もう一度入力してください'));
		}
	}

	public function edit($id = null) {

		if (!$id) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

	    $category = $this->Category->findById($id);
	    if (!$category) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Category->id = $id;
	        if ($this->Category->save($this->request->data)) {
	            $this->Session->setFlash(__('編集完了'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('編集できませんでした'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $category;
	    }
	}

}