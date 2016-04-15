<?php
Class Shop extends AppModel{
	public $useTable = 'shop';
	public $belongsTo = array(
        'shopCategories' => array(
            'className' => 'shopCategories',
            'foreignKey' => 'cat'
        )
    );
	public $validate = array(
			'name' => array(
				'rule' => array('minlength', '3'),
				'message' => 'Vous devez saisir un nom pour cet article',
				'required' => 'required'
			),
			'description' => array(
				'rule' => array('minlength', '3'),
				'message' => 'Vous devez saisir une description pour cet article',
				'required' => 'required'
			),
			'cat' => array(
				'rule' => array('minlength', '1'),
				'message' => 'Vous devez saisir un catégorie pour cet article',
				'required' => 'required'
			),
			'img' => array(
				'rule' => 'url',
				'message' => 'Vous devez ajouter une image (une url) pour cet article',
				'required' => 'required'
			),
			'price_money_site' => array(
				'rule' => 'numeric',
				'message' => 'Vous devez saisir un prix (un nombre entier) pour cet article',
				'required' => 'required'
			),
			'price_money_server' => array(
				'rule' => 'numeric',
				'message' => 'Vous devez saisir un prix (un nombre entier) pour cet article',
				'allowEmpty' => true
			),
			'command' => array(
				'rule' => array('minlength', '3'),
				'message' => 'Vous devez saisir une commande à éxecuter apres l\'achat de cet article',
				'required' => 'required'
			)
		);
}