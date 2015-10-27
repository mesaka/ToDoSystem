<?php

class TasksController extends AppController {

	public $helpers = array('Html', 'Form', 'Session', 'Markdown.Markdown',);
	public $components = array('Session');
	public $uses = array('Task', 'Category', 'User', 'Organization', 'Group', 'GroupsUser');
// 

    public function beforeFilter() {
        
        // ログイン中のユーザー名
        $user = $this->Auth->user();
        if (is_null($user)) {
           $this->name = 'Guest';
        } else {
           $this->name = $_SESSION['Auth']['User']['username'];
        }


        $this->checkOrganization = $this->Auth->user('organization_id');
        $this->checkGroup = $this->Auth->user('group_id');
        $this->checkAuthority = $this->Auth->user('authority');


    }


	public function index() {

        $login_id = $this->Auth->user('id');                                                                               // ログインユーザーのID
        $groups_user = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $login_id)));    // GroupsUserテーブルのuser_idがログイン中のユーザーと同じデータを取得する
        $result = Hash::extract($groups_user, '{n}.GroupsUser.group_id'); 


		$this->set('tasks',$this->Task->find('all', array('conditions' => array('and' => 
                                                                            array(
                                                                                // 'Task.group_id' => $result,
                                                                                'Task.public_private' => 0,
                                                                            )))));

		$this->set('categories', $this->Category->find('all'));


	}


	public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $task = $this->Task->findById($id);
        if (!$task) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('task', $task);
    }


	public function add() {
		if ($this->request->is('post')) {
			$this->Task->create();

			$this->request->data['Task']['user_id'] = $this->Auth->user('id');

			if ($this->Task->save($this->request->data)) {
                $this->Session->setFlash(__('追加されました'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('もう一度入力してください'));
		}

		$this->set('categories', $this->Category->find('list'));
        $this->set('organize', $this->checkOrganization);
        $user_organize = $this->checkOrganization;
        $this->set('groups', $this->Group->find('list', array('conditions' => array('Group.organization_id' => $user_organize))));

	}


	public function edit($id = null) {

		if (!$id) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

	    $task = $this->Task->findById($id);
        $this->set('task', $task);
	    if (!$task) {
	        throw new NotFoundException(__('エラーが起きました'));
	    }

        $login_id = $this->Auth->user('id');                                                                               // ログインユーザーのID
        $groups_user = $this->GroupsUser->find('all', array('conditions' => array('GroupsUser.user_id' => $login_id)));    // GroupsUserテーブルのuser_idがログイン中のユーザーと同じデータを取得する
        $result = Hash::extract($groups_user, '{n}.GroupsUser.group_id');                                             // ユーザーの所属グループID。取得されたデータの中からgroup_idだけを取得する
        $task_group = $task['Group']['id'];                                                                                // タスクの所属グループを変数に代入
        if (!in_array($task_group, $result)) {
            throw new NotFoundException(__('ほかのグループのTaskは編集できません'));                                            // タスクの所属グループと、ユーザーの所属グループが一致しなかった場合編集できない
        }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Task->id = $id;
	        if ($this->Task->save($this->request->data)) {
	            $this->Session->setFlash(__('編集完了'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('編集できませんでした'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $task;
	    }

        $user_organize = $this->checkOrganization;
        $this->set('groups', $this->Group->find('list', array('conditions' => array('Group.organization_id' => $user_organize))));

	}


	public function delete($id) {

	    if ($this->request->is('get')) {
        	throw new MethodNotAllowedException();
	    }
        // グループリーダーしか削除できない
        if ($this->checkAuthority < 2) {
            throw new NotFoundException(__('権限が与えられていません'));
        }

	    if ($this->Task->delete($id)) {

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



	// カテゴリー並べ替え
	public function category_index($category_id = null) {
        $user_organize = $this->checkOrganization;
    	$tasks = $this->Task->find('all', array('conditions' => array('and' =>
                                                                    array(
                                                                        'category_id' => $category_id,
                                                                        'Task.organization_id' => $user_organize,
                                                                    ))));

    	$this->set(compact('tasks'));

    	$this->set('categories', $this->Category->find('all'));
    }


    //タイトル前方一致検索
    public function search_index() {

        $user_organize = $this->checkOrganization;

    	if ($this->request->is('post')) {
    		$title = $this->request->data['Task']['タイトル検索'];
    		$this->set('tasks', $this->Task->find('all', array('conditions' => array('and' =>
                                                                                array(
                                                                                    'Task.title like' => $title . '%',
                                                                                    'Task.organization_id' => $user_organize,
                                                                                    'Task.public_private' => 0,
                                                                                )))));
    	} else {
    		$this->set('tasks', $this->Task->find('all'));
    	}

    	$this->set('categories', $this->Category->find('all'));

    }



    // ID昇順
    public function id_asc($id = null) {

    	$this->set('tasks', $this->Task->find('all', array('order' => 'Task.id')));

    	$this->set('categories', $this->Category->find('all'));

    }
    // ID降順
    public function id_desc($id = null) {

    	$this->set('tasks', $this->Task->find('all', array('order' => 'Task.id DESC')));

    	$this->set('categories', $this->Category->find('all'));

    }




    // カテゴリー昇順
    public function category_asc($id = null) {

    	$this->set('tasks',$this->Task->find('all', array('order' => 'Category.name')));

    	$this->set('categories', $this->Category->find('all'));

    }
    // カテゴリー降順
    public function category_desc($id = null) {

    	$this->set('tasks',$this->Task->find('all', array('order' => 'Category.name DESC')));

    	$this->set('categories', $this->Category->find('all'));

    }




    // 締め切り昇順
    public function deadline_asc($id = null) {

    	$this->set('tasks', $this->Task->find('all', array('order' => array("deadline_date", 'deadline_time'))));

    	$this->set('categories', $this->Category->find('all'));

    }
    // 締め切り降順
    public function deadline_desc($id = null) {

    	$this->set('tasks', $this->Task->find('all', array('order' => array('deadline_date DESC', 'deadline_time DESC'))));

    	$this->set('categories', $this->Category->find('all'));

    }



    public function schedule() {

    	$this->set('tasks',$this->Task->find('all'));

    }


    public function contact() {



    }

}