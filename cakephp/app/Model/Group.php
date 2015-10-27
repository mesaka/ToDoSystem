<?php

class Group extends AppModel {

    public $actsAs = array('SoftDelete');

    // public $hasMany = array('User');
    public $belongsTo = array('Organization');
    public $hasAndBelongsToMany = array(
    	'User'=>
    	array(
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
    	)
    );

}