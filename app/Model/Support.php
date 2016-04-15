<?php
Class Support Extends AppModel{
	public $useTable = 'support';
	public $belongsTo = 'User';
	public $hasMany = array(
        'supportComments' => array(
            'className' => 'supportComments',
            'foreignKey' => 'ticket_id',
            'order' => 'supportComments.created DESC',
            'limit' => '1',
            'dependent' => true
        )
    );
}