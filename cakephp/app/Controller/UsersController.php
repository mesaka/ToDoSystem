<?php

class UsersController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Task', 'User', 'Group', 'GroupsUser');
    public $scaffold;

    public function beforeFilter() {
        $this->Auth->allow('login', 'add', 'send_comp', 'add_comp');
    }


    public function index() {

    }


    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $to = $this->request->data['User']['email'];

            if ($this->User->save($this->request->data)) {
                // ユーザアクティベート(本登録)用URLの作成
                $url = 
                    DS . 'users' .          // コントローラ
                    DS . 'add_comp' .                       // アクション
                    DS . $this->User->id .                  // ユーザID
                    DS . $this->User->getActivationHash();  // ハッシュ値
                $url = Router::url($url, true);  // ドメイン(+サブディレクトリ)を付与

                $email = new CakeEmail('mail');
                $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より')); 
                $email->to($to); // 送信先
                $email->subject('仮登録完了のお知らせ'); // メールタイトル
                $email->send($url);

                $this->Session->setFlash(__('仮登録完了'));
                $this->redirect(array('action' => 'send_comp'));
            } else {
                $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
            }
        }

        $this->set('groups', $this->Group->find('list'));

    }


    public function send_comp() {

    }

    // 本登録完了
    public function add_comp($user_id = null, $in_hash = null) {
        // UserモデルにIDをセット
        $this->User->id = $user_id;
        if ($this->User->exists() && $in_hash == $this->User->getActivationHash()) {
        // 本登録に有効なURL
            // statusフィールドを0に更新
            $this->User->saveField('authority', 1);
            $this->Session->setFlash('本登録完了');
        }else{
        // 本登録に無効なURL
            $this->Session->setFlash('無効なURLです');
        }

    }


    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('エラーが起きました'));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('エラーが起きました'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('編集完了'));
                return $this->redirect(array('action' => 'admin'));
            }
            $this->Session->setFlash(__('編集できませんでした'));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }

        $this->set('groups', $this->Group->find('list'));
        $this->set('user', $user);
    }



    public function login() {
    	if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('id')) {
                    $userId = $this->Auth->user('id');
                    // 本登録が完了しているか確認する
                    $userEntry = $this->Auth->user('entry');
                    $this->User->checkFirstLogin($userId,$userEntry);
                    //最終ログイン日時を更新
                    $this->User->updateLastLogin($userId);

                    $this->Session->setFlash(__('ログイン完了'));
                    $this->redirect($this->Auth->redirect(array(
                        'controller' => 'groups', 'action' => 'index')));
                } 
            } else {
                $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
            }
    	}
    }


    public function logout() {
        $this->Session->destroy();
        $this->Session->setFlash(__('ログアウト完了'));
        $this->redirect($this->Auth->logout());
    }


    public function delete($id) {
         if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->User->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('User.id' => $id))) {
            $this->Group->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('Group.user_id' => $id));
            $this->Task->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('Task.user_id' => $id));
            $this->GroupsUser->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('GroupsUser.user_id' => $id));
            $this->Session->setFlash(__('退会しました', h($id)));
        } else {
            $this->Session->setFlash(__('退会できませんでした', h($id)));
        }

        return $this->redirect(array('action' => 'login'));
    }

}