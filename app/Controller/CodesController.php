<?php
Class CodesController extends AppController{

	public $uses = ['Code', 'User', 'Informations'];

	public function index(){
		if($this->Auth->user('role' > 1)){
			return $this->redirect(['controller' => 'codes', 'action' => 'generate', 'admin' => true]);
		}
		else{
			return $this->redirect($this->referer());
		}
	}

	public function admin_index(){
		if($this->Auth->user('role' > 1)){
			return $this->redirect(['controller' => 'codes', 'action' => 'create', 'admin' => true]);
		}
		else{
			return $this->redirect($this->referer());
		}
	}

	public function admin_generate(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$creator = $this->Auth->user('username');
				$ip = $_SERVER['REMOTE_ADDR'];
				$value = $this->request->data['Codes']['value'];
				$number = $this->request->data['Codes']['number'];
				if($number == null){
					$number = 1;
				}
				if($number > 250){
					$this->Session->setFlash('Vous ne pouvez générer que 250 codes maximum', 'error');
					return $this->redirect(['controller' => 'codes', 'action' => 'generate', 'admin' => true]);
				}
				else{
					for($i = 1; $i <= $number; $i++){
						// On génère un code
						$char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
						$random = str_shuffle($char);
						$random2 = str_shuffle($char);
						$random3 = str_shuffle($char);
						$random4 = str_shuffle($char);
						$code = substr($random, 0, 4).'-'.substr($random2, 0, 4).'-'.substr($random3, 0, 4).'-'.substr($random4, 0, 4);
						// On l'enregistre
						$this->Code->create;
						$this->Code->saveField('creator', $creator);
						$this->Code->saveField('ip', $ip);
						$this->Code->saveField('code', $code);
						$this->Code->saveField('value', $value);
						$this->Code->saveField('used', 0);
						$this->Code->clear();
					}
					// On redirige
					if($number > 1){
						$this->Session->setFlash('Vos codes ont bien étés générés !', 'toastr_success');
					}
					else{
						$this->Session->setFlash('Votre code a bien été généré !', 'toastr_success');
					}
					return $this->redirect(['controller' => 'codes', 'action' => 'list', 'admin' => true]);
				}
				
			}
		}
		else {
			throw new NotFoundException();			
		}
	}

	public function admin_list(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Code->find('all', ['order' => ['Code.id' => 'DESC']]));
		}
		else{
			throw new NotFoundException();			
		}
	}

	public function admin_delete($id){
		if($this->Auth->user('role') > 1){
			$this->Code->delete($id);
			$this->Session->setFlash('Ce code a été supprimé', 'toastr_success');
			return $this->redirect(['controller' => 'codes', 'action' => 'list', 'admin' => true]);
		}
		else{
			throw new NotFoundException();			
		}
	}

	public function consume(){
		if($this->Auth->user()){
			if($this->request->is('post')){
				$code = $this->request->data['Codes']['code'];
				// Si ce code existe
				if($this->Code->findByCode($code)){
					$code = $this->Code->findByCode($code);
					$id = $code['Code']['id'];
					$used = $code['Code']['used'];
					$value = $code['Code']['value'];
					$userid = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
					$user_id = $userid['User']['id'];
					// S'il n'est pas déjà utilisé
					if($used == 0){
						// On utilise le code
						$this->Code->id = $id;
						$this->Code->saveField('user_id', $user_id);
						$this->Code->saveField('used', 1);
						// On va chercher les infos de l'utilisateur
						$user = $this->User->find('first', ['conditions' => ['User.id' => $this->Auth->user('id')]]);
						// On récupère son nombre de tokens actuels
						$user_tokens = $user['User']['tokens'];
						// On définit son nouveau nombre de tokens
						$new_user_tokens = $user_tokens + $value;
						// On le sauvegarde
						$this->User->id = $this->Auth->user('id');
						$this->User->saveField('tokens', $new_user_tokens);
						// Et on redirige
						$this->Session->setFlash('Votre avez été crédité de '.$value.' '.$this->config['site_money'].' !', 'success');
						return $this->redirect(['controller' => 'shops', 'action' => 'reload', 'admin' => false]);
					}
					else{
						$this->Session->setFlash('Ce code a déjà été utilisé !', 'error');
						return $this->redirect(['controller' => 'shops', 'action' => 'reload', 'admin' => false]);
					}
				}
				else{
					$this->Session->setFlash('Code erroné', 'error');
					return $this->redirect(['controller' => 'shops', 'action' => 'reload', 'admin' => false]);
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}
}