<?php

class Category extends AppModel {

	public $actsAs = array( 'SoftDelete' );

	public $hasMany = 'Task';

	public $validate = array(
        'name' => array(
            'rule' => 'notBlank'
        ),
    );

}