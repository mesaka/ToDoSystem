<?php

class GroupsUsersController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
	public $uses = array('Group', 'Organization', 'User', 'GroupsUser');
	public $scaffold;



	public function add() {
		if ($this->request->is('post')) {
			$this->GroupsUser->create();

			if ($this->GroupsUser->save($this->request->data)) {
                $this->Session->setFlash(__('追加されました'));
                return $this->redirect(array('controller'=>'groups', 'action' => 'index'));
            }
            $this->Session->setFlash(__('もう一度入力してください'));

		}
	}

}