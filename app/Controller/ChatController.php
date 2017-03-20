<?php
Class ChatController extends AppController {
    public $uses = ['Chat'];

    public function index() {
        // Si le chat est activée
        if($this->config['use_igchat'] == 1) {
            if($this->Auth->user()) {
                $ban = ($this->Auth->user('ban'));
                if($ban == 1){
                    $this->Session->setFlash('Les joueurs bannis n\'ont pas accès au chat', 'error');
                    return $this->redirect(['controller' => 'posts', 'action' => 'index']);
                }
            }
            else {
                $ban = 0;
            }
        } // Si le chat est désactivée
        else {
            throw new NotFoundException();
        }
    }
}