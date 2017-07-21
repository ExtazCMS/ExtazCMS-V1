<?php
class CpagesController extends AppController {

	public function index(){
		return $this->redirect(['controller' => 'posts', 'action' => 'index']);
	}

	public function admin_index(){
		if($this->Auth->user('role') > 1){
			return $this->redirect(['controller' => 'cpages', 'action' => 'add']);
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$this->Cpage->create;
				$this->Cpage->saveField('user_id', $this->Auth->user('id'));
				$this->Cpage->saveField('name', $this->request->data['Cpages']['name']);
				if(isset($this->request->data['Cpages']['visible'])){
					$this->Cpage->saveField('visible', $this->request->data['Cpages']['visible']);
				}
				else{
					$this->Cpage->saveField('visible', 0);
				}
				$this->Cpage->saveField('slug', $this->request->data['Cpages']['slug']);
				$this->Cpage->saveField('content', $this->request->data['Cpages']['content']);
				$this->Cpage->saveField('redirect', '0');
				$this->Cpage->saveField('url', '');
				$this->Session->setFlash('Page créée avec succès !', 'toastr_success');
				return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add_redirection(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$name = $this->request->data['Cpages']['name'];
				$slug = $this->request->data['Cpages']['slug'];
				$this->Cpage->create;
				$this->Cpage->saveField('user_id', $this->Auth->user('id'));
				$this->Cpage->saveField('name', $name);
				if(isset($this->request->data['Cpages']['visible'])){
					$this->Cpage->saveField('visible', $this->request->data['Cpages']['visible']);
				}
				else{
					$this->Cpage->saveField('visible', 0);
				}
				
				$this->Cpage->saveField('slug', $slug);
				$this->Cpage->saveField('content', '');
				$this->Cpage->saveField('redirect', '1');
				$this->Cpage->saveField('url', $this->request->data['Cpages']['url']);
				$this->Session->setFlash('Page créée avec succès !', 'toastr_success');
				return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit($id){
		if($this->Auth->user('role') > 1){
			if($this->Cpage->findById($id)){
				$this->set('data', $this->Cpage->find('first', ['conditions' => ['Cpage.id' => $id]]));
				if($this->request->is('post')){
					$this->Cpage->id = $id;
					$this->Cpage->saveField('name', $this->request->data['Cpages']['name']);
					if(isset($this->request->data['Cpages']['visible'])){
						$this->Cpage->saveField('visible', $this->request->data['Cpages']['visible']);
					}
					$this->Cpage->saveField('slug', $this->request->data['Cpages']['slug']);
					$this->Cpage->saveField('content', $this->request->data['Cpages']['content']);
					$this->Session->setFlash('Page éditée !', 'toastr_success');
					return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
				}
			}
			else{
				$this->Session->setFlash('Cette page n\'existe pas !', 'toastr_error');
				return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit_redirection($id){
		if($this->Auth->user('role') > 1){
			if($this->Cpage->findById($id)){
				$this->set('data', $this->Cpage->find('first', ['conditions' => ['Cpage.id' => $id]]));
				if($this->request->is('post')){
					$this->Cpage->id = $id;
					$this->Cpage->saveField('name', $this->request->data['Cpages']['name']);
					$this->Cpage->saveField('url', $this->request->data['Cpages']['url']);
					if(isset($this->request->data['Cpages']['visible'])){
						$this->Cpage->saveField('visible', $this->request->data['Cpages']['visible']);
					}
					$this->Session->setFlash('Page éditée !', 'toastr_success');
					return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
				}
			}
			else{
				$this->Session->setFlash('Cette page n\'existe pas !', 'toastr_error');
				return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_list(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Cpage->find('all'));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete($id){
		if($this->Auth->user('role') > 1){
			if($this->Cpage->findById($id)){
				$this->Cpage->delete($id);
				$this->Session->setFlash('Page supprimée !', 'toastr_success');
				return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
			}
			else{
				$this->Session->setFlash('Cette page n\'existe pas !', 'toastr_error');
				return $this->redirect(['controller' => 'cpages', 'action' => 'list']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function read($slug){
		if($this->Cpage->findBySlug($slug)){
			// On récupère les données
			$data = $this->Cpage->findBySlug($slug);
			$content = $data['Cpage']['content'];
			$redirect = $data['Cpage']['redirect'];
			// Si c'est une redirection
			if($redirect == 1){
				$url = $data['Cpage']['url'];
				return $this->redirect($url);
			}
			else{
				// JSONAPI
				$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
				// On récupère le groupe du joueur, return NULL si impossible
				if($api->call('worlds.world.players.player.chat.groups.primary', ['world', $this->Auth->user('username')])[0]['is_success'] == true){
					$group = $api->call('worlds.world.players.player.chat.groups.primary', ['world', $this->Auth->user('username')])[0]['success'];
				}
				else{
					$group = null;
				}
				// On récupère l'argent que possède le joueur sur le serveur, return NULL si impossible
				if($api->call('economy.banks.name.balance', [$this->Auth->user('username')])[0]['is_success'] == true){
					$balance = $api->call('economy.banks.name.balance', [$this->Auth->user('username')])[0]['success']['balance'];
				}
				else{
					$balance = null;
				}
				// On test si l'utilisateur est connecté en jeu
				$online_players = $api->call('players.online.names');
				$player_is_online = in_array($this->Auth->user('username'), "TristanCode");
				// On génère l'url de connexion
				$login = Router::url(['controller' => 'users', 'action' => 'login']);
				// On génère l'ip du serveur
				$ip_port = $this->config['ip_server'].':'.$this->config['port_server'];
				// Si ce pattern existe, on le supprime
				$content = preg_replace("/\[\[\{\{(.*?)\}\}\]\]/i", "$1", $content);
				$content = preg_replace("/\{\{\[\[(.*?)\]\]\}\}/i", "$1", $content);
				// Si on n'est connecté ni au site, ni au jeu
				if(!$this->Auth->user() && !$player_is_online){
					$content = preg_replace("/\{\{(.*?)\}\}/i", "<a href='$login'>[Vous devez être connecté pour voir ceci]</a>", $content);
					$content = preg_replace("/\[\[(.*?)\]\]/i", "<a href='$login'>[Vous devez être connecté au site, et au jeu pour voir ceci]</a>", $content);
					$content = preg_replace("/\(\((.*?)\)\)/i", "$1", $content);
				}
				// Si on n'est pas connecté au site
				elseif(!$this->Auth->user() && $player_is_online){
					$content = preg_replace("/\{\{(.*?)\}\}/i", "<a href='$login'>[Vous devez être connecté pour voir ceci]</a>", $content);
					$content = preg_replace("/\[\[(.*?)\]\]/i", "<a href='$login'>[Vous devez être connecté au site, et au jeu pour voir ceci]</a>", $content);
					$content = preg_replace("/\(\((.*?)\)\)/i", "$1", $content);
				}
				// Si on n'est pas connecté en jeu
				elseif($this->Auth->user() && !$player_is_online){
					$content = preg_replace("/\{\{(.*?)\}\}/i", "$1", $content);
					$content = preg_replace("/\[\[(.*?)\]\]/i", "<a href='$login'>[Vous devez être connecté au site, et au jeu pour voir ceci]</a>", $content);
					$content = preg_replace("/\(\((.*?)\)\)/i", "", $content);
				}
				// Sinon on est connecté partout
				else{
					$content = preg_replace("/\{\{(.*?)\}\}/i", "$1", $content);
					$content = preg_replace("/\[\[(.*?)\]\]/i", "$1", $content);
					$content = preg_replace("/\(\((.*?)\)\)/i", "", $content);
				}
				if($group != null){
					$content = str_replace('%groupe%', $group, $content);
				}
				else{
					$content = str_replace('%groupe%', 'inconnu', $content);
				}
				if($balance != null){
					$content = str_replace('%money%', $balance, $content);
				}
				else{
					$content = str_replace('%money%', 'inconnu', $content);
				}
				$content = str_replace('%pseudo%', $this->Auth->user('username'), $content);
				$content = str_replace('%email%', $this->Auth->user('email'), $content);
				$content = str_replace('%tokens%', $this->Auth->user('tokens'), $content);
				$content = str_replace('%ip_port%', $ip_port, $content);
				$content = str_replace('%ip%', $this->config['ip_server'], $content);
				$content = str_replace('%port%', $this->config['port_server'], $content);
	            $this->set('content', $content);
				$this->set('data', $data);
			}
		}
		else{
			throw new NotFoundException();
		}
	}
}