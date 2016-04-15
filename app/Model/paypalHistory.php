<?php
Class paypalHistory extends AppModel{
	public $useTable = 'instant_payment_notifications';
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'custom'
        )
    );
}