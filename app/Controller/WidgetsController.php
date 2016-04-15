<?php
Class WidgetsController extends AppController{

	public function admin_add(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$name = $this->request->data['Widget']['name'];
				$content = $this->request->data['Widget']['content'];
				$order = $this->request->data['Widget']['order'];
				if(!empty($name) && !empty($content)){
					$this->Widget->create;
					$this->Widget->saveField('user_id', $this->Auth->user('id'));
					$this->Widget->saveField('name', $name);
					$this->Widget->saveField('content', $content);
					$this->Widget->saveField('ip', $_SERVER['REMOTE_ADDR']);
					$this->Widget->saveField('order', $order);
					$this->Widget->saveField('visible', '1');
					$this->Session->setFlash('Le widget a été ajouté !', 'toastr_success');
					$this->redirect(['controller' => 'widgets', 'action' => 'list']);
				}
				else{
					$this->Session->setFlash('Les deux champs sont obligatoires', 'toastr_error');
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit($id){
		if($this->Auth->user('role') > 1){
			if($this->Widget->find('first', ['conditions' => ['Widget.id' => $id]])){
				$this->set('data', $this->Widget->find('first', ['conditions' => ['Widget.id' => $id]]));
				if($this->request->is('post')){
					$this->Widget->id = $id;
					$name = $this->request->data['Widget']['name'];
					$content = $this->request->data['Widget']['content'];
					if(!empty($name) && !empty($content)){
						$this->Widget->save($this->request->data);
						$this->Session->setFlash('Le widget a été modifié !', 'toastr_success');
						$this->redirect(['controller' => 'widgets', 'action' => 'list']);
					}
					else{
						$this->Session->setFlash('Les deux champs sont obligatoires', 'toastr_error');
					}
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_show($id){
		if($this->Auth->user('role') > 1){
			if($this->Widget->find('first', ['conditions' => ['Widget.id' => $id]])){
				$this->Widget->id = $id;
				$this->Widget->saveField('visible', '1');
				$this->Session->setFlash('Le widget est désormais visible !', 'toastr_success');
				$this->redirect(['controller' => 'widgets', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_hide($id){
		if($this->Auth->user('role') > 1){
			if($this->Widget->find('first', ['conditions' => ['Widget.id' => $id]])){
				$this->Widget->id = $id;
				$this->Widget->saveField('visible', '0');
				$this->Session->setFlash('Le widget est désormais caché !', 'toastr_success');
				$this->redirect(['controller' => 'widgets', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete($id){
		if($this->Auth->user('role') > 1){
			if($this->Widget->find('first', ['conditions' => ['Widget.id' => $id]])){
				$this->Widget->delete($id);
				$this->Session->setFlash('Le widget a été supprimé !', 'toastr_success');
				$this->redirect(['controller' => 'widgets', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_list(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Widget->find('all', ['order' => ['Widget.order ASC']]));
		}
		else{
			throw new NotFoundException();
		}
	}
}