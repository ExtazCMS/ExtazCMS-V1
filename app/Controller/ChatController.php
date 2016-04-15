<?php
Class ChatController extends AppController {
    public $uses = ['Chat'];

    public function index() {
        // Si le chat est activée
        if($this->config['use_igchat'] == 1) {

        } // Si le chat est désactivée
        else {
            throw new NotFoundException();
        }
    }
}