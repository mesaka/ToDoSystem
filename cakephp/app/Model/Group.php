<?php

class Group extends AppModel {

    public $hasAndBelongsToMany = array(
    	'User'=> array(
		    'className'              => 'User',   //所属先のデータを扱うモデルクラス
		    'joinTable'              => 'groups_users',
		    'foreignKey'             => 'group_id',   //所属先のモデルがこのモデルを指し示す外部キー
		    'associationForeignKey'  => 'user_id',
		    'unique'                 => true,
		    'conditions'             => '',
		    'fields'                 => '',
		    'order'                  => '',
		    'limit'                  => '',
		    'offset'                 => '',
		    'finderQuery'            => '',
		    'deleteQuery'            => '',
		    'insertQuery'            => '',
		    'with'                   => 'GroupsUser'
    	),
    	'Task' => array(
			'className' => 'Task',
			'join_table' => 'groups_tasks',
			'foreignKey' => 'group_id',
			'associationForeignKey' => 'task_id',
		),
    );


    public $validate = array(
    	'name' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'グループ名を入力してください'
            )
        ),
    );

}