<?php

class GroupsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Group', 'Task', 'User', 'GroupsTask', 'GroupsUser');
    public $scaffold;


	public function beforeFilter() {
        parent::beforeFilter();

        if (isset($this->params['pass'][0])) {
            $this->group_id = $this->params['pass'][0];
            $this->set('group_id', $this->group_id);
        }

        $this->userSession = $this->Auth->user();

        if (isset($this->userSession) && isset($this->group_id)) {
            $groups_user = $this->GroupsUser->find('first', array('conditions' => array('GroupsUser.group_id' => $this->group_id, 'GroupsUser.user_id' => $this->userSession['id'])));
            $this->authority = $groups_user['GroupsUser']['authority'];
            $this->set('auth_authority', $this->authority);
        }
    }


    public function index() {
        $user_id = $this->userSession['id'];
        $group_id = $this->GroupsUser->find('all', array('fields' => 'group_id', 'conditions' => array('GroupsUser.user_id' => $user_id)));
        $tmp_group_id = Hash::extract($group_id, '{n}.GroupsUser.group_id');

    	$groups = $this->Group->find('all', array('conditions' => array('Group.id' => $tmp_group_id, 'Group.deleted_date' => null)));
        $tasks = $this->Task->find('all', array('conditions' => array('Task.deleted_date' => null)));
        $this->set(compact('groups', 'tasks'));
    }


    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $group = $this->Group->findById($id);
        $this->set('group', $group);
        if (!$group) {
            throw new NotFoundException(__('Invalid post'));
        }
    }


    public function add() {
    	if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->saveAll($this->request->data)) {
                // 中間テーブルへgroupのIDとuserのIDを保存する
                $this->GroupsUser->create();
                $last_group_id = $this->Group->getLastInsertID();
                $user_id = $this->request->data['Group']['user_id'];
                $this->request->data['GroupsUser']['group_id'] = $last_group_id;
                $this->request->data['GroupsUser']['user_id'] = $user_id;
                $this->request->data['GroupsUser']['authority'] = 3;
                $this->GroupsUser->save($this->request->data);

                $this->Session->setFlash(__('登録完了'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
            }
        }
    }


    public function member_set() {
        if ($this->request->is(array('post', 'put'))) {
            $id = $this->request->data['GroupsUser']['id'];
            // メンバー追加
            if (isset($this->request->data['member_add'])) {
                $this->GroupsUser->create();
                if ($this->GroupsUser->save($this->request->data)) {
                    $this->Session->setFlash(__('追加完了'));
                    $this->redirect(array('action' => 'member_set', $this->group_id));
                } else {
                    $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
                }
            }
            // 権限変更
            elseif (isset($this->request->data['ch_member_set'. $id])) {
                $this->GroupsUser->id = $id;
                if ($this->GroupsUser->save($this->request->data)) {
                    $this->Session->setFlash(__('変更完了'));
                    return $this->redirect(array('action' => 'member_set', $this->group_id));
                }
                $this->Session->setFlash(__('変更できませんでした'));
            }
        }

        $group = $this->Group->findById($this->group_id);
        if (!$group) {
            throw new NotFoundException(__('Invalid post'));
        }

        $users = $this->User->find('list', array('fields' => array('User.id', 'User.username')));
        $this->set(compact('group', 'users'));
    }



    public function edit($id = null) {
        if ($this->authority  ===  '0' || $this->authority  ===  '1') {
            $this->Session->setFlash(__('このグループを設定できる権限がありません'));
            return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
        }
        if (!$id) {
            throw new NotFoundException(__('エラーが起きました'));
        }
        $group = $this->Group->findById($id);
        if (!$group) {
            throw new NotFoundException(__('エラーが起きました'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Group->id = $id;
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('編集完了'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('編集できませんでした'));
        }

        if (!$this->request->data) {
            $this->request->data = $group;
        }

        $user_id = $this->GroupsUser->find('all', array('fields' => 'GroupsUser.user_id', 'conditions' => array('GroupsUser.group_id' => $this->group_id)));
        $tmp_user_id = Hash::extract($user_id, '{n}.GroupsUser.user_id');
        $users = $this->User->find('all', array('conditions' => array('User.id' => $tmp_user_id)));
        $this->set(compact('group', 'users'));
    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Group->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('Group.id' => $id))) {
            $this->GroupsUser->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('GroupsUser.group_id' => $id));
            $this->GroupsTask->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('GroupsTask.group_id' => $id));
            $this->Session->setFlash(__('削除しました', h($id)));
        } else {
            $this->Session->setFlash(__('削除できませんでした', h($id)));
        }

        return $this->redirect(array('action' => 'index'));
    }
}