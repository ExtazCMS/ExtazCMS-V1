<?php
class FaqController extends AppController {
    public $uses = ['Faq'];

    public function index() {
        // Si le faq est activée
        if($this->config['use_faq'] == 1) {

            // Get database info...
            $this->set('data', $this->Faq->find('all', ['order' => ['Faq.id ASC']]));

        } // Si le faq est désactivée
        else {
            throw new NotFoundException();
        }
    }

    public function admin_index(){
        if($this->Auth->user('role') > 1){
            $this->set('data', $this->Faq->find('all', ['order' => ['Faq.id' => 'ASC']]));
            if($this->request->is('post')){
                if((isset($this->request->data['Faq']['question']) != "") && (isset($this->request->data['Faq']['answer']) != "")) {
                    if(strlen($this->request->data['Faq']['question']) < 5 || strlen($this->request->data['Faq']['answer']) < 5) {
                        $this->Session->setFlash('Les champs sont trop courts!', 'toastr_error');
                    } else {
                        $this->Faq->create;
                        $this->Faq->saveField('question', $this->request->data['Faq']['question']);
                        $this->Faq->saveField('answer', $this->request->data['Faq']['answer']);
                        $this->Session->setFlash('La requête a bien été envoyée!', 'toastr_success');
                        return $this->redirect($this->referer());
                    }
                }
                else{
                    $this->Session->setFlash('Tous les champs sont obligatoires', 'toastr_error');
                }
            }
        }
        else{
            throw new NotFoundException();
        }
    }

    public function admin_delete($id) {
        if($this->Auth->user('role') > 1){
            $this->Faq->delete($id);
            $this->Session->setFlash('Le F.A.Q a été supprimé', 'toastr_success');
            return $this->redirect(['controller' => 'faq', 'action' => 'index', 'admin' => true]);
        }
        else{
            throw new NotFoundException();
        }
    }
}