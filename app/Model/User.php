<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{

	public $name = 'User';
    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule'     => 'isUnique',
                'required' => true,
                'message'  => 'Ce pseudo à déjà été choisi'
            ),
            'between' => array(
                'rule'    => array('between', 3, 15),
                'message' => 'Entre 3 et 15 caractères'
            )
        ),
        'email' => array(
            'email' => array(
                'rule'    => 'email',
                'message' => 'Vous devez utiliser une adresse email valide',
                'required' => true
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Cette adresse est déjà utilisée',
                'required' => true
            )
        ),
        'password' => array(
            'rule'    => array('minLength', '6'),
            'message' => '6 caractères minimum',
            'required' => true
        )
    );
    
    public function beforeSave($options = []){
	    if(isset($this->data[$this->alias]['password'])){
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}
}