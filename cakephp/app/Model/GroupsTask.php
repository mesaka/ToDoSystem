<?php

class GroupsTask extends AppModel {

    public $name = 'GroupsTask';

    public $belongsTo = array('Group', 'Task');

}