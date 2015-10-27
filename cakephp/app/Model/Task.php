<?php

class Task extends AppModel {

	public $actsAs = array('SoftDelete');

	public $belongsTo = array('Category', 'User', 'Organization', 'Group', 'GroupsUser');

	public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'contents' => array(
            'rule' => 'notBlank'
        )
    );
}