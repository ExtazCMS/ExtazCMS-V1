<?php
class supportComments extends AppModel{
	public $useTable = 'support_comments';
	public $belongsTo = 'User';
}