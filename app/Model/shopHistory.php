<?php
Class shopHistory extends AppModel{
	public $useTable = 'shop_history';
	public $belongsTo = 'User';
}