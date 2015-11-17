<?php

class ContactsController extends AppController {
 
 	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	public $uses = array('Contact');

	public function beforeFilter() {
		parent::beforeFilter();
        $this->Auth->allow('index', 'confirm', 'send', 'comp');
    }


	// 入力画面
	public function index() {
		if (!empty($this->request->data)) {
			$this->Contact->set($this->request->data);
		
			if ($this->Contact->validates()) {
			    return true;
			} else {
			    $errors = $this->Contact->validationErrors;
			}
		}
	}

	// 確認画面
	public function confirm() {
		if ($this->request->is('post')) {
			$name = $this->request->data['Contact']['name'];
			$from = $this->request->data['Contact']['from'];
			// $to = $this->request->data['Contact']['to'];
			$subject = $this->request->data['Contact']['subject'];
			$message = $this->request->data['Contact']['message'];

			$this->set(compact("name", "from", "to", "subject", "message"));

		}

	}

	// 送信処理
	public function send() {
		if ($this->request->is('post')) {

			$from = $this->request->data['Contact']['from'];
			// $to = $this->request->data['Contact']['to'];
			$subject = $this->request->data['Contact']['subject'];
			$message = $this->request->data['Contact']['message'];


			$email = new CakeEmail('mail'); // インスタンス化
		    $email->from( array($from => $from.'より')); // 送信元
		    $email->to("yagishita@nunatoi.jp"); // 送信先
		    $email->subject($subject); // メールタイトル

		    if ($email->send($message)) {
		    	$this->Session->setFlash('問い合わせ完了');
		    	$this->redirect(array('action' => 'comp'));
		    } else {
		    	$this->Session->setFlash('問い合わせに失敗しました。');
		    }
		}
		
	}

	// 完了画面
	public function comp() {

	}
}