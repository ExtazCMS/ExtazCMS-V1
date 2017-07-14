<?php
class ShopsController extends AppController {

	public $uses = ['Shop', 'User', 'Informations', 'starpassHistory', 'shopHistory', 'donationLadder', 'shopCategories'];

	var $paginate = array(
		'Shop' => array(
			'limit' => 30,
			'conditions' => array(
				'Shop.visible' => '1'
			),
			'order' => array(
				'Shop.id' => 'ASC'
			),
			'paramType'=> 'named'
		));

	/*public function index(){
		// Si la boutique est activée
		if($this->config['use_store'] == 1){
			// Pagination
			$q = $this->paginate('Shop');
			$this->set('items', $q);
			$this->set('nb_items', $this->Shop->find('count', ['conditions' => ['Shop.visible' => '1']]));
			$this->set('categories', $this->shopCategories->find('all', ['order' => ['shopCategories.id ASC']]));
		}
		// Si la boutique est désactivée
		else{
			throw new NotFoundException();
		}
	} */
	public function index(){
	    // Si l'utilisateur est connecté
		if($this->Auth->user()){
		// Si la boutique est activée
		if($this->config['use_store'] == 1){
			// Pagination
			$q = $this->paginate('Shop');
			$this->set('items', $q);
			$this->set('nb_items', $this->Shop->find('count', ['conditions' => ['Shop.visible' => '1']]));
			$this->set('categories', $this->shopCategories->find('all', ['order' => ['shopCategories.id ASC']]));
		}
		// Si la boutique est désactivée
		else{
			throw new NotFoundException();
		}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login']);
		}
	}

	public function promo() {
		// Si la boutique est activée
		if($this->config['use_store'] == 1){
			// Pagination
			$items = $this->Shop->find('all', ['conditions' => ['Shop.promo != -1', 'Shop.visible' => '1']]);
			$this->set('items', $items);
			$this->set('nb_items', $this->Shop->find('count', ['conditions' => ['Shop.promo != -1', 'Shop.visible' => '1']]));
			$this->set('categories', $this->shopCategories->find('all', ['order' => ['shopCategories.id ASC']]));
		}
		// Si la boutique est désactivée
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add(){
		if($this->Auth->user('role') > 1){
			$this->set('list_item', $this->Shop->find('all', ['fields' => ['name', 'id']]));
			$this->set('categories', $this->shopCategories->find('all', ['order' => ['shopCategories.id ASC']]));
			if($this->request->is('post')){
				$this->Shop->set($this->request->data);
				if($this->Shop->validates()){
					$this->Shop->create;
					$this->Shop->save($this->request->data);
					$this->Shop->saveField('visible', '1');
					if($this->config['use_server_money'] == 0){
						$this->Shop->saveField('price_money_server', '-1');
					}
					if(!isset($this->request->data['Shop']['cat'])){
						$this->Shop->saveField('cat', '0');
					}
					if(!isset($this->request->data['Shop']['needonline'])){
						$this->Shop->saveField('needonline', '1');
					}
					if(!isset($this->request->data['Shop']['promo'])){
						$this->Shop->saveField('promo', '-1');
					}
					if(isset($this->request->data['Shop']['required'])){
						$explode = explode('--', $this->request->data['Shop']['required']);
						$required = $explode[0];
						$required_name = $explode[1];
						$this->Shop->saveField('required', $required);
						$this->Shop->saveField('required_name', $required_name);
					}
					else{
						$this->Shop->saveField('required', '-1');
						$this->Shop->saveField('required_name', 'Aucun');
					}
					$this->Session->setFlash('Article ajouté à la boutique !', 'toastr_success');
					return $this->redirect(['controller' => 'shops', 'action' => 'list', 'admin' => true]);
				}
				else{
					$this->Session->setFlash('Une erreur est survenue !', 'toastr_error');
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_list(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Shop->find('all', array('order' => array('Shop.created' => 'DESC'))));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit($id){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Shop->find('first', ['conditions' => ['Shop.id' => $id]]));
			$this->set('list_item', $this->Shop->find('all', ['conditions' => ['Shop.id !=' => $id], 'fields' => ['name', 'id']]));
			$this->set('categories', $this->shopCategories->find('all', ['order' => ['shopCategories.id ASC']]));
			if($this->request->is('post')){
				$this->Shop->set($this->request->data);
				if($this->Shop->validates()){
					$this->Shop->id = $id;
					$this->Shop->save($this->request->data);
					if(isset($this->request->data['Shop']['required'])){
						$explode = explode('--', $this->request->data['Shop']['required']);
						$required = $explode[0];
						$required_name = $explode[1];
						$this->Shop->saveField('required', $required);
						$this->Shop->saveField('required_name', $required_name);
					}
					$this->Session->setFlash('Article modifié !', 'toastr_success');
					return $this->redirect(['controller' => 'shops', 'action' => 'list']);
				}
				else{
					$this->Session->setFlash('Une erreur est survenue !', 'toastr_error');
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function delete($id){
		if($this->Auth->user('role') > 1){
			$this->Shop->delete($id);
			$this->Session->setFlash('Article supprimé !', 'success');
			return $this->redirect($this->referer());
		}
		else{
			throw new NotFoundException();
		}
	}

	public function reload(){
		if(!$this->Auth->user()){
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function search() {
		$min = 3; // Nombre de carac minimum
		$max = 40; // Nombre de carac maximum
		// Si une recherche a été effectuée
		if(isset($this->request->data['Shop']['search'])){
			$this->set('request', $this->request->data['Shop']['search']);
			// Si la recherche n'est pas trop courte ou n'est pas trop longue
			if(strlen($this->request->data['Shop']['search']) >= $min && strlen($this->request->data['Shop']['search']) <= $max){
				// On va chercher les articles qui correspondent à la recherche
				$this->set('items', $this->Shop->find('all', ['conditions' => ['Shop.name LIKE' => '%'.$this->request->data['Shop']['search'].'%', 'Shop.visible' => '1', 'Shop.price_money_server > -1', 'Shop.price_money_site > -1'], 'order' => ['Shop.created DESC']]));
				// Et on compte combien d'articles correspondent à la recherche
				$this->set('nb_items', $this->Shop->find('count', ['conditions' => ['Shop.name LIKE' => '%'.$this->request->data['Shop']['search'].'%', 'Shop.visible' => '1', 'Shop.price_money_server > -1', 'Shop.price_money_site > -1'], 'order' => ['Shop.created DESC']]));
			}
			// Si la recherche est trop courte ou trop longue
			else{
				$this->set('nb_items', 0);
				$this->Session->setFlash('Faites une recherche qui contient entre '.$min.' et '.$max.' caractères', 'warning');
			}
		}
		// Si aucune recherche n'a été effectuée
		else{
			throw new NotFoundException();
		}
	}

	public function starpass() {
		if($this->Auth->user()){
			if($this->request->is('post')){
				// Déclaration des variables
				$ident = $idp = $ids = $idd = $code = $code1 = $datas = ''; 
				$idp = $this->config['starpass_idp'];
				$idd = $this->config['starpass_idd'];
				$ident = $idp.';'.$ids.';'.$idd;
				// On récupère le code
				if(isset($this->request->data['code1'])){
					$code = $this->request->data['code1'];
				}
				// On récupère le champ DATAS
				$datas = '';
				// On encode les trois chaines en URL
				$ident = urlencode($ident);
				$code = urlencode($code);
				$datas = urlencode($datas);
				// Envoi de la requête vers le serveur StarPass
				// Dans la variable tab[0] on récupère la réponse du serveur
				// Dans la variable tab[1] on récupère l'URL d'accès ou d'erreur suivant la réponse du serveur
				$get_f = file("http://script.starpass.fr/check_php.php?ident=$ident&codes=$code&DATAS=$datas"); 
				if(!$get_f){ 
					exit('Votre serveur n\'a pas accès au serveur de Starpass, merci de contacter votre hébergeur.'); 
				} 
				$tab = explode('|',$get_f[0]);
				if(!$tab[1]){
					$url = 'http://script.starpass.fr/error.php';
				}
				else{
					$url = $tab[1];
				}
				// Si $tab[0] ne répond pas "OUI" l'accès est refusé
				if(substr($tab[0],0,3) != 'OUI'){ 
			       $this->Session->setFlash('Code eronné', 'error');
				} 
				else{
					// On recup les infos de l'utlisateur
					$user = $this->User->find('first', ['conditions' => ['User.username' => $this->Auth->user('username')]]);
					$user_tokens = $user['User']['tokens'];
					// On définit son nv nb de tokens
					$starpass_tokens = $this->config['starpass_tokens'];
					if($this->config['happy_hour'] == 1){
						$new_user_tokens = $user_tokens + $this->starpass_tokens_during_happy_hour;
					}
					else{
						$new_user_tokens = $user_tokens + $starpass_tokens;
					}
					$this->User->id = $this->Auth->user('id');
					$this->User->saveField('tokens', $new_user_tokens);
					// Historique
					$this->starpassHistory->create;
					$this->starpassHistory->saveField('user_id', $this->Auth->user('id'));
					$this->starpassHistory->saveField('code', $this->request->data['code1']);
					if($this->config['happy_hour'] == 1){
						$this->starpassHistory->saveField('tokens', $this->starpass_tokens_during_happy_hour);
						$this->starpassHistory->saveField('note', 'Happy hour');
					}
					else{
						$this->starpassHistory->saveField('tokens', $starpass_tokens);
						$this->starpassHistory->saveField('note', 'Classique');
					}
					// Donation ladder
					if($this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $this->Auth->user('id')]])){
						if($this->config['happy_hour'] == 1){
							$donationLadder = $this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $this->Auth->user('id')]]);
							$new_tokens = $donationLadder['donationLadder']['tokens'] + $this->starpass_tokens_during_happy_hour;
							$this->donationLadder->id = $donationLadder['donationLadder']['id'];
							$this->donationLadder->saveField('tokens', $new_tokens);
						}
						else{
							$donationLadder = $this->donationLadder->find('first', ['conditions' => ['donationLadder.user_id' => $this->Auth->user('id')]]);
							$new_tokens = $donationLadder['donationLadder']['tokens'] + $starpass_tokens;
							$this->donationLadder->id = $donationLadder['donationLadder']['id'];
							$this->donationLadder->saveField('tokens', $new_tokens);
						}
					}
					else{
						if($this->config['happy_hour'] == 1){
							$this->donationLadder->create;
							$this->donationLadder->saveField('user_id', $this->Auth->user('id'));
							$this->donationLadder->saveField('tokens', $this->starpass_tokens_during_happy_hour);
						}
						else{
							$this->donationLadder->create;
							$this->donationLadder->saveField('user_id', $this->Auth->user('id'));
							$this->donationLadder->saveField('tokens', $starpass_tokens);
						}
					}
					$this->Session->setFlash('Merci de votre confiance, vous avez maintenant '.$new_user_tokens.' '.$this->config['site_money'].' !', 'success');
				}
			}
			else{
				$this->Session->setFlash('Ridicule...', 'error');
			}
			return $this->redirect(['controller' => 'shops', 'action' => 'reload']);
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'shops', 'action' => 'reload']);
		}
	}

	public function buy(){
		$id = $this->request->data['Shop']['id'];
		$itemid = $this->Shop->find('first', ['conditions' => ['Shop.id' => $id]]);
		$online = $itemid['Shop']['needonline'];
		$money = $this->request->data['Shop']['money'];
		$quantity = $this->request->data['Shop']['quantity'];
		// JSONAPI
		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
		if($online == 1){
			// On test si le joueur est en ligne
			$online_players = $api->call('players.online.names');
			$player_is_online = in_array($this->Auth->user('username'), $online_players[0]['success']);
			// Si l'utilisateur est connecté en jeu
			if($player_is_online){
				// Si l'utlisateur est co au site
				if($this->Auth->user()){
					// Si la quatité est valide
					if($quantity >= 1 && $quantity <= 250){
						// Si l'item existe
						if($this->Shop->findById($id)){
							// Si la boutique est activée
							if($this->config['use_store'] == 1){
								// Si l'utilisateur paye avec la monnaie du site
								if($money == 'site'){
									// On recupère les infos de l'utlisateur
									$user = $this->User->find('first', ['conditions' => ['User.username' => $this->Auth->user('username')]]);
									// Le nombre de tokens que possède l'utilisateur
									$user_tokens = $user['User']['tokens'];
									// On recupère les infos de l'item
									$item = $this->Shop->find('first', ['conditions' => ['Shop.id' => $id]]);
									// Cout de l'achat avec la monnaie du site
									$price = $item['Shop']['price_money_site'];
									if($price == -1){
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
										exit();
									}
									else{
										$price = $item['Shop']['price_money_site'] * $quantity;
									}
									// Promotion du produit
									$promo = $item['Shop']['promo'];
									if($promo != -1){
										$promo = round($price / 100 * $promo);
										$price = $price - $promo;
									}
									// Si l'utilisateur a assez
									if($user_tokens >= $price){
										// S'il y a un prérequis pour cet achat
										if($item['Shop']['required'] != -1){
											$item_required = $this->Shop->find('first', ['conditions' => ['Shop.id' => $item['Shop']['required']]]);
											$item_required_id = $item_required['Shop']['id'];
											$item_required_name = $item_required['Shop']['name'];
											// Si l'utilisateur n'a pas le prérequis
											if(!$this->shopHistory->find('first', ['conditions' => ['user_id' => $this->Auth->user('id'), 'item_id' => $item_required_id]])){
												$this->Session->setFlash('Cet achat a un prérequis vous devez d\'abord acheter <u>'.$item_required_name.'</u>', 'error');
												return $this->redirect(['controller' => 'shops', 'action' => 'index']);
											}
										}
										// Historique d'achat
										$this->shopHistory->create;
										$this->shopHistory->saveField('user_id', $this->Auth->user('id'));
										$this->shopHistory->saveField('item', $item['Shop']['name']);
										$this->shopHistory->saveField('item_id', $item['Shop']['id']);
										$this->shopHistory->saveField('price', $price);
										$this->shopHistory->saveField('money', $money);
										$this->shopHistory->saveField('quantity', $quantity);
										// On définit son nv nb de tokens
										$new_user_tokens = $user_tokens - $price;
										$this->User->id = $this->Auth->user('id');
										$this->User->saveField('tokens', $new_user_tokens);
										// On execute la/les commande(s)

									    $command = str_replace('%player%', $this->Auth->user('username'), $item['Shop']['command']);
									    if (strstr($item['Shop']['command'], '&&&')) {
										$new_command = explode('&&&', $command);
									    }
									    for($i=0; $i < $quantity; $i++) {
										if(is_array($new_command)) {
										    foreach ($new_command as $c) {
											$api->call('server.run_command', [trim($c)]);
										    }
										} else {
										    $api->call('server.run_command', [$command]);
										}
									    }
									    // On redirige avec un message
										$this->Session->setFlash('Achat effectué, vous avez depensé '.$price.' '.$this->config['site_money'].'', 'success');
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
									}
									// Si l'utilisateur n'a pas assez
									else{
										$this->Session->setFlash('Vous n\'avez pas assez de '.$this->config['site_money'].'', 'error');
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
									}
								}
								// L'utilisateur paye avec la monnaie du serveur
								else{
									// Si l'utilisation de la monnaie du serveur est activée
									if($this->config['use_economy'] == 1 && $this->config['use_server_money'] == 1){
										// On recupère les infos de l'utlisateur
										$user = $this->User->find('first', ['conditions' => ['User.username' => $this->Auth->user('username')]]);
										// L'argent que possède l'utilisateur sur le serveur
										$user_server_money = $api->call('players.name.bank.balance', [$this->Auth->user('username')])[0]['success'];
										// On recupère les infos de l'item
										$item = $this->Shop->find('first', ['conditions' => ['Shop.id' => $id]]);
										// Cout de l'achat avec la monnaie du serveur
										$price = $item['Shop']['price_money_server'];
										if($price == -1){
											return $this->redirect(['controller' => 'shops', 'action' => 'index']);
											exit();
										}
										else{
											$price = $item['Shop']['price_money_server'] * $quantity;
										}
										$promo = $item['Shop']['promo'];
										if($promo != -1){
											$promo = round($price / 100 * $promo);
											$price = $price - $promo;
										}
										// Si l'utilisateur a assez
										if($user_server_money >= $price){
											// S'il y a un prérequis pour cet achat
											if($item['Shop']['required'] != -1){
												$item_required = $this->Shop->find('first', ['conditions' => ['Shop.id' => $item['Shop']['required']]]);
												$item_required_id = $item_required['Shop']['id'];
												$item_required_name = $item_required['Shop']['name'];
												// Si l'utilisateur n'a pas le prérequis
												if(!$this->shopHistory->find('first', ['conditions' => ['user_id' => $this->Auth->user('id'), 'item_id' => $item_required_id]])){
													$this->Session->setFlash('Cet achat a un prérequis vous devez d\'abord acheter <u>'.$item_required_name.'</u>', 'error');
													return $this->redirect(['controller' => 'shops', 'action' => 'index']);
												}
											}
											// Historique d'achat
											$this->shopHistory->create;
											$this->shopHistory->saveField('user_id', $this->Auth->user('id'));
											$this->shopHistory->saveField('item', $item['Shop']['name']);
											$this->shopHistory->saveField('item_id', $item['Shop']['id']);
											$this->shopHistory->saveField('price', $price);
											$this->shopHistory->saveField('money', $money);
											$this->shopHistory->saveField('quantity', $quantity);
											// On fait payer l'utilisateur sur le serveur
											$api->call('players.name.bank.withdraw', [$this->Auth->user('username'), $price]);
											// On execute la/les commande(s)
										    $command = str_replace('%player%', $this->Auth->user('username'), $item['Shop']['command']);
										    if (strstr($item['Shop']['command'], '&&&')) {
											$new_command = explode('&&&', $command);
										    }
										    for($i=0; $i < $quantity; $i++) {
											if(is_array($new_command)) {
											    foreach ($new_command as $c) {
												$api->call('server.run_command', [trim($c)]);
											    }
											} else {
											    $api->call('server.run_command', [$command]);
											}
										    }
											// On redirige avec un message
											$this->Session->setFlash('Achat effectué, vous avez depensé '.$price.' '.$this->config['money_server'].'', 'success');
											return $this->redirect(['controller' => 'shops', 'action' => 'index']);
										}
										// Si l'utilisateur n'a pas assez
										else{
											$this->Session->setFlash('Vous n\'avez pas assez de '.$this->config['money_server'].'', 'error');
											return $this->redirect(['controller' => 'shops', 'action' => 'index']);
										}
									}
									// Si l'utilisation de la monnaie du serveur est désactivée
									else{
										$this->Session->setFlash('Action impossible', 'error');
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
									}
								}
							// Si la boutique n'est pas activé
							}
							else{
								$this->Session->setFlash('Désolé mais la boutique est désactivé, contactez un administrateur', 'error');
								return $this->redirect(['controller' => 'shops', 'action' => 'index']);
							}
						}
						// Si l'item n'existe pas
						else{
							$this->Session->setFlash('Cet article n\'existe pas !', 'error');
							return $this->redirect(['controller' => 'shops', 'action' => 'index']);
						}
					// Si la quantité est invalide
					}
					else{
						$this->Session->setFlash('Quantité invalide', 'error');
						return $this->redirect(['controller' => 'shops', 'action' => 'index']);
					}
				// Si l'utlisateur n'est pas co au site
				}
				else{
					$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
					return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
				}
			// Si l'utlisateur n'est pas co en jeu
			}
			else{
				$this->Session->setFlash('Vous devez être connecté en jeu pour faire un achat', 'error');
				return $this->redirect(['controller' => 'shops', 'action' => 'index']);
			}
		} else {
			// Si l'utlisateur est co au site
			if($this->Auth->user()){
				// Si la quatité est valide
				if($quantity >= 1 && $quantity <= 250){
					// Si l'item existe
					if($this->Shop->findById($id)){
						// Si la boutique est activée
						if($this->config['use_store'] == 1){
							// Si l'utilisateur paye avec la monnaie du site
							if($money == 'site'){
								// On recupère les infos de l'utlisateur
								$user = $this->User->find('first', ['conditions' => ['User.username' => $this->Auth->user('username')]]);
								// Le nombre de tokens que possède l'utilisateur
								$user_tokens = $user['User']['tokens'];
								// On recupère les infos de l'item
								$item = $this->Shop->find('first', ['conditions' => ['Shop.id' => $id]]);
								// Cout de l'achat avec la monnaie du site
								$price = $item['Shop']['price_money_site'];
								if($price == -1){
									return $this->redirect(['controller' => 'shops', 'action' => 'index']);
									exit();
								}
								else{
									$price = $item['Shop']['price_money_site'] * $quantity;
								}
								// Promotion du produit
								$promo = $item['Shop']['promo'];
								if($promo != -1){
									$promo = round($price / 100 * $promo);
									$price = $price - $promo;
								}
								// Si l'utilisateur a assez
								if($user_tokens >= $price){
									// S'il y a un prérequis pour cet achat
									if($item['Shop']['required'] != -1){
										$item_required = $this->Shop->find('first', ['conditions' => ['Shop.id' => $item['Shop']['required']]]);
										$item_required_id = $item_required['Shop']['id'];
										$item_required_name = $item_required['Shop']['name'];
										// Si l'utilisateur n'a pas le prérequis
										if(!$this->shopHistory->find('first', ['conditions' => ['user_id' => $this->Auth->user('id'), 'item_id' => $item_required_id]])){
											$this->Session->setFlash('Cet achat a un prérequis vous devez d\'abord acheter <u>'.$item_required_name.'</u>', 'error');
											return $this->redirect(['controller' => 'shops', 'action' => 'index']);
										}
									}
									// Historique d'achat
									$this->shopHistory->create;
									$this->shopHistory->saveField('user_id', $this->Auth->user('id'));
									$this->shopHistory->saveField('item', $item['Shop']['name']);
									$this->shopHistory->saveField('item_id', $item['Shop']['id']);
									$this->shopHistory->saveField('price', $price);
									$this->shopHistory->saveField('money', $money);
									$this->shopHistory->saveField('quantity', $quantity);
									// On définit son nv nb de tokens
									$new_user_tokens = $user_tokens - $price;
									$this->User->id = $this->Auth->user('id');
									$this->User->saveField('tokens', $new_user_tokens);
									// On execute la/les commande(s)
								    $command = str_replace('%player%', $this->Auth->user('username'), $item['Shop']['command']);
								    if (strstr($item['Shop']['command'], '&&&')) {
									$new_command = explode('&&&', $command);
								    }
								    for($i=0; $i < $quantity; $i++) {
									if(is_array($new_command)) {
									    foreach ($new_command as $c) {
										$api->call('server.run_command', [trim($c)]);
									    }
									} else {
									    $api->call('server.run_command', [$command]);
									}
								    }
									// On redirige avec un message
									$this->Session->setFlash('Achat effectué, vous avez depensé '.$price.' '.$this->config['site_money'].'', 'success');
									return $this->redirect(['controller' => 'shops', 'action' => 'index']);
								}
								// Si l'utilisateur n'a pas assez
								else{
									$this->Session->setFlash('Vous n\'avez pas assez de '.$this->config['site_money'].'', 'error');
									return $this->redirect(['controller' => 'shops', 'action' => 'index']);
								}
							}
							// L'utilisateur paye avec la monnaie du serveur
							else{
								// Si l'utilisation de la monnaie du serveur est activée
								if($this->config['use_economy'] == 1 && $this->config['use_server_money'] == 1){
									// On recupère les infos de l'utlisateur
									$user = $this->User->find('first', ['conditions' => ['User.username' => $this->Auth->user('username')]]);
									// L'argent que possède l'utilisateur sur le serveur
									$user_server_money = $api->call('players.name.bank.balance', [$this->Auth->user('username')])[0]['success'];
									// On recupère les infos de l'item
									$item = $this->Shop->find('first', ['conditions' => ['Shop.id' => $id]]);
									// Cout de l'achat avec la monnaie du serveur
									$price = $item['Shop']['price_money_server'];
									if($price == -1){
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
										exit();
									}
									else{
										$price = $item['Shop']['price_money_server'] * $quantity;
									}
									$promo = $item['Shop']['promo'];
									if($promo != -1){
										$promo = round($price / 100 * $promo);
										$price = $price - $promo;
									}
									// Si l'utilisateur a assez
									if($user_server_money >= $price){
										// S'il y a un prérequis pour cet achat
										if($item['Shop']['required'] != -1){
											$item_required = $this->Shop->find('first', ['conditions' => ['Shop.id' => $item['Shop']['required']]]);
											$item_required_id = $item_required['Shop']['id'];
											$item_required_name = $item_required['Shop']['name'];
											// Si l'utilisateur n'a pas le prérequis
											if(!$this->shopHistory->find('first', ['conditions' => ['user_id' => $this->Auth->user('id'), 'item_id' => $item_required_id]])){
												$this->Session->setFlash('Cet achat a un prérequis vous devez d\'abord acheter <u>'.$item_required_name.'</u>', 'error');
												return $this->redirect(['controller' => 'shops', 'action' => 'index']);
											}
										}
										// Historique d'achat
										$this->shopHistory->create;
										$this->shopHistory->saveField('user_id', $this->Auth->user('id'));
										$this->shopHistory->saveField('item', $item['Shop']['name']);
										$this->shopHistory->saveField('item_id', $item['Shop']['id']);
										$this->shopHistory->saveField('price', $price);
										$this->shopHistory->saveField('money', $money);
										$this->shopHistory->saveField('quantity', $quantity);
										// On fait payer l'utilisateur sur le serveur
										$api->call('players.name.bank.withdraw', [$this->Auth->user('username'), $price]);
										// On execute la/les commande(s)
									    $command = str_replace('%player%', $this->Auth->user('username'), $item['Shop']['command']);
									    if (strstr($item['Shop']['command'], '&&&')) {
										$new_command = explode('&&&', $command);
									    }
									    for($i=0; $i < $quantity; $i++) {
										if(is_array($new_command)) {
										    foreach ($new_command as $c) {
											$api->call('server.run_command', [trim($c)]);
										    }
										} else {
										    $api->call('server.run_command', [$command]);
										}
									    }
										// On redirige avec un message
										$this->Session->setFlash('Achat effectué, vous avez depensé '.$price.' '.$this->config['money_server'].'', 'success');
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
									}
									// Si l'utilisateur n'a pas assez
									else{
										$this->Session->setFlash('Vous n\'avez pas assez de '.$this->config['money_server'].'', 'error');
										return $this->redirect(['controller' => 'shops', 'action' => 'index']);
									}
								}
								// Si l'utilisation de la monnaie du serveur est désactivée
								else{
									$this->Session->setFlash('Action impossible', 'error');
									return $this->redirect(['controller' => 'shops', 'action' => 'index']);
								}
							}
						// Si la boutique n'est pas activé
						}
						else{
							$this->Session->setFlash('Désolé mais la boutique est désactivé, contactez un administrateur', 'error');
							return $this->redirect(['controller' => 'shops', 'action' => 'index']);
						}
					}
					// Si l'item n'existe pas
					else{
						$this->Session->setFlash('Cet article n\'existe pas !', 'error');
						return $this->redirect(['controller' => 'shops', 'action' => 'index']);
					}
				// Si la quantité est invalide
				}
				else{
					$this->Session->setFlash('Quantité invalide', 'error');
					return $this->redirect(['controller' => 'shops', 'action' => 'index']);
				}
			// Si l'utlisateur n'est pas co au site
			}
			else{
				$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
				return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
			}
		}
	}

	public function admin_add_prerequisite(){
		if($this->Auth->user('role') > 1){
			$user_id = $this->request->data['Shop']['user_id'];
			$item_id = $this->request->data['Shop']['item'];
			if($this->Shop->findById($item_id)){
				$item = $this->Shop->find('first', ['conditions' => ['Shop.id' => $item_id]]);
				$item_name = $item['Shop']['name'];
				$this->shopHistory->create;
				$this->shopHistory->saveField('user_id', $user_id);
				$this->shopHistory->saveField('item', $item_name);
				$this->shopHistory->saveField('item_id', $item_id);
				$this->shopHistory->saveField('price', '0');
				$this->shopHistory->saveField('money', '['.$this->Auth->user('username').']');
				$this->shopHistory->saveField('quantity', '1');
				$this->Session->setFlash('Prérequis octroyé', 'toastr_success');
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
