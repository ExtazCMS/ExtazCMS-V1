<?php
class PlayersController extends AppController{

	public $uses = ['Informations', 'User', 'shopHistory', 'starpassHistory', 'paypalHistory'];

	public function admin_index(){
		if($this->Auth->user('role') > 1){

		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_whois($username){
		if($this->Auth->user('role') > 1){
	    	$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
			if($api->call('players.name', [$username])[0]['result'] == 'success'){
				if($this->User->find('first', ['conditions' => ['User.username' => $username]])){
					$player = $this->User->find('first', ['conditions' => ['User.username' => $username]]);
					$player_id = $player['User']['id'];
					$this->set('player', $this->User->find('first', ['conditions' => ['User.username' => $username]]));
					$this->set('achatsBoutique', $this->shopHistory->find('count', ['conditions' => ['shopHistory.user_id' => $player_id]]));
					$this->set('achatsStarpass', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.user_id' => $player_id]]));
					$this->set('achatsPaypal', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.custom' => $player_id]]));
				}
				else{
					$this->Session->setFlash('Ce joueur n\'est pas inscrit sur le site !', 'toastr_error');
					return $this->redirect(['controller' => 'players', 'action' => 'index', 'admin' => true]);
				}
			}
			else{
				$this->Session->setFlash('Ce joueur n\'existe pas ou n\'est pas connecté', 'toastr_error');
				return $this->redirect(['controller' => 'players', 'action' => 'index', 'admin' => true]);
			}
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_kick($username = null){
		if($this->Auth->user('role') > 1){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
    		if($api->call('players.name.kick', [$username, 'Vous avez été kické'])){
	    		$this->Session->setFlash($username.' a été kické du serveur !', 'toastr_success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'toastr_error');
	    		return $this->redirect($this->referer());
	    	}
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_clear($username = null){
		if($this->Auth->user('role') > 1){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
    		if($api->call('server.run_command', ['clear '.$username])){
	    		$this->Session->setFlash('L\'inventaire de '.$username.' a été supprimé !', 'toastr_success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'toastr_error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_ban($username = null){
		if($this->Auth->user('role') > 1){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
    		if($api->call('server.run_command', ['ban '.$username.' Vous avez été banni'])){
	    		$this->Session->setFlash($username.' a été banni du serveur !', 'toastr_success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'toastr_error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_banip($username = null){
		if($this->Auth->user('role') > 1){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
    		if($api->call('server.run_command', ['banip '.$username])){
	    		$this->Session->setFlash($username.' a été ban IP du serveur !', 'toastr_success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'toastr_error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}
}