<?php
class Post extends AppModel{

	public $hasMany = array(
        'Like' => array(
            'className' => 'Like',
            'foreignKey' => 'id_article'
        ),
        'Comment' => array(
        	'order' => 'Comment.id DESC'
        ),
    );

	public $validate = array(
		'title' => array(
	    	'rule' => 'notEmpty',
	    	'required' => true,
	    	'message' => 'Ce champ est obligatoire'
	    ),
	    'cat' => array(
            'between' => array(
                'rule'    => array('between', 2, 20),
                'message' => 'Entre 2 et 10 caractères'
            )
        ),
	    'slug' => array(
            'between' => array(
                'rule'    => array('between', 2, 30),
                'message' => 'Entre 2 et 30 caractères'
            )
        ),
        'img_file' => array(
	    	'rule' => array('fileExtension', array('jpg', 'jpeg', 'png'), true),
	    	'message' => array('Vous ne pouvez envoyer que des jpg ou des png')
	    ),
	    'content' => array(
	    	'rule' => 'notEmpty',
	    	'required' => true,
	    	'message' => 'Ce champ est obligatoire'
	    )
	);

	public function fileExtension($check, $extensions, $allowEmpty = true){
		$file = current($check);
		if($allowEmpty && empty($file['tmp_name'])){
			return true;
		}
		$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
		return in_array($extension, $extensions);
	}

	public function beforeDelete($cascade = true){
		$oldExtension = $this->field('img');
		$oldFile = IMAGES . 'posts' . DS . $this->id . '.' . $oldExtension;
		if(file_exists($oldFile)){
			unlink($oldFile);
		}
	}

	public function afterSave($created, $options = Array()){
		if(isset($this->data[$this->alias]['img_file'])){
			$file = $this->data[$this->alias]['img_file'];
			$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			if(!empty($file['tmp_name'])){
				$oldExtension = $this->field('img');
				$oldFile = IMAGES . 'posts' . DS . $this->id . '.' . $oldExtension;
				if(file_exists($oldFile)){
					unlink($oldFile);
				}
				move_uploaded_file($file['tmp_name'], IMAGES . 'posts' . DS . $this->id . '.' . $extension);
				$this->saveField('img', $this->id.'.'.$extension);
			}
		}
	}
}