<?php

class GroupsController extends AppController {

	public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Group', 'Organization', 'User', 'GroupsUser');
    public $scaffold;


	public function beforeFilter() {
        $this->checkAuthority = $this->Auth->user('authority');
        $this->checkOrganization = $this->Auth->user('organization_id');
    }


    public function index() {
        if ($this->checkAuthority < 2) {
            throw new NotFoundException(__('権限が与えられていません'));
        }

    	$this->set('groups', $this->Group->find('all'))
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
        //ログインしているユーザーは自分が属している組織のグループページしか見れない
        if ($this->checkOrganization !== $group['Organization']['id'] && $this->checkAuthority != 9) {
            throw new NotFoundException(__('権限が与えられていません'));
        }

        // グループと同じ組織に属しているユーザーデータを取ってくる
        $organization = $group['Organization']['id'];
        $this->set('users', $this->User->find('all', array('conditions' => array('User.organization_id' => $organization))));

    }


    public function add() {
        if ($this->checkAuthority < 2) {
            throw new NotFoundException(__('権限が与えられていません'));
        }

    	if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->saveAll($this->request->data)) {
                $this->Session->setFlash(__('登録完了'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
            }
        }

        // ログインしているユーザーの所属している組織ID
        $userId = $this->Auth->user('organization_id');
        //ログインしているユーザーと同じ組織に属しているメンバーを一覧で表示させる
        $this->set('users', $this->User->find('all', array('conditions' => array('User.organization_id' => $userId))));
        $this->set('organizations', $this->Organization->find('list'));
    }


    public function member_add($id = null) {
        if ($this->request->is('post')) {
            $this->GroupsUser->create();

            if ($this->GroupsUser->save($this->request->data)) {
                $this->Session->setFlash(__('登録完了'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
            }
        }
        $group = $this->Group->findById($id);
        if (!$group) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('group', $group);


        // ログインしているユーザーの所属している組織ID
        $userId = $this->Auth->user('organization_id');
        //ログインしているユーザーと同じ組織に属しているメンバーを一覧で表示させる。
        $this->set('users', $this->User->find('list', array(
                                                'fields' => array('User.id', 'User.username'),   //取得したいカラムを指定(valueにあたるカラム,keyにあたるカラム)
                                                'conditions' => array('User.organization_id' => $userId))));

    }



    public function edit($id = null) {
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

        $this->set('organizations', $this->Organization->find('list'));

    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Group->delete($id)) {
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