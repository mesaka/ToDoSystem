<?php

App::uses('CakeEmail', 'Network/Email');

class SamplesController extends AppController {

	public function index() {

		$email = new CakeEmail('mail');                        // インスタンス化
	    $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社'));  // 送信元
	    $email->to('kidsdream226@gmail.com');                      // 送信先
	    $email->subject('メール送信テスト');                      // メールタイトル

	    $email->send('From CakePHP テスト成功！');                             // メール送信
	}
}