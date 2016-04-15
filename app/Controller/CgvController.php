<?php

class CgvController extends AppController{

    public $uses = ['User'];


    public function cgv(){
		
    }

    public function ok(){
        if($this->Auth->user()){
            $id = $this->Auth->user('id');
            $this->User->id = $id;
            $this->User->saveField('cgvcgu', 1);
            $this->Session->setFlash('Vous avez accepté les CGV/CGU', 'success');
            return $this->redirect(['controller' => 'cgv', 'action' => 'cgv']);
        }
    }
} ?>