<?php

class TasksController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Markdown.Markdown',);
	public $components = array('Session', 'Paginator');
	public $uses = array('Task', 'User', 'Group', 'GroupsTask', 'GroupsUser');


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

    // メール送信処理
    public function _sendMail($to, $subject, $message) {
        $email = new CakeEmail('mail');
        $email->from(array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
        $email->to($to);
        $email->subject($subject);
        $email->send($message);
    }

    // グループ名を取得
    public function _groupName($group_id) {
        $group = $this->Group->findById($group_id);
        $group_name = $group['Group']['name'];
        return $group_name;
    }



	public function index() {
        $login_id = $this->Auth->user('id');
        $groups_user = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $login_id)));
        $result = Hash::extract($groups_user, '{n}.GroupsUser.group_id'); 

		$tasks = $this->Task->find('all', array('conditions' => array('and' => 
                                                                            array(
                                                                                'Task.public_private' => 0,
                                                                            ))));
        $this->set('tasks', $this->Paginator->paginate());
	}


	public function view($group_id = null, $task_id = null) {
        if (!$task_id) {
            throw new NotFoundException(__('Invalid post'));
        }
        $task = $this->Task->findById($task_id);
        if (!$task) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is('post')) {
            $this->GroupsTask->create();
            $this->request->data['GroupsTask']['task_id'] = $task_id;
            if ($this->GroupsTask->save($this->request->data)) {
                $this->Session->setFlash(__('共有しました'));
                return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
            }
            $this->Session->setFlash(__('もう一度入力してください'));
        }

        $group_ids = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $this->userSession['id'])));
        $tmp_group_ids = Hash::extract($group_ids, '{n}.Group.id');
        $groups = $this->Group->find('list', array('conditions' => array('Group.id' => $tmp_group_ids, 'Group.deleted_date' => null)));
        $this->set(compact('task', 'groups'));
    }


	public function add() {
        if ($this->authority  ===  '0' || $this->authority  ===  '1') {
            $this->Session->setFlash(__('このグループにタスクを追加できる権限がありません'));
            return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
        }

		if ($this->request->is('post')) {
			$this->Task->create();
			$this->request->data['Task']['user_id'] = $this->Auth->user('id');
			if ($this->Task->save($this->request->data)) {

                // 中間テーブルにタスクを保存
                $this->GroupsTask->create();
                $last_task_id = $this->Task->getLastInsertID();
                $group_id = $this->group_id;
                $this->request->data['GroupsTask']['task_id'] = $last_task_id;
                $this->request->data['GroupsTask']['group_id'] = $group_id;
                $this->GroupsTask->save($this->request->data);

                // グループのメンバーに報告メールを送信
                $group_users = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.group_id' => $this->group_id)));
                foreach ($group_users as $group_user) {
                    if ($group_user['GroupsUser']['report'] === '1') {
                        $user = $this->User->findById($group_user['GroupsUser']['user_id']);
                        $email = $user['User']['email']; // 送信先
                        $subject = "タスク追加のお知らせ"; // 件名
                        $message = $this->_groupName($this->group_id)." にタスクが追加されました"; // 内容

                        $this->_sendMail($email, $subject, $message);
                    }
                }

                $this->Session->setFlash(__('追加されました'));
                return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
            }

            $this->Session->setFlash(__('もう一度入力してください'));
		}
	}


	public function edit($group_id = null, $task_id = null) {
		if (!$task_id) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }
	    $task = $this->Task->findById($task_id);
        $this->set('task', $task);
	    if (!$task) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

        $task_title = $task['Task']['title'];

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Task->id = $task_id;
	        if ($this->Task->save($this->request->data)) {
                // グループのメンバーに報告メールを送信
                $group_users = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.group_id' => $this->group_id)));
                foreach ($group_users as $group_user) {
                    if ($group_user['GroupsUser']['report'] === '1') {
                        $user = $this->User->findById($group_user['GroupsUser']['user_id']);
                        $email = $user['User']['email']; // 送信先
                        $subject = "タスク編集のお知らせ"; // 件名
                        $message = "グループ \"".$this->_groupName($this->group_id)."\" のタスク \"".$task_title."\"が編集されました"; // 内容

                        $this->_sendMail($email, $subject, $message);
                    }
                }

	            $this->Session->setFlash(__('編集完了'));
	            return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('編集できませんでした'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $task;
	    }

	}


	public function delete($id, $group_id) {
        // 権限がないユーザーをリダイレクトする
        if (isset($group_id)) {
            $groups_user = $this->GroupsUser->find('first', array('conditions' => array('GroupsUser.group_id' => $group_id, 'GroupsUser.user_id' => $this->userSession['id'])));
            $this->authority = $groups_user['GroupsUser']['authority'];
            if ($this->authority  ===  '0' || $this->authority  ===  '1') {
                $this->Session->setFlash(__('タスクを削除できる権限がありません'));
                return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
            }
        }

	    if ($this->request->is('get')) {
        	throw new MethodNotAllowedException();
	    }

        $task = $this->Task->findById($id);
        $task_title = $task['Task']['title'];

	    if ($this->Task->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('Task.id' => $id))) {
            $this->GroupsTask->updateAll(array('deleted_date' => "'" . date('Y-m-d H:i:s') . "'"), array('GroupsTask.task_id' => $id));

            // グループのメンバーに報告メールを送信
            $group_users = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.group_id' => $group_id)));
            foreach ($group_users as $group_user) {
                if ($group_user['GroupsUser']['report'] === '1') {
                    $user = $this->User->findById($group_user['GroupsUser']['user_id']);
                    $email = $user['User']['email']; // 送信先
                    $subject = "タスク削除のお知らせ"; // 件名
                    $message = "グループ \"".$this->_groupName($group_id)."\" のタスク \"".$task_title."\"が削除されました"; // 内容

                    $this->_sendMail($email, $subject, $message);
                }
            }
	        $this->Session->setFlash(__('削除しました', h($id)));

	    } else {
	        $this->Session->setFlash(__('削除できませんでした', h($id)));
	    }

	    return $this->redirect(array('controller' => 'groups', 'action' => 'index'));
	}


    public function schedule() {
        // ログインユーザーが属しているグループを取得
        $auth_groups = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $this->userSession['id'])));
        $tmp_auth_groups = Hash::extract($auth_groups, '{n}.GroupsUser.group_id');
        // グループが所持しているタスクを取得
        $auth_tasks_ids = $this->GroupsTask->find('all', array('conditions' => array('GroupsTask.group_id' => $tmp_auth_groups)));
        $tmp_auth_tasks_ids = Hash::extract($auth_tasks_ids, '{n}.GroupsTask.task_id');
        $auth_tasks = $this->Task->find('all', array('conditions' => array('Task.id' => $tmp_auth_tasks_ids, 'Task.deleted_date' => null)));

        $this->set(compact('auth_tasks'));
    }


}