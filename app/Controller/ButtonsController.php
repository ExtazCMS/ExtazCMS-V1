<?php
class ButtonsController extends AppController{

    public function admin_index(){
        if($this->Auth->user('role') > 1){
            $this->set('data', $this->Button->find('all', ['order' => ['Button.order' => 'ASC']]));
        }
        else{
            throw new NotFoundException();
        }
    }

    public function admin_edit($id){
        if($this->Auth->user('role') > 1){
            $this->Button->id = $id;
            if($this->Button->exists()){
                $this->set('data', $this->Button->find('first', ['conditions' => ['Button.id' => $id]]));
            }
            else{
                $this->Session->setFlash('Ce bouton n\'existe pas', 'error');
                return $this->redirect(['controller' => 'buttons', 'action' => 'index', 'admin' => true]);
            }
            if($this->request->is('post')){
                $this->Button->saveField('content', $this->request->data['Buttons']['content']);
                $this->Button->saveField('url', $this->request->data['Buttons']['url']);
                if(isset($this->request->data['Buttons']['icon'])){
                    $this->Button->saveField('icon', $this->request->data['Buttons']['icon']);
                }
                if(isset($this->request->data['Buttons']['color'])){
                    $this->Button->saveField('color', $this->request->data['Buttons']['color']);
                }
                $this->Button->saveField('order', $this->request->data['Buttons']['order']);
                $this->Session->setFlash('Votre bouton à bien été modifié !', 'toastr_success');
                return $this->redirect(['controller' => 'buttons', 'action' => 'index', 'admin' => true]);
            }
        }
        else{
            throw new NotFoundException();
        }
    }

    public function admin_add($id){
        if($this->Auth->user('role') > 1){
            $this->set('data', $this->Button->find('all', ['order' => ['Button.order' => 'ASC']]));
            if($this->request->is('post')){
                if(isset($this->request->data['Buttons']['icon']) && isset($this->request->data['Buttons']['color'])){
                    $this->Button->create;
                    $this->Button->saveField('user_id', $this->Auth->user('id'));
                    $this->Button->saveField('content', $this->request->data['Buttons']['content']);
                    $this->Button->saveField('url', $this->request->data['Buttons']['url']);
                    $this->Button->saveField('icon', $this->request->data['Buttons']['icon']);
                    $this->Button->saveField('color', $this->request->data['Buttons']['color']);
                    $this->Button->saveField('order', $this->request->data['Buttons']['order']);
                    $this->Session->setFlash('Votre bouton à bien été ajouté !', 'toastr_success');
                    return $this->redirect(['controller' => 'buttons', 'action' => 'index', 'admin' => true]);
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

    public function admin_delete($id){
        if($this->Auth->user('role') > 1){
            $this->Button->delete($id);
            $this->Session->setFlash('Ce bouton a été supprimé', 'toastr_success');
            return $this->redirect(['controller' => 'buttons', 'action' => 'index', 'admin' => true]);
        }
        else{
            throw new NotFoundException();
        }
    }
}