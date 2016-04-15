<?php
Class donationLadder extends AppModel{
	public $useTable = 'donation_ladder';
	public $belongsTo = 'User';
}