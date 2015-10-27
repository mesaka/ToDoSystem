<?php

class Organization extends AppModel {

	public $actsAs = array('SoftDelete');

	public $hasMany = array('Group', 'User');

}