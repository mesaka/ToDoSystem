<?php

class Contact extends AppModel {

	public $useTable = false;
	
	public $validate = array(
		'name' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'お名前を入力してください'
            )
        ),
        'from' => array(
            'rule'=> 'email', 
            'required' => true, 
            'message' => '｢メールアドレス｣は正しく入力して下さい',
        ),
        'subject' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => '件名を入力してください'
            )
        ),
        'message' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'お問い合わせ内容を入力してください'
            )
        ),

	);
}