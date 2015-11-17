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

	public function delete($group_id, $user_id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $id = $this->GroupsUser->find('first', array('fields' => 'GroupsUser.id', 'conditions' => array('GroupsUser.group_id' => $group_id, 'GroupsUser.user_id' => $user_id)));
        $tmp_id = Hash::get($id, 'GroupsUser.id');

        if ($this->GroupsUser->delete($tmp_id)) {
            $this->Session->setFlash(
                __('削除されました', h($tmp_id))
            );
        } else {
            $this->Session->setFlash(
                __('削除できませんでした', h($tmp_id))
            );
        }
        return $this->redirect(array('controller' => 'groups', 'action' => 'member_set', $group_id));
    }

}