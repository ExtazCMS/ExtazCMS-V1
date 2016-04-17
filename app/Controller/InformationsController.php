<?php

App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class InformationsController extends AppController{

	public function admin_index(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Informations->find('first', ['conditions' => ['Informations.id' => 1]]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_update_informations(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$this->Informations->id = 1;
				if($this->Informations->save($this->request->data)){
					$this->Session->setFlash('Configuration mise à jour !', 'toastr_success');
				}
				return $this->redirect(['controller' => 'informations', 'action' => 'index']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}


	public function admin_reset_votes() {
		if ($this->Auth->user('role') > 1) {
			if($this->request->is('post')) {
                $db = ConnectionManager::getDataSource('default');
                $db->rawQuery("UPDATE extaz_users SET votes = '0'");

                $this->Session->setFlash('Les votes on été remis à zero !', 'toastr_success');
                return $this->redirect(['controller' => 'informations', 'action' => 'index']);
            }

		} else {
			throw new NotFoundException();
		}
		exit();
        //$this->autoRender = false;
    }

	public function admin_test_jsonapi(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('ajax')){
		    	$api = new JSONAPI($this->request->data['ip'], $this->request->data['port'], $this->request->data['username'], $this->request->data['password'], $this->request->data['salt']);
				if($api->call('players.online.limit')[0]['result'] == 'success'){
					$result = 'success';
				} else {
					$result = 'failure';
				}
				echo json_encode(['result' => $result]);
				exit();
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_update_options(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$this->Informations->id = 1;
				if(isset($this->request->data['use_slider'])){
					$this->Informations->saveField('use_slider', 1);
				}
				else{
					$this->Informations->saveField('use_slider', 0);
				}
				if(isset($this->request->data['use_store'])){
					$this->Informations->saveField('use_store', 1);
				}
				else{
					$this->Informations->saveField('use_store', 0);
				}
				if(isset($this->request->data['use_faq'])){
					$this->Informations->saveField('use_faq', 1);
				}
				else{
					$this->Informations->saveField('use_faq', 0);
				}
				if(isset($this->request->data['use_donation_ladder'])){
					$this->Informations->saveField('use_donation_ladder', 1);
				}
				else{
					$this->Informations->saveField('use_donation_ladder', 0);
				}
				if(isset($this->request->data['use_igchat'])){
					$this->Informations->saveField('use_igchat', 1);
				}
				else{
					$this->Informations->saveField('use_igchat', 0);
				}
				if(isset($this->request->data['use_paypal'])){
					$this->Informations->saveField('use_paypal', 1);
				}
				else{
					$this->Informations->saveField('use_paypal', 0);
				}
				if(isset($this->request->data['use_starpass'])){
					$this->Informations->saveField('use_starpass', 1);
				}
				else{
					$this->Informations->saveField('use_starpass', 0);
				}
				if(isset($this->request->data['use_economy'])){
					$this->Informations->saveField('use_economy', 1);
				}
				else{
					$this->Informations->saveField('use_economy', 0);
				}
				if(isset($this->request->data['use_server_money'])){
					$this->Informations->saveField('use_server_money', 1);
				}
				else{
					$this->Informations->saveField('use_server_money', 0);
				}
				if(isset($this->request->data['use_votes'])){
					$this->Informations->saveField('use_votes', 1);
				}
				else{
					$this->Informations->saveField('use_votes', 0);
				}
				if(isset($this->request->data['use_votes_ladder'])){
					$this->Informations->saveField('use_votes_ladder', 1);
				}
				else{
					$this->Informations->saveField('use_votes_ladder', 0);
				}
				if(isset($this->request->data['use_team'])){
					$this->Informations->saveField('use_team', 1);
				}
				else{
					$this->Informations->saveField('use_team', 0);
				}
				if(isset($this->request->data['use_contact'])){
					$this->Informations->saveField('use_contact', 1);
				}
				else{
					$this->Informations->saveField('use_contact', 0);
				}
				if(isset($this->request->data['use_rules'])){
					$this->Informations->saveField('use_rules', 1);
				}
				else{
					$this->Informations->saveField('use_rules', 0);
				}
				if(isset($this->request->data['happy_hour'])){
			    	$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
					if($api->call('server.bukkit.version')[0]['result'] == 'success'){
						$api->call('server.run_command', ['say Happy hour ! Rendez-vous sur le site. '.$this->config['happy_hour_bonus'].'% de '.$this->config['site_money'].' offerts ! (http://'.$_SERVER['HTTP_HOST'].$this->webroot.'recharger)']);
					}
					$this->Informations->saveField('happy_hour', 1);
				}
				else{
					$this->Informations->saveField('happy_hour', 0);
				}
				if(isset($this->request->data['maintenance'])){
					$this->Informations->saveField('maintenance', 1);
				}
				else{
					$this->Informations->saveField('maintenance', 0);
				}
				if(isset($this->request->data['debug'])){
					$this->Informations->saveField('debug', 1);
				}
				else{
					$this->Informations->saveField('debug', 0);
				}
				if(isset($this->request->data['use_posts_views'])){
					$this->Informations->saveField('use_posts_views', 1);
				}
				else{
					$this->Informations->saveField('use_posts_views', 0);
				}
				$this->Session->setFlash('Options mises à jour !', 'toastr_success');
				return $this->redirect(['controller' => 'informations', 'action' => 'index', '?' => ['tab' => 'options']]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_background(){
		if($this->Auth->user('role') > 1){
			$dir = new Folder('../webroot/img/bg/');
			if($dir->path != null){
				$backgrounds = $dir->find('.*\.jpg');
				$nb_backgrounds = count($backgrounds);
				$this->set('backgrounds', $backgrounds);
				$this->set('nb_backgrounds', $nb_backgrounds);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add_background(){
		if($this->Auth->user('role') > 1){
			// On verifie que l'extension est valide
			$file = $_FILES['file'];
			$extensions = ['jpg', 'jpeg', 'png'];
			$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			if(in_array($extension, $extensions)){
				// On genere un id
				$nums = '123456789123456789123456789';
				$nums = str_shuffle($nums);
				$nums = substr($nums, 0, 7);
				// On enregistre le fichier
				move_uploaded_file($file['tmp_name'], IMAGES . 'bg' . DS . $nums . '.jpg');
				// On le sauvegarde
				$this->Informations->id = 1;
				$this->Informations->saveField('background', $nums.'.jpg');
				$this->Session->setFlash('Background mis à jour !', 'toastr_success');
				return $this->redirect(['controller' => 'informations', 'action' => 'background']);
			}
			else{
				$this->Session->setFlash('Type de fichier invalide', 'toastr_error');
				return $this->redirect(['controller' => 'informations', 'action' => 'background']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_update_background($background){
		if($this->Auth->user('role') > 1){
			$this->Informations->id = 1;
			$this->Informations->saveField('background', $background);
			$this->Session->setFlash('Background mis à jour !', 'toastr_success');
			return $this->redirect(['controller' => 'informations', 'action' => 'background']);
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete_background($background){
		if($this->Auth->user('role') > 1){
			$file = IMAGES . 'bg' . DS . $background;
			if(file_exists($file)){
				unlink($file);
			}
			$this->Session->setFlash('Background supprimé !', 'toastr_success');
			return $this->redirect(['controller' => 'informations', 'action' => 'background']);
		}
		else{
			throw new NotFoundException();
		}
	}
}