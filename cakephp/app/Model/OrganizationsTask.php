<?php

class OrganizationsTask extends AppModel {

    // public $actsAs = array('SoftDelete');

    public $name = 'OrganizationsTask';

    public $belongsTo = array('Organization', 'Task');

}