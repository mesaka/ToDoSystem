<?php

class UsersController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $uses = array('Task', 'Category', 'User', 'Organization', 'Group', 'GroupsUser');
    public $scaffold;


    public function beforeFilter() {
        // ログイン中のユーザー名
        $user = $this->Auth->user();
        if (is_null($user)) {
           $this->name = 'Guest';
        } else {
           $this->name = $_SESSION['Auth']['User']['username'];
        }
        //ログイン認証していなくても入れるページ
        $this->Auth->allow('login', 'add', 'send_comp', 'add_comp');

        $this->checkId = $this->Auth->user('id');
        $this->checkAuthority = $this->Auth->user('authority');
        $this->checkOrganization = $this->Auth->user('organization_id');
        

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


    public function add_comp($user_id = null, $in_hash = null) {
        // UserモデルにIDをセット
        $this->User->id = $user_id;
        if ($this->User->exists() && $in_hash == $this->User->getActivationHash()) {
        // 本登録に有効なURL
            // statusフィールドを更新
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
        //ログインしているユーザーは自分が属している組織のユーザーページしか見れない
        if ($this->checkOrganization !== $user['Organization']['id'] && $this->checkAuthority != 9) {
            throw new NotFoundException(__('権限が与えられていません'));
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

        $this->set('organizations', $this->Organization->find('list'));
        $this->set('groups', $this->Group->find('list'));
        $this->set('user', $user);
    }



    public function login() {
    	if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('id')) {
                    $userId = $this->Auth->user('id');
                    // 本登録が完了しているか確認する
                    $userAuthority = $this->Auth->user('authority');
                    $this->User->checkFirstLogin($userId,$userAuthority);
                    //最終ログイン日時を更新
                    $this->User->updateLastLogin($userId);

                    $this->Session->setFlash(__('ログイン成功'));
                    $this->redirect($this->Auth->redirect(array(
                        'controller' => 'tasks', 'action' => 'index')));
                    } else {
                    //ログイン失敗
                    $this->Session->setFlash(__('入力内容をもう一度ご確認ください'));
                }
            }  
    	}
    }


    public function logout() {
        $this->Session->destroy();
        $this->Session->setFlash(__('ログアウト完了'));
        $this->redirect($this->Auth->logout());
    }



    // マイページ
    public function mypage() {
        $login_id = $this->checkId = $this->Auth->user('id');

        $this->set('tasks',$this->Task->find('all', array('conditions' => array('Task.user_id' => $login_id))));
        $this->set('categories', $this->Category->find('all'));
        
    }


    public function my_organization() {
        // ログインユーザーと同じ組織に属しているTaskだけを取得する
        $user_organize = $this->checkOrganization;
        $this->set('tasks',$this->Task->find('all', array('conditions' => array('and' => 
                                                                            array(
                                                                                'Task.organization_id' => $user_organize,
                                                                                'Task.public_private' => 0,
                                                                            )))));

        $this->set('categories', $this->Category->find('all'));
    }



    // 管理者ページ
    public function admin() {
        if ($this->checkAuthority < 3) {
            throw new NotFoundException(__('権限が与えられていません'));
        }

        $this->set('users',$this->User->find('all'));
        $this->set('organizations', $this->Organization->find('list'));
        $this->set('groups', $this->Group->find('list'));
    }

    // システム管理者ページ
    public function system_admin() {

        if ($this->checkAuthority < 9) {
            throw new NotFoundException(__('権限が与えられていません'));
        }

        $this->set('users',$this->User->find('all'));
        $this->set('organizations', $this->Organization->find('list'));
        $this->set('groups', $this->Group->find('list'));
    }


    public function tasks_admin() {
        $this->set('tasks',$this->Task->find('all'));
        $this->set('categories', $this->Category->find('all'));
    }



    public function users_admin() {
        $this->set('users',$this->User->find('all'));
        $this->set('organizations', $this->Organization->find('list'));
        $this->set('groups', $this->Group->find('list'));
    }



    public function edit_admin($id = null) {
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
                return $this->redirect(array('action' => 'users_admin'));
            }
            $this->Session->setFlash(__('編集できませんでした'));
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }

        $this->set('organizations', $this->Organization->find('list'));
        $this->set('groups', $this->Group->find('list'));
    }

}