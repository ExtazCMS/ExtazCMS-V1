<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = ['Informations', 'shopHistory', 'starpassHistory', 'paypalHistory', 'Team', 'Support', 'supportComments', 'donationLadder', 'shopCategories', 'sendTokensHistory'];

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */

	public function beforeFilter(){
	    parent::beforeFilter();
        $this->Auth->allow();
	}

	public function display() {
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;
		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}

	public function admin_send_tokens_history(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->sendTokensHistory->find('all', ['order' => ['sendTokensHistory.id DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_send_tokens_delete($id){
		if($this->Auth->user('role') > 1){
			if($this->sendTokensHistory->findById($id)){
				$this->sendTokensHistory->delete($id);
				$this->Session->setFlash('Action effectuée !', 'toastr_success');
				return $this->redirect($this->referer());
			}
			else{
				$this->Session->setFlash('Action impossible !', 'toastr_error');
				return $this->redirect($this->referer());
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function send_tokens(){
		if($this->Auth->user()){
			if($this->request->is('post')){
				$shipper = strtolower($this->Auth->user('username'));
				$shipper_username = $this->Auth->user('username');
				$recipient = strtolower($this->request->data['Pages']['username']);
				$user_inf = $this->User->find('first', ['conditions' => ['User.username' => $recipient]]);
				$ban_recipient = $user_inf['User']['ban'];
				$recipient_username = $this->request->data['Pages']['username'];
				$nb_tokens = $this->request->data['Pages']['nb_tokens'];
				$nb_tokens = str_replace('-', '', $nb_tokens);

				// Si c'est un nombre
				if(is_numeric($nb_tokens)){
					// Si l'expéditeur est différent du destinataire
					if($shipper != $recipient){
						// Si le destinataire existe (c'est mieux)
						if($this->User->find('first', ['conditions' => ['User.username' => $recipient]])){
							// Si le destinataire est banni
							if($ban_recipient != 1){
								// Si l'expéditeur à assez de tokens
								if($nb_tokens <= $this->tokens){
									// On récupère les infos
									$shipper_tokens = $this->tokens;
									$shipper_id = $this->Auth->user('id');
									$tax_percent = $this->config['tax_percent'];
									$user_infos = $this->User->find('first', ['conditions' => ['User.username' => $recipient]]);
									$user_tokens = $user_infos['User']['tokens'];
									$user_id = $user_infos['User']['id'];
									// On calcul le nouveau nb de tokens
									$new_shipper_tokens = $shipper_tokens - $nb_tokens;
									$tax = round(($nb_tokens / 100) * $tax_percent);
									$add_user_tokens_taxed = $nb_tokens - $tax;
									$new_user_tokens = $user_tokens + $add_user_tokens_taxed;
									// On définit le nv nb de tokens de l'expéditeur
									$this->User->id = $shipper_id;
										$this->User->saveField('tokens', $new_shipper_tokens);
									// On définit le nv nb de tokens du destinataire
									$this->User->id = $user_id;
									$this->User->saveField('tokens', $new_user_tokens);
									// Historique
									$this->sendTokensHistory->create;
									$this->sendTokensHistory->saveField('shipper', $shipper_username);
									$this->sendTokensHistory->saveField('recipient', $recipient_username);
									$this->sendTokensHistory->saveField('nb_tokens', $nb_tokens);
									$this->sendTokensHistory->saveField('loss_rate', $tax_percent.'%');
									$this->sendTokensHistory->saveField('nb_tokens_with_loss_rate', $add_user_tokens_taxed);
									// Message et redirection
									if($tax_percent == 0){
									$this->Session->setFlash(''.$recipient_username.' a reçu '.$add_user_tokens_taxed.' '.$this->config['site_money'].'', 'success');
									} else {
									$this->Session->setFlash(''.$recipient_username.' a reçu '.$add_user_tokens_taxed.' '.$this->config['site_money'].'. '.$tax.' '.$this->config['site_money'].' de la somme envoyé ont été retenus!', 'success');
									}
									return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'send_tokens'], 'admin' => false]);
								}
								else{
									$this->Session->setFlash('Vous n\'avez pas assez de tokens', 'error');
									return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'send_tokens'], 'admin' => false]);
								}
							} else {
							$this->Session->setFlash('Le destinataire est banni', 'error');
							return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'send_tokens'], 'admin' => false]);
							}
						}
						else{
							$this->Session->setFlash('Le destinataire n\'existe pas', 'error');
							return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'send_tokens'], 'admin' => false]);
						}
					}
					else{
						$this->Session->setFlash('Vous ne pouvez pas vous envoyer des '.$this->config['site_money'].' vous même...', 'error');
						return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'send_tokens'], 'admin' => false]);
					}
				}
				else{
					$this->Session->setFlash('Erreur', 'error');
					return $this->redirect(['controller' => 'users', 'action' => 'account', '?' => ['tab' => 'send_tokens'], 'admin' => false]);
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function admin_edit_shop_categories($id) {
		if($this->Auth->user('role') > 1){
			if($this->shopCategories->findById($id)){
				$this->set('data', $this->shopCategories->findById($id));
				if($this->request->is('post')){
					if(!empty($this->request->data['Pages']['name'])){
						$this->shopCategories->id = $id;
						$name = ucfirst($this->request->data['Pages']['name']);
						$this->shopCategories->saveField('name', $name);
						$this->Session->setFlash('Catégorie modifiée avec succès !', 'toastr_success');
						return $this->redirect(['controller' => 'pages', 'action' => 'list_shop_categories']);
					}
					else{
						$this->Session->setFlash('Vous devez renseigner une catégorie !', 'toastr_error');
						return $this->redirect(['controller' => 'pages', 'action' => 'edit_shop_categories', 'id' => $id]);
					}
				}
			}
			else{
				$this->Session->setFlash('Cette catégorie n\'existe pas', 'toastr_error');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_shop_categories']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete_shop_categories($id) {
		if($this->Auth->user('role') > 1){
			if($this->shopCategories->findById($id)){
				$this->shopCategories->delete($id);
				$this->Session->setFlash('Catégorie supprimée avec succès !', 'toastr_success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_shop_categories']);
			}
			else{
				$this->Session->setFlash('Action impossible !', 'toastr_error');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_shop_categories']);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add_shop_categories() {
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				if(!empty($this->request->data['Pages']['name'])){
					$this->shopCategories->create;
					$name = ucfirst($this->request->data['Pages']['name']);
					$this->shopCategories->saveField('name', $name);
					$this->Session->setFlash('Catégorie créée avec succès !', 'toastr_success');
					return $this->redirect(['controller' => 'pages', 'action' => 'list_shop_categories']);
				}
				else{
					$this->Session->setFlash('Vous devez renseigner une catégorie !', 'toastr_error');
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_list_shop_categories() {
		if($this->Auth->user('role') > 1){
			$categories = $this->shopCategories->find('all');
			$nb_categories = $this->shopCategories->find('count');
			$this->set('categories', $categories);
			$this->set('nb_categories', $nb_categories);
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_chat_update(){
			if($this->request->is('ajax')){
    			$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
				$data = '<i class="fa fa-clock-o"></i> Dernière mise à jour à '.date('H:i:s').', il y a '.$api->call('players.online.count')[0]['success'].' joueur(s) connecté(s)';
				echo json_encode($data);
				exit();
			}
    }

	public function admin_chat_messages(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('ajax')){
				$data = '';
    			$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
				$messages = $api->call('streams.chat.latest', [100])[0]['success'];
				if(count($messages) >= 1){
					foreach($messages as $m){
						if(empty($m['player'])){
							$explode = explode(']', $m['message']);
							$explode = str_replace('[', '', $explode);
							$player = $explode[0];
							$message = $explode[1];
						}
						else{
							$player = $m['player'];
							$message = $m['message'];
						}
						$data .='<small>['.date('H:i:s', $m['time']).']</small> <b class="player" id="'.$player.'"> '.$player.'</b> '.$message.'<br>';
					}
				}
				else{
					$data = '<div class="alert alert-warning alert-dismissable"><small>Désolé mais il n\'y a pas assez de messages pour afficher le chat (minimum '.$this->config['chat_nb_messages'].')</small></div>';
				}
				echo json_encode($data);
				exit();
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_send_message(){
		if($this->Auth->user('role') >1 ) {
			if($this->request->is('ajax')){
	    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
				$message = trim(str_replace('/', '', $this->request->data['message']));
				if(empty($this->config['chat_prefix'])){
					$prefix = '';
					$command = '['.$this->Auth->user('username').'] '.$message;
				}
				else{
					$prefix = '('.$this->config['chat_prefix'].') ';
					$command = $prefix.'['.$this->Auth->user('username').'] '.$message;
				}
				if(!empty($message)){
					$data['result'] = 'success';
					$api->call('chat.broadcast', [$command]);
				}
				else{
					$data['result'] = 'error';
				}
				echo json_encode($data);
				exit();
				
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_send_command(){
		if($this->request->is('ajax')){
    		$api = new JSONAPI($this->config['jsonapi_ip'], $this->config['jsonapi_port'], $this->config['jsonapi_username'], $this->config['jsonapi_password'], $this->config['jsonapi_salt']);
			$command = trim(str_replace('/', '', $this->request->data['command']));
			if($this->Auth->user('role') > 1){
				if(!empty($command) && $api->call('server.run_command', [$command])){
					$data['result'] = 'success';
					$data['message'] = 'Commande envoyée au serveur !';
				}
				else{
					$data['result'] = 'error';
					$data['message'] = 'Erreur';
				}
			}
			else{
				$data['result'] = 'error';
				$data['message'] = 'Action non autorisée';
			}
			echo json_encode($data);
			exit();
		}
	}

	public function admin_edit_donator($id = null){
        if($this->Auth->user('role') > 1){
            if($this->donationLadder->findById($id)){
                $this->set('data', $this->donationLadder->find('first', ['conditions' => ['donationLadder.id' => $id]]));
                if($this->request->is('post')){
                    $this->donationLadder->id = $id;
                    $this->donationLadder->saveField('tokens', $this->request->data['Pages']['tokens_ladder']);
                    $this->donationLadder->saveField('updated', $this->request->data['Pages']['updated']);
                    $this->Session->setFlash('Modification réussie !', 'toastr_success');
                    return $this->redirect($this->referer());
                }
            }
            else{
                $this->Session->setFlash('Ce donateur n\'existe pas !', 'toastr_error');
                return $this->redirect($this->referer());
            }
        }
        else{
			throw new NotFoundException();
		}
    }

	public function admin_delete_donator($id = null){
		if($this->Auth->user('role') > 1){
			if($this->donationLadder->findById($id)){
				$this->donationLadder->delete($id);
				$this->Session->setFlash('Ce donateur a été retiré du classement !', 'toastr_success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_donator', 'admin' => true]);
			}
			else{
				$this->Session->setFlash('Ce dontateur n\'existe pas !', 'toastr_error');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_donator', 'admin' => true]);
			}
		}
		else{
			throw new NotFoundException();			
		}
	}

	public function admin_list_donator(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->donationLadder->find('all', ['order' => ['donationLadder.tokens' => 'DESC']]));
		}
		else{
			throw new NotFoundException();			
		}
	}

	public function admin_stats(){
		if($this->Auth->user('role') > 1){
			$today = date('Y-m-j').' 00:00:00';
			$hier = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$thisWeek = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			// ACHATS
			// Depuis toujours
			$this->set('achatsDepuisToujours', $this->shopHistory->find('count'));
			$this->set('starpassDepuisToujours', $this->starpassHistory->find('count'));
			$this->set('paypalDepuisToujours', $this->paypalHistory->find('count'));
			// Les 7 derniers jours
			$this->set('achatsCetteSemaine', $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $thisWeek]]));
			$this->set('starpassCetteSemaine', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $thisWeek]]));
			$this->set('paypalCetteSemaine', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $thisWeek]]));
			// Ajd
			$this->set('achatsAujourdhui', $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $today]]));
			$this->set('starpassAujourdhui', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $today]]));
			$this->set('paypalAujourdhui', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $today]]));
			// Hier
			$this->set('achatsHier', $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $hier, 'shopHistory.created <' => $today]]));
			$this->set('starpassHier', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $hier, 'starpassHistory.created <' => $today]]));
			$this->set('paypalHier', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $hier, 'paypalHistory.created <' => $today]]));

			// GLOBALES
			// Depuis toujours
			$this->set('utilisateursDepuisToujours', $this->User->find('count'));
			$this->set('ticketsDepuisToujours', $this->Support->find('count'));
			$this->set('reponsesDepuisToujours', $this->supportComments->find('count'));
			// Les 7 derniers jours
			$this->set('utilisateursCetteSemaine', $this->User->find('count', ['conditions' => ['User.created >' => $thisWeek]]));
			$this->set('ticketsCetteSemaine', $this->Support->find('count', ['conditions' => ['Support.created >' => $thisWeek]]));
			$this->set('reponsesCetteSemaine', $this->supportComments->find('count', ['conditions' => ['supportComments.created >' => $thisWeek]]));
			// Ajd
			$this->set('utilisateursAujourdhui', $this->User->find('count', ['conditions' => ['User.created >' => $today]]));
			$this->set('ticketsAujourdhui', $this->Support->find('count', ['conditions' => ['Support.created >' => $today]]));
			$this->set('reponsesAujourdhui', $this->supportComments->find('count', ['conditions' => ['supportComments.created >' => $today]]));
			// Hier
			$this->set('utilisateursHier', $this->User->find('count', ['conditions' => ['User.created >' => $hier, 'User.created <' => $today]]));
			$this->set('ticketsHier', $this->Support->find('count', ['conditions' => ['Support.created >' => $hier, 'Support.created <' => $today]]));
			$this->set('reponsesHier', $this->supportComments->find('count', ['conditions' => ['supportComments.created >' => $hier, 'supportComments.created <' => $today]]));
		}
		elseif($this->Auth->user('role') == 1){
			return $this->redirect(['controller' => 'pages', 'action' => 'manage_tickets']);
		}
		else{
			throw new NotFoundException();
		}
	}

	public function add_ticket(){
		if($this->Auth->user()){
			if($this->request->is('post')){
				if(!empty($this->request->data['Pages']['message'])){
					if($this->request->data['Pages']['type'] == 'report'){
						$reported = $this->request->data['Pages']['report_input'];
						$message = '(Signalement de '.$reported.') '.$this->request->data['Pages']['message'];
					}
					else{
						$message = $this->request->data['Pages']['message'];
					}
					$this->Support->create;
					$this->Support->saveField('user_id', $this->Auth->user('id'));
					$this->Support->saveField('username', $this->Auth->user('username'));
					$this->Support->saveField('type', $this->request->data['Pages']['type']);
					if($this->request->data['Pages']['type'] == 'report'){
						$this->Support->saveField('priority', '2');
					}
					else{
						$this->Support->saveField('priority', $this->request->data['Pages']['priority']);
					}
					$message = nl2br(htmlspecialchars($message));
					$this->Support->saveField('message', $message);
					$this->Support->saveField('resolved', 0);
					$this->Session->setFlash('Votre message a été envoyé au support, merci !', 'success');
					return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
				}
				else{
					$this->Session->setFlash('Vous devez écrire un message', 'error');
					return $this->redirect(['controller' => 'pages', 'action' => 'add_ticket']);
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function list_tickets(){
		if($this->Auth->user()){
			$this->set('data', $this->Support->find('all', ['conditions' => ['Support.user_id' => $this->Auth->user('id')], 'order' => ['Support.created DESC']]));
			$this->set('nbTickets', $this->Support->find('count', ['conditions' => ['Support.user_id' => $this->Auth->user('id')]]));
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function view_ticket($id = null){
		if($this->Auth->user()){
			$ticket = $this->Support->find('first', ['conditions' => ['Support.id' => $id]]);
			$ticket_owner = $ticket['User']['username'];
			if($ticket_owner == $this->Auth->user('username') OR $this->Auth->user('role') > 0){
				if($this->Support->findById($id)){
					$this->set('data', $this->Support->find('first', ['conditions' => ['Support.id' => $id]]));
					$this->set('comments', $this->supportComments->find('all', ['conditions' => ['supportComments.ticket_id' => $id], 'order' => ['supportComments.created DESC']]));
					$this->set('nbComments', $this->supportComments->find('count', ['conditions' => ['supportComments.ticket_id' => $id], 'order' => ['supportComments.created DESC']]));
				}
				else{
					throw new NotFoundException();
				}
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function close_ticket($id = null){
		if($this->Auth->user('role') > 0){
			if($this->Support->find('first', ['conditions' => ['Support.id' => $id]])){
				$this->Support->id = $id;
				$this->Support->saveField('resolved', 1);
				$this->Session->setFlash('Ticket clôturé', 'success');
				return $this->redirect($this->referer());
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function close_my_ticket($id = null){
		if($this->Auth->user()){
            $ticket = $this->Support->find('first', ['conditions' => ['Support.id' => $id]]);
			$ticket_owner = $ticket['User']['username'];
			if($this->Support->find('first', ['conditions' => ['Support.id' => $id]]) && $ticket_owner == $this->Auth->user('username') ){
				$this->Support->id = $id;
				$this->Support->saveField('resolved', 1);
				$this->Session->setFlash('Votre ticket a bien été fermé', 'success');
				return $this->redirect($this->referer());
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function open_ticket($id = null){
		if($this->Auth->user('role') > 0){
			if($this->Support->find('first', ['conditions' => ['Support.id' => $id]])){
				$this->Support->id = $id;
				$this->Support->saveField('resolved', 0);
				$this->Session->setFlash('Ticket ouvert', 'success');
				return $this->redirect($this->referer());
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function answer_ticket($id = null){
		if($this->Auth->user()){
			if($this->request->is('post')){
				if(!empty($this->request->data['Pages']['message'])){
					$ticket = $this->Support->find('first', ['conditions' => ['Support.id' => $this->request->data['Pages']['id']]]);
					$ticket_owner = $this->User->find('first', ['conditions' => ['User.username' => $ticket['User']['username']]]);
					$ticket_owner_email = $ticket_owner['User']['email'];
					//$ticket_owner_allow_email = $ticket_owner['User']['allow_email'];
					if($ticket_owner['User']['username'] == $this->Auth->user('username') OR $this->Auth->user('role') > 0){
						if($ticket['Support']['resolved'] == 0){
							// Si l'utilisateur accepte de recevoir des emails
							// if($ticket_owner_allow_email == 1){
							// 	$name_server = $this->config['name_server'];
							// 	$name_server = strtolower(preg_replace('/\s/', '', $name_server));
							// 	$Email = new CakeEmail();
							// 	$Email->from(array('support@'.$name_server.'.com' => $name_server));
							// 	$Email->to($ticket_owner_email);
							// 	$Email->subject('['.$this->config['name_server'].'] Support, nouvelle réponse à votre ticket #'.$ticket['Support']['id'].'');
							// 	$Email->send('Retrouvez cette nouvelle réponse ici : http://'.$_SERVER['HTTP_HOST'].$this->webroot.'tickets/'.$ticket['Support']['id']);
							// }
							$message = nl2br(htmlspecialchars($message));
							$this->supportComments->create;
							$this->supportComments->saveField('ticket_id', $this->request->data['Pages']['id']);
							$this->supportComments->saveField('user_id', $this->Auth->user('id'));
							$this->supportComments->saveField('message', $message);
							$this->Session->setFlash('Réponse ajoutée !', 'success');
							return $this->redirect($this->referer());
						}
						else{
							$this->Session->setFlash('Ce ticket est fermé...', 'error');
							return $this->redirect($this->referer());
						}
					}
					else{
						$this->Session->setFlash('Action impossible !', 'error');
						return $this->redirect($this->referer());
					}
				}
				else{
					$this->Session->setFlash('Vous devez écrire un message', 'error');
					return $this->redirect($this->referer());
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'add_ticket']);
		}
	}

	public function admin_manage_tickets(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->Support->find('all', ['conditions' => ['Support.resolved' => 0], 'order' => ['Support.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function delete_support_comment($id = null){
		if($this->Auth->user('role') > 0){
			$this->supportComments->delete($id);
			$this->Session->setFlash('Réponse supprimée', 'success');
			return $this->redirect($this->referer());
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_shop_history(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->shopHistory->find('all', ['order' => ['shopHistory.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_starpass_history(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->starpassHistory->find('all', ['order' => ['starpassHistory.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_paypal_history(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->paypalHistory->find('all', ['order' => ['paypalHistory.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add_member(){
		if($this->Auth->user('role') > 1){
			if($this->request->is('post')){
				$dname    = trim($this->request->data['Pages']['dname']);
				$username = trim($this->request->data['Pages']['username']);

				$this->Team->saveField('dname', $dname);
				$this->Team->saveField('username', $username);
				$this->Team->saveField('rank', $this->request->data['Pages']['rank']);
				if(!empty($this->request->data['Pages']['color'])){
					$this->Team->saveField('color', $this->request->data['Pages']['color']);
				}
				else{
					$this->Team->saveField('color', 'light');
				}
				$this->Team->saveField('order', $this->request->data['Pages']['order']);
				$this->Team->saveField('facebook_url', $this->request->data['Pages']['facebook_url']);
				$this->Team->saveField('twitter_url', $this->request->data['Pages']['twitter_url']);
				$this->Team->saveField('youtube_url', $this->request->data['Pages']['youtube_url']);
				$this->Session->setFlash('Membre ajouté à l\'équipe !', 'toastr_success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_list_member(){
		if($this->Auth->user('role') > 1){
			$this->set('data', $this->Team->find('all', array('order' => array('Team.order' => 'ASC'))));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete_member($id = null){
		if($this->Auth->user('role') > 1){
			if($this->Team->findById($id)){
				$this->Team->delete($id);
				$this->Session->setFlash('Membre retiré de l\'équipe !', 'toastr_success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
			}
			else{
				$this->Session->setFlash('Ce membre n\'existe pas !', 'toastr_error');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit_member($id = null){
        if($this->Auth->user('role') > 1){
            if($this->Team->findById($id)){
                $this->set('data', $this->Team->find('first', ['conditions' => ['Team.id' => $id]]));
                if($this->request->is('post')){
                    $this->Team->id = $id;
                    $this->Team->saveField('username', $this->request->data['Pages']['username']);
					$this->Team->saveField('rank', $this->request->data['Pages']['rank']);
					if(!empty($this->request->data['Pages']['color'])){
						$this->Team->saveField('color', $this->request->data['Pages']['color']);
					}
					$this->Team->saveField('order', $this->request->data['Pages']['order']);
					$this->Team->saveField('facebook_url', $this->request->data['Pages']['facebook_url']);
					$this->Team->saveField('twitter_url', $this->request->data['Pages']['twitter_url']);
					$this->Team->saveField('youtube_url', $this->request->data['Pages']['youtube_url']);
                    $this->Session->setFlash('Membre modifié !', 'toastr_success');
                    return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
                }
            }
            else{
                $this->Session->setFlash('Ce membre n\'existe pas !', 'toastr_error');
                return $this->redirect($this->referer());
            }
        }
	else{
			throw new NotFoundException();
		}
    }

	public function team(){
		$this->set('data', $this->Team->find('all', ['order' => ['Team.order ASC']]));
		$this->set('count', $this->Team->find('count'));
	}

	public function contact() {
		if ($this->config['use_contact'] == 1) {
			if ($this->Auth->user()) {
				if ($this->request->is('post')) {
					$contact_email = $this->config['contact_email'];
					$name_server = $this->config['name_server'];
					$username = $this->Auth->user('username');
					$email = $this->Auth->user('email');
					$subject = $this->request->data['Pages']['subject'];
					$message = $this->request->data['Pages']['message'];
					if (!empty($subject) && !empty($message)) {
						$Email = new CakeEmail();
						$Email->from(array($email => $username .' de '.$name_server));
						$Email->to($contact_email);
						$Email->subject($subject);
						$Email->send($username . ' (' . $email . ') a envoyé : ' . $message);
						$this->Session->setFlash('Votre message a été envoyé, merci !', 'success');
					} else {
						$this->Session->setFlash('Tous les champs sont obligatoires', 'error');
					}
				}/* else {
					$this->Session->setFlash('Erreur 1001', 'error');
				}*/
			} else {
				$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
				return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
			}
		} else {
			$this->Session->setFlash('Accès refusé', 'error');
			return $this->redirect(['controller' => 'posts', 'action' => 'index', 'admin' => false]);
		}
	}

    public function cgv(){
		
	}


	public function rules() {
		
	}
}
