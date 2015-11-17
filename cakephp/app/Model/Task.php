<?php

class Task extends AppModel {

	public $belongsTo = array('User', 'Group');

	public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'contents' => array(
            'rule' => 'notBlank'
        )
    );
}