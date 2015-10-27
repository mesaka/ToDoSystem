<?php

class GroupsUser extends AppModel {

    // public $actsAs = array('SoftDelete');

    public $name = 'GroupsUser';

    public $belongsTo = array('Group', 'User',);

}